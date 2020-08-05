<?php

namespace Vass\RequestPrice\Controller\Adminhtml\Grid;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\View\Result\PageFactory;
use Vass\RequestPrice\Model\Price;

class Save extends Action
{
    protected $model;
    private $pageFactory;
    protected $resultRedirectFactory;

    public function __construct(
        RedirectFactory $redirectFactory,
        Price $affiliateMember,
        PageFactory $pageFactory,
        Action\Context $context
    ) {
        $this->resultRedirectFactory = $redirectFactory;
        $this->model = $affiliateMember;
        $this->pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($data) {
            $id = $this->getRequest()->getParam('entity_id');
            if ($id) {
                $model = $this->model->load($id);
            }
            $model = $this->model->setData($data);
//            $news = $this -> collection -> getItems();
        }

        try {

            $model->save();
            $this->messageManager->addSuccessMessage(__('Price Request Saved Sucessfully'));
            $this->_getSession()->setFormData(false);
            if ($this->getRequest()->getParam('back')) {
                return $resultRedirect->setPath('*/*/edit', ['id' =>$model->getId(), '_current' => true]);
            }
            return $resultRedirect->setPath('*/*/index');
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }

        return $resultRedirect->setPath('*/*/index');
    }
}

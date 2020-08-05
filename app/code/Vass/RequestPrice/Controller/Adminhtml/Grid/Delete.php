<?php

namespace Vass\RequestPrice\Controller\Adminhtml\Grid;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\View\Result\PageFactory;
use Vass\RequestPrice\Model\Price;

class Delete extends Action
{
    protected $model;
    private $pageFactory;
    protected $resultRedirectFactory;
    public function __construct(
        RedirectFactory $redirectFactory,
        Price $price,
        PageFactory $pageFactory,
        Action\Context $context
    ) {
        $this->resultRedirectFactory = $redirectFactory;
        $this->model = $price;
        $this->pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            $model = $this->model;
            $model->load($id);
            try {
                $model->delete();
                $this->messageManager->addSuccessMessage(__('Request Deleted'));
                return $resultRedirect->setPath('*/*/index');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__($e->getMessage()));
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }

        return $resultRedirect->setPath('*/*/index');
    }
}

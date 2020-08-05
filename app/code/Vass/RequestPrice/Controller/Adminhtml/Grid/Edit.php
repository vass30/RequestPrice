<?php

namespace Vass\RequestPrice\Controller\Adminhtml\Grid;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Registry;
use Vass\RequestPrice\Model\Price;

class Edit extends Action
{
    protected $price;

    private $pageFactory;
    protected $registry;

    public function __construct(
        PageFactory $pageFactory,
        Price $price,
        Registry $registry,
        Action\Context $context
    ) {
        $this->price = $price;
        $this->pageFactory = $pageFactory;
        $this->registry = $registry;
        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $model = $this->price;

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This request does not exists'));

                $result = $this->resultRedirectFactory->create();
                return $result->setPath("price/grid/index");
            }
        }

        $data = $this->_getSession()->getFormData(true);

        if (!empty($data)) {
            $model->setData($data);
        }

        $this->registry->register('id', $model);

        $resultPage = $this->pageFactory->create();

        if ($id) {
            $resultPage->getConfig()->getTitle()->prepend('Edit');
        } else {
            $resultPage->getConfig()->getTitle()->prepend('Add');
        }
        return $resultPage;
    }
}

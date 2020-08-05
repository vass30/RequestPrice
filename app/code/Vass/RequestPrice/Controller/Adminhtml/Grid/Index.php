<?php

namespace Vass\RequestPrice\Controller\Adminhtml\Grid;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    protected $_resultPageFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        $this->_resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage =  $this->_resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Request Price'));
        return $resultPage;
    }
}

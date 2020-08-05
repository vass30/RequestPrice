<?php

namespace Vass\RequestPrice\Block;

use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;

class RequestPriceForm extends Template
{
    protected $_registry;

    public function __construct(
        Template\Context $context,
        Registry $registry,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_isScopePrivate = true;
        $this->_registry = $registry;
    }

    public function getFormAction()
    {
        return $this->getUrl('contact/index/post', ['_secure' => true]);
    }

    public function getCurrentProduct()
    {
        return $this->_registry->registry('current_product');
    }
}

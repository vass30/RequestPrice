<?php

namespace Vass\RequestPrice\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Vass\RequestPrice\Model\PriceFactory;

class Index extends Action
{
    protected $priceFactory;
    protected $_registry;

    public function __construct(
        Context $context,
        PriceFactory $priceFactory,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        parent::__construct($context);
        $this->priceFactory=$priceFactory;
        $this->_registry = $registry;
    }


    public function execute()
    {
        $price = $this->priceFactory->create();
        $post = $this->getRequest()->getPostValue();
        $price->addData([
            'name'=> $post ['name'],
            'email'=> $post['email'],
            'telephone'=> $post['telephone'],
            'comment'=> $post['comment'],
            'status'=> 'NEW'

        ]);
        $price->save();
    }
}

<?php
/**
 * @author Korotkij Vasilij <vass.kor@gmail.com>
 */

namespace Vass\RequestPrice\Block;

use VassMagento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\View\Element\Template;

class GetCustomer extends Action
{
    protected $customer;

    public function __construct(
        \Magento\Customer\Model\Session $customer,
        Context $context
    ) {
        $this->customer = $customer;
        parent::__construct($context);
    }
//
    public function yourMethodName()
    {
        $customer = $this -> customer;
        $customerName = $customer -> getName();
        $customerId = $customer -> getCustomer()->getName();
        $customerd = $customer -> getCustomer()->getEmail();
        echo "<pre>";
        var_dump($customerd);
        var_dump($customerId);
        exit();
//        return $customerName;
//        //You will get all basic detail with this $customer object
    }
}

<?php
/**
 * @author Korotkij Vasilij <vass.kor@gmail.com>
 */

namespace Vass\RequestPrice\Controller\Index;

use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class InStock extends Action
{
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * [__construct description]
     * @param Context           $context           [description]
     * @param CollectionFactory $collectionFactory [description]
     */
    public function __construct(
        Context $context,
        CollectionFactory $collectionFactory
    ) {
        $this->productCollection = $collectionFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        /*Get in stock product collection*/
        $collection = $this->productCollection->create()->addFieldToSelect('*')
            ->setFlag('has_stock_status_filter', false)
            ->joinField('stock_item', 'cataloginventory_stock_item', 'is_in_stock', 'product_id=entity_id', 'is_in_stock=0');
        echo "<pre>";
        print_r($collection->getData());
        exit();
    }
}
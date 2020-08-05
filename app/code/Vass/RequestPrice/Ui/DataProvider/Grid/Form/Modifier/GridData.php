<?php

namespace Vass\RequestPrice\Ui\DataProvider\Grid\Form\Modifier;

use Magento\Ui\DataProvider\Modifier\ModifierInterface;
use Vass\RequestPrice\Model\ResourceModel\Price\CollectionFactory;

class GridData implements ModifierInterface
{
    protected $pricecollection;

    public function __construct(CollectionFactory $priceCollectionFactory)
    {
        $this->pricecollection = $priceCollectionFactory->create();
    }
    public function modifyMeta(array $meta)
    {
        return $meta;
    }

    public function modifyData(array $data)
    {
        $price = $this->pricecollection->getItems();
        foreach ($price as $item) {
            $_data = $item->getData();
            $item->setData($_data);
            $data[$item->getId()] = $_data;
        }
        return $data;
    }
}

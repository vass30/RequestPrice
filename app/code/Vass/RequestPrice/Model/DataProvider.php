<?php

namespace Vass\RequestPrice\Model;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Ui\DataProvider\Modifier\ModifierInterface;
use Magento\Ui\DataProvider\Modifier\PoolInterface;
use Magento\Framework\Exception\LocalizedException;
use Vass\RequestPrice\Model\ResourceModel\Price\CollectionFactory;

class DataProvider extends AbstractDataProvider
{

    protected $pool;
    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $newsCollectionFactory
     * @param PoolInterface $pool
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $newsCollectionFactory,
        PoolInterface $pool,
        array $meta = [],
        array $data = []
    ) {
        parent ::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $meta,
            $data
        );
        $this -> collection = $newsCollectionFactory -> create();
        $this -> pool = $pool;
        $this->meta         = $this->prepareMeta($this->meta);
    }

    /**
     * Get data
     *
     * @return array
     * @throws LocalizedException
     */
    public function prepareMeta(array $meta)
    {
        $meta = parent::getMeta();

        /** @var ModifierInterface $modifier */
        foreach ($this->pool->getModifiersInstances() as $modifier) {
            $meta = $modifier->modifyMeta($meta);
        }
        return $meta;
    }

    public function getData()
    {
        /** @var ModifierInterface $modifier */
        foreach ($this -> pool -> getModifiersInstances() as $modifier) {
            $this -> data = $modifier -> modifyData($this -> data);
        }
        return $this -> data;
    }
}

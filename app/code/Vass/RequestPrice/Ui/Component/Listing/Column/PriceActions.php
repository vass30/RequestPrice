<?php

namespace Vass\RequestPrice\Ui\Component\Listing\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class PriceActions extends Column
{
    const URL_PATH_EDIT = 'price/grid/edit';
    const URL_PATH_DELETE = 'price/grid/delete';
    protected $urlBuilder;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->urlBuilder = $urlBuilder;
    }

    public function prepareDataSource(array $dataSource): ?array
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource ['data']['items'] as &$item) {
                $item[$this
                    -> getData('name')]['edit'] = ['href' => $this -> urlBuilder
                        -> getUrl(static::URL_PATH_EDIT, ['id' => $item['entity_id']]) , 'label' => __('Edit') , 'hidden'
                => false];

                $item[$this
                    -> getData('name')]['delete'] = ['href' => $this -> urlBuilder
                        -> getUrl(static::URL_PATH_DELETE, ['id' => $item['entity_id']]) , 'label' => __('Delete') , 'hidden'
                => false];
            }
        }
        return $dataSource;
    }
}

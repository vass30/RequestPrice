<?php

namespace Vass\RequestPrice\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Price extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('price_request', 'entity_id');
    }
}

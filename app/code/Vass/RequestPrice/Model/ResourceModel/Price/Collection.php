<?php
/**
 * @author Korotkij Vasilij <vass.kor@gmail.com>
 */

namespace Vass\RequestPrice\Model\ResourceModel\Price;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Vass\RequestPrice\Model\Price;
use Vass\RequestPrice\Model\ResourceModel\Price as PriceResource;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'entity_id';

    public function _construct()
    {
        parent::_construct();
        $this->_init(Price::class, PriceResource::class);
    }
}

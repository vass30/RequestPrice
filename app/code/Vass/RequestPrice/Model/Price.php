<?php
/**
 * @author Korotkij Vasilij <vass.kor@gmail.com>
 */

namespace Vass\RequestPrice\Model;

use Magento\Framework\Model\AbstractModel;

class Price extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel\Price::class);
    }
}


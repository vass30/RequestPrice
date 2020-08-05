<?php

namespace Vass\RequestPrice\Block\Adminhtml\Grid\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class SaveButton extends GenericButton implements ButtonProviderInterface
{
    public function getButtonData(): ?array
    {
        return ['label' => __('Save Request Price') , 'class' => 'save primary' , 'sort_order' => 50];
    }
}

<?php

namespace Vass\RequestPrice\Block\Adminhtml\Grid\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class SaveAndContinueButton extends GenericButton implements ButtonProviderInterface
{
    public function getButtonData(): ?array
    {
        return ['label' => __('Save And Continue') , 'class' => 'save' , 'sort_order' => 40];
    }
}

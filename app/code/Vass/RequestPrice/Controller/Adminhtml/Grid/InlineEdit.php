<?php

namespace Vass\RequestPrice\Controller\Adminhtml\Grid;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\Result\JsonFactory;
use Vass\RequestPrice\Model\Price;

class InlineEdit extends Action
{
    private $price;

    private $jsonFactory;

    public function __construct(
        Action\Context $context,
        Price $price,
        JsonFactory $jsonFactory
    ) {
        parent ::__construct($context);
        $this -> price = $price;
        $this -> jsonFactory = $jsonFactory;
    }

    public function execute()
    {
        $resultJson = $this -> jsonFactory -> create();
        $error = false;
        $message = [];
        if ($this -> getRequest() -> getParam('isAjax')) {
            $postItems = $this -> getRequest() -> getParam('items', []);

            if (!count($postItems)) {
                $message[] = __('Please correct data sent!');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $modelId) {
                    $model = $this -> price -> load($modelId);
                    try {
                        $model -> setData(array_merge($model -> getData(), $postItems[$modelId]));
                        $model -> save();
                    } catch (\Exception $e) {
                        $message[] = $e -> getMessage();
                        $error = true;
                    }
                }
            }
        }
        return $resultJson -> setData(['messages' => $message , 'error' => $error]);
    }
}

<?php


namespace Codilar\Vendor\Block\Vendor;

use Magento\CatalogRule\Block\Adminhtml\Edit\GenericButton;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class SaveBtn
 * @package Codilar\Vendor\Block\Vendor
 * provides Frontend Data for Save Button like href,label,class and etc., */
class SaveBtn extends GenericButton implements ButtonProviderInterface
{

    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Save'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => [
                    'buttonAdapter' => [
                        'actions' => [
                            [
                                'targetName' => 'template_add_ui.template_add_ui',
                                'params' => [
                                    false
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }
}

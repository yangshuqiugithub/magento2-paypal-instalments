<?php
namespace Iways\PayPalInstalments\Block\Sales\Creditmemo;

/**
 * Class Totals
 * @package Iways_PayPalInstalments
 */
class Totals extends \Iways\PayPalInstalments\Block\Sales\Totals
{
    protected function getSource()
    {
        return parent::getSource()->getOrder();
    }
}

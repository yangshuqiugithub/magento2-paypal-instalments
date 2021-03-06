<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Iways\PayPalInstalments\Block\Instalments;

use Magento\Framework\Pricing\PriceCurrencyInterface;
use Magento\Quote\Model\Quote\Address\Rate;

/**
 * Paypal Express Onepage checkout block
 *
 * @api
 * @author      Magento Core Team <core@magentocommerce.com>
 * @since 100.0.2
 */
class Review extends \Magento\Paypal\Block\Express\Review
{
    /**
     * Paypal controller path
     *
     * @var string
     */
    protected $_controllerPath = 'instalments/instalments';

    /**
     * Wrapper for getting instalments infos from payment additional information
     *
     * @return string
     */
    public function getInstalmentInfo($key)
    {
        return $this->_quote->getPayment()->getAdditionalInformation('instalments_' . $key);
    }

    public function formatPrice($price)
    {
        return $this->_formatPrice($price);
    }
}

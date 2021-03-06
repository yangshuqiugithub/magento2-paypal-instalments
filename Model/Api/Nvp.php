<?php
/**
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com and you will be sent a copy immediately.
 *
 * Created on 02.03.2015
 * Author Robert Hillebrand - hillebrand@i-ways.de - i-ways sales solutions GmbH
 * Copyright i-ways sales solutions GmbH © 2015. All Rights Reserved.
 * License http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 *
 */
namespace Iways\PayPalInstalments\Model\Api;
use Iways\PayPalInstalments\Model\Cart;

/**
 * Iways PayPalInstalments Model Api Nvp
 *
 * @category   Iways
 * @package    Iways_PayPalInstalments
 * @author robert
 */
class Nvp extends \Magento\Paypal\Model\Api\Nvp
{
    /**
     * Global public interface map
     *
     * @var array
     */
    protected $_globalMap = [
        // each call
        'VERSION' => 'version',
        'USER' => 'api_username',
        'PWD' => 'api_password',
        'SIGNATURE' => 'api_signature',
        'BUTTONSOURCE' => 'build_notation_code',

        // for Unilateral payments
        'SUBJECT' => 'business_account',

        // commands
        'PAYMENTACTION' => 'payment_action',
        'RETURNURL' => 'return_url',
        'CANCELURL' => 'cancel_url',
        'INVNUM' => 'inv_num',
        'TOKEN' => 'token',
        'CORRELATIONID' => 'correlation_id',
        'SOLUTIONTYPE' => 'solution_type',
        'GIROPAYCANCELURL' => 'giropay_cancel_url',
        'GIROPAYSUCCESSURL' => 'giropay_success_url',
        'BANKTXNPENDINGURL' => 'giropay_bank_txn_pending_url',
        'IPADDRESS' => 'ip_address',
        'NOTIFYURL' => 'notify_url',
        'RETURNFMFDETAILS' => 'fraud_management_filters_enabled',
        'NOTE' => 'note',
        'REFUNDTYPE' => 'refund_type',
        'ACTION' => 'action',
        'REDIRECTREQUIRED' => 'redirect_required',
        'SUCCESSPAGEREDIRECTREQUESTED' => 'redirect_requested',
        'REQBILLINGADDRESS' => 'require_billing_address',
        // style settings
        'PAGESTYLE' => 'page_style',
        'HDRIMG' => 'hdrimg',
        'HDRBORDERCOLOR' => 'hdrbordercolor',
        'HDRBACKCOLOR' => 'hdrbackcolor',
        'PAYFLOWCOLOR' => 'payflowcolor',
        'LOCALECODE' => 'locale_code',
        'PAL' => 'pal',
        'USERSELECTEDFUNDINGSOURCE' => 'funding_source',

        // transaction info
        'TRANSACTIONID' => 'transaction_id',
        'AUTHORIZATIONID' => 'authorization_id',
        'REFUNDTRANSACTIONID' => 'refund_transaction_id',
        'COMPLETETYPE' => 'complete_type',
        'AMT' => 'amount',
        'ITEMAMT' => 'subtotal_amount',
        'GROSSREFUNDAMT' => 'refunded_amount', // possible mistake, check with API reference

        // payment/billing info
        'CURRENCYCODE' => 'currency_code',
        'PAYMENTSTATUS' => 'payment_status',
        'PENDINGREASON' => 'pending_reason',
        'PROTECTIONELIGIBILITY' => 'protection_eligibility',
        'PAYERID' => 'payer_id',
        'PAYERSTATUS' => 'payer_status',
        'ADDRESSID' => 'address_id',
        'ADDRESSSTATUS' => 'address_status',
        'EMAIL' => 'email',

        // backwards compatibility
        'FIRSTNAME' => 'firstname',
        'LASTNAME' => 'lastname',

        // shipping rate
        'SHIPPINGOPTIONNAME' => 'shipping_rate_code',
        'NOSHIPPING' => 'suppress_shipping',

        // paypal direct credit card information
        'CREDITCARDTYPE' => 'credit_card_type',
        'ACCT' => 'credit_card_number',
        'EXPDATE' => 'credit_card_expiration_date',
        'CVV2' => 'credit_card_cvv2',
        'STARTDATE' => 'maestro_solo_issue_date',
        'ISSUENUMBER' => 'maestro_solo_issue_number',
        'CVV2MATCH' => 'cvv2_check_result',
        'AVSCODE' => 'avs_result',

        'SHIPPINGAMT' => 'shipping_amount',
        'TAXAMT' => 'tax_amount',
        'INITAMT' => 'init_amount',
        'STATUS' => 'status',

        //Next two fields are used for Brazil only
        'TAXID' => 'buyer_tax_id',
        'TAXIDTYPE' => 'buyer_tax_id_type',

        'BILLINGAGREEMENTID' => 'billing_agreement_id',
        'REFERENCEID' => 'reference_id',
        'BILLINGAGREEMENTSTATUS' => 'billing_agreement_status',
        'BILLINGTYPE' => 'billing_type',
        'SREET' => 'street',
        'CITY' => 'city',
        'STATE' => 'state',
        'COUNTRYCODE' => 'countrycode',
        'ZIP' => 'zip',
        'PAYERBUSINESS' => 'payer_business',
        // Finance nodes
        'PAYMENTINFO_0_FINANCINGFEEAMT' => 'instalments_fee_amt',
        'PAYMENTINFO_0_FINANCINGTOTALCOST' => 'instalments_total_cost',
        'PAYMENTINFO_0_FINANCINGTERM' => 'instalments_term',
        'PAYMENTINFO_0_FINANCINGMONTHLYPAYMENT' => 'instalments_monthly_payment',
        'PAYMENTINFO_0_ISFINANCING' => 'instalments_is_financing',
        'PAYMENTINFO_0_CURRENCYCODE' => 'currency_code'
    ];

    /**
     * Payment information response specifically to be collected after some requests
     * @var array
     */
    protected $_paymentInformationResponse = array(
        'PAYERID', 'PAYERSTATUS', 'CORRELATIONID', 'ADDRESSID', 'ADDRESSSTATUS',
        'PAYMENTSTATUS', 'PENDINGREASON', 'PROTECTIONELIGIBILITY', 'EMAIL', 'SHIPPINGOPTIONNAME', 'TAXID', 'TAXIDTYPE',
        'PAYMENTINFO_0_FINANCINGFEEAMT', 'PAYMENTINFO_0_FINANCINGTOTALCOST', 'PAYMENTINFO_0_FINANCINGTERM', 'PAYMENTINFO_0_FINANCINGMONTHLYPAYMENT',
        'PAYMENTINFO_0_ISFINANCING', 'PAYMENTINFO_0_CURRENCYCODE'
    );

    /**
     * Return Paypal Api version
     *
     * @return string
     */
    public function getVersion()
    {
        return '124.0';
    }

    /**
     * SetExpressCheckout call
     *
     * TODO: put together style and giropay settings
     *
     * @return void
     * @link https://cms.paypal.com/us/cgi-bin/?&cmd=_render-content&content_ID=developer/e_howto_api_nvp_r_SetExpressCheckout
     */
    public function callSetExpressCheckout()
    {
        $this->_prepareExpressCheckoutCallRequest($this->_setExpressCheckoutRequest);
        $request = $this->_exportToRequest($this->_setExpressCheckoutRequest);
        $this->_exportLineItems($request);
        // import/suppress shipping address, if any
        $options = $this->getShippingOptions();
        if ($this->getAddress()) {
            $request = $this->_importAddresses($request);
            $request['ADDROVERRIDE'] = 1;
        } elseif ($options && count($options) <= 10) {
            // doesn't support more than 10 shipping options
            $request['CALLBACK'] = $this->getShippingOptionsCallbackUrl();
            $request['CALLBACKTIMEOUT'] = 6;
            // max value
            $request['MAXAMT'] = $request['AMT'] + 999.00;
            // it is impossible to calculate max amount
            $this->_exportShippingOptions($request);
        }
        $request['USERSELECTEDFUNDINGSOURCE'] = 'Finance';
        $request['LANDINGPAGE'] = 'Billing';
        $request['LOCALECODE'] = 'DE';

        $response = $this->call(self::SET_EXPRESS_CHECKOUT, $request);
        $this->_importFromResponse($this->_setExpressCheckoutResponse, $response);
    }

    /**
     * DoExpressCheckout call
     * @link https://cms.paypal.com/us/cgi-bin/?&cmd=_render-content&content_ID=developer/e_howto_api_nvp_r_DoExpressCheckoutPayment
     */
    public function callDoExpressCheckoutPayment()
    {
        $this->_prepareExpressCheckoutCallRequest($this->_doExpressCheckoutPaymentRequest);
        $request = $this->_exportToRequest($this->_doExpressCheckoutPaymentRequest);
//        $installmentsFeeAmt = $this->_cart->getSalesEntity()->getPayment()->getAdditionalInformation('instalments_fee_amt');
//        if($installmentsFeeAmt) {
//            $request['AMT'] = (float)$request['AMT'] - (float) $installmentsFeeAmt;
//        }
        $response = $this->call(self::DO_EXPRESS_CHECKOUT_PAYMENT, $request);
        $this->_importFromResponse($this->_paymentInformationResponse, $response);
        $this->_importFromResponse($this->_doExpressCheckoutPaymentResponse, $response);
    }
}
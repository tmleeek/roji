<?php
/**
 * Mirasvit
 *
 * This source file is subject to the Mirasvit Software License, which is available at http://mirasvit.com/license/.
 * Do not edit or add to this file if you wish to upgrade the to newer versions in the future.
 * If you wish to customize this module for your needs.
 * Please refer to http://www.magentocommerce.com for more information.
 *
 * @category  Mirasvit
 * @package   Follow Up Email
 * @version   1.1.3
 * @build     735
 * @copyright Copyright (C) 2016 Mirasvit (http://mirasvit.com/)
 */



class Mirasvit_Email_Model_Rule_Condition_Billing extends Mirasvit_Email_Model_Rule_Condition_Abstract
{
    public function loadAttributeOptions()
    {
        $attributes = array(
            'country_id' => Mage::helper('email')->__('Billing: Country'),
            'city' => Mage::helper('email')->__('Billing: City'),
            'region_id' => Mage::helper('email')->__('Billing: State/Province'),
            'region' => Mage::helper('email')->__('Billing: Region'),
            'postcode' => Mage::helper('email')->__('Billing: Postcode'),
            'company' => Mage::helper('email')->__('Billing: Company'),
        );

        asort($attributes);
        $this->setAttributeOption($attributes);

        return $this;
    }

    public function getInputType()
    {
        $type = 'string';
        switch ($this->getAttribute()) {
            case 'country_id':
            case 'region_id':
                $type = 'select';
                break;
        }

        return $type;
    }

    public function getValueElementType()
    {
        $type = 'text';
        switch ($this->getAttribute()) {
            case 'country_id':
            case 'region_id':
                $type = 'select';
                break;
        }

        return $type;
    }

    public function getValueSelectOptions()
    {
        if (!$this->hasData('value_select_options')) {
            switch ($this->getAttribute()) {
                case 'country_id':
                    $options = Mage::getModel('adminhtml/system_config_source_country')
                        ->toOptionArray();
                    break;

                case 'region_id':
                    $options = Mage::getModel('adminhtml/system_config_source_allregion')
                        ->toOptionArray();
                    break;

                default:
                    $options = array();
            }
            $this->setData('value_select_options', $options);
        }

        return $this->getData('value_select_options');
    }

    public function validate(Varien_Object $object)
    {
        $attrCode = $this->getAttribute();
        $value = null;

        if ($object->hasData('order_id')) {
            $order = Mage::getModel('sales/order')->load($object->getOrderId());
            $address = $order->getBillingAddress();
        } elseif ($object->hasData('quote_id')) {
            $quote = Mage::getModel('sales/quote')->load($object->getQuoteId());
            $address = $quote->getBillingAddress();
        } elseif ($object->hasData('customer_id')) {
            $customer = Mage::getModel('customer/customer')->load($object->getCustomerId());
            $address = Mage::getModel('customer/address')->load($customer->getDefaultBilling());
        }

        if (isset($address) && $address && $address->getId()) {
            $value = $address->getData($attrCode);
        }

        return parent::validateAttribute($value);
    }
}

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



class Mirasvit_Email_Model_Event_Customer_Groupchanged extends Mirasvit_Email_Model_Event_Abstract
{
    const EVENT_CODE = 'customer_groupchanged';

    public function getEventsGroup()
    {
        return Mage::helper('email')->__('Customer');
    }

    public function getEvents()
    {
        $result = array();

        $result[self::EVENT_CODE] = Mage::helper('email')->__('Change group');

        return $result;
    }

    public function findEvents($eventCode, $from)
    {
        return array();
    }

    protected function observe($eventCode, $observer)
    {
        $customer = $observer->getEvent()->getCustomer();
        $event = array(
            'time' => strtotime($customer->getUpdatedAt()),
            'customer_email' => $customer->getEmail(),
            'customer_name' => $customer->getName(),
            'customer_id' => $customer->getId(),
            'store_id' => $this->getCustomerStoreId($customer),
            'expire_after' => 300,
        );

        return array($event);
    }

    /**
     * Get customer's store ID
     *
     * @param Mage_Core_Model_Abstract $customer
     *
     * @return int
     */
    private function getCustomerStoreId(Mage_Core_Model_Abstract $customer)
    {
        $storeId = $customer->getStoreId();
        if (!$storeId) {
            $storeId = Mage::app()->getWebsite($customer->getWebsiteId())->getDefaultStore()->getId();
        }

        return $storeId;
    }
}

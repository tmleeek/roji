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



class Mirasvit_Email_Model_Resource_Unsubscription_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('email/unsubscription');
    }

    /**
     * Filter unsubscriptions by trigger.
     *
     * @param int|Mirasvit_Email_Model_Trigger $trigger
     *
     * @return $this
     */
    public function addTriggerToFilter($trigger)
    {
        if ($trigger instanceof Mirasvit_Email_Model_Trigger) {
            $trigger = $trigger->getId();
        }

        $this->addFieldToFilter('trigger_id', $trigger);

        return $this;
    }
}

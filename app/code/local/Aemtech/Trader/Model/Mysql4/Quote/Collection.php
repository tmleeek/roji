<?php

class Aemtech_Trader_Model_Mysql4_Quote_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('trader/quote');
    }
}
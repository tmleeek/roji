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
 * @version   1.1.34
 * @build     851
 * @copyright Copyright (C) 2017 Mirasvit (http://mirasvit.com/)
 */



class Mirasvit_Email_Helper_Variables_Coupon
{
    protected $_coupons = array();

    public function getCoupon($parent, $args)
    {
        if ($parent->getPreview()) {
            // in previem mode, we create fake coupon
            $expirationDate = time() + rand(1, 30) * 24 * 60 * 60;

            $coupon = Mage::getModel('salesrule/coupon');
            $coupon->setCode('EML#####')
                ->setExpirationDate(date(DateTime::ISO8601, $expirationDate))
                ->setType(1);

            return $coupon;
        } elseif ($parent->getChain()) {
            $chain = $parent->getChain();

            # if we already generated coupon for this chain and queue
            if (isset($this->_coupons[$this->getCouponKey($parent)])) {
                return $this->_coupons[$this->getCouponKey($parent)];
            }

            if ($chain->getCouponEnabled()) {
                $rule = Mage::getModel('salesrule/rule')->load($chain->getCouponSalesRuleId());

                if ($rule->getId()) {
                    $generator = Mage::getSingleton('salesrule/coupon_codegenerator', array('length' => 5));
                    $rule->setCouponCodeGenerator($generator);
                    $code = 'EML'.$rule->getCouponCodeGenerator()->generateCode();

                    $expirationDate = false;
                    if ($chain->getCouponExpiresDays()) {
                        $expirationDate = time() + $chain->getCouponExpiresDays() * 24 * 60 * 60;
                    }

                    $coupon = Mage::getModel('salesrule/coupon');
                    $coupon->setRule($rule)
                        ->setCode($code)
                        ->setIsPrimary(false)
                        ->setUsageLimit(1)
                        ->setUsagePerCustomer(1)
                        ->setExpirationDate(date(DateTime::ISO8601, $expirationDate))
                        ->setType(1)
                        ->save();

                    $this->_coupons[$this->getCouponKey($parent)] = $coupon;

                    return $coupon;
                }
            }
        }

        return false;
    }

    /**
     * Coupon code key consists of chain and queue IDs.
     *
     * @param array $parent
     *
     * @return string
     */
    private function getCouponKey($parent)
    {
        return $parent->getChain()->getId().'_'.$parent->getQueue()->getId();
    }

    public function getCouponExpiryDate($parent, $args)
    {
        $date = null;

        if ($parent->getPreview()) {
            $date = now(true);
        } elseif ($parent->getChain()) {
            $expirationDate = 100000;
            if ($parent->getChain()->getCouponExpiresDays()) {
                $expirationDate = time() + $parent->getChain()->getCouponExpiresDays() * 24 * 60 * 60;
            }
            $date = date('Y-m-d', $expirationDate);
        }

        return $date;
    }
}

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



class Mirasvit_EmailDesign_Helper_Variables_Price
{
    public function getFormattedPrice($parent, $args)
    {
        if (isset($args[0]) && floatval($args[0]) > 0) {
            return $parent->getStore()->formatPrice($args[0], false);
        }
    }
}

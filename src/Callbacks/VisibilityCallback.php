<?php

/**
 * TechDivision\Import\Product\Callbacks\VisibilityCallback
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * PHP version 5
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2016 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import-product
 * @link      http://www.techdivision.com
 */

namespace TechDivision\Import\Product\Callbacks;

/**
 * A callback implementation that converts the passed visibility.
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2016 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import-product
 * @link      http://www.techdivision.com
 */
class VisibilityCallback extends AbstractProductImportCallback
{

    /**
     * Will be invoked by a observer it has been registered for.
     *
     * @param mixed $value The value to handle
     *
     * @return mixed The modified value
     * @see \TechDivision\Import\Product\Callbacks\ProductImportCallbackInterface::handle()
     */
    public function handle($value)
    {
        return $this->getSubject()->getVisibilityIdByValue($value);
    }
}

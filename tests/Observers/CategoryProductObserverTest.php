<?php

/**
 * TechDivision\Import\Product\Observers\CategoryProductObserverTest
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

namespace TechDivision\Import\Product\Observers;

use TechDivision\Import\Product\Utils\ColumnKeys;

/**
 * Test class for the product category observer implementation.
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2016 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import-product
 * @link      http://www.techdivision.com
 */
class CategoryProductObserverTest extends \PHPUnit_Framework_TestCase
{

    /**
     * The observer we want to test.
     *
     * @var \TechDivision\Import\Product\Observers\CategoryProductObserver
     */
    protected $observer;

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     * @see \PHPUnit_Framework_TestCase::setUp()
     */
    protected function setUp()
    {
        $this->observer = new CategoryProductObserver();
    }

    /**
     * Test's the handle() method with an empty value.
     *
     * @return void
     */
    public function testHandleWithEmptyValue()
    {

        // create a dummy CSV file row
        $headers = array(
            ColumnKeys::SKU             => 0,
            ColumnKeys::CATEGORIES      => 1
        );

        // create a dummy CSV file header
        $row = array(
            0 => 'TEST-01',
            1 => null
        );

        // create a mock subject
        $mockSubject = $this->getMockBuilder('TechDivision\Import\Product\Subjects\BunchSubject')
                            ->setMethods(
                                array(
                                    'hasHeader',
                                    'getHeader',
                                    'getHeaders',
                                    'getLastSku',
                                    'getLastEntityId'
                                )
                            )
                            ->getMock();
        $mockSubject->expects($this->any())
                    ->method('getHeaders')
                    ->willReturn($headers);
        $mockSubject->expects($this->any())
                    ->method('hasHeader')
                    ->willReturn(true);
        $mockSubject->expects($this->any())
                    ->method('getHeader')
                    ->withConsecutive(array(ColumnKeys::SKU), array(ColumnKeys::CATEGORIES))
                    ->willReturnOnConsecutiveCalls(0, 1);
        $mockSubject->expects($this->once())
                    ->method('getLastSku')
                    ->willReturn('TEST-02');
        $mockSubject->expects($this->never())
                    ->method('getLastEntityId');

        // inject the subject und invoke the handle() method
        $this->observer->setSubject($mockSubject);
        $this->assertSame($row, $this->observer->handle($row));
    }
}

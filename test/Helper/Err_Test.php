<?php

/**
 * Copyright 2015 Rafal Zajac <rzajac@gmail.com>.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */
namespace Kicaj\Test\Tools\Helper;

use Kicaj\Tools\Helper\Err;
use stdClass;

/**
 * Class Err_Test.
 *
 * @coversDefaultClass Kicaj\Tools\Helper\Err
 *
 * @author             Rafal Zajac <rzajac@gmail.com>
 */
class Err_Test extends \PHPUnit_Framework_TestCase
{
    /**
     * Original error handler.
     *
     * @var mixed
     */
    protected $origHandler;

    /**
     * Original error reporting.
     *
     * @var int
     */
    protected $origErrorReporting;

    protected function setUp()
    {
        // Get current error handler
        $this->origHandler = set_error_handler('var_dump');
        set_error_handler($this->origHandler);

        $this->origErrorReporting = error_reporting(0);
        error_reporting($this->origErrorReporting);
    }

    protected function tearDown()
    {
        set_error_handler($this->origHandler);
        error_reporting($this->origErrorReporting);
    }

    /**
     * @covers ::getCurrentErrorHandler
     */
    public function test_getCurrentErrorHandler()
    {
        $this->assertSame($this->origHandler, Err::getCurrentErrorHandler());
    }

    /**
     * @covers ::errToException
     */
    public function test_errToException_returns_previous_handler()
    {
        // When
        $prevHandler = Err::errToException();

        // Then
        $this->assertSame($this->origHandler, $prevHandler);
    }

    /**
     * @covers ::errToException
     *
     * @expectedException \Exception
     * @expectedExceptionMessage Undefined property: stdClass::$test
     */
    public function test_errToException()
    {
        // When
        Err::errToException();

        // Then
        $o = new stdClass();
        $o->test;
    }

    /**
     * @covers ::errToException
     */
    public function test_errToException_noError()
    {
        // Given
        $o = null;

        // When
        Err::errToException();
        error_reporting(0);

        // Then
        try {
            $o = new stdClass();
            $o->test;
        } catch (\Exception $e) {
            $this->fail('We should get no error.');
        }

        $this->assertNotNull($o);
    }

    /**
     * @covers ::errToException
     */
    public function test_errToException_to_default()
    {
        // Given
        Err::errToException();

        // When
        Err::errToException(false);

        // Then
        $this->assertSame(null, Err::getCurrentErrorHandler());
    }

    /**
     * @covers ::restoreHandler
     */
    public function test_restoreHandler()
    {
        // Given
        Err::errToException();

        // When
        Err::restoreHandler($this->origHandler);

        // Then
        $this->assertSame($this->origHandler, Err::getCurrentErrorHandler());
    }

    /**
     * @covers ::restoreHandler
     */
    public function test_restoreHandler_to_orig()
    {
        // When
        Err::restoreHandler(null);

        // Then
        $this->assertSame(null, Err::getCurrentErrorHandler());
    }
}

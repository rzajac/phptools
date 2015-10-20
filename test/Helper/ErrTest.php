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
 * Class ErrTest.
 *
 * @coversDefaultClass Kicaj\Tools\Helper\Err
 *
 * @author Rafal Zajac <rzajac@gmail.com>
 */
class ErrTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Previous error handler.
     *
     * @var mixed
     */
    protected $prevHandler = null;

    protected function tearDown()
    {
        if ($this->prevHandler !== null) {
            set_error_handler($this->prevHandler);
        }
    }

    /**
     * @covers ::errToException
     *
     * @expectedException \Exception
     * @expectedExceptionMessage Undefined property: stdClass::$test
     */
    public function test_errToException()
    {
        $currentHandler = Err::getCurrentErrorHandler();
        $this->prevHandler = Err::errToException();

        // Assert getCurrentErrorHandler returned current handler
        $this->assertSame($currentHandler, $this->prevHandler);

        // This is actual test
        $o = new stdClass();
        $o->test;
    }

    /**
     * @covers ::restoreHandler
     */
    public function test_restoreHandler()
    {
        $currentHandler = Err::getCurrentErrorHandler();
        $this->prevHandler = Err::errToException();

        Err::restoreHandler($this->prevHandler);
        $this->assertSame($currentHandler, Err::getCurrentErrorHandler());
    }

    /**
     * @covers ::getCurrentErrorHandler
     */
    public function test_getCurrentErrorHandler()
    {
        $this->prevHandler = Err::errToException();
        $this->assertNotNull(Err::getCurrentErrorHandler());
    }
}

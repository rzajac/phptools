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

use Kicaj\Tools\Helper\Debug;

/**
 * Class Debug_Test.
 *
 * @coversDefaultClass Kicaj\Tools\Helper\Debug
 *
 * @author Rafal Zajac <rzajac@gmail.com>
 */
class Debug_Test extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::getCallStack
     */
    public function test_getCallStack_true()
    {
        // When
        $stack = Debug::getCallStack(true);

        // Then
        $this->assertTrue(is_array($stack));
        $this->assertTrue(strpos($stack[0], 'Debug_Test.php:getCallStack') !== false);
    }

    /**
     * @covers ::getCallStack
     */
    public function test_getCallStack_false()
    {
        // When
        $stack = Debug::getCallStack();

        // Then
        $this->assertTrue(is_string($stack));
    }
}

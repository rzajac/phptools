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
namespace Kicaj\Test\PhpTools;

use Kicaj\Tools\NotImplementedException;

/**
 * NotImplementedException_Test.
 *
 * @coversDefaultClass \Kicaj\Tools\NotImplementedException
 *
 * @author Rafal Zajac <rzajac@gmail.com>
 */
class NotImplementedException_Test extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getUserMessage
     * @covers ::getErrorCode
     */
    public function test___construct_EC_CODE_and_message()
    {
        $e = new NotImplementedException();
        $this->assertSame('not implemented', $e->getUserMessage());
        $this->assertSame('EC_NOT_IMPLEMENTED', $e->getErrorCode());
        $this->assertSame(0, $e->getCode());
    }

    /**
     * @covers ::__construct
     * @covers ::getUserMessage
     * @covers ::getErrorCode
     */
    public function test___construct_EC_CODE_and_message_custom()
    {
        $e = new NotImplementedException('custom msg', 'EC_CUSTOM');
        $this->assertSame('custom msg', $e->getUserMessage());
        $this->assertSame('EC_CUSTOM', $e->getErrorCode());
        $this->assertSame(0, $e->getCode());
    }
}

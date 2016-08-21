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
namespace Kicaj\Test\Tools;

use Kicaj\Tools\Exception;

/**
 * Class Exception_Test.
 *
 * @coversDefaultClass Kicaj\Tools\Exception
 *
 * @author             Rafal Zajac <rzajac@gmail.com>
 */
class Exception_Test extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getUserMessage
     * @covers ::getErrorCode
     */
    public function test___construct_simple_message()
    {
        // When
        $e = new Exception('error message');

        // Then
        $this->assertSame('error message', $e->getUserMessage());
        $this->assertSame('EC_UNKNOWN', $e->getErrorCode());
        $this->assertSame(0, $e->getCode());
    }

    /**
     * @covers ::__construct
     * @covers ::getUserMessage
     * @covers ::getErrorCode
     */
    public function test___construct_no_message()
    {
        // When
        $e = new Exception('');

        // Then
        $this->assertSame('EC_UNKNOWN', $e->getUserMessage());
        $this->assertSame('EC_UNKNOWN', $e->getErrorCode());
        $this->assertSame(0, $e->getCode());
    }

    /**
     * @covers ::__construct
     * @covers ::getUserMessage
     * @covers ::getErrorCode
     */
    public function test___construct_EC_CODE()
    {
        // When
        $e = new Exception('EC_SOME_ERROR');

        // Then
        $this->assertSame('EC_SOME_ERROR', $e->getUserMessage());
        $this->assertSame('EC_SOME_ERROR', $e->getErrorCode());
        $this->assertSame(0, $e->getCode());
    }

    /**
     * @covers ::__construct
     * @covers ::getUserMessage
     * @covers ::getErrorCode
     */
    public function test___construct_EC_CODE_and_message()
    {
        // When
        $e = new Exception('my message', 'EC_MY_ERROR');

        // Then
        $this->assertSame('my message', $e->getUserMessage());
        $this->assertSame('EC_MY_ERROR', $e->getErrorCode());
        $this->assertSame(0, $e->getCode());
    }

    /**
     * @covers ::makeFromException
     */
    public function test_makeFromException()
    {
        // When
        $e = new \Exception('ex message', 123);
        $apiEx = Exception::makeFromException($e);

        // Then
        $this->assertSame('ex message', $apiEx->getUserMessage());
        $this->assertSame(123, $apiEx->getErrorCode());
        $this->assertSame(123, $apiEx->getCode());
    }

    /**
     * @covers ::makeFromException
     */
    public function test_makeFromException_override_code()
    {
        // When
        $e = new \Exception('ex message', 123);
        $apiEx = Exception::makeFromException($e, 345);

        // Then
        $this->assertSame('ex message', $apiEx->getUserMessage());
        $this->assertSame(345, $apiEx->getErrorCode());
        $this->assertSame(345, $apiEx->getCode());
        $this->assertSame(123, $apiEx->getPrevious()->getCode());
    }

    /**
     * @covers ::makeFromException
     */
    public function test_makeFromException_return_if_already_instance_of_self()
    {
        // When
        $e = new \Exception('ex message', 123);
        $apiEx = Exception::makeFromException($e);
        $apiEx2 = Exception::makeFromException($apiEx);

        // Then
        $this->assertSame($apiEx, $apiEx2);
    }

    /**
     * @covers ::jsonSerialize
     */
    public function test_jsonSerialize()
    {
        // When
        $e = new Exception('my message', 'EC_MY_ERROR');
        $std = $e->jsonSerialize();

        // Then
        $this->assertInstanceOf('stdClass', $std);
        $exp = ['code' => 'EC_MY_ERROR', 'message' => 'my message'];
        $this->assertSame($exp, (array)$exp);
    }

    /**
     * @covers ::spf
     */
    public function test_spf()
    {
        // When
        $e = Exception::spf('Something %s created %d errors.', 'awful', 666);

        // Then
        $this->assertSame('Something awful created 666 errors.', $e->getMessage());
    }
}

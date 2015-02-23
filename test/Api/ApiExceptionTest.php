<?php
/**
 * Copyright 2015 Rafal Zajac <rzajac@gmail.com>
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

namespace Kicaj\Test\Api;

use Kicaj\Tools\Api\ApiException;

/**
 * Class ApiExceptionTest
 *
 * @coversDefaultClass Kicaj\Tools\Api\ApiException
 *
 * @package Kicaj\Test\Api
 * @author Rafal Zajac <rzajac@gmail.com>
 */
class ApiExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getUserMessage
     * @covers ::getErrorCode
     */
    public function test___construct_simple_message()
    {
        $e = new ApiException('error message');
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
        $e = new ApiException('');
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
        $e = new ApiException('EC_SOME_ERROR');
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
        $e = new ApiException('my message', 'EC_MY_ERROR');
        $this->assertSame('my message', $e->getUserMessage());
        $this->assertSame('EC_MY_ERROR', $e->getErrorCode());
        $this->assertSame(0, $e->getCode());
    }

    /**
     * @covers ::makeFromException
     */
    public function test_makeFromException()
    {
        $e = new \Exception('ex message', 123);
        $apiEx = ApiException::makeFromException($e);

        $this->assertSame('ex message', $apiEx->getUserMessage());
        $this->assertSame(123, $apiEx->getErrorCode());
        $this->assertSame(123, $apiEx->getCode());

        $apiEx2 = ApiException::makeFromException($apiEx);
        $this->assertSame($apiEx, $apiEx2);
    }

    /**
     * @covers ::jsonSerialize
     */
    public function test_jsonSerialize()
    {
        $e = new ApiException('my message', 'EC_MY_ERROR');
        $std = $e->jsonSerialize();

        $this->assertInstanceOf('stdClass', $std);

        $exp = ['code' => 'EC_MY_ERROR', 'message' => 'my message'];
        $this->assertSame($exp, (array) $exp);
    }
}

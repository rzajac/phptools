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
namespace Kicaj\Test\Tools\Api;

use Kicaj\Tools\Api\JResp;
use Kicaj\Tools\Itf\Paginer;

/**
 * Class JResp_Test.
 *
 * @coversDefaultClass Kicaj\Tools\Api\JResp
 *
 * @author Rafal Zajac <rzajac@gmail.com>
 */
class JResp_Test extends \PHPUnit_Framework_TestCase
{
    /**
     * @var array
     */
    protected $testValue;

    protected $testValueJson;

    protected $testValueJsonPretty;

    protected function setUp()
    {
        $this->testValue = ['a' => 1, 'b' => 2];
        $this->testValueJson = json_encode($this->testValue);
        $this->testValueJsonPretty = json_encode($this->testValue, JSON_PRETTY_PRINT);
    }

    /**
     * @covers ::buildResponse
     */
    public function test_buildResponse_simple()
    {
        // When
        $resp = JResp::buildResponse($this->testValue, true, 200);

        // Then
        $this->assertInstanceOf('stdClass', $resp);
        $this->assertObjectHasAttribute('success', $resp);
        $this->assertObjectHasAttribute('http_code', $resp);
        $this->assertObjectHasAttribute('data', $resp);
        $this->assertObjectNotHasAttribute('pageNumber', $resp);
        $this->assertObjectNotHasAttribute('pageSize', $resp);
        $this->assertObjectNotHasAttribute('totalPages', $resp);

        $this->assertSame(true, $resp->success);
        $this->assertSame(200, $resp->http_code);
        $this->assertSame($this->testValue, $resp->data);

        // Make sure there are no other keys
        $this->assertSame(3, count(array_keys((array) $resp)));
    }

    /**
     * @covers ::buildResponse
     */
    public function test_buildResponse_httpCode()
    {
        // When
        $resp = JResp::buildResponse($this->testValue, true, 123);

        // Then
        $this->assertSame(123, $resp->http_code);
        // Make sure there are no other keys
        $this->assertSame(3, count(array_keys((array) $resp)));
    }

    /**
     * @covers ::buildResponse
     */
    public function test_buildResponse_success()
    {
        // When
        $resp = JResp::buildResponse($this->testValue, false, 123);

        // Then
        $this->assertSame(false, $resp->success);
        // Make sure there are no other keys
        $this->assertSame(3, count(array_keys((array) $resp)));
    }

    /**
     * @covers ::buildResponse
     */
    public function test_buildResponse_paging()
    {
        // When
        $resp = JResp::buildResponse($this->testValue, false, 123, new TestPaginer);

        // Then
        $this->assertObjectHasAttribute('success', $resp);
        $this->assertObjectHasAttribute('http_code', $resp);
        $this->assertObjectHasAttribute('data', $resp);
        $this->assertObjectHasAttribute('pageNumber', $resp);
        $this->assertObjectHasAttribute('pageSize', $resp);
        $this->assertObjectHasAttribute('totalPages', $resp);

        $this->assertSame(2, $resp->pageNumber);
        $this->assertSame(20, $resp->pageSize);
        $this->assertSame(30, $resp->totalPages);

        $this->assertSame($this->testValue, $resp->data);

        // Make sure there are no other keys
        $this->assertSame(6, count(array_keys((array) $resp)));
    }

    /**
     * @covers ::buildResponse
     */
    public function test_buildResponse_paging_no_totalPages()
    {
        // Given
        $paging = new TestPaginer();
        $paging->totalPages = 0;

        // When
        $resp = JResp::buildResponse($this->testValue, false, 123, $paging);

        // Then
        $this->assertObjectHasAttribute('success', $resp);
        $this->assertObjectHasAttribute('http_code', $resp);
        $this->assertObjectHasAttribute('data', $resp);
        $this->assertObjectHasAttribute('pageNumber', $resp);
        $this->assertObjectHasAttribute('pageSize', $resp);
        $this->assertObjectNotHasAttribute('totalPages', $resp);

        $this->assertSame(2, $resp->pageNumber);
        $this->assertSame(20, $resp->pageSize);

        $this->assertSame($this->testValue, $resp->data);

        // Make sure there are no other keys
        $this->assertSame(5, count(array_keys((array) $resp)));
    }

    /**
     * @covers ::isSuccess
     */
    public function test_isSuccess_false()
    {
        // When
        $resp = JResp::buildResponse($this->testValue, false, 345);

        // Then
        $this->assertSame(false, JResp::isSuccess($resp));
    }

    /**
     * @covers ::isSuccess
     */
    public function test_isSuccess_true()
    {
        // When
        $resp = JResp::buildResponse($this->testValue, true, 345);

        // Then
        $this->assertSame(true, JResp::isSuccess($resp));
    }

    /**
     * @covers ::retJSON
     */
    public function test_retJSON_prettyPrint_false()
    {
        // When
        $ret = JResp::retJSON($this->testValue);

        // Then
        $this->assertSame($this->testValueJson, $ret);
    }

    /**
     * @covers ::retJSON
     */
    public function test_retJSON_prettyPrint_true()
    {
        // When
        $ret = JResp::retJSON($this->testValue, true);

        // Then
        $this->assertSame($this->testValueJsonPretty, $ret);
    }

    /**
     * @covers ::retSuccess
     */
    public function test_retSuccess_no_paging()
    {
        // When
        $resp = JResp::retSuccess($this->testValue, 200);
        $resp = json_decode($resp);

        // Then
        $this->assertInstanceOf('stdClass', $resp);
        $this->assertObjectHasAttribute('success', $resp);
        $this->assertObjectHasAttribute('http_code', $resp);
        $this->assertObjectHasAttribute('data', $resp);
        $this->assertObjectNotHasAttribute('pageNumber', $resp);
        $this->assertObjectNotHasAttribute('pageSize', $resp);
        $this->assertObjectNotHasAttribute('totalPages', $resp);

        $this->assertSame(true, $resp->success);
        $this->assertSame(200, $resp->http_code);
        $this->assertSame($this->testValue, (array) $resp->data);

        // Make sure there are no other keys
        $this->assertSame(3, count(array_keys((array) $resp)));
    }

    /**
     * @covers ::retSuccess
     */
    public function test_retSuccess_paging()
    {
        // When
        $resp = JResp::retSuccess($this->testValue, 123, new TestPaginer);
        $resp = json_decode($resp);

        // Then
        $this->assertInstanceOf('stdClass', $resp);
        $this->assertObjectHasAttribute('success', $resp);
        $this->assertObjectHasAttribute('http_code', $resp);
        $this->assertObjectHasAttribute('data', $resp);
        $this->assertObjectHasAttribute('pageNumber', $resp);
        $this->assertObjectHasAttribute('pageSize', $resp);
        $this->assertObjectHasAttribute('totalPages', $resp);

        $this->assertSame(true, $resp->success);
        $this->assertSame(123, $resp->http_code);
        $this->assertSame($this->testValue, (array) $resp->data);
        $this->assertSame(2, $resp->pageNumber);
        $this->assertSame(20, $resp->pageSize);
        $this->assertSame(30, $resp->totalPages);

        // Make sure there are no other keys
        $this->assertSame(6, count(array_keys((array) $resp)));
    }

    /**
     * @covers ::retError
     */
    public function test_retError()
    {
        // Given
        $error = ['error' => 'error message', 'errorCode' => 123];

        // When
        $resp = JResp::retError($error, 444);
        $resp = json_decode($resp);

        // Then
        $this->assertInstanceOf('stdClass', $resp);
        $this->assertObjectHasAttribute('success', $resp);
        $this->assertObjectHasAttribute('http_code', $resp);
        $this->assertObjectHasAttribute('data', $resp);
        $this->assertObjectNotHasAttribute('pageNumber', $resp);
        $this->assertObjectNotHasAttribute('pageSize', $resp);
        $this->assertObjectNotHasAttribute('totalPages', $resp);

        $this->assertSame(false, $resp->success);
        $this->assertSame(444, $resp->http_code);
        $this->assertSame($error, (array) $resp->data);

        // Make sure there are no other keys
        $this->assertSame(3, count(array_keys((array) $resp)));
    }
}

/**
 * TestPaginer.
 *
 * Unit test helper class
 *
 * @author Rafal Zajac <rzajac@gmail.com>
 */
class TestPaginer implements Paginer
{
    public $currPage = 2;

    public $pageSize = 20;

    public $totalPages = 30;

    /**
     * Get current page number.
     *
     * For first page this method should return 1 not 0
     *
     * @return int
     */
    public function getPageNumber()
    {
        return $this->currPage;
    }

    /**
     * Get number of data elements in the response.
     *
     * @return int
     */
    public function getPageSize()
    {
        return $this->pageSize;
    }

    /**
     * Get total number of pages in the result set.
     *
     * If the result set size is not known this method should return -1.
     *
     * @return int
     */
    public function getPageCount()
    {
        return $this->totalPages;
    }
}

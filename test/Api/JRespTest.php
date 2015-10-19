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

namespace Kicaj\Test\Api;

use Kicaj\Tools\Api\JResp;
use Kicaj\Tools\Itf\Paging;

/**
 * Class JRespTest.
 *
 * @coversDefaultClass Kicaj\Tools\Api\JResp
 *
 * @author Rafal Zajac <rzajac@gmail.com>
 */
class JRespTest extends \PHPUnit_Framework_TestCase
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
        $resp = JResp::buildResponse($this->testValue, true, 200);

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
        $resp = JResp::buildResponse($this->testValue, true, 123);
        $this->assertSame(123, $resp->http_code);

        // Make sure there are no other keys
        $this->assertSame(3, count(array_keys((array) $resp)));
    }

    /**
     * @covers ::buildResponse
     */
    public function test_buildResponse_success()
    {
        $resp = JResp::buildResponse($this->testValue, false, 123);
        $this->assertSame(false, $resp->success);

        // Make sure there are no other keys
        $this->assertSame(3, count(array_keys((array) $resp)));
    }

    /**
     * @covers ::buildResponse
     */
    public function test_buildResponse_paging()
    {
        $paging = new TestPaging();

        $resp = JResp::buildResponse($this->testValue, false, 123, $paging);

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
        $paging = new TestPaging();
        $paging->totalPages = 0;

        $resp = JResp::buildResponse($this->testValue, false, 123, $paging);

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
    public function test_isSuccess()
    {
        $resp = JResp::buildResponse($this->testValue, false, 345);
        $this->assertSame(false, JResp::isSuccess($resp));

        $resp = JResp::buildResponse($this->testValue, true, 345);
        $this->assertSame(true, JResp::isSuccess($resp));
    }

    /**
     * @covers ::retJSON
     */
    public function test_retJSON()
    {
        $ret = JResp::retJSON($this->testValue);
        $this->assertSame($this->testValueJson, $ret);

        $ret = JResp::retJSON($this->testValue, true);
        $this->assertSame($this->testValueJsonPretty, $ret);
    }

    /**
     * @covers ::retSuccess
     */
    public function test_retSuccess_no_paging()
    {
        $resp = JResp::retSuccess($this->testValue, 200);
        $resp = json_decode($resp);

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
        $paging = new TestPaging();
        $resp = JResp::retSuccess($this->testValue, 123, $paging);
        $resp = json_decode($resp);

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
        $error = ['error' => 'error message', 'errorCode' => 123];
        $resp = JResp::retError($error, 444);
        $resp = json_decode($resp);

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

class TestPaging implements Paging
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

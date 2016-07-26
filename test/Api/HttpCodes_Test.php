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

use Kicaj\Tools\Api\HttpCodes;

/**
 * Class HttpCodes_Test.
 *
 * @coversDefaultClass Kicaj\Tools\Api\HttpCodes
 *
 * @author Rafal Zajac <rzajac@gmail.com>
 */
class HttpCodes_Test extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider httpHeaderForProvider
     *
     * @covers ::httpHeaderFor
     *
     * @param int    $code
     * @param string $expected
     */
    public function test_httpHeaderFor($code, $expected)
    {
        // When
        $gotHeader = HttpCodes::httpHeaderFor($code);

        // Then
        $this->assertSame($expected, $gotHeader);
    }

    public function httpHeaderForProvider()
    {
        return [
            [200, 'HTTP/1.1 OK'],
            [301, 'HTTP/1.1 Moved Permanently'],
            [400, 'HTTP/1.1 Bad Request'],
            [401, 'HTTP/1.1 Unauthorized'],
            [404, 'HTTP/1.1 Not Found'],
        ];
    }

    /**
     * @dataProvider getMessageForCodeProvider
     *
     * @covers ::getMessageForCode
     *
     * @param int    $code
     * @param string $expected
     */
    public function test_getMessageForCode($code, $expected)
    {
        // When
        $gotHeader = HttpCodes::getMessageForCode($code);

        // Then
        $this->assertSame($expected, $gotHeader);
    }

    public function getMessageForCodeProvider()
    {
        return [
            [200, 'OK'],
            [301, 'Moved Permanently'],
            [400, 'Bad Request'],
            [401, 'Unauthorized'],
            [404, 'Not Found'],
        ];
    }

    /**
     * @dataProvider isErrorProvider
     *
     * @covers ::isError
     * @covers ::isOk
     * @covers ::mayHaveBody
     *
     * @param int  $code
     * @param bool $isError
     * @param bool $isOk
     * @param bool $mayHaveBody
     */
    public function test_isError($code, $isError, $isOk, $mayHaveBody)
    {
        // When
        $gotIsOk = HttpCodes::isOk($code);
        $gotIsError = HttpCodes::isError($code);
        $gotMayHaveBody = HttpCodes::mayHaveBody($code);

        // Then
        $this->assertSame($isOk, $gotIsOk);
        $this->assertSame($isError, $gotIsError);
        $this->assertSame($mayHaveBody, $gotMayHaveBody);
    }

    public function isErrorProvider()
    {
        return [
            [100, false, false, false],
            [101, false, false, false],
            [200, false, true, true],
            [204, false, true, false],
            [250, false, true, true],
            [304, false, true, false],
            [399, false, true, true],
            [400, true, false, true],
            [401, true, false, true],
            [500, true, false, true],
        ];
    }
}

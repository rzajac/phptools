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
namespace Kicaj\Test\Tools\Api {

    use Kicaj\Tools\Api\_WhatJsonLastError;
    use Kicaj\Tools\Api\JSON;
    use Kicaj\Tools\Api\JSONParseException;


    /**
     * JSON class unit tests.
     *
     * @coversDefaultClass Kicaj\Tools\Api\JSON
     *
     * @author             Rafal Zajac <rzajac@gmail.com>
     */
    class JSON_Test extends \PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            _WhatJsonLastError::$jsonLastErrorReturn = _WhatJsonLastError::USE_DEFAULT;
        }

        /**
         * @dataProvider decodeProvider
         *
         * @covers ::decode
         *
         * @param string $json
         * @param bool   $asClass
         * @param int    $depth
         * @param string $expErrMsg
         * @param string $expErrCode
         *
         * @throws \Kicaj\Tools\Api\JSONParseException
         */
        public function test_decode($json, $asClass, $depth, $expErrMsg, $expErrCode)
        {
            // When
            try {
                $gotErrMsg = '';
                $gotErrCode = '';
                JSON::decode($json, $asClass, $depth);
            } catch (JSONParseException $e) {
                $gotErrMsg = $e->getMessage();
                $gotErrCode = $e->getErrorCode();
            }

            // Then
            $this->assertSame($expErrMsg, $gotErrMsg);
            $this->assertSame($expErrCode, $gotErrCode);
        }

        public function decodeProvider()
        {
            return [
                ['{"aaa": 1}', false, 512, '', ''],
                ['{"aaa: 1}', false, 512, 'JSON decoding error', 'EC_JSON_ERROR_DECODE'],
                ['{"aaa": {"aaa": {"aaa": {}}}', false, 1, 'Maximum stack depth exceeded', 'EC_JSON_ERROR_DEPTH'],
                ['{"j": 1 ] }', false, 512, 'JSON decoding error', 'EC_JSON_ERROR_DECODE'],
            ];
        }

        /**
         * @covers ::decode
         *
         * @expectedException \Kicaj\Tools\Api\JSONParseException
         * @expectedExceptionMessage Unknown error
         */
        public function test_decode_unknown_error()
        {
            // Given
            _WhatJsonLastError::$jsonLastErrorReturn = 10000;

            // Then
            $json = '{"does not matter what it is here": 1}';
            JSON::decode($json);
        }
    }
}

// Trick to inject our own json_last_error() to  Kicaj\Tools\Api namespace.

namespace Kicaj\Tools\Api {

    class _WhatJsonLastError
    {
        const USE_DEFAULT = -1;

        public static $jsonLastErrorReturn = self::USE_DEFAULT;
    }

    function json_last_error()
    {
        if (_WhatJsonLastError::$jsonLastErrorReturn === _WhatJsonLastError::USE_DEFAULT) {
            return \json_last_error();
        } else {
            return _WhatJsonLastError::$jsonLastErrorReturn;
        }
    }
}

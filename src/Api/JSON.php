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

namespace Kicaj\Tools\Api;

class JSON
{
    /**
     * Decode JSON string.
     *
     * @param string     $json    The JOSN string being decoded
     * @param bool|false $asClass Set to true to get stdClass
     * @param int        $depth   The user specified recursion depth
     * @param int        $options The bitmask of JSON decode options
     *
     * @return mixed
     *
     * @throws JSONParseException
     */
    public static function decode($json, $asClass = false, $depth = 512, $options = 0)
    {
        $array = json_decode($json, !$asClass, $depth, $options);
        switch (json_last_error()) {
            case JSON_ERROR_NONE:
                return $array;
            case JSON_ERROR_DEPTH:
                throw new JSONParseException('Maximum stack depth exceeded', 'EC_JSON_ERROR_DEPTH');
            case JSON_ERROR_STATE_MISMATCH:
                throw new JSONParseException('Underflow or the modes mismatch', 'EC_JSON_ERROR_STATE_MISMATCH');
            case JSON_ERROR_CTRL_CHAR:
                throw new JSONParseException('Unexpected control character found', 'EC_JSON_ERROR_CTRL_CHAR');
            case JSON_ERROR_SYNTAX:
                throw new JSONParseException('Syntax error, malformed JSON', 'EC_JSON_ERROR_SYNTAX');
            case JSON_ERROR_UTF8:
                throw new JSONParseException('Malformed UTF-8 characters, possibly incorrectly encoded', 'EC_JSON_ERROR_UTF8');
            default:
                throw new JSONParseException('Unknown error', ApiException::EC_UNKNOWN);
        }
    }
}

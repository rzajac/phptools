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

namespace Kicaj\Tools\Api;

use Kicaj\Tools\Itf\Paging;
use stdClass;

/**
 * Provides static methods for constructing JSON responses
 *
 * @package Kicaj\Tools\Helper
 * @author  Ralph Zajac <rzajac@gmail.com>
 */
class JResp
{
    /**
     * Return error
     *
     * @param mixed   $value       The error response
     * @param int     $http_code   The HTTP response code
     * @param boolean $prettyPrint If true the JSON will be pretty printed
     *
     * @return string JSON encoded $value.
     */
    public static function retError($value, $http_code = 400, $prettyPrint = false)
    {
        $response = self::buildResponse($value, false, $http_code);

        return self::retJSON($response, $prettyPrint);
    }

    /**
     * Builds API response
     *
     * @param mixed  $value      The response
     * @param bool   $success    Set to true for success, false for failure
     * @param int    $httpCode   The HTTP response code
     * @param Paging $pagingInfo The pagination information coming from Paging interface
     *
     * @return stdClass
     */
    public static function buildResponse($value, $success, $httpCode, Paging $pagingInfo = null)
    {
        $response           = new stdClass;
        $response->success  = $success;
        $response->httpCode = $httpCode;

        if ($pagingInfo)
        {
            $response->pageNumber = $pagingInfo->getPageNumber();
            $response->pageSize   = $pagingInfo->getPageSize();

            $totalPages = $pagingInfo->getPages();
            if ($totalPages > 0)
            {
                $response->totalPages = $totalPages;
            }
        }

        $response->data = $value;

        return $response;
    }

    /**
     * Return $data encoded as JSON
     *
     * @param mixed   $response    The response
     * @param boolean $prettyPrint If true the JSON will be pretty printed
     *
     * @return string JSON encoded $response
     */
    public static function retJSON($response = null, $prettyPrint = false)
    {
        $options = $prettyPrint ? JSON_PRETTY_PRINT : 0;

        return json_encode($response, $options);
    }

    /**
     * Return success
     *
     * @param mixed   $value       The success response
     * @param int     $http_code   The HTTP response code
     * @param Paging  $pagingInfo  The pagination information coming from Paging interface
     * @param boolean $prettyPrint If true the JSON will be pretty printed
     *
     * @return string JSON encoded $value
     */
    public static function retSuccess($value = null, $http_code = 200, Paging $pagingInfo = null, $prettyPrint = false)
    {
        $response = self::buildResponse($value, true, $http_code, $pagingInfo);

        return self::retJSON($response, $prettyPrint);
    }

    /**
     * Check if a response is a success
     *
     * @param stdClass $response The AJAX response in a format returned by buildResponse method
     *
     * @return bool
     */
    public static function isSuccess(stdClass $response)
    {
        if (is_object($response) && $response->success == true)
        {
            return HttpCodes::isOk($response->httpCode);
        }
        else
        {
            return false;
        }
    }
}

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

use stdClass;

/**
 * Exception used in JSON API endpoints
 *
 * @package Kicaj\Tools\Api
 */
class ApiException extends \Exception implements \JsonSerializable
{
    /**
     * The error code
     *
     * @var string|int
     */
    protected $errorCode = 'EC_UNKNOWN';

    /**
     * Constructor
     *
     * @param string    $message  The human readable message or one of the EC_* strings
     * @param string    $ecCode   The EC_* string
     * @param \Exception $previous The previous exception
     */
    public function __construct($message, $ecCode = '', \Exception $previous = null)
    {
        // If message is set to EC_*
        if ($ecCode === '' && strpos($message, 'EC_') === 0)
        {
            $this->errorCode = $message;
        }
        elseif ($ecCode != '')
        {
            $this->errorCode = $ecCode;
        }

        $code = is_int($this->errorCode) ? $this->errorCode : 0;

        parent::__construct($message, $code, $previous);
    }

    /**
     * Creates ApiException from any other exception.
     *
     * @param \Exception $e
     *
     * @return ApiException
     */
    public static function makeFromException($e)
    {
        if ($e instanceof ApiException)
        {
            return $e;
        }

        return new self($e->getMessage(), $e->getCode(), $e);
    }

    /**
     * Get user readable error message
     *
     * @return string
     */
    public function getUserMessage()
    {
        $msg = $this->getMessage();

        if ($msg === '')
        {
            $msg = $this->errorCode;
        }

        return $msg;
    }

    /**
     * Returns error code
     *
     * @return string
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * Returns data which should be serialized to JSON
     *
     * @return stdClass
     */
    public function jsonSerialize()
    {
        $ret = new stdClass;
        $ret->code = $this->errorCode;
        $ret->message = $this->getUserMessage();

        return $ret;
    }
}

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

namespace Kicaj\Tools\Helper;

use ErrorException;

/**
 * Error handling.
 *
 * @author Rafal Zajac <rzajac@gmail.com>
 */
abstract class Err
{
    /**
     * Change errors to exceptions.
     *
     * @see http://php.net/manual/en/class.errorexception.php
     *
     * @param bool $turnOn Set to false to turn off user defined error to exception handling
     *
     * @return mixed
     */
    public static function errToException($turnOn = true)
    {
        if (!$turnOn) {
            // @codeCoverageIgnoreStart
            return set_error_handler(null);
            // @codeCoverageIgnoreEnd
        }

        /*
         * Error handler
         *
         * @param int $errno
         * @param string $errStr
         * @param string $errFile
         * @param int $errLine
         *
         * @throws ErrorException
         */
        $handler = function ($errno, $errStr, $errFile, $errLine) {
            // This error code is not included in error_reporting
            if (!(error_reporting() & $errno)) {
                return;
            }
            throw new ErrorException($errStr, 0, $errno, $errFile, $errLine);
        };

        return set_error_handler($handler);
    }

    /**
     * Restore error handler.
     *
     * @see http://php.net/manual/en/function.set-error-handler.php
     *
     * @param mixed $handler
     *
     * @return mixed
     */
    public static function restoreHandler($handler)
    {
        if (!$handler) {
            $handler = null;
        }

        return set_error_handler($handler);
    }

    /**
     * Return current error handler.
     *
     * @return mixed
     */
    public static function getCurrentErrorHandler()
    {
        set_error_handler($handler = set_error_handler('var_dump'));

        return $handler;
    }
}

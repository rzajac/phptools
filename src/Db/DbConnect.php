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
namespace Kicaj\Tools\Db;

/**
 * Database connection helper class.
 *
 * @author Rafal Zajac <rzajac@gmail.com>
 */
final class DbConnect
{
    /**
     * @param string     $driver   The database driver to use. One of the DbConnector::DB_DRIVER_* constants
     * @param string     $host     The database host address
     * @param string     $username The username
     * @param string     $password The password
     * @param string     $database The database name
     * @param string|int $port     The database port
     *
     * @return array
     */
    public static function getCfg($driver, $host, $username, $password, $database, $port)
    {
        return [
            DbConnector::DB_CFG_DRIVER => $driver,
            DbConnector::DB_CFG_HOST => $host,
            DbConnector::DB_CFG_USERNAME => $username,
            DbConnector::DB_CFG_PASSWORD => $password,
            DbConnector::DB_CFG_DATABASE => $database,
            DbConnector::DB_CFG_PORT => $port,
        ];
    }
}

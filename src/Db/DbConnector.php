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

use Kicaj\Tools\Itf\Error;

/**
 * Database connection interface.
 *
 * @author Rafal Zajac <rzajac@gmail.com>
 */
interface DbConnector extends Error
{
    /** MySQL driver */
    const DB_DRIVER_MYSQL = 'mysql';

    /** Database host address */
    const DB_CFG_HOST = 'host';

    /** Database user name */
    const DB_CFG_USERNAME = 'username';

    /** Database password */
    const DB_CFG_PASSWORD = 'password';

    /** Database name */
    const DB_CFG_DATABASE = 'database';

    /** Database port */
    const DB_CFG_PORT = 'port';

    /** Debugging 'on' or  'off'. Default 'no' */
    const DB_CFG_DEBUG = 'debug';

    /** Database driver to use. One of the self::DB_DRIVER_* constants */
    const DB_CFG_DRIVER = 'driver';

    /**
     * Configure database.
     *
     * @param array $dbConfig The database configuration. See self::DB_CFG_* constants.
     *
     * @return $this
     */
    public function dbSetup(array $dbConfig);

    /**
     * Connect to database.
     *
     * @return bool Returns true on success.
     */
    public function dbConnect();
}

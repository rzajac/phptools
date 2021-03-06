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
namespace Kicaj\Tools\Cli;

/**
 * CLI user interactions helper.
 *
 * @author Rafal Zajac <rzajac@gmail.com>
 */
class Interaction
{
    /**
     * Get password from command line.
     *
     * Note: you probably should trim the return
     *
     * @param string $prompt The CLI prompt text
     *
     * @return string
     */
    public static function getPassword($prompt = '')
    {
        echo $prompt;
        system('stty -echo');
        $pass = fgets(STDIN);
        system('stty echo');

        return $pass;
    }

    /**
     * Returns true if shell command exists.
     *
     * @param string $cmd The command line program to check.
     *
     * @return bool
     */
    public static function commandExist($cmd)
    {
        exec("which $cmd", $output, $returnVal);
        return ($returnVal === 0 ? true : false);
    }
}

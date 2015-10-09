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

/**
 * Collection of static helper methods for string and mixed types.
 *
 * @author Rafal Zajac <rzajac@gmail.com>
 */
abstract class Str
{
    /**
     * Returns newValue when oldValue !== ifNot.
     *
     * @param mixed $oldValue
     * @param mixed $ifNot
     * @param mixed $newValue
     *
     * @return mixed
     */
    public static function returnIfNot($oldValue, $ifNot, $newValue)
    {
        if ($oldValue === $ifNot) {
            return $oldValue;
        }

        return $newValue;
    }

    /**
     * Generate random string.
     *
     * @param int $length The length of the string
     *
     * @return string
     */
    public static function randomString($length)
    {
        $key = '';
        $keys = array_merge(range('a', 'z'));

        for ($i = 0; $i < $length; ++$i) {
            $key .= $keys[array_rand($keys)];
        }

        return $key;
    }

    /**
     * Generates a random token, uses base64: 0-9a-zA-Z/+.
     *
     * @param int  $length The token length
     * @param bool $strong
     *
     * @return string token
     */
    public static function generateToken($length = 32, $strong = true)
    {
        $token = base64_encode(openssl_random_pseudo_bytes($length + 10, $strong));
        $token = str_replace(['/'], '', $token);

        return substr($token, 0, $length);
    }

    /**
     * If value evaluates to FALSE this method returns empty string.
     *
     * @param mixed $value
     *
     * @return string
     */
    public static function emptyOnFalse($value)
    {
        if (((bool) $value) === false) {
            return '';
        }

        return $value;
    }

    /**
     * Get random weighted element.
     *
     * Utility function for getting random values with weighting.
     *
     * Pass in an associative array, such as array('A'=>5, 'B'=>45, 'C'=>50)
     * An array like this means that "A" has a 5% chance of being selected, "B" 45%, and "C" 50%.
     * The return value is the array key, A, B, or C in this case.  Note that the values assigned
     * do not have to be percentages.  The values are simply relative to each other.  If one value
     * weight was 2, and the other weight of 1, the value with the weight of 2 has about a 66%
     * chance of being selected.  Also note that weights should be integers.
     *
     * @param array $weightedValues
     * @param int   $default
     *
     * @return int
     */
    public static function getRandomWeightedElement(array $weightedValues, $default = 1)
    {
        $sum = (int) array_sum($weightedValues);
        $min = 1;

        $rand = mt_rand(min($min, $sum), max($min, $sum));

        $ret = $default;

        foreach ($weightedValues as $key => $value) {
            $rand -= (int) $value;

            if ($rand <= 0) {
                $ret = $key;
                break;
            }
        }

        return $ret;
    }

    /**
     * Slugify strings.
     *
     * @param string $text
     *
     * @return string
     */
    public static function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

        // trim
        $text = trim($text, '-');

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        if ($text == '') {
            return 'n-a';
        }

        return $text;
    }

    /**
     * Return TRUE if haystack starts with the needle.
     *
     * @param string $haystack
     * @param string $needle
     *
     * @return bool
     */
    public static function startsWith($haystack, $needle)
    {
        $length = strlen($needle);

        return (substr($haystack, 0, $length) === $needle);
    }

    /**
     * Return TRUE if haystack ends with the needle.
     *
     * @param string $haystack
     * @param string $needle
     *
     * @return bool
     */
    public static function endsWith($haystack, $needle)
    {
        $length = strlen($needle);
        if ($length == 0) {
            return true;
        }

        return (substr($haystack, -$length) === $needle);
    }

    /**
     * Change camelCase string to camel_case.
     *
     * @param string $input
     *
     * @return string
     */
    public static function camelCaseToUnderscore($input)
    {
        return ltrim(strtolower(preg_replace('/[A-Z]/', '_$0', $input)), '_');
    }
}

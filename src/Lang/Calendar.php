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
namespace Kicaj\Tools\Lang;

/**
 * Calendar translations.
 *
 * @author Rafal Zajac <rzajac@gmail.com>
 */
class Calendar
{
    /** Long style */
    const STYLE_LONG = 'long';

    /** Short style */
    const STYLE_SHORT = 'short';

    /** Medium style */
    const STYLE_MEDIUM = 'medium';

    /** English language code */
    const LANG_EN = 'en';

    /** Polish language code */
    const LANG_PL = 'pl';

    /**
     * Supported translations.
     *
     * @var array
     */
    protected static $supportedLangs = ['en', 'pl'];

    /**
     * Get translated day of the week.
     *
     * @param int    $day      The day of the week number 1 - 7
     * @param string $langCode The supported language code ex: en
     * @param string $style    The style to return day name in. One of the self::STYLE_* constants
     *
     * @return mixed
     */
    public static function getDay($day, $langCode, $style = self::STYLE_LONG)
    {
        $langCode = static::checkLanguageCode($langCode);

        return self::$i18n[$langCode]['day'][$style][$day];
    }

    /**
     * Get translated month.
     *
     * @param int    $month    The month number 1 - 12
     * @param string $langCode The supported language code ex: en
     * @param string $style    The style to return month name in. One of the self::STYLE_* constants
     *
     * @return mixed
     */
    public static function getMonth($month, $langCode, $style = self::STYLE_LONG)
    {
        $langCode = static::checkLanguageCode($langCode);

        return self::$i18n[$langCode]['month'][$style][$month];
    }

    /**
     * Check if language code is supported.
     *
     * @param string $languageCode The supported language code ex: en
     *
     * @return string The supported language code or en
     */
    public static function checkLanguageCode($languageCode)
    {
        return  in_array($languageCode, self::$supportedLangs) ? $languageCode : 'en';
    }

    /**
     * Translations.
     *
     * @var array
     */
    protected static $i18n = [
        'en' => [
            'day' => [
                'short' => ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                'medium' => ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                'long' => ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
            ],
            'month' => [
                'short' => [null, 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                'long' => [null, 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            ],
        ],

        'pl' => [
            'day' => [
                'short' => ['Nd', 'Pn', 'Wt', 'Śr', 'Cz', 'Pt', 'So'],
                'medium' => ['Nie', 'Pon', 'Wto', 'Śro', 'Czw', 'Pią', 'Sob'],
                'long' => ['Niedziela', 'Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek', 'Sobota'],
            ],
            'month' => [
                'short' => [null, 'Sty', 'Lut', 'Mar', 'Kwi', 'Maj', 'Cze', 'Lip', 'Sie', 'Wrz', 'Paź', 'Lis', 'Gru'],
                'long' => [null, 'Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'],
            ],
        ],
    ];
}

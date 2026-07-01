<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Request;

class MiscHelper
{
    public static function getLangQueryStr()
    {
        $queryString = '?lang=';
        if (!empty(Request::getQueryString())) {
            parse_str(Request::getQueryString(), $queryStringArray);
            if (Request::has('lang')) {
                unset($queryStringArray['lang']);
            }
            $queryString = http_build_query($queryStringArray);
            $queryString = (empty($queryString)) ? '?lang=' : '?' . $queryString . '&lang=';
        }
        return $queryString;
    }

    public static function getLang($lang = '')
    {
        if (Request::has('lang')) {
            $lang = Request::query('lang');
        }
        return ($lang != '') ? $lang : config('default_lang');
    }

    public static function getLangDirection($lang = '')
    {
        $lang = ($lang != '') ? $lang : config('default_lang');
        $arr = \App\Language::select('languages.iso_code')->where('is_rtl', '=', 1)->active()->pluck('languages.iso_code')->toArray();
        $direction = 'ltr';
        if (Request::has('lang') && in_array(Request::query('lang'), $arr)) {
            $direction = 'rtl';
        } elseif (in_array($lang, $arr)) {
            $direction = 'rtl';
        }
        return $direction;
    }

    public static function getNumOffices()
    {
        return array_combine(range(1, 20), range(1, 20));
    }

    public static function getNumPositions()
    {
        return array_combine(range(1, 100), range(1, 100));
    }

    public static function getNumEmployees()
    {
        return [
            '1-10' => '1-10', '11-50' => '11-50', '51-100' => '51-100',
            '101-200' => '101-200', '201-300' => '201-300', '301-600' => '301-600',
            '601-1000' => '601-1000', '1001-1500' => '1001-1500', '1501-2000' => '1501-2000',
            '2001-2500' => '2001-2500', '2501-3000' => '2501-3000', '3001-3500' => '3001-3500',
            '3501-4000' => '3501-4000', '4001-4500' => '4001-4500', '4501-5000' => '4501-5000',
            '5000+' => '5000+'
        ];
    }

    public static function getEstablishedIn()
    {
        return array_combine(range(date('Y'), 1901), range(date('Y'), 1901));
    }

    public static function getSalaryDD()
    {
        $salaries = [5000, 6000, 7000, 8000, 9000, 10000, 11000, 12000, 13000, 14000, 15000, 16000, 17000, 18000, 19000, 20000, 25000, 30000, 35000, 40000, 45000, 50000, 60000, 70000, 80000, 90000, 100000, 125000, 150000, 175000, 200000, 250000, 300000, 350000, 400000, 450000, 500000, 550000, 600000, 600001];
        return array_combine($salaries, array_map(function ($salary) {
            return $salary == 600001 ? '600,000+' : number_format($salary);
        }, $salaries));
    }

    public static function getCcExpiryYears()
    {
        return array_combine(range(date('Y'), date('Y') + 49), range(date('Y'), date('Y') + 49));
    }
}

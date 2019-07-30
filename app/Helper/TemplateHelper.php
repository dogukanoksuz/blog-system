<?php

namespace App\Helper;

class TemplateHelper
{
    public static function fetchSocialLink($whichOne)
    {
        return json_decode(config('setting.Social Links'), JSON_PRETTY_PRINT)[$whichOne];
    }
}

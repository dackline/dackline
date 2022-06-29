<?php

if (! function_exists('get_locale_title')) {
    function get_locale_title($locale)
    {
        $locales_meta = config('translatable.locales_meta');
        if(!isset($locales_meta[$locale])) {
            return false;
        }

        return $locales_meta[$locale]['title'];
    }
}

if (! function_exists('get_locale_icon')) {
    function get_locale_icon($locale)
    {
        $locales_meta = config('translatable.locales_meta');
        if(!isset($locales_meta[$locale])) {
            return false;
        }

        return $locales_meta[$locale]['icon'];
    }
}

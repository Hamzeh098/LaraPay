<?php
if (!function_exists('is_rtl')) {
    function is_rtl()
    {
        $currentLang = app()->getLocale();
        return in_array($currentLang, ['fa', 'ar']);
    }
}
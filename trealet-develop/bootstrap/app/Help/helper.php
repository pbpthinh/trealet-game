<?php

if (!function_exists('checkUrlCurrent')) {
    function checkUrlCurrent($url)
    {
        $uri = $_SERVER['REQUEST_URI'];
        $paths = explode('/', $uri);
        $keyPage = array_search('page', $paths);
        if ($keyPage == false && $url == 'index') {
            return true;
        }

        return $paths[$keyPage + 1] == $url;
    }
}

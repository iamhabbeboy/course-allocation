<?php
    if( !function_exists('array_get')) {
        function array_get($array, $key)
        {
            if (array_key_exists($key, $array)) {
                return $array[$key];
            }
        }
    }

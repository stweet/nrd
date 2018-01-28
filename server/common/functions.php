<?php

/** Служебный функционал системы */

if (!function_exists("__pre")) {
    
    /** Простой вывод дампа переданных значенийй */
    function __pre(...$args) {
        if (count($args) > 1) print_r($args);
        else print_r(array_shift($args));
        echo "\n";
    }
}
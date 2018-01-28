<?php

/** Модуль переопределения на уровне нтерпритатора */

function __autoload(string $classname) {
    $name = str_replace('\\', '/', $classname);
    include_once(__ROOT__."/{$name}.php");
}
<?php

/**
 * Объект выполняет поиск и выборку входящих данных
 * @todo php://input
 */
abstract
class Input {
    
    /** Поис данных в любом из массивов GET or POST */
    static 
    public function any($name, $def = "") {
        $g = self::get($name);
        if (!empty($g)) return $g;

        $p = self::post($name);
        if (!empty($p)) return $p;

        return $def;
    }
    
    /** Поис массива данных в любом из массивов GET or POST */
    static 
    public function anyArray($name, $def = array()) {
        $g = self::getArray($name);
        if (!empty($g)) return $g;

        $p = self::postArray($name);
        if (!empty($p)) return $p;

        return $def;
    }
    
    /** Поис данных в GET запросе */
    static 
    public function get($name, $def = "") {
        if ($request = filter_input(INPUT_GET, $name)) 
            return $request;

        return $def;
    }
    
    /** Поис массива данных в GET запросе */
    static 
    public function getArray($name, $def = array()) {
        if (($request = filter_input_array(INPUT_GET)) && 
            isset($request[$name])) return $request[$name];

        return $def;
    }
    
    /** Поис данных в POST запросе */
    static 
    public function post($name, $def = "") {
        if ($request = filter_input(INPUT_POST, $name)) 
            return $request;

        return $def;
    }
    
    /** Поис массива данных в POST запросе */
    static 
    public function postArray($name, $def = array()) {
        if (($request = filter_input_array(INPUT_POST)) && 
            isset($request[$name])) return $request[$name];

        return $def;
    }
    
    /** Поис файла в запросе */
    static 
    public function file($name, $def = NULL) {
        if (isset($_FILES[$name]) && is_string($_FILES[$name]["name"])) 
            return $_FILES[$name];

        return $def;
    }
    
    /** Поис файлов в запросе */
    static 
    public function fileArray($name, $def = NULL) {
        if (isset($_FILES[$name]) && is_array($_FILES[$name]['name'])) {

            $output = array();
            for ($i = 0; $i < count($_FILES[$name]['name']); $i ++) {

                $output[$i] = array();
                foreach($_FILES[$name] as $field => $value)
                    $output[$i][$field] = $_FILES[$name][$field][$i];
            }

            return $output;
        }

        return $def;
    }
}
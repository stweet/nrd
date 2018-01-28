<?php

namespace database\models {

    /**
     * Undocumented interface
     */
    interface ITaskModel {
        
        public function findById(int $id);
        public function create($title, $context);
        public function removeById(int $id);
        public function updateById(int $id, string $title, string $context);
        public function changeById(int $id, int $state);
    }
}
<?php

namespace database\models {

    /**
     * Undocumented interface
     */
    interface ITasksModel {

        public function findAll(string $state);
    }
}
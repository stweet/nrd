<?php

namespace database\models\pdo {
    
    use database\models\ITasksModel;
    use database\models\pdo\base\Model;
    
    class TasksModel extends Model implements ITasksModel {

        public function findAll(string $state) {
            return parent::execute("select * from tasks{$state};")
                ->fetchAll(\PDO::FETCH_ASSOC);
        }
    }
}
<?php

namespace database\models\pdo {
    
    use database\models\ITaskModel;
    use database\models\pdo\base\Model;
    
    class TaskModel extends Model implements ITaskModel {

        public function findById(int $id) {
            $result = parent::execute("select * from tasks where id=?;", [$id]);
            return $result->fetch(\PDO::FETCH_ASSOC);
        }
        
        public function create($title, $context) {
            $request = "insert into tasks(title, context) values(?,?);";
            $result = parent::execute($request, [$title, $context]);
            if ($result) return $this->lastCreateItem();
            return null;
        }

        public function updateById(int $id, string $title, string $context) {
            $request = "update tasks set title=?, context=? where id=?";
            if ($result = parent::execute($request, [$title, $context, $id]))
                return $this->findById($id);
            return null;
        }

        public function changeById(int $id, int $state) {
            $request = "update tasks set state=? where id=?";
            if ($result = parent::execute($request, [$state, $id]))
                return $this->findById($id);
            return null;
        }

        public function removeById(int $id) {

            if ($item = $this->findById($id)) {
                $request = "delete from tasks where id=?;";
                $result = parent::execute($request, [$id]);
                if ($result) return $item;
                return null;
            }

            return null;
        }

        protected function lastCreateItem() {
            $id = parent::lastInsertId();
            return $this->findById($id);
        }
    }
}
<?php

namespace database\models\pdo\base {
    
    use database\models\pdo\base\Model;

    class Install extends Model {

        public function apply() {
            
            $this->execute("
                create table if not exists tasks(
                    id int(11) unsigned auto_increment primary key,
                    title varchar(255) not null,
                    context varchar(500) not null,
                    state boolean not null default 0,
                    createdAt timestamp);");
            
            $this->execute("
                insert into tasks
                    (title, context, state) 
                values 
                    ('First task', 'First task context.', false),
                    ('Second task', 'Second task context.', true),
                    ('last task', 'Last task context.', false);");
        }

        /**
         * Undocumented function
         *
         * @param string $request
         * @return void
         */
        protected function execute(string $request) {
            
            if ($result = parent::execute($request)) {
                \__pre("COMPLETE REQUEST $request");
            } else {
                \__pre("ERROR REQUEST $request");
            }
        }
    }
}
<?php include_once "template/header.php"; ?>

<div class="content-block">
    <h1 class="page-header">Задачник.</h1>

    <div class="tasks-tools">
        <button type="button" class="btn btn-success" onclick="TasksModal.append();">
            <span class="glyphicon glyphicon-plus"></span>
        </button>
        <div class="dropdown pull-right" id="filter-state">
            <button class="btn btn-default dropdown-toggle" type="button" id="btn-filter-state" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <span style="margin-right: 10px;" id="label">Фильтр</span><span class="caret"></span>
            </button>
            <ul id="select" class="dropdown-menu" aria-labelledby="btn-filter-state">
                <li><a href="javascript:TasksFilter.setState('*');">Все задачи</a></li>
                <li><a href="javascript:TasksFilter.setState('0');">Только открытые</a></li>
                <li><a href="javascript:TasksFilter.setState('1');">Только закрытые</a></li>
            </ul>
        </div>
    </div>

    <div id="tasks-container">
        Loading list ...
    </div>

    <div class="modal fade" id="task-form-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Редактор задач</h4>
                </div>

                <div class="modal-body">
                    <form class="form-horizontal">
                        <input id="task-form-id" type="hidden" value="0"/>
                        
                        <div class="form-group">
                            <label for="task-form-title" class="col-sm-2 control-label">Заголовок:</label>
                            <div class="col-sm-10">
                                <input class="form-control" id="task-form-title" type="text"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="task-form-context" class="col-sm-2 control-label">Описание:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="task-form-context"></textarea>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="TasksModal.apply();">Выполнить</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once "template/footer.php"; ?>
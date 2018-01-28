
var TasksServiceCommands = (function( ) {
    var CREATE = "/task-create";
    var UPDATE = "/task-update";
    var REMOVE = "/task-remove";
    var CHANGE = "/task-change";
    var LOAD = "/tasks";

    this.create = function(title, context) {
        Service.sendPost(CREATE, {title, context});
    };
    
    this.update = function(id, title, context) {
        Service.sendPost(UPDATE, {id, title, context});
    };

    this.remove = function(id) {
        Service.sendPost(REMOVE, {id});
    };

    this.change = function(id, state) {
        Service.sendPost(CHANGE, {id, state});
    };

    this.load = function(state) {
        Service.sendPost(LOAD, {state});
    };

    return this;
})();

var TasksModal = (function( ) {
    
    var iModal = $('#task-form-modal');
    var iId = iModal.find("#task-form-id");
    var iTitle = iModal.find("#task-form-title");
    var iContext = iModal.find("#task-form-context");

    function show() {
        iContext.val(iData.context);
        iTitle.val(iData.title);
        iModal.modal("show");
    }

    function hide() {
        iModal.modal("hide");
        iContext.val("");
        iTitle.val("");
        iId.val("");
    }

    this.append = function( ) {
        iId.val("");
        iTitle.val("");
        iContext.val("");
        iModal.modal("show");
    };

    this.edit = function(id, title, context) {
        iId.val(id);
        iTitle.val(title);
        iContext.val(context);
        iModal.modal("show");
    };

    this.apply = function( ) {
        var id = iId.val();
        var title = iTitle.val();
        var context = iContext.val();

        if (id) TasksServiceCommands.update(id, title, context);
        else TasksServiceCommands.create(title, context);
        
        iModal.modal("hide");
        iContext.val("");
        iTitle.val("");
        iId.val("");
    };

    return this;
})();

var TasksFilter = (function() {

    this.setState = function(state) {
        TasksServiceCommands.load(state);
    };

    this.reload = function() {
        TasksServiceCommands.load("*");
    };

    return this;
})();

var TasksItem = function(parent, fields) {
    var root = this;

    var title = document.createElement("span");
        title.innerText = fields.title;
    
    var index = document.createElement("span");
        index.innerText = "#" + fields.id;
        index.style.marginRight = "10px";
    
    var btnRemove = document.createElement('span');
        btnRemove.classList.add("glyphicon", "glyphicon-trash", "pull-right", "text-danger");
        btnRemove.style.marginTop = "3px";
        btnRemove.onclick = remove;

    var btnChange = document.createElement('span');
        btnChange.classList.add("glyphicon", "glyphicon-check", "pull-right", "text-success");
        btnChange.style.marginRight = "8px";
        btnChange.style.marginTop = "3px";
        btnChange.onclick = change;

    var btnEdit = document.createElement('span');
        btnEdit.classList.add("glyphicon", "glyphicon-edit", "pull-right", "text-info");
        btnEdit.style.marginRight = "8px";
        btnEdit.style.marginTop = "3px";
        btnEdit.onclick = edit;

    var head = document.createElement('div');
        head.classList.add("panel-heading");
        head.appendChild(btnRemove);
        head.appendChild(btnChange);
        head.appendChild(btnEdit);
        head.appendChild(index);
        head.appendChild(title);
    
    var body = document.createElement('div');
        body.classList.add("panel-body");
        body.innerText = fields.context;
    
    var panel = document.createElement('div');
        panel.classList.add("panel", "panel-default");
        panel.appendChild(head);
        panel.appendChild(body);
    
    function change() {
        TasksServiceCommands.change(fields.id, 
            fields.state == "1" ? "0" : "1");
    }

    function remove() { 
        if (!confirm("Удалить задачу?")) return;
        TasksServiceCommands.remove(fields.id); 
    }

    function redraw() {
        body.innerText = fields.context;
        title.innerText = fields.title;

        if (fields.state == "1") root.selectOff();
        else root.selectOn();
    }

    function edit() { 
        TasksModal.edit(fields.id, fields.title, fields.context);
    }
    
    root.selectOn = function() {
        panel.classList.remove("panel-info");
        panel.classList.add("panel-default");
        btnChange.classList.remove("glyphicon-share");
        btnChange.classList.add("glyphicon-check");
        btnEdit.style.display = "inherit";
    };
    
    root.selectOff = function() {
        panel.classList.remove("panel-default");
        panel.classList.add("panel-info");
        btnChange.classList.remove("glyphicon-check");
        btnChange.classList.add("glyphicon-share");
        btnEdit.style.display = "none";
    };
    
    root.update = function(title, context) {
        fields.context = context;
        fields.title = title;
        redraw();
    };

    root.change = function(state) {
        fields.state = state;
        redraw();
    };

    root.remove = function(){
        parent.removeChild(panel);
        btnRemove.onclick = null;
        btnChange.onclick = null;
        btnEdit.onclick = null;
    };

    if (fields.state == "1") root.selectOff();
    parent.insertBefore(panel, parent.children[0]);
    return root;
};

var TasksController = function() {
    var element = document.querySelector("#tasks-container");
    var root = this;
    var items = {};

    root.create = function(item) {
        items[item.id] = new TasksItem(element, item);
        ShowMessageSuccess("Create item: #" + item.id);
    };
    
    root.update = function(item) {
        if (!items[item.id]) return;
        items[item.id].update(item.title, item.context);
        ShowMessageSuccess("Update item: #" + item.id);
    };
    
    root.change = function(item) {
        if (!items[item.id]) return;
        items[item.id].change(item.state);
        ShowMessageSuccess("Change item: #" + item.id);
    };

    root.remove = function(item) {
        if (!items[item.id]) return;
        items[item.id].remove();
        delete items[item.id];
        ShowMessageSuccess("Remove item: #" + item.id);
    };

    root.load = function(list) {
        element.innerHTML = "";
        list.map(function(item) { 
            items[item.id] = new TasksItem(element, item);
        });
    };
    
    Service.addListener("task.create", root.create);
    Service.addListener("task.update", root.update);
    Service.addListener("task.change", root.change);
    Service.addListener("task.remove", root.remove);
    Service.addListener("tasks.items", root.load);

    TasksFilter.reload();
    return root;
};

window.addEventListener('load', function($event) {
    return new TasksController();
});
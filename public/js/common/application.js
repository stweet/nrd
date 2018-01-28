var SystemAlert = function(message, type) {
    var text = document.createTextNode(message);
    
    var div = document.createElement("div");
        div.classList.add("system-message", type);
        div.appendChild(text);
    
    var parent = document.querySelector(".system-messages-container");
        parent.appendChild(div);
    
    $(div).delay(3000).fadeOut(500, function(){$(div).remove();});
    return parent;
};

var ShowMessage = function(message, type) {
    return new SystemAlert(message, type);
};

var ShowMessageError = function(message) {
    return ShowMessage(message, "danger");
};

var ShowMessageInfo = function(message) {
    return ShowMessage(message, "info");
};

var ShowMessageWarning = function(message) {
    return ShowMessage(message, "warning");
};

var ShowMessageSuccess = function(message) {
    return ShowMessage(message, "success");
};

var Application = function() {
    let root = this;

    root.onMessage = function(object) {
        
        var type = object.type;
        var message = object.message;
        return ShowMessage(message, type);
    };

    Service.addListener('system.error', root.onMessage);
    return root;
};

window.addEventListener('load', function( ) {
    return new Application();
});
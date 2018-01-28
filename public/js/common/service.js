

var Service = (function( ) {
    var listeners = {};

    function dispatch(action, target) {
        if (!listeners[action]) return;

        var list = listeners[action];
        list.map(function(listener) {
            listener(target);
        });
    };

    this.addListener = function(action, listener) {
        if (!listeners[action]) listeners[action] = [];
        listeners[action].push(listener);
    };

    this.sendPost = function(cmd, args) {
        if (!args) args = {};
        
        $.post(cmd, args, function(json) {
            var up = JSON.parse(json);
            dispatch(up.cmd, up.args);
        });
    };

    return this;
})();
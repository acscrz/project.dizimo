(function ($) {
    $.fn.alert = function (options) {

        var defaults = {
            type: null,
            content: null,
            onDeny: null,
            onApprove: null
        };

        var settings = $.extend({}, defaults, options);
        
        var dContent = $('<div />', { html: type(settings.type, settings.content), class: 'content' });
        
        return this.each(function () {
            var m = $('<div />', {
                html: dContent,
                class: 'ui small modal'
            }).appendTo('body').modal({
                closable: false,
                onDeny: function () {
                    if ($.isFunction(settings.onDeny)) {
                        settings.onDeny.call(this);
                    }
                },
                onApprove: function () {
                    if ($.isFunction(settings.onApprove)) {
                        settings.onApprove.call(this);
                    }
                },
                onHidden: function () {
                    m.remove();
                }
            }).modal('show');
            
            var dActions = $('<div />', { class: 'actions' }).appendTo(m);

            if (settings.type === 'confirm') {
                $('<button />', { html: 'CANCELAR', class: 'ui mini deny black button' }).appendTo(dActions);
            }

            $('<button />', { html: 'CONFIRMAR', class: 'ui mini approve primary button' }).appendTo(dActions);
            
        });
        
        function type(type, content) {
            switch (type) {
                case 'alert':
                    return '<h4 class="ui blue header"><i class="info icon"></i><div class="content">Mensagem de aviso</h4><h4 class="ui header" style="margin-top: 0 !important;"><div class="sub header">' + content + '</div></h4>';
                break;
                
                case 'confirm':
                    return '<h5 class="ui green header"><i class="help circle large icon"></i><div class="content">MENSAGEM DE CONFIRMAÇÃO<div class="sub header">' + content + '</div></h5>';
                break;
                
                case 'refresh':
                    return '<h4 class="ui blue header"><i class="refresh icon"></i><div class="content">Mensagem de esclarecimento</h4><h4 class="ui header" style="margin-top: 0 !important;"><div class="sub header">' + content + '</div></h4>';
                break;
            }
        }
        
    };
})(jQuery);
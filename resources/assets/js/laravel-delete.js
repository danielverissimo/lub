$(function() {

    var Laravel = {
        initialize: function() {
            this.methodLinks = $('[data-method]');
            this.token = $('a[data-token]');
            this.registerEvents();
        },

        registerEvents: function() {
            this.methodLinks.on('click', this.handleMethod);
        },

        handleMethod: function(e) {
            e.preventDefault()

            var link = $(this)
            var httpMethod = link.data('method').toUpperCase()
            var form

            // If the data-method attribute is not PUT or DELETE,
            // then we don't know what to do. Just ignore.
            if ($.inArray(httpMethod, ['PUT', 'DELETE']) === -1) {
                return false
            }

            Laravel
                .verifyConfirm(link)
                .done(function () {
                    form = Laravel.createForm(link)
                    form.submit()
                })
        },

        verifyConfirm: function(link) {
            var confirm = new $.Deferred()

            swal({
                title: "Excluir Registro...",
                text: link.data('confirm'),
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Sim, tenho certeza!",
                cancelButtonText: "Não",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function (isConfirm) {
                if (isConfirm) {
                    confirm.resolve(link)
                } else {
                    swal("Operação Cancelada", "Todas as informações estão como antes!", "error");
                }
            });

            return confirm.promise()
        },

        createForm: function(link) {
            var form =
                $('<form>', {
                    'method': 'POST',
                    'action': link.attr('action')
                });

            var token =
                $('<input>', {
                    'type': 'hidden',
                    'name': '_token',
                    'value': link.data('token')
                });

            var hiddenInput =
                $('<input>', {
                    'name': '_method',
                    'type': 'hidden',
                    'value': link.data('method')
                });

            return form.append(token, hiddenInput)
                .appendTo('body');
        }
    };

    Laravel.initialize();

});
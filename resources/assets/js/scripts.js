// Vue trans function to get langs.
Vue.prototype.trans = (key) => {
    return _.get(window.transResource, key, key);
};

// Javascript trans function to get langs.
window.trans = function(key){
    return _.get(window.transResource, key, key);
}

$(function() {
    $('.date-picker').datepicker({
        format: 'dd/mm/yyyy',
        language: "pt-BR",
        clearBtn: true
    });

    $.jMaskGlobals.watchDataMask= true;

    // Activate tooltips
    $('.tip, .tooltip, [data-tooltip], [data-toggle="tooltip"]').tooltip();

    // Activate popovers
    $('.popover, [data-popover], [data-toggle="popover"]').popover({
        trigger : 'hover'
    });

    // Activate modal windows
    $(document).on('click', '[data-modal], [data-toggle="modal"]', function(event) {

        event.preventDefault();

        // Get the modal target
        var target = $(this).data('target');

        // Is this modal target a confirmation?
        if (target === 'modal-confirm')
        {
            $('#modal-confirm .confirm').attr('href', $(this).attr('href'));

            $('#modal-confirm').modal({show:true, remote:false});

            return false;
        }

    });

    $('body').on('click', '.clear-data', function (e) {
        e.preventDefault();

        var inputs = $(this).closest('.input-group').find('input');

        swal({
                title: "Remover Seleção...",
                text: 'Tem certeza que deseja apagar o valor deste campo?',
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
                    inputs.val('');
                }
                swal.close();
            });


    });
});
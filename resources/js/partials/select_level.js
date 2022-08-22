const selectLevel = $('.select-level').select2({
    theme: 'bootstrap4',
    placeholder: 'Pilih Level',
    ajax: {
        url: URL_ADMIN + '/level/select2',
        dataType: 'json',
        data: function (params) {
            return {
                term: params.term
            }
        }
    }
})
import '../partials/select_kelas'
import '../partials/select_mapel'
import '../partials/select_rombel'
import '../partials/select_paket_soal'

const addWaktuMulai = $('#addWaktu').daterangepicker({
    singleDatePicker: true,
    timePicker: true,
    timePicker24Hour: true,
    startDate: new Date(),
    minDate: new Date(),
    locale: {
        format: 'D-M-Y H:mm'
    }
})

$('#tes').daterangepicker()

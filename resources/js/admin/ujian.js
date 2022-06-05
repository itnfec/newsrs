import '../partials/select_kelas'
import '../partials/select_mapel'
import '../partials/select_rombel'
import '../partials/select_paket_soal'

const table = $('#table').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: URL_ADMIN + '/ujian/datatable'
    },
    columns: [
        {data: 'index', name: 'id'},
        {data: 'nama'},
        {data: 'rombel.nama'},
        {data: 'paket_soal.nama'},
        {data: 'waktu_mulai'},
        {data: 'opsi'},
    ]
})

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

// form tambah
const modalTambah = $('#modalTambah')
const formTambah = $('#formTambah')
formTambah.on('submit', function (e) {
    e.preventDefault();

    const form = new FormData(this)

    $.post({
        url: URL_ADMIN + '/ujian',
        processData: false,
        contentType: false,
        data: form,
        success: function(res) {
            formTambah[0].reset()
            Swal.fire('Berhasil', 'Paket Soal berhasil ditambahkan', 'success')
            table.draw()
            modalTambah.modal('hide')
        }
    })
})

// Hapus Paket
$(document).on('click', '.btn-hapus', function () {
    const data = $(this).data()

    Swal.fire({
        title: "Hapus Paket Soal",
        icon: 'question',
        html: '<div class="alert alert-danger">Menghapus Paket Soal akan menghapus data launnya yang terkait</div>',
        showCancelButton: true,
        cancelButtonText: "Tidak",
        confirmButtonText: "Ya, hapus!"
    }).then(hapus => {
        if (hapus.value) {
            $.ajax({
                url: URL_ADMIN + '/ujian/' + data.id,
                type: 'DELETE',
                success: function (res) {
                    Swal.fire('Berhail', 'Paket Soal berhasil dihapus', 'success')
                    table.draw()
                }
            })
        }
    })
})
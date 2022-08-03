import '../partials/select_kelas'
import '../partials/select_mapel'
import '../partials/select_paket_soal'

const table = $('#table').DataTable({
    processing: true,
    responsive: true,
    serverSide: true,
    ajax: {
        url: URL_ADMIN + '/soal/datatable',
        data: function (d) {
            d.kelas_id = $('#selectKelas').val()
            d.mapel_id = $('#selectMapel').val()
            d.paket_soal_id = $('#selectPaket').val()
        }
    },
    columns: [
        {
            data: 'pertanyaan',
            name: 'soal'
        }, {
            data: 'paket_soal.judul',
            name: 'paketSoal.nama'
        }, {
            data: 'jenis',
            name: 'jenis'
        }, {
            data: 'opsi',
            name: 'opsi'
        },
    ]
})

$('.select-filter').on('change', function () {
    table.draw()
})

// Hapus Soal
$(document).on('click', '.btn-hapus', function () {
    const data = $(this).data()

    Swal.fire({
        title: "Hapus Paket Soal",
        icon: 'question',
        html: '<div class="alert alert-danger">Menghapus Soal akan menghapus data launnya yang terkait</div>',
        showCancelButton: true,
        cancelButtonText: "Tidak",
        confirmButtonText: "Ya, hapus!"
    }).then(hapus => {
        if (hapus.value) {
            $.ajax({
                url: URL_ADMIN + '/soal/' + data.id,
                type: 'DELETE',
                success: function (res) {
                    Swal.fire({
                        title: "Soal Berhasil Dihapus",
                        icon: 'success',
                        html: '<div class="alert alert-success">Menghapus Soal berhasil!</div>',
                    })
                    table.draw()
                }
            })
        }
    })
})

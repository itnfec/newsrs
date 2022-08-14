const table = $('#table').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: '/daftar-ujian/data',
        type: 'POST'
    },
    columns: [
        {data: 'index', name: 'id'},
        {data: 'nama', name: 'nama'},
        {data: 'paket_soal.mapel.nama', name: 'paketSoal.mapel.nama'},
        {data: 'paket_soal.nama', name: 'paketSoal.nama'},
        {data: 'waktu_mulai', name: 'waktu_mulai'},
        {data: 'durasi'},
        {data: 'btnMulai'}
    ]
})

const modalMulai = $('#modalMulai').on('show.bs.modal', function (event) {
            const button = $(event.relatedTarget)
    $.post({
        url: '/daftar-ujian/' + button.data('id'),
        success: function (res) {
            // var id = button.data('id')
            // var durasi = button.data('duration')
            // var mapel = button.data('mapel')
            // var judul = button.data('judul')
            // var keterangan = button.data('keterangan')
            // var modal = $(this)
            // modal.find('#ujianNama').text(judul)
            // modal.find('#ujianKeterangan').html(keterangan)
            // modal.find('#ujianDurasi').text(durasi + " Menit")
            // modal.find('#ujianPaket').text(mapel)
            // modal.find('#ujianId').text(id)
            $('#ujianId').val(res.id);
            $('#ujianNama').html(res.nama);
            $('#ujianKeterangan').html(res.keterangan);
            $('#ujianDurasi').html(res.durasi + ' Menit');
            $('#ujianPaket').html("<h4 class='text-capitalize'>" + res.paket_soal.judul + "</h4>");

            if (res.token != null) {
                $('#divToken').removeClass('d-none').html(`
                <th>Token</th>
                <td>
                    <input type="text" name="token" class="form-control" placeholder="Masukkan Token" required>
                </td>`)
            } else {
                $('#divToken').addClass('d-none').html('')
            }
        }
    })
})

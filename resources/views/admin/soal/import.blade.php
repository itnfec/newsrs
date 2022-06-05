@extends('layouts.admin')
@section('title', 'Import Soal')

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}">
@endpush

@section('content')
    <form action="{{ route('import.document') }}" enctype="multipart/form-data" method="POST" class="form-horizontal">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Detail Soal</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="selectKelas">Kelas</label>
                                    <select id="selectKelas" class="form-control select-kelas"></select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="selectMapel">Mata Pelajaran</label>
                                    <select id="selectMapel" class="form-control select-mapel"></select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="selectPaket">Paket Soal</label>
                                    <select name="paket_soal_id" id="selectPaket"
                                        class="form-control select-paket-soal" required></select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Import Soal</h4>
                    </div>
                    <div class="card-body">
                        <input type="file" name="soal" accept=".xlsx,.xls,.csv" required>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('script')
    <script src="{{ asset('assets/plugins/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('js/admin/soal_create.js') }}"></script>
    <script>
        const btnTambahPilihan = $('#btnTambahPilihan')
        const divPilihanJawaban = $('#pilihanJawaban')

        $('#selectJenis').on('change', function() {
            const value = $(this).val()

            if (value == 'pilihan_ganda') {
                btnTambahPilihan.removeAttr('disabled')
                divPilihanJawaban.html('')
            } else {
                btnTambahPilihan.attr('disabled', 'disabled')
                divPilihanJawaban.html(`
                <div class="form-group">
                    <input type="text" name="soal_pilihan[0][jawaban]" class="form-control" placeholder="Masukkan jawaban singkat">
                </div>`)
            }

            $(this).removeClass('is-invalid')
            $(this).next().remove()
        })
        $('#addSoal').summernote({
            height: 300
        })

        // change paket
        $('#selectPaket').on('change', function () {
            $(this).removeClass('is-invalid')
            // $(this).next().remove()
            tableSoal.draw()
        })

        // Pilihan Jawaban
        let countPilihanJawaban = 1
        btnTambahPilihan.on('click', function() {
            const html = `
            <div class="form-group">
                <div class="custom-control custom-radio mb-2">
                    <input class="custom-control-input" type="radio" id="soal_pilihan${countPilihanJawaban}"
                        name="jawaban" value="${countPilihanJawaban}">
                    <label for="soal_pilihan${countPilihanJawaban}" class="custom-control-label">Pilihan ${countPilihanJawaban}</label>
                </div>
                <textarea name="soal_pilihan[${countPilihanJawaban}][jawaban]" id="" cols="30" rows="10" class="editor-pilihan-jawaban"></textarea>
                <hr>
            </div>`

            divPilihanJawaban.append(html)
            $('.editor-pilihan-jawaban').summernote({
                height: 100
            })
            countPilihanJawaban++
        })

        $('#formTambah').on('submit', function (e) {
            e.preventDefault();
            const form = new FormData(this)

            $.post({
                url: URL_ADMIN + '/soal',
                processData: false,
                contentType: false,
                data: form,
                beforeSend: function () {
                    $('.is-invalid').removeClass('is-invalid')
                    $('.error').remove()
                },
                success: function (res) {
                    countPilihanJawaban = 1
                    $('#formTambah').trigger('reset')
                    $('#addSoal').summernote('code', '')
                    divPilihanJawaban.html('')
                    Swal.fire('Berhasil', 'Soal berhasil disimpan', 'success')
                    tableSoal.draw()
                },
                error: function (error) {
                    const err = error.responseJSON
                    Object.keys(err.errors).forEach(key => {
                        const item = err.errors[key]
                        const tag = $('[name="' + key + '"]')
                        tag.addClass('is-invalid')
                        tag.after(`<span class="error invalid-feedback">${item[0]}</span>`)
                    })
                }
            })
        })

        // table soal
        const tableSoal = $('#tableSoal').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            ajax: {
                url: URL_ADMIN + '/soal/datatable',
                data: function (d) {
                    d.paket_soal_id = $('#selectPaket').val()
                }
            },
            columns: [
                {data: 'index', name: 'id'},
                {data: 'pertanyaan'},
                {data: 'jenis'},
                {
                    data: 'media', render: function (data, type, row) {
                        if (data) {
                            return data
                        }

                        return '-'
                    }
                }
            ]
        })
    </script>
@endpush

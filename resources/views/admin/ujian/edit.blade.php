@extends('layouts.admin')
@section('title', 'Edit Ujian')

@push('style')
<link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
@endpush

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Ujian [{{ $data->nama }}]</h4>
                <div class="card-tools">
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTambah"><i
                            class="fas fa-plus"></i> Tambah Ujian</button>
                </div>
            </div>
            <div class="card-body">
                <form id="formTambah">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="addNama">Nama Ujian</label>
                                    <input type="text" name="nama" class="form-control" id="addNama"
                                        placeholder="Masukkan nama ujian" value="{{ $data->nama }}">
                                </div>
                                <div class="form-group">
                                    <label for="addWaktu">Waktu Mulai</label>
                                    <input type="text" name="waktu_mulai" class="form-control" id="addWaktu"
                                        placeholder="Masukkan waktu mulai">
                                </div>
                                <div class="form-group">
                                    <label for="addDurasi">Durasi Ujian</label>
                                    <input type="number" name="durasi" id="addDurasi" class="form-control"
                                        placeholder="Masukkan durasi ujian (menit)" value="{{ $data->durasi }}">
                                </div>
                                <div class="form-group">
                                    <label for="addKeterangan">Keterangan Ujian</label>
                                    <textarea name="keterangan" id="addKeterangan" cols="30" rows="5"
                                        class="form-control">{{ $data->keterangan }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="selectKelas">Kelas</label>
                                    <select id="selectKelas" class="form-control select-kelas"></select>
                                </div>
                                <div class="form-group">
                                    <label for="selectMapel">Mata Pelajaran</label>
                                    <select id="selectMapel" class="form-control select-mapel"></select>
                                </div>
                                <div class="form-group">
                                    <label for="selectRombel">Rombongan Belajar</label>
                                    <select name="rombel_id" id="selectRombel" class="form-control select-rombel"></select>
                                </div>
                                <div class="form-group">
                                    <label for="selectPaket">Paket Soal</label>
                                    <select name="paket_soal_id" id="selectPaket" data-type="ujian"
                                        class="form-control select-paket-soal"></select>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="tampilHasil" value="1"
                                            name="tampil_hasil" {{ $data->tampil_hasil != null ? "checked" : "" }}>
                                        <label for="tampilHasil" class="custom-control-label">Tampilkan Nilai</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="detailHasil" value="1"
                                            name="detail_hasil" {{ $data->detail_hasil != null ? "checked" : "" }}>
                                        <label for="detailHasil" class="custom-control-label">Tampilkan Hasil</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="token" value="1"
                                            name="token" {{ $data->token != null ? "checked" : "" }}>
                                        <label for="token" class="custom-control-label">Gunakan Token</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                {{--
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="inputBobot">Bobot</label>
                                    <input type="number" name="bobot" id="inputBobot" class="form-control" value="0">
                                </div>
                            </div> --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputPoinBenar">Poin Benar</label>
                                    <input type="number" name="poin_benar" id="inputPoinBenar" class="form-control"
                                        value="{{ $data->poin_benar }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputPoinSalah">Poin Salah</label>
                                    <input type="number" name="poin_salah" id="inputPoinSalah" class="form-control"
                                        value="{{ $data->poin_salah }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputPoinTidakJawab">Poin Tidak Jawab</label>
                                    <input type="number" name="poin_tidak_jawab" id="inputPoinTidakJawab"
                                        class="form-control" value="{{ $data->poin_tidak_jawab }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')
<script src="{{ asset('assets/plugins/daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('js/admin/ujian.js') }}"></script>
<script>
    var data = {!! json_encode($data->toArray()) !!};
    
    var optionKelas = new Option(data.rombel.kelas.nama, data.rombel.kelas.id, true, true);
    $('#selectKelas').append(optionKelas).trigger('change');
    
    var optionMapel = new Option(data.paket_soal.mapel.nama, data.paket_soal.mapel.id, true, true);
    $('#selectMapel').append(optionMapel).trigger('change');

    var optionRombel = new Option(data.rombel.nama, data.rombel.id, true, true);
    $('#selectRombel').append(optionRombel).trigger('change');
    
    var optionPaketSoal = new Option(data.paket_soal.judul, data.paket_soal.id, true, true);
    $('#selectPaket').append(optionPaketSoal).trigger('change');

</script>
@endpush
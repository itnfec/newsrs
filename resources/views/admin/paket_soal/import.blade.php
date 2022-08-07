@extends('layouts.admin')
@section('title', 'Import Paket Soal')

@push('style')
<link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
@endpush

@section('content')
<div class="container">
<form action="{{ route('import.document.paket') }}" enctype="multipart/form-data" method="POST" class="form-horizontal">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Import Paket Soal</h4>
                </div>
                <div class="card-body">
                    <input type="file" name="paket" accept=".xlsx,.xls,.csv" required>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Detail Soal</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="selectKelas">Kelas</label>
                                <select id="selectKelas" class="form-control select-kelas" required
                                    name="kelas_id"></select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="selectMapel">Mata Pelajaran</label>
                                <select id="selectMapel" class="form-control select-mapel" required name="mapel_id">

                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Daftar Ujian</h4>
                </div>
                <div class="card-body">
                    <div class="col-md-12 row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="duNamaUjian">Nama Ujian</label>
                                <input type="text" name="duNamaUjian" class="form-control" id="duNamaUjian"
                                    placeholder="Masukkan Nama Ujian">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="addWaktu">Waktu Mulai</label>
                                <input type="text" name="duWaktuMulai" class="form-control" id="addWaktu"
                                    placeholder="Masukkan waktu Mulai">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="addDurasi">Durasi Ujian</label>
                                <input type="number" name="duDurasi" id="addDurasi" class="form-control"
                                    placeholder="Masukkan durasi ujian (menit)">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="selectRombel">Rombongan Belajar</label>
                                <select name="du_rombel_id" id="selectRombel"
                                    class="form-control select-rombel"></select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="duKeterangan">Keterangan Ujian</label>
                                <textarea name="duKeterangan" id="duKeterangan" cols="30" rows="5"
                                    class="form-control summernote"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="tampilHasil" value="1"
                                        name="du_tampil_hasil">
                                    <label for="tampilHasil" class="custom-control-label">Tampilkan Nilai</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="detailHasil" value="1"
                                        name="du_detail_hasil">
                                    <label for="detailHasil" class="custom-control-label">Tampilkan Hasil</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="token" value="1"
                                        name="du_token">
                                    <label for="token" class="custom-control-label">Gunakan Token</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputPoinBenar">Poin Benar</label>
                                <input type="number" name="du_poin_benar" id="inputPoinBenar" class="form-control"
                                    value="0">
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputPoinSalah">Poin Salah</label>
                                <input type="number" name="du_poin_salah" id="inputPoinSalah" class="form-control"
                                    value="0">
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputPoinTidakJawab">Poin Tidak Jawab</label>
                                <input type="number" name="du_poin_tidak_jawab" id="inputPoinTidakJawab"
                                    class="form-control" value="0">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-right">
        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
    </div>
</form>
</div>
@endsection
@push('script')

<script src="{{ asset('assets/plugins/daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>

<script src="{{ asset('js/admin/soal_create.js') }}"></script>
@endpush
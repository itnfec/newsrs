@extends('layouts.admin')
@section('title', 'Paket Soal')

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}">
@endpush

@push('script')
    <script src="{{ asset('assets/plugins/summernote/summernote-bs4.js') }}"></script>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <a href="{{ route('paket.import') }}" class="btn btn-sm btn-success btn-sm"><i class="fas fa-plus"></i>
                            Import Paket Soal</a>
                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalTambah"><i class="fas fa-plus"></i> Tambah Paket Soal</button>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped display nowrap w-100" id="table">
                        <thead>
                            <tr>
                                <th>Opsi</th>
                                <th>Judul</th>
                                <th>Author</th>
                                <th>publisher</th>
                                <th>level</th>
                                <th>point</th>
                                <th>jenis</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Tambah --}}
    <div class="modal fade" id="modalTambah">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Paket Soal</h5>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="formTambah" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="addKelas">Kelas</label>
                            <select name="kelas_id" id="addKelas" class="form-control select-kelas"></select>
                        </div>
                        <div class="form-group">
                            <label for="addMapel">Mata Pelajaran</label>
                            <select name="mapel_id" id="addMapel" class="form-control select-mapel"></select>
                        </div>
                        <div class="form-group">
                            <label for="addJudul">Judul</label>
                            <input type="text" name="judul" class="form-control" id="addJudul" placeholder="Masukkan Judul Paket">
                        </div>
                        <div class="form-group">
                            <label for="addAuthor">Author</label>
                            <input type="text" name="author" class="form-control" id="addAuthor" placeholder="Masukkan Author Paket">
                        </div>
                        <div class="form-group">
                            <label for="addPublisher">Publisher</label>
                            <input type="text" name="publisher" class="form-control" id="addPublisher" placeholder="Masukkan Publisher Paket">
                        </div>
                        <div class="form-group">
                            <label for="addLevel">Level</label>
                            <input type="text" name="level" class="form-control" id="addLevel" placeholder="Masukkan Level Paket">
                        </div>
                        <div class="form-group">
                            <label for="addPoint">Point</label>
                            <input type="text" name="point" class="form-control" id="addPoint" placeholder="Masukkan Point Paket">
                        </div>
                        <div class="form-group">
                            <label for="addJenis">Jenis</label>
                            <input type="text" name="jenis" class="form-control" id="addJenis" placeholder="Masukkan Jenis Paket">
                        </div>

                        <div class="form-group">
                            <label for="image">Cover Buku</label>
                            <input type="file" class="form-control" name="image" id="image">
                        </div>

                        <div class="form-group">
                            <label for="addKeterangan">Keterangan</label>
                            <textarea name="keterangan" cols="30" rows="5" class="form-control summernote" placeholder="Masukkan keterangan Paket Soal"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div class="modal fade" id="modalEdit">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Paket Soal</h5>
                </div>
                <form id="formEdit">
                    <input type="hidden" id="editId">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="editKelas">Kelas</label>
                            <select name="kelas_id" id="editKelas" class="form-control select-kelas"></select>
                        </div>
                        <div class="form-group">
                            <label for="editMapel">Mata Pelajaran</label>
                            <select name="mapel_id" id="editMapel" class="form-control select-mapel"></select>
                        </div>
                        <div class="form-group">
                            <label for="editJudul">Judul</label>
                            <input type="text" name="judul" class="form-control" id="editJudul" placeholder="Masukkan Judul Paket">
                        </div>
                        <div class="form-group">
                            <label for="editAuthor">Author</label>
                            <input type="text" name="author" class="form-control" id="editAuthor" placeholder="Masukkan Author Paket">
                        </div>
                        <div class="form-group">
                            <label for="editPublisher">Publisher</label>
                            <input type="text" name="publisher" class="form-control" id="editPublisher" placeholder="Masukkan Publisher Paket">
                        </div>
                        <div class="form-group">
                            <label for="editLevel">Level</label>
                            <input type="text" name="level" class="form-control" id="editLevel" placeholder="Masukkan Level Paket">
                        </div>
                        <div class="form-group">
                            <label for="editPoint">Point</label>
                            <input type="text" name="point" class="form-control" id="editPoint" placeholder="Masukkan Point Paket">
                        </div>
                        <div class="form-group">
                            <label for="editJenis">Jenis</label>
                            <input type="text" name="jenis" class="form-control" id="editJenis" placeholder="Masukkan Jenis Paket">
                        </div>
                        <div class="form-group">
                            <label for="editKeterangan">Keterangan</label>
                            <textarea name="keterangan" cols="30" rows="5" class="form-control summernote" placeholder="Masukkan keterangan Paket Soal"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('js/admin/paket_soal.js') }}"></script>
@endpush

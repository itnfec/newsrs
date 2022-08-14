@extends('layouts.admin')
@section('title', 'Siswa')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                     <a href="{{ route('siswa.import') }}" class="btn btn-sm btn-success btn-sm"><i class="fas fa-plus"></i>Import Siswa</a>
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalTambah"><i class="fas fa-plus"></i> Tambah Siswa</button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped text-center display nowrap w-100" id="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Sekolah</th>
                            <th>Level</th>
                            <th>Nama</th>
                            <th>NIS</th>
                            <th>Jenis Kelamin</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Modal Tambah --}}
<div class="modal fade" id="modalTambah">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Siswa</h4>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="formTambah">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="addLevel">level</label>
                        <select name="level_id" id="addLevel" class="form-control select-level"></select>
                    </div>
                    <div class="form-group">
                        <label for="addNama">Nama Siswa</label>
                        <input type="text" name="nama" class="form-control" id="addNama" placeholder="Masukkan Nama Siswa">
                    </div>
                    <div class="form-group">
                        <label for="addNis">NIS</label>
                        <input type="text" name="nis" class="form-control" id="addNis" placeholder="Masukan NIS Siswa">
                    </div>
                    <div class="form-group">
                        <label for="addJenisKelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" name="jenis_kelamin" id="addJenisKelamin" class="form-control">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
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
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Siswa</h4>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="formEdit">
                <input type="hidden" id="editId">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editRombel">Rombongan Belajar</label>
                        <select name="rombel_id" id="editRombel" class="form-control select-rombel"></select>
                    </div>
                    <div class="form-group">
                        <label for="editNama">Nama Siswa</label>
                        <input type="text" name="nama" class="form-control" id="editNama" placeholder="Masukkan Nama Siswa">
                    </div>
                    <div class="form-group">
                        <label for="editNis">NIS</label>
                        <input type="text" name="nis" class="form-control" id="editNis" placeholder="Masukan NIS Siswa">
                    </div>
                    <div class="form-group">
                        <label for="editPassword">Password</label>
                        <input type="password" name="password" id="editPassword" class="form-control" placeholder="Masukkan password baru">
                    </div>
                    <div class="form-group">
                        <label for="editJenisKelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" name="jenis_kelamin" id="editJenisKelamin" class="form-control">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
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
<script src="{{ asset('js/admin/siswa.js') }}"></script>
@endpush

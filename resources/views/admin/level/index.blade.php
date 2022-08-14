@extends('layouts.admin')
@section('title', 'Level')

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalTambah"><i class="fas fa-plus"></i> Tambah Level</button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped text-center display nowrap w-100" id="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Point</th>
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
                <h4 class="modal-title">Tambah Level</h4>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="formTambah">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="addNama">Nama Level</label>
                        <input type="text" name="name" class="form-control" id="addNama" placeholder="Masukkan Nama Level">
                    </div>
                    <div class="form-group">
                        <label for="addpoint">Point Level</label>
                        <input type="text" name="point" class="form-control" id="addpoint" placeholder="Masukkan point Level">
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
                <h4 class="modal-title">Edit Level</h4>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="formEdit">
                @method('PUT')
                <input type="hidden" id="editId">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editName">Nama Level</label>
                        <input type="text" name="name" class="form-control" id="editName" placeholder="Masukkan Nama Level">
                    </div>
                    <div class="form-group">
                        <label for="editPoint">Point Level</label>
                        <input type="text" name="point" class="form-control" id="editPoint" placeholder="Masukkan point Level">
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
<script src="{{ asset('js/admin/level.js') }}"></script>
@endpush

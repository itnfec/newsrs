@extends('layouts.admin')
@section('title', 'Import Paket Soal')

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}">
@endpush

@section('content')
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
    </script>
@endpush

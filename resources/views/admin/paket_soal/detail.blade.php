@extends('layouts.admin')
@section('title', 'Detail Paket Soal')
@push('style')
<link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}">
@endpush
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Detail Paket</h4>
			</div>
			<div class="card-body">
				<form action="{{ route('paket.soal.update') }}" enctype="multipart/form-data" method="POST" class="form-horizontal">
					@csrf
					<input type="hidden" name="id" value="{{ $paket->id }}">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="editKelas">Kelas</label>
							<select name="kelas_id" id="editKelas" class="form-control select-kelas" ></select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="selectMapel">Mata Pelajaran</label>
						<select id="selectMapel" name="mapel_id" class="form-control select-mapel"></select>
					</div>
				</div>
				
				<div class="col-md-12 pt-2">
					<div class="form-group">
						<label for="judul">Judul</label>
						<input type="text" name="judul" class="form-control" value="{{ $paket->judul ?? '' }}" id="judul" placeholder="Masukkan Judul Paket">
					</div>
				</div>


				<div class="col-md-6 pt-2">
					<div class="form-group">
						<label for="jenis">Jenis</label>
						<input type="text" name="jenis" class="form-control" value="{{ $paket->jenis ?? '' }}" id="jenis" placeholder="Masukkan Jenis Paket">
					</div>
				</div>
				
				<div class="col-md-6 pt-2">
					<div class="form-group">
						<label for="author">Author</label>
						<input type="text" name="author" value="{{ $paket->author ?? '' }}" class="form-control" id="author" placeholder="Masukkan Author Paket">
					</div>
				</div>
				
				<div class="col-md-6 pt-2">
					<label for="publisher">Publisher</label>
					<input type="text" name="publisher" value="{{ $paket->publisher ?? '' }}" class="form-control" id="publisher" placeholder="Masukkan Author Paket">
				</div>
				
				<div class="col-md-6 pt-2">
					<label for="level">Level</label>
					<input type="text" name="level" class="form-control" value="{{ $paket->level ?? '' }}" id="level" placeholder="Masukkan Author Paket">
				</div>
				
				<div class="col-md-6 pt-2">
					<label for="point">Point</label>
					<input type="text" name="point" class="form-control" value="{{ $paket->point ?? '' }}" id="point" placeholder="Masukkan Author Paket">
				</div>
				
				<div class="col-md-6 pt-2">
					<label for="jenis">Jenis</label>
					<input type="text" name="jenis" value="{{ $paket->jenis ?? '' }}" class="form-control" id="jenis" placeholder="Masukkan Author Paket">
				</div>
				<div class="col-md-6 pt-2">
					<label>Cover</label>
					<input type="file" name="image" class="form-control">
				</div>
				
				<div class="col-md-6 pt-5">
					@if(file_exists($paket->image))
					    <img src="{{ $paket->image }}">
					@else 
					    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTiQc9dZn33Wnk-j0sXZ19f8NiMZpJys7nTlA&usqp=CAU">
					@endif
				</div>
				

				<div class="col-md-12 pt-3" >
					<label for="addKeterangan">Keterangan</label>
					<textarea name="keterangan" cols="30" rows="5" value="{{ $paket->keterangan ?? '' }}" class="form-control summernote" placeholder="Masukkan keterangan Paket Soal">
						{{ $paket->keterangan ?? '' }}
					</textarea>
				</div>
				<div class="col-md-12 pt-4 " >
					<div class="text-right">
						<button type="submit" class="btn btn-outline-primary" style="width:15%;">Update</button>
					</div>
				</div>
				
			</div>
		</form>
	</div>
</div>
<div class="card">
	<div class="card-header">
		<div class="card-tools">
			<a href="{{ route('soal.import', [ 'paketId' => $id ]) }}" class="btn btn-sm btn-success btn-sm"><i class="fas fa-plus"></i>
			Import Soal</a>
			<a href="{{ route('soal.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i>
			Tambah Soal</a>
		</div>
	</div>
	<input type="hidden" value="{{ $id }}" id="paket_soal_id">
	<div class="card-body">
		<table class="table table-striped display nowrap w-100" id="soal-table" data-id="'.$id.'">
			<thead>
				<tr>
					<th>No</th>
					<th>jenis</th>
					<th>Pertanyaan</th>
					<th>Opsi</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
</div>
</div>
@endsection
@push('script')
<script src="{{ asset('assets/plugins/daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset('js/admin/detail_paket_soal.js') }}"></script>
<script type="text/javascript">
var data = {!! json_encode($paket->toArray()) !!};
var optionKelas = new Option(data.kelas.nama, data.kelas.id, true, true);
	$('#editKelas').append(optionKelas).trigger('change');
var optionMapel = new Option(data.mapel.nama, data.mapel.id, true, true);
	$('#selectMapel').append(optionMapel).trigger('change');
</script>
@endpush
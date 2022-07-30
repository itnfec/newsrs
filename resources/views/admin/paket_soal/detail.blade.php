@extends('layouts.admin')
@section('title', 'Detail Paket Soal')
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
                                        class="form-control select-paket-soal"></select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
		 <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <a href="{{ route('soal.import') }}" class="btn btn-sm btn-success btn-sm"><i class="fas fa-plus"></i>
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
								<input type="text" name="duNamaUjian" class="form-control" id="duNamaUjian" placeholder="Masukkan Nama Ujian">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="addWaktu">Waktu Mulai</label>
								<input type="text" name="duWaktuMulai" class="form-control" id="duWaktuMulai" placeholder="Masukkan waktu Mulai">
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
								<label for="duKeterangan">Keterangan Ujian</label>
								<textarea name="duKeterangan" id="duKeterangan" cols="30" rows="5"
								class="form-control"></textarea>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="selectRombel">Rombongan Belajar</label>
							<select name="du_rombel_id" id="selectRombel" class="form-control select-rombel"></select>
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
@endsection
@push('script')
<script src="{{ asset('assets/plugins/daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset('js/admin/detail_paket_soal.js') }}"></script>
@endpush
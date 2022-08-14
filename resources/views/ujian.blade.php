@extends('layouts.app_ujian')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div id="accordion">
                <div class="card">
                    <a class="text-dark" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        <div class="card-header">
                            <h4 class="card-title">
                                    Detail Ujian [{{ $ujianSiswa->ujian->paketSoal->judul }}]

                            </h4>
                            <div class="float-right text-primary">Klik Untuk Lihat Detail</div><br>
                        </div>
                    </a>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Nama Ujian</th>
                                                <td>{{ $ujianSiswa->ujian->paketSoal->judul }}</td>
                                            </tr>
                                            <tr>
                                                <th>Keterangan</th>
                                                <td>{!! $ujianSiswa->ujian->keterangan !!}</td>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Waktu Mulai</th>
                                                <td>{{ \Carbon\Carbon::parse($ujianSiswa->mulai)->diffForHumans() }}</td>
                                            </tr>
                                            <tr>
                                                <th>Waktu Selesai</th>
                                                <td>{{ \Carbon\Carbon::parse($ujianSiswa->selesai)->format('H:i:s') }}</td>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-8">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="card-title m-0">Soal <span id="noSoal"></span></h5>
                    <div class="card-tools">
                        <div class="custom-control custom-checkbox mr-3">
                            <input class="custom-control-input" type="checkbox" id="btnRagu" value="1">
                            <label for="btnRagu" class="custom-control-label">Ragu-ragu</label>
                        </div>
                    </div>
                </div>
                <form id="formJawab">
                    <input type="hidden" name="id" id="ujianHasilId">
                    <div class="card-body">
                        <div class="card-text" id="div-soal">
                            {{-- Soal --}}
                        </div>

                        <div class="form-group mt-2" id="div-jawaban">
                            {{-- List Jawaban --}}
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-sm btn-primary" id="btnPrev"><i class="fas fa-arrow-left"></i> Sebelumnya</button>
                            <button type="submit" class="btn btn-sm btn-outline-success">Simpan</button>
                            <button type="button" class="btn btn-sm btn-primary" id="btnNext">Selanjutnya <i class="fas fa-arrow-right"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="card-title m-0">Daftar Soal</h5>
                </div>
                <div class="card-body">
                    <h3 id="timer" class="text-center">00:00:00</h3>
                    <div class="row" id="pilihan"></div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-block btn-outline-danger" id="btnAkhiri">Akhiri Ujian</button>
                </div>
            </div>
        </div>

        {{-- {!! json_encode($ujianSiswa) !!} --}}
    </div>
@endsection

@push('script')
    <script>
        const ujianSiswaid = '{{ $ujianSiswa->id }}';
        const ujianId = '{{ $ujianSiswa->ujian_id }}';
        const paketSoalId = '{{ $ujianSiswa->ujian->paket_soal_id }}';
        const end = new Date('{{ $ujianSiswa->selesai }}').getTime()
    </script>
    <script src="{{ asset('js/ujian.js') }}"></script>
@endpush

@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">

        @foreach ($errors->all() as $error)
        <div class="alert alert-warning">{!! $error !!}</div>
        @endforeach

        <div class="row col-md-12">

            @foreach($ujian as $data)
            <div class="col-md-4">

                <div class="card">
                  <center><p class="card-text pt-2"><b>{{ $data->nama }}</b></p></center>
                  <img class="card-img-top pt-2" src="{{$data->paketSoal->image}}" alt="Card image cap" style="width: 100%;
                  height: 40vh;
                  object-fit: cover;">
                  <div class="card-body">
                    <p class="card-text"> Mulai: {{ $data->waktu_mulai }}</p>
                    <p class="card-text">Durasi:  {{ $data->durasi }} menit </p>
                    <p class="card-text">Mapel: {{ $data->paketSoal->mapel->nama }}</p>
                    <hr>

                    <div class="text-right">
                        @if($data->checkUjian($data->waktu_mulai))
                        <a href="#" class="btn btn-primary btn-mulai px-5" data-id="{{ $data->id }}" >Mulai</a> 
                        @else
                        <button type="button" class="btn btn-primary" disabled>Mulai</button>
                        @endif
                    </div>

                </div>
            </div>
        </div>
        @endforeach

        <div>
        </div>
    </div>
</div>

</div>

<div class="row col-md-12">
    <div class="col-md-10">
        
    </div>

    <div class="col">
         {{ $ujian->links() }}
    </div>

</div>


{{-- Modal mulai --}}
<div class="modal fade" id="modalMulai">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Mulai Ujian</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ route('ujian.mulai') }}" method="POST">
                @csrf
                <input type="hidden" name="ujian_id" id="ujianId">
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Ujian</th>
                                <td id="ujianNama"></td>
                            </tr>
                            <tr>
                                <th>Keterangan</th>
                                <td id="ujianKeterangan"></td>
                            </tr>
                            <tr>
                                <th>Durasi</th>
                                <td id="ujianDurasi"></td>
                            </tr>
                            <tr>
                                <th>Paket Soal</th>
                                <td id="ujianPaket"></td>
                            </tr>
                            <tr id="divToken" class="d-none">
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-sm btn-primary">Mulai</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="{{ asset('js/daftar_ujian.js') }}"></script>
@endpush

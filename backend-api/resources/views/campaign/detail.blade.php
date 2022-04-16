@extends('template.default')

@section('content')
<div class="row">
    <div class="col">
        <div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-secondary">Detail Campaign</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <!-- <img src="" class="img-fluid" alt=""> -->
                            <div>Alat</div>
                        </div>
                        <div class="col">
                            <div>
                                <span>Nama Campaign</span>
                                <input type="text" class="form-control mt-2" disabled value="{{ $campaign->campaign_title }}">
                            </div>

                            <div class="mt-4">
                                <span>Deskripsi</span>
                                <textarea cols="30" rows="5" class="form-control" disabled>{{$campaign->description}}</textarea>
                            </div>

                            <div class="mt-4">
                                <span>Jenis Campaign</span>
                                <div>
                                    @if ($campaign->always_open == 0)
                                        <span class="btn btn-sm btn-primary">Terbatas Waktu</span>
                                    @elseif ($campaign->always_open == 1)
                                        <span class="btn btn-sm btn-success">Tak Terbatas Waktu</span>
                                    @endif
                                </div>
                            </div>

                            <div class="mt-4">
                                <span>Jenis Pendanaan</span>
                                <div>
                                    @if ($campaign->always_open == 0)
                                        <span class="btn btn-sm btn-primary">Terbatas dengan Jumlah</span>
                                    @elseif ($campaign->always_open == 1)
                                        <span class="btn btn-sm btn-success">Tak Terbatas dengan Jumlah</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col">
                            <div>
                                <span>Target Donasi</span>
                                <input type="text" class="form-control mt-2" disabled value="Rp. {{ number_format($campaign->goal_amount) }}">
                            </div>
                        </div>

                        <div class="col">
                            <div>
                                <span>Donasi Terkumpul</span>
                                <input type="text" class="form-control mt-2" disabled value="Rp. {{ number_format($campaign->current_amount) }}">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col">
                            <div>
                                <span>Batas Waktu Campaign</span>
                                @if ($campaign->target_day)
                                    <input type="text" class="form-control mt-2" disabled value="{{ $campaign->target_day }}">
                                @else
                                    <span class="btn btn-sm btn-primary">Tidak ada batas waktu</span>
                                @endif
                            </div>
                        </div>
                        <div class="col"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- modal approve confirmation --}}
<div class="modal fade" id="approve-donasi" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda Yakin Ingin Melakukan Approval Donasi Terkait ?</p>
            </div>
            <div class="modal-footer">
                <form action="" method="POST" id="modal-approve-form">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Approve</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- modal reject confirmation --}}
<div class="modal fade" id="reject-donasi" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda Yakin Ingin Melakukan Pembatalan Donasi Terkait ?</p>
            </div>
            <div class="modal-footer">
                <form action="" method="POST" id="modal-reject-form">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Batalkan</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- modal bukti --}}
<div class="modal fade" id="modal-bukti" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img id="url-img-bukti" class="img-fluid" alt="">
            </div>
        </div>
    </div>
</div>
@endsection

@section('script-custom')

@endsection
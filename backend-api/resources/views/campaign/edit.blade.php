
@extends('template.default')

@section('content')
<div class="row">
    <div class="col">
        <div>
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
            @endif
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-secondary">Detail Campaign</h6>
                </div>
                <form action="{{url('dashboard/campaign/' . $id . '/update')}}" method="POST">
                    {{csrf_field()}}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col">
                                        @php($iimg = 1)
                                        @foreach ($image as $img)
                                            @if ($iimg == 1)
                                                <img src="/{{$img->path}}" class="img-fluid" alt="">
                                            @endif
                                            @php($iimg++)
                                        @endforeach
                                    </div>
                                </div>
                                <div class="row mt-3 justify-content-center">
                                    <div class="col-6 d-inline text-center">
                                        <div class="badge badge-success rounded-circle p-3"><i style="font-size: 18px;" class="fas fa-clock"></i></div>
                                        <div class="mt-3">
                                            @if ($campaign->always_open == 0)
                                                <div>Terbatas Waktu</div>
                                            @elseif ($campaign->always_open == 1)
                                                <div>Tak Terbatas Waktu</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-6 d-inline text-center">
                                        <span class="badge badge-danger rounded-circle p-3"><i style="font-size: 18px;" class="fas fa-external-link"></i></span>
                                        <div class="mt-3">
                                            @if ($campaign->always_open == 0)
                                                <span>Terbatas dengan Jumlah</span>
                                            @elseif ($campaign->always_open == 1)
                                                <span>Tak Terbatas dengan Jumlah</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div>
                                    <span>Nama Campaign</span>
                                    <input type="text" name="campaign_title" class="form-control mt-2" value="{{ $campaign->campaign_title }}">
                                </div>

                                <div class="mt-4">
                                    <span>Deskripsi</span>
                                    <textarea cols="30" name="description" rows="5" class="form-control">{{$campaign->description}}</textarea>
                                </div>

                                <div class="mt-4">
                                    <span>Target Donasi</span>
                                    <input type="number" name="goal_amount" class="form-control mt-2" value="{{$campaign->goal_amount}}">
                                </div>

                                <div class="mt-4">
                                    <span>Batas Waktu Campaign</span>
                                    @if ($campaign->target_day)
                                        <input type="date" name="target_day" class="form-control mt-2" value="{{ $campaign->target_day }}">
                                    @else
                                        <div class="btn btn-sm btn-primary">Tidak ada batas waktu</div>
                                        <input type="date" name="target_day" class="form-control mt-2" value="{{ $campaign->target_day }}">
                                    @endif
                                </div>

                                <div class="mt-4">
                                    <span>Status Campaign</span>
                                    <select name="always_open" id="always_open" class="form-control">
                                        <option value="0" <?= $campaign->always_open == 0 ? 'selected' : '' ?> >Terbatas Waktu</option>
                                        <option value="1" <?= $campaign->always_open == 1 ? 'selected' : '' ?> >Tidak Terbatas Waktu</option>
                                    </select>
                                </div>

                                <div class="mt-4">
                                    <span>Status Donasi</span>
                                    <select name="always_fund" id="always_fund" class="form-control">
                                        <option value="0" <?= $campaign->always_fund == 0 ? 'selected' : '' ?> >Terbatas Nominal Donasi</option>
                                        <option value="1" <?= $campaign->always_fund == 1 ? 'selected' : '' ?> >Tidak Terbatas Nominal Donasi</option>
                                    </select>
                                </div>

                                <!-- <div class="mt-4">
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
                                </div> -->
                            </div>
                        </div>

                        <hr>

                        <div class="row mt-4">
                            <div class="col">
                                <h4 class="m-0 font-weight-bold text-secondary">Gambar Campaign</h6>
                                <div class="mt-4">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <td>No</td>
                                                <td>Gambar</td>
                                                <td>Urutan</td>
                                                <td>Aksi</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php($iteratorGambar = 1)
                                            @foreach ($image as $img)
                                                <tr>
                                                    <td> <span>{{$iteratorGambar}}</span> </td>
                                                    <td> <img src="/{{ $img->path }}" style="max-height: 85px;" class="img-fluid" alt=""> </td>
                                                    <td>
                                                        <select class="form-control">
                                                            @for ($i=1; $i<=count($image); $i++)
                                                                <option value="{{$i}}" <?= $img->sequence == $i ? 'selected' : '' ?> > {{$i}} </option>
                                                            @endfor
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <div class="badge badge-danger rounded-circle p-3"><i style="font-size: 14px;" class="fas fa-trash"></i></div>
                                                        <div class="badge badge-warning rounded-circle p-3"><i style="font-size: 14px;" class="fas fa-pencil"></i></div>
                                                    </td>
                                                </tr>
                                                @php($iteratorGambar++)
                                            @endforeach
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row mt-4 p-4">
                            <div class="col text-right">
                                <button type="submit" class="btn btn-primary">Update Data</button>
                            </div>
                        </div>
                    </div>
                </form>
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
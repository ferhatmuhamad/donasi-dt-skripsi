
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
                <form action="{{url('dashboard/campaign/' . $id . '/update')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col">
                                        <img src="/{{$campaign->path}}" class="img-fluid" alt="">
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
                                    <span>Ganti Gambar Campaign</span>
                                    <input type="file" name="file-image-campaign" class="form-control mt-2">
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
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-image">Tambah Gambar</button>
                                </div>
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
                                                    <td> <img src="/{{ $img->path }}" style="max-height: 60px;" class="img-fluid" alt=""> </td>
                                                    <td>
                                                        {{ $img->sequence }}
                                                    </td>
                                                    <td>
                                                        <div onclick="rejectModal({{$img->id_campaign_img}})" class="badge badge-danger rounded-circle p-3"><i style="font-size: 14px;" class="fas fa-trash"></i></div>
                                                        <a href="{{url('dashboard/campaign/2/edit/gambar/' . $img->id_campaign_img)}}" class="badge badge-warning rounded-circle p-3"><i style="font-size: 14px;" class="fas fa-pencil"></i></a>
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

{{-- tambah gambar --}}
<div class="modal fade" id="add-image" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('dashboard/campaign/2/edit/addimage') }}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="modal-header">
                    <h5>Tambah Data Gambar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <span>File Gambar</span>
                        <input type="file" class="form-control" name="file-image">
                    </div>
                    <div class="mt-4">
                        <span>Urutan</span>
                        <input type="number" class="form-control" name="sequence">
                    </div>
                    <div class="mt-4">
                        <button class="btn btn-primary btn-block" type="submit">Tambah Gambar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- modal reject confirmation --}}
<div class="modal fade" id="reject-campaign-img" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
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
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script-custom')
<script>
    function rejectModal(id) {
        $('#reject-campaign-img').modal('show');
        document.getElementById('modal-reject-form').setAttribute('action', '/dashboard/campaign/' + id + '/edit/removeimage');
    }
</script>
@endsection
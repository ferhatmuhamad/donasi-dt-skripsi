
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
                    <h4 class="m-0 font-weight-bold text-secondary">Detail Campaign Image</h6>
                </div>
                
                <form action="{{url('/dashboard/campaign/' . $campaign->id_campaign . '/edit/gambar/' . $image->id_campaign_img . '/' . 'update')}}" method="POST">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col">
                            <div class="p-4">
                                <img src="{{ url($image->path) }}" class="img-fluid" style="max-height: 200px;" alt="">
                            </div>
                        </div>
                        <div class="col p-4">
                            <div>
                                <span>Ganti Foto</span>
                                <input type="file" class="form-control" name="file-campaign-img">
                            </div>
                            <div class="mt-4">
                                <span>Urutan</span>
                                <input type="number" class="form-control" name="sequence" value="{{ $image->sequence }}">
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary btn-sm ">Update Data Image</button>
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
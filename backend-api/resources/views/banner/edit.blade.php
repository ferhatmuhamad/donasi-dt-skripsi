
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
                    <h4 class="m-0 font-weight-bold text-secondary">Detail Banner</h6>
                </div>
                <form action="{{url('dashboard/banner/update/' . $id)}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col">
                                        <img src="/{{$banner->path}}" class="img-fluid" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div>
                                    <span>Ganti Banner</span>
                                    <input type="file" name="photo_banner" class="form-control mt-2" >
                                </div>

                                <div class="mt-4">
                                    <span>Deskripsi</span>
                                    <textarea name="description" id="description" cols="30" rows="5" class="form-control">{{$banner->description}}</textarea>
                                </div>

                                <div class="mt-4">
                                    <span>Urutan</span>
                                    <input type="text" name="campaign_title" class="form-control mt-2" value="{{ $banner->sequence }}">
                                </div>

                            </div>
                        </div>

                        <div class="row mt-4 p-4">
                            <div class="col text-right">
                                <button type="submit" class="btn btn-primary">Update Banner</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@extends('template.default')

@section('content')
<div class="row" id="app">
    <div class="col">
        <div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col">
                            <h4 class="m-0 font-weight-bold text-secondary">Campaign</h6>
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-campaign">Tambah Banner</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="data-campaign" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>HP</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($iterator = 1)
                                @foreach ($users as $user)
                                <tr>
                                    <td> {{$iterator}} </td>
                                    <td>
                                        {{$user->nama}}
                                    </td>
                                    <td> {{$user->email}} </td>
                                    <td> {{$user->hp}} </td>
                                    <td>
                                        <a onclick="rejectModal({{ $user->id_user }})" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                        <a href="banner/edit/{{$user->id_user}}" class="btn btn-warning"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                @php($iterator++)
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal add banner --}}
    <div class="modal fade" id="modal-add-campaign" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    Tambah Data User
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/dashboard/banner/add" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="mt-4">
                            <span>Foto Banner</span>
                            <input type="file" name="photo_banner" class="form-control">
                        </div>

                        <div class="mt-4">
                            <span>Urutan</span>
                            <input type="number" name="sequence" class="form-control">
                        </div>

                        <div class="mt-4">
                            <span>Deskripsi Banner</span>
                            <textarea name="description" id="" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-sm btn-danger">Cancel</button>
                        <button class="btn btn-sm btn-primary" type="submit">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal reject confirmation --}}
    <div class="modal fade" id="reject-banner" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda Yakin Ingin Melakukan Penghapusan User Terkait ?</p>
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
</div>


@endsection

@section('script-custom')
<script src="{{ asset('theme/js/vue.js') }}"></script>
<script>
    let urlSite = '<?= env("APP_URL"); ?>';


    // VUE JS
    var app = new Vue({
        el: '#app',
        data: {
            message: 'Hello Vue!',

            campaignAlyawsOpen: 0,
            campaignAlwaysFund: 0
        },

        mounted() {
            console.log('berhasil');
        }
    })

    // END VUE JS

    $(document).ready(function() {
        $('#data-campaign').DataTable({
            "order": [
                [0, "asc"]
            ]
        });
    });

    function rejectModal(id) {
        $('#reject-banner').modal('show');
        document.getElementById('modal-reject-form').setAttribute('action', '/dashboard/banner/' + id + '/remove');
    }
</script>

@endsection
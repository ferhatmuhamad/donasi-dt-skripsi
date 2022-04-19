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
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-campaign">Tambah Campaign</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="data-campaign" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Campaign</th>
                                    <th>Target</th>
                                    <th>Terkumpul</th>
                                    <th>Due Date</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($iterator = 1)
                                @foreach ($campaign as $c)
                                <tr>
                                    <td>#{{$iterator}} </td>
                                    <td>{{$c->campaign_title}} </td>
                                    <td>
                                        @if($c->always_fund == 0)
                                        <span class="btn btn-sm btn-primary ml-2"> Rp. {{number_format($c->goal_amount)}} </span>
                                        @elseif($c->always_fund == 1)
                                        <span class="btn btn-sm btn-success ml-2"> Open </span>
                                        @endif
                                    </td>
                                    <td>
                                        Rp. {{number_format($c->current_amount)}}
                                        @if($c->always_fund == 0)
                                        <span class="btn btn-sm btn-primary ml-2"> {{($c->current_amount / $c->goal_amount)*100}}% </span>
                                        @elseif($c->always_fund == 1)
                                        <span class="btn btn-sm btn-success ml-2"> Open </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($c->always_open == 0)
                                        {{ date('d M Y', strtotime($c->target_day)) }}
                                        @elseif($c->always_open == 1)
                                        <span class="btn btn-sm btn-primary ml-2"> Open </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="campaign/{{$c->id_campaign}}" class="btn btn-sm btn-secondary"> Detail </a>
                                            <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdown-campaign" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-gear"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown-campaign">
                                                <a class="dropdown-item" href="campaign/{{$c->id_campaign}}/edit"><i class="mx-2 fas fa-pencil"></i>Edit</a>
                                                <a class="dropdown-item" href="#"><i class="mx-2 fas fa-stop"></i>Stop</a>
                                                <a class="dropdown-item" href="#"><i class="mx-2 fas fa-play"></i>Jalankan</a>
                                                <div onclick="rejectModal({{ $c->id_campaign }})" class="dropdown-item" href="#"><i class="mx-2 fas fa-trash"></i>Hapus</div>
                                            </div>
                                        </div>
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

    {{-- modal add campaign --}}
    <div class="modal fade" id="modal-add-campaign" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    Tambah Data Campaign
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/dashboard/campaign/add" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div>
                            <span>Nama Campaign</span>
                            <input type="text" name="campaign_title" class="form-control">
                        </div>

                        <div class="mt-4">
                            <span>Deskripsi Campaign</span>
                            <textarea name="description" id="" cols="30" rows="5" class="form-control"></textarea>
                        </div>

                        <div class="mt-4">
                            <span>Status Campaign</span>
                            <select name="always_open" id="always_open" class="form-control" v-model="campaignAlyawsOpen">
                                <option value="0">Terbatas Waktu</option>
                                <option value="1">Tidak Terbatas Waktu</option>
                            </select>
                        </div>

                        <div class="mt-4" v-if="campaignAlyawsOpen == 0">
                            <span>Batas Waktu Campaign</span>
                            <input type="date" class="form-control" name="target_day">
                        </div>

                        <div class="mt-4">
                            <span>Status Pendanaan Campaign</span>
                            <select name="always_fund" id="always_fund" class="form-control" v-model="campaignAlwaysFund">
                                <option value="0">Terbatas Nominal</option>
                                <option value="1">Tidak Terbatas Nominal</option>
                            </select>
                        </div>

                        <div class="mt-4" v-if="campaignAlwaysFund == 0">
                            <span>Target Pendanaan Campaign</span>
                            <input type="number" class="form-control" name="goal_amount">
                        </div>

                        <div class="mt-4">
                            <span>Foto Campaign</span>
                            <input type="file" name="photo_campaign" class="form-control">
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
    <div class="modal fade" id="reject-campaign" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda Yakin Ingin Melakukan Penghapusan Campaign Terkait ?</p>
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
        $('#reject-campaign').modal('show');
        document.getElementById('modal-reject-form').setAttribute('action', '/dashboard/campaign/' + id + '/remove');
    }
</script>

@endsection
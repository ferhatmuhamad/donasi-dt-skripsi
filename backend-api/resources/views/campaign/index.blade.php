@extends('template.default')

@section('content')
<div class="row">
    <div class="col">
        <div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-secondary">Transaksi Donasi</h6>
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
                                    <td>Rp. {{number_format($c->goal_amount)}} </td>
                                    <td>
                                        Rp. {{number_format($c->current_amount)}}
                                        @if($c->always_open == 0)
                                        <span class="btn btn-sm btn-primary ml-2"> {{($c->current_amount / $c->goal_amount)*100}}% </span>
                                        @elseif($c->always_open == 1)
                                        <span class="btn btn-sm btn-primary ml-2"> Open </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($c->always_fund == 0)
                                        {{ date('d M Y', strtotime($c->target_day)) }}
                                        @elseif($c->always_fund == 1)
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
</div>

<!-- {{-- modal approve confirmation --}}
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
</div> -->
@endsection

@section('script-custom')
<script>
    let urlSite = '<?= env("APP_URL"); ?>';

    $(document).ready(function() {
        $('#data-campaign').DataTable({
            "order": [
                [0, "asc"]
            ]
        });
    });

    function approveModal(id) {
        $('#approve-donasi').modal('show');
        document.getElementById('modal-approve-form').setAttribute('action', '/dashboard/donasi/approve/' + id);
    }

    function rejectModal(id) {
        $('#reject-donasi').modal('show');
        document.getElementById('modal-reject-form').setAttribute('action', '/dashboard/donasi/reject/' + id);
    }

    function showBukti(id) {

        fetch(`${urlSite}api/donasi/bukti/${id}`, {
            method: 'POST',
        }, ).then(response => response.json()).then(
            json => {
                console.log(json);
                if (json.meta.status == 'success') {
                    document.getElementById('url-img-bukti').setAttribute('src', json.data);
                } else {
                    document.getElementById('url-img-bukti').setAttribute('src', `${urlSite}theme/img/not-found.png`);
                }
            }
        );


        $('#modal-bukti').modal('show');
    }
</script>
@endsection
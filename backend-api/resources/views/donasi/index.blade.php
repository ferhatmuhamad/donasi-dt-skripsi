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
                        <table class="table table-bordered" id="data-donasi" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Nominal</th>
                                    <th>Bukti</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datadonasi as $ds)
                                <tr>
                                    <td>#{{$ds->kode_donasi}} </td>
                                    <td><a class="btn btn-sm btn-primary"><i class="fas fa-external-link"></i></a> {{$ds->nama}} </td>
                                    <td>Rp. {{number_format($ds->amount)}} </td>
                                    <td> <button onclick="showBukti({{ $ds->id_donasi }})" class="btn btn-sm btn-primary">Bukti</button> </td>
                                    <td>
                                        @if ($ds->status == 'success')
                                        <div class="badge badge-success">Berhasil</div>
                                        @elseif ($ds->status == 'pending')
                                        <div class="badge badge-primary">Pending</div>
                                        @elseif ($ds->status == 'cancel')
                                        <div class="badge badge-danger">Batal</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($ds->status == 'pending' || $ds->status == 'cancel')
                                        <div onclick="approveModal({{ $ds->id_donasi }})" class="btn btn-sm btn-success"><i class="fas fa-check" title="Setujui"></i></div>
                                        @elseif ($ds->status == 'pending' || $ds->status == 'success')
                                        <div onclick="rejectModal({{ $ds->id_donasi }})" class="btn btn-sm btn-danger"><i class="fas fa-xmark" title="Batalkan"></i></div>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<script>
    let urlSite = '<?= env("APP_URL"); ?>';    

    $(document).ready(function() {
        $('#data-donasi').DataTable({
            "order": [
                [0, "desc"]
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
        }, 
        ).then(response => response.json()).then(
            json => {
                console.log(json);
                if(json.meta.status == 'success') {
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
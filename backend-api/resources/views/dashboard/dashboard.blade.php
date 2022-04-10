@extends('template.default')

@section('content')
<div class="row">
    <div class="col">
        <!-- donasi -->
        <div class="row">
            <div class="col">
                <h4 class="text-dark">Donasi</h4>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col">
                <div class="row">
                    <div class="col-lg-3 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Total Donasi</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"> 0 Donasi </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-users fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Donasi Berhasil</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"> 1 Donasi </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-palette fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 mb-4">
                        <div class="card border-left-danger shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Donasi Pending</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"> 1 Donasi </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-palette fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 mb-4">
                        <div class="card border-left-secondary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Total Donasi</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"> Rp. 192.000 </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-palette fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-6 col-lg-6">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Total Donasi Berdasarkan Waktu</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Total Donasi Berdasarkan Campaign</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

        <!-- Campaign -->
        <div class="row mt-4">
            <div class="col">
                <h4 class="text-dark">Campaign</h4>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col">
                <div class="row">
                    <div class="col-lg-4 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Total Campaign</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"> 0 Campaign </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-users fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Campaign Aktif</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"> 1 Campaign </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-palette fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4">
                        <div class="card border-left-danger shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Donasi Pending</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"> 1 Campaign </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-palette fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- User -->
        <div class="row mt-4">
            <div class="col">
                <h4 class="text-dark">User</h4>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col">
                <div class="row">
                    <div class="col-lg-4 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Total User</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"> 0 Paguyuban </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-users fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Campaign Aktif</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"> 1 Donasi </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-palette fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4">
                        <div class="card border-left-danger shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Donasi Pending</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"> 1 Pembatik </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-palette fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
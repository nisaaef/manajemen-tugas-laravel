@extends('layouts.app')

@section('content')
         <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">
            <i class="fas fa-tachometer-alt mr-2"></i>  
            {{ $title }}
        </h1>

        <div class="row">
                        @if(auth()->user()->jabatan=='Admin')
                        
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2"
                                onclick="window.location='{{ route('user') }}'"
                                style="cursor: pointer;">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                TOTAL USER
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-primary">
                                                {{ $jumlahUser }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-dark shadow h-100 py-2"
                                onclick="window.location='{{ route('user.admin') }}'"
                                style="cursor: pointer;">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                                TOTAL ADMIN</div>
                                            <div class="h5 mb-0 font-weight-bold text-dark">
                                                {{ $jumlahAdmin}}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-dark"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2"
                                onclick="window.location='{{ route('user.karyawan') }}'"
                                style="cursor: pointer;">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                TOTAL KARYAWAN</div>
                                            <div class="h5 mb-0 font-weight-bold text-info">
                                                {{ $jumlahKaryawan}}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-info"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2"
                            onclick="window.location='{{ route('user.ditugaskan') }}'"
                            style="cursor:pointer;">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                TOTAL KARYAWAN YANG SEDANG DI TUGASKAN</div>
                                            <div class="h5 mb-0 font-weight-bold text-success">
                                                {{ $jumlahDitugaskan}}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-check fa-2x text-success"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                         <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2"
                            onclick="window.location='{{ route('user.belumtugas') }}'"
                            style="cursor:pointer;">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                TOTAL KARYAWAN YANG BELUM DI TUGASKAN</div>
                                            <div class="h5 mb-0 font-weight-bold text-danger">
                                                {{ $jumlahTidaktugas}}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-times fa-2x text-danger"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif 

                        @if (auth()->user()->jabatan == 'Karyawan')

                            @if (auth()->user()->is_tugas)
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-success shadow h-100 py-2"
                                        onclick="window.location='{{ route('tugas') }}'"
                                        style="cursor: pointer;">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                        STATUS
                                                    </div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <span class="badge badge-success">
                                                            DITUGASKAN
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-check fa-2x text-success"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @else

                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-danger shadow h-100 py-2"
                                        onclick="window.location='{{ route('tugas') }}'"
                                        style="cursor: pointer;">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                        STATUS
                                                    </div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <span class="badge badge-danger">
                                                            BELUM DITUGASKAN
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-times fa-2x text-danger"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endif

                        @endif
                    
        </div>
@endsection
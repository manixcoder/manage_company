@extends('users.master')
@section('pageTitle', 'Dashboard')
@section('content')
<!-- Row -->
<div class="card-group">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <h2 class="m-b-0"><i class="fa fa-users"></i></h2>
                    <h3 class="">{{ $user_data }}</h3>
                    <h6 class="card-subtitle">Policy Holders User</h6>
                </div>
                <div class="col-12">
                    <div class="progress">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 100%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="col-12">
                    <a href="javascript:void(0);" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <h2 class="m-b-0"><i class="fa fa-building-o"></i></h2>
                    <h3 class="">{{ $masjid_data }}</h3>
                    <h6 class="card-subtitle">Insurance Company</h6>
                </div>
                <div class="col-12">
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="col-12">
                    <a href="javascript:void(0);" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column 
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <h2 class="m-b-0">
                    <i class="mdi mdi-buffer text-warning"></i></h2>
                    <h3 class="">$00.00</h3>
                    <h6 class="card-subtitle">Total Donations</h6>
                </div>
                <div class="col-12">
                    <div class="progress">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 100%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="col-6">
                    <a href="javascript:void(0);" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
 Row -->
@endsection
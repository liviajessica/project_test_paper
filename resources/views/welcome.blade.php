@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>
    <!-- Content Row -->
    <!-- <div class="row"> -->

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Transaction Overview</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <!-- <div class="chart-area"> -->
                {!! $chart->html() !!}
                <!-- </div> -->
            </div>
        </div>
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Account Overview</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <!-- <div class="chart-area"> -->
                {!! $chart2->html() !!}
                <!-- </div> -->
            </div>
        </div>
    </div>
    <!-- </div> -->
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
</div>
{!! Charts::scripts() !!}
{!! $chart->script() !!}
{!! $chart2->script() !!}
@endsection
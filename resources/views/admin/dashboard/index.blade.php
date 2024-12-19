@extends('admin.layouts.master')

@section('title', 'Dashboard')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Admin</h4>
                    </div>
                    <div class="card-body">
                        {{ $admin_count }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total User</h4>
                    </div>
                    <div class="card-body">
                        {{ $user_count }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Slider</h4>
                    </div>
                    <div class="card-body">
                        {{ $slider_count }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Blog</h4>
                    </div>
                    <div class="card-body">
                        {{ $blogs_count }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Chart Report--}}
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <canvas id="monthlyClickChart" height="182"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-6 col-12">
                <table class="table table-hover ">
                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>ชื่อ</th>
                            <th>ปี</th>
                            <th>เดือน</th>
                            <th>จำนวนการกด</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clickData as $index => $data)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $data->user_name }}</td>
                            <td>{{ $data->year }}</td>
                            <td>{{ $data->month }}</td>
                            <td>{{ $data->click_count }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection

{{-- Script --}}
@yield('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('monthlyClickChart').getContext('2d');
    var chartData = @json($chartData);

    new Chart(ctx, {
        type: 'line',
        data: chartData,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Number of Clicks'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Months'
                    }
                }
            }
        }
    });
});
</script>

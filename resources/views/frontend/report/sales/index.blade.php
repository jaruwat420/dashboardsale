@extends('frontend.layouts.master')

@section('title', 'content')

@section('css')
<style>
    .report-container {
        position: relative;
        width: 100%;
        height: 0;
        padding-bottom: 56.25%;
    }

    iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: none;
    }

    .active {
        background-color: #e6b301 !important;
        /* เปลี่ยนสีพื้นหลัง */
        color: #ffffff !important;
        /* เปลี่ยนสีข้อความ */
        border-color: #ffffff !important;
    }

    .fp__list__group {
        margin-top: 180px !important;
    }

    .btn-type {
        width: 100% !important;
        height: 150px;
        background-color: var(--colorPrimary);
        color: #ffffff;
        font-size: 25px;
    }

    .campaign {
        height: 150px;
        background-color: var(--colorPrimary);
        padding: 0;
        margin: 0;
    }

    .btn-previous{

    }

    .fp__breadcrumb_text_custom h1 {
        font-size: 40px;
    }

    .fp__breadcrumb_text_custom h1 {
        font-size: 30px;
    }
    .fp__breadcrumb_text_custom ul li a {
        font-size: 14px;
    }

    .fp__breadcrumb_text_custom ul li:first-child a::before {
        font-size: 14px;
    }
    .fp__breadcrumb_text_custom h1 {
        font-size: 25px;
    }

</style>
@endsection

@section('content')
<!--=============================
        BREADCRUMB START
    ==============================-->
    <div class="container" style="margin-top: 150px; ">
        <div class="fp__breadcrumb_text">
        <h1 style="color: var(--colorPrimary)">Over View</h1>
            <ul>
                <li><a  href="{{ route('report.index') }}" style="color: var(--colorPrimary)">ย้อนกลับ</a></li>
                <li><a>-</a></li>
                <li><a  href="#" style="color: var(--colorPrimary)">ภาพรวม</a></li>
            </ul>
        </div>
    </div>
    <!--=============================
        BREADCRUMB END
    ==============================-->
<section class="fp__about_us ">
    <div class="container">
        <div class="card">
            <div class="card-body">
                {{-- <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-center">Overview</h1>
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-success radius-6 my-3">
                            <div class="card-body custom">
                                <div class="d-flex justify-content-between">
                                    <h4 class="text-white">
                                        Franchise 38 MB​
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-success radius-6 my-3">
                            <div class="card-body custom">
                                <div class="d-flex justify-content-between">
                                    <h4 class="text-white">​
                                        Food Retail 20 MB​
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container my-3">
            <div class="row">
                <div class="col-md-6">
                    <div class="d-grid">
                        <button class="btn btn-type" type="button" onclick="window.location='{{ route('sales.report.franchise') }}'">Franchise</button>
                    </div>
                </div>
                <div class="col-md-6 2">
                    {{-- <div class="d-grid">
                        <button class="btn btn-type" type="button" onclick="window.location='{{ route('report.performance') }}'">FoodRetail</button>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    $(document).ready(function (){

    });
</script>
@endpush

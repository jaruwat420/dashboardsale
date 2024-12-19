@extends('frontend.layouts.master')

@section('title', 'Sales Performance Dashboard')
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
        color: #ffffff !important;
        border-color: #ffffff !important;
    }

    .fp__list__group {
        margin-top: 180px !important;
    }

    .custom {
        background: #e6b301 !important;
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
</style>
@endsection

@section('content')
<section class="fp__about_us " style="margin-top: 180px;" >
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="d-grid">
                    <button class="btn btn-type" type="button" onclick="window.location='{{ route('sales.performance') }}'">Sales Performance</button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-grid">
                    {{-- <button class="btn btn-type" type="button" onclick="window.location='{{ route('sales.promotion') }}'">Promotion</button> --}}
                    <button class="btn btn-type" type="button" onclick="#">Promotion</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-success radius-6 my-3">
                    <div class="d-flex justify-content-center campaign">
                        <h3 class="text-white mt-2">Campaign</h3>
                    </div>
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

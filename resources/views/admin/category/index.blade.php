@extends('admin.layouts.master')

@section('title', 'Product')

@section('css')
<style>

</style>
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>MainCategories</h1>
    </div>
</section>
<div class="card card-primary">
    <div class="card-header">
        <h4>All Categories</h4>
        <div class="card-header-action">
            <a href="{{ route('admin.category.create') }}" class="btn btn-primary">
                Create new
            </a>
        </div>
    </div>
    <div class="card-body">
        {{-- {{ $dataTable->table() }} --}}
    </div>
</div>
@endsection

@push('scripts')
    {{-- {{ $dataTable->scripts(attributes: ['type' => 'module']) }} --}}
    <script>
        $(document).ready(function (){

        })
    </script>
@endpush

@extends('admin.layouts.master')

@section('title', 'Blog')

@section('css')
<style>

</style>
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Blog</h1>
    </div>
</section>
<div class="card card-primary">

    <div class="card-header">

        <h4>All Blog</h4>
        <div class="card-header-action">
            <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">
                Create new
            </a>
        </div>
    </div>
    <div class="card-body">
        {{ $dataTable->table() }}
    </div>
</div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script>
        $(document).ready(function(){

        })
    </script>
@endpush

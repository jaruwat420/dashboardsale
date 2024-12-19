@extends('admin.layouts.master')

@section('title', 'User')

@section('content')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>User</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">User</div>
        </div>
    </div>
</section>
<div class="card card-primary">
    <div class="card-header">
        <h4>All Users</h4>
        <div class="card-header-action">
            <a href="{{ route('admin.user.create') }}" class="btn btn-primary">
                Create New User
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

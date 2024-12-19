@extends('admin.layouts.master')

@section('title', 'CrateProduct')

@section('css')
<style>

</style>
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Create Categories</h1>
    </div>
</section>
<div class="card card-primary">
    <div class="card-header">
        <h4>Categories  Create</h4>
        <div class="card-header-action">
            <h4>Create Categories </h4>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <label>Description</label>
                <input type="text" name="description" class="form-control" value="{{ old('description') }}">
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function (){

    });
</script>
@endpush

@extends('admin.layouts.master')

@section('title', 'createSlider')

@section('css')
<style>

</style>
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Create</h1>
    </div>
</section>
<div class="card card-primary">
    <div class="card-header">
        <div class="card-header-action">
            <h4>Create Blog</h4>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Image</label>

                <div id="image-preview" class="image-preview">
                    <label for="image-upload" id="image-label">Choose File</label>
                    <input type="file" name="image" id="image-upload">
                </div>
            </div>
            <div class="form-group">
                <label>Blog Type</label>
                <input type="text" name="blog_type" class="form-control">
            </div>
            <div class="form-group">
                <label>Blog Title</label>
                <input type="text" name="blog_title" class="form-control">
            </div>
            <div class="form-group">
                <label>Blog Link</label>
                <input type="text" name="blog_link" class="form-control">
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="blog_status" id="" class="form-control">
                    <option value="1">YES</option>
                    <option value="0">NO</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function (){

        })
    </script>
@endpush

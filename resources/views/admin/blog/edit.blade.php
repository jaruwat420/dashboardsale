@extends('admin.layouts.master')

@section('title', 'createSlider')

@section('css')
<style>

</style>
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Upate</h1>
    </div>
</section>
<div class="card card-primary">
    <div class="card-header">
        <div class="card-header-action">
            <h4>Update Blog</h4>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.blog.update', $blogs->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group">
                <label>Image</label>

                <div id="image-preview" class="image-preview">
                    <label for="image-upload" id="image-label">Choose File</label>
                    <input type="file" name="image" id="image-upload">
                </div>
            </div>
            <div class="form-group">
                <label>Blog Type</label>
                <input type="text" name="blog_type" class="form-control" value="{{ $blogs->blog_type }}">
            </div>
            <div class="form-group">
                <label>Blog Title</label>
                <input type="text" name="blog_title" class="form-control" value="{{ $blogs->blog_title }}">
            </div>
            <div class="form-group">
                <label>Blog Link</label>
                <input type="text" name="blog_link" class="form-control" value="{{ $blogs->blog_link }}">
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="blog_status" class="form-control" >
                    <option @selected($blogs->status === 1) value="1">Active</option>
                    <option @selected($blogs->status === 0) value="0">Inactive</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection


@push('scripts')
<script>
    $(document).ready(function(){
        $('.image-preview').css({
            'background-image': 'url({{ asset($blogs->image) }})',
            'background-size': 'cover',
            'background-position': 'center center'
        })
    })
</script>
@endpush

@extends('admin.layouts.master')

@section('title', 'content')

@section('css')
<style>

</style>
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Link</h1>
    </div>
</section>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Edit Your Links</h4>
            </div>
            <div class="card-body">
                <div class="contianer">
                    <div class="row justify-content-md-center">
                        <div class="col-6">
                            <form action="{{ route('admin.link.update', $link->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label>URL</label>
                                    <input type="text" name="link_url" class="form-control" value="{{ $link->url }}">
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option @selected($link->status === 1) value="1">Active</option>
                                        <option @selected($link->status === 0) value="0" >Inactive</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>

</script>
@endpush

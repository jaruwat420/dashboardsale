@extends('admin.layouts.master')

@section('title', 'AddLink')

@section('content')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Create New Url</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">home</a></div>
            <div class="breadcrumb-item">Url</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Your Links</h4>
                    </div>
                    <div class="card-body">
                        <form id="link_form">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">URL</label>
                                <div class="col-sm-5 col-md-7">
                                    <input type="text" class="form-control" name="link_url">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button class="btn btn-primary" id="create_url_btn">Create Url</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- URL --}}
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>:: All URL ::</h4>
            </div>
            <div class="card-body">
                <div class="clearfix mb-3"></div>
                <div class="table-responsive">
                    <table class="table table-striped" id="link-table">
                        <thead>
                        </thead>
                        <tbody>
                            {{ $dataTable->table() }}
                        </tbody>
                    </table>
                </div>
                <div class="float-right">
                    <nav>
                        <ul class="pagination">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" href="#">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
<script>
    $(document).ready(function() {
            $('#create_url_btn').on('click', function(e) {
                e.preventDefault();
                var formData = $('#link_form').serialize();

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.link.create') }}",
                    data: formData + '&_token=' + "{{ csrf_token() }}",
                    dataType: "JSON",
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success("Create Links Successfully.");

                            // Reload Page
                            window.location.reload();

                        } else if (response.status === 'error'){
                            toastr.error(response.message)
                        }
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            })
        })
</script>
@endpush

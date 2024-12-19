@extends('frontend.layouts.master')

@section('title', 'url')
@section('css')
<style>
    .no-copy {
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        -o-user-select: none;
        user-select: none;
    }
</style>
@endsection

@section('content')
<!--=============================
        BREADCRUMB START
    ==============================-->
{{-- <section class="fp__breadcrumb" style="background: url(images/counter_bg.jpg);">
    <div class="fp__breadcrumb_overlay">
        <div class="container">
            <div class="fp__breadcrumb_text">
                <h1>URL</h1>
                <ul>
                    <li><a href="{{ route('home') }}">home</a></li>
                    <li><a href="#">url</a></li>
                </ul>
            </div>
        </div>
    </div>
</section> --}}
<!--=============================
        BREADCRUMB END
    ==============================-->


<!--=============================
        FAQ PAGE START
    ==============================-->
<section class="fp__faq pt_100 xs_pt_70 pb_100 xs_pb_70">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 wow fadeInUp">
                @foreach ($links as $link)
                <div class="input-group mb-3">
                    <input type="text" class="form-control no-copy url-input" value="{{ $link->url }}"
                        placeholder="url links" aria-label="Recipient's username" aria-describedby="basic-addon2"
                        readonly>
                    <div class="input-group-append mx-2">
                        <button class="btn btn-primary copy-btn" type="button">คัดลอก</button>
                        <button class="btn btn-success open-btn" type="button">เปิด</button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!--=============================
        FAQ PAGE END
    ==============================-->
@endsection

@push('scripts')
<script>
    $(document).ready(function () {

        // Disable copy/paste for each url-input
        $('.url-input').on('copy paste', function (e) {
            e.preventDefault();
        });

        // Function for copying URL
        $('.copy-btn').on('click', function () {
            let url_input = $(this).closest('.input-group').find('.url-input').val();
            navigator.clipboard.writeText(url_input).then(() => {
                toastr.success('คัดลอกข้อความเรียบร้อยแล้ว');
            }).catch(err => {
                console.error('Failed to copy URL: ', err);
            });


            $.ajax({
                type: "POST",
                url: "{{ route('create.history.url') }}",
                data: {
                    url: url_input,
                    _token: "{{ csrf_token() }}"
                },
                dataType: "JSON",
                success: function (response) {
                    if (response.status === 'success') {
                        console.log(response.message);
                    } else if (response.status === 'error') {
                        console.log(response.message);
                    }
                }
            });
        });

        // Function for opening URL
        $('.open-btn').on('click', function () {
            let url_input = $(this).closest('.input-group').find('.url-input').val();
            window.open(url_input, '_blank');
            $.ajax({
                type: "POST",
                url: "{{ route('open.history.url') }}",
                data: {
                    url: url_input,
                    _token: "{{ csrf_token() }}"
                },
                dataType: "JSON",
                success: function (response) {
                    if (response.status === 'success') {
                        window.open(url_input, '_blank');
                    }
                }
            });
        });
    });
</script>
@endpush

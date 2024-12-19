@extends('frontend.layouts.master')

@section('title', 'Sales Performance Dashboard')
@section('css')
<style>
    .report-container {
        position: relative;
        width: 100%;
        height: 0;
        padding-bottom: 56.25%; /* อัตราส่วน 16:9 */
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
        background-color: #e6b301 !important; /* เปลี่ยนสีพื้นหลัง */
        color: #ffffff !important;/* เปลี่ยนสีข้อความ */
        border-color: #ffffff !important;
    }

    .fp__list__group {
        margin-top: 180px !important;
    }
</style>
@endsection

@section('content')
<section class="fp__list__group mt_100 xs_mt_100 mb_100 xs_mb_100">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header custom">
                        <h4 class="text-white">SALES PERFORMANCE</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group" id="performanceMenu">
                            <li class="list-group-item" data-target="dailySales">Daily Sales Dashboard</li>
                            <li class="list-group-item" data-target="weekly">Weekly</li>
                            <li class="list-group-item" data-target="monthly">Monthly</li>
                            <li class="list-group-item" data-target="monthly">Year on Year Analysis​</li>
                            <li class="list-group-item" data-target="monthly">Product Analysis​</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div id="contentArea">
                    <!-- Content will be dynamically inserted here -->
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-md-12">
                <div id="reportContainer" class="report-container" style="display: none;">
                    <iframe id="reportFrame" title="Power BI Report" allowfullscreen="true"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        const contentArea = $('#contentArea');
        const performanceMenu = $('#performanceMenu');
        const reportContainer = $('#reportContainer');
        const reportFrame = $('#reportFrame');

        // Define content for each menu item
        const contents = {
            dailySales: `
                <div class="card">
                    <div class="card-header custom">
                        <h4 class="text-white">Daily Sales Dashboard</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col">
                                <select class="form-select" id="yearSelect">
                                    <option selected>2024</option>
                                    <option>2023</option>
                                    <option>2022</option>
                                </select>
                            </div>
                        </div>
                        <div class="row" id="monthButtonsContainer">
                            ${generateMonthButtons()}
                        </div>
                    </div>
                </div>
            `,
            weekly: `
                <div class="card">
                    <div class="card-header custom">
                        <h4 class="text-white">Weekly Sales Report</h4>
                    </div>
                    <div class="card-body">
                        <p>Weekly sales data will be displayed here.</p>
                    </div>
                </div>
            `,
            monthly: `
                <div class="card">
                    <div class="card-header custom">
                        <h4 class="text-white">Monthly Sales Summary</h4>
                    </div>
                    <div class="card-body">
                        <p>Monthly sales summary will be shown here.</p>
                    </div>
                </div>
            `
        };

        function generateMonthButtons() {
            const months = ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน',
                            'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'];
            const urlMonth = {
                '1': 'https://app.powerbi.com/view?r=eyJrIjoiNmU3MTNkNmQtOGQyNy00ZDdmLWJlMzgtZTRlOWFjOWUyN2ZiIiwidCI6IjA5NTYwOGFkLWZkMzQtNDVmYi05OGU3LTE3ZDQ4MzYxNjMwMCIsImMiOjEwfQ%3D%3D',
                '2': 'https://app.powerbi.com/view?r=eyJrIjoiNmU3MTNkNmQtOGQyNy00ZDdmLWJlMzgtZTRlOWFjOWUyN2ZiIiwidCI6IjA5NTYwOGFkLWZkMzQtNDVmYi05OGU3LTE3ZDQ4MzYxNjMwMCIsImMiOjEwfQ%3D%3D',
                '3': 'https://app.powerbi.com/view?r=eyJrIjoiYTRkZGMzZjEtYmZkZC00YjdlLTg4YjUtODkzZjY4YzMyOTlhIiwidCI6IjA5NTYwOGFkLWZkMzQtNDVmYi05OGU3LTE3ZDQ4MzYxNjMwMCIsImMiOjEwfQ%3D%3D',
                '4': 'https://app.powerbi.com/view?r=eyJrIjoiYWUwMTUxMjUtOGY2YS00YjczLWJjOTgtYTg4MjMzMzhlNmE3IiwidCI6IjA5NTYwOGFkLWZkMzQtNDVmYi05OGU3LTE3ZDQ4MzYxNjMwMCIsImMiOjEwfQ%3D%3D',
                '5': 'https://app.powerbi.com/view?r=eyJrIjoiZTAzMjFhNDAtOTcyYy00NjkyLTkzN2QtMzA2NDhhNThhYzQyIiwidCI6IjA5NTYwOGFkLWZkMzQtNDVmYi05OGU3LTE3ZDQ4MzYxNjMwMCIsImMiOjEwfQ%3D%3D',
                '6': 'https://app.powerbi.com/view?r=eyJrIjoiOTkwZDUzNzYtOTg2OC00ODMwLWEyYzYtMDkxY2YyYjA5NTIyIiwidCI6IjA5NTYwOGFkLWZkMzQtNDVmYi05OGU3LTE3ZDQ4MzYxNjMwMCIsImMiOjEwfQ%3D%3D',
                '7': 'https://app.powerbi.com/view?r=eyJrIjoiMTg5OTdiMzEtMmMyNC00ODVjLWFmOGYtZWRjZDUxMTI4NjhjIiwidCI6IjA5NTYwOGFkLWZkMzQtNDVmYi05OGU3LTE3ZDQ4MzYxNjMwMCIsImMiOjEwfQ%3D%3D',
                '8': 'https://app.powerbi.com/view?r=eyJrIjoiZjk3ZTFjNDYtODdiZi00ZjA2LThlMTMtY2E4ODZmMDNjOGUyIiwidCI6IjA5NTYwOGFkLWZkMzQtNDVmYi05OGU3LTE3ZDQ4MzYxNjMwMCIsImMiOjEwfQ%3D%3D',
                '9': 'https://app.powerbi.com/view?r=eyJrIjoiMGUxNWYwNzgtZmE1Yy00NjIxLWFmZTYtNmE1ZTAzNjA5ZTE1IiwidCI6IjA5NTYwOGFkLWZkMzQtNDVmYi05OGU3LTE3ZDQ4MzYxNjMwMCIsImMiOjEwfQ%3D%3D',
                '10': 'https://app.powerbi.com/view?r=eyJrIjoiMjRkZTg3OTItMjJlZi00Mjg3LWEwNWItOTRiODBkZDViMDY5IiwidCI6IjA5NTYwOGFkLWZkMzQtNDVmYi05OGU3LTE3ZDQ4MzYxNjMwMCIsImMiOjEwfQ%3D%3D',
                '11': 'https://app.powerbi.com/view?r=eyJrIjoiYTZjN2M0ZTItZGY5Yy00OTYwLWE1OGEtMjcyYzM4MWQ3YjEzIiwidCI6IjA5NTYwOGFkLWZkMzQtNDVmYi05OGU3LTE3ZDQ4MzYxNjMwMCIsImMiOjEwfQ%3D%3D',
                '12': '#',
            };

            let buttonsHtml = '';
            months.forEach((month, index) => {
                const monthNumber = (index + 1).toString();
                const url = urlMonth[monthNumber] || '#';
                buttonsHtml += `
                    <div class="col-md-2 mb-2">
                        <button type="button" class="common_btn w-100 month-btn" data-month="${monthNumber}" data-url="${url}">
                            ${month}
                        </button>
                    </div>
                `;
            });
            return buttonsHtml;
        }

        // Event listener for menu items
        performanceMenu.on('click', 'li', function() {
            const target = $(this).data('target');
            contentArea.html(contents[target]);
            performanceMenu.find('li').removeClass('active');
            $(this).addClass('active');

            // Hide the report container when switching menu items
            reportContainer.hide();

            // Attach event listeners to month buttons if daily sales is selected
            if (target === 'dailySales') {
                attachMonthButtonListeners();
            }
        });

        function attachMonthButtonListeners() {
            $('#monthButtonsContainer').on('click', '.month-btn', function() {
                const url = $(this).data('url');
                const month = $(this).data('month');
                const year = $('#yearSelect').val();

                if (url && url !== '#') {
                    reportFrame.attr('src', url);
                    reportContainer.show();

                    $.ajax({
                        type: "POST",
                        url: "{{ route('report.store') }}",
                        data: {
                            year: year,
                            month: month
                            },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: "JSON",
                        success: function (response) {
                            console.log(response.message);
                        }
                    });

                } else {
                    alert('URL for this month is not available.');
                    reportContainer.hide();
                }
            });
        }

        // Initialize with Daily Sales Dashboard
        contentArea.html(contents.dailySales);
        performanceMenu.find('li[data-target="dailySales"]').addClass('active');
        attachMonthButtonListeners();

        // Event listener for year selection
        $(document).on('change', '#yearSelect', function() {
            const selectedYear = $(this).val();
            // Here you can update the month buttons or URLs based on the selected year
            console.log('Selected year:', selectedYear);
            // For now, we'll just regenerate the buttons (you might want to update URLs based on the year)
            $('#monthButtonsContainer').html(generateMonthButtons());
            reportContainer.hide();
        });
    });
</script>
@endpush

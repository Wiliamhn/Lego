@extends('admin.layout.master')
@section('title', 'Revenue & Profit Statistics')
@section('body')

<div class="app-main__inner">
    <!-- Page Title -->
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-graph icon-gradient bg-mean-fruit"></i>
                </div>
                <div>
                    Thống kê doanh thu và lợi nhuận
                    <div class="page-title-subheading">
                        Trực quan hóa doanh thu và lợi nhuận theo ngày, tuần, tháng hoặc năm.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Card -->
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <label for="startDate" class="mb-0 mr-2">Từ:</label>
                        <input type="date" id="startDate" class="form-control form-control-sm mr-2" />

                        <label for="endDate" class="mb-0 mr-2">Đến:</label>
                        <input type="date" id="endDate" class="form-control form-control-sm mr-2" />

                        <button class="btn btn-sm btn-primary mr-2" onclick="fetchChartData()">Lọc</button>
                    </div>

                    {{-- Nút Excel sát phải --}}
                    <a id="exportExcelBtn" class="btn btn-success text-white">
                        <i class="fa fa-file-excel"></i> Xuất file Excel
                    </a>
                </div>

                <div class="card-body">
                    <h5 class="card-title">Biểu đồ doanh thu và lợi nhuận</h5>
                    <div id="revenue-profit-chart" style="height: 300px;">
                        <p class="text-center text-muted">Đang tải dữ liệu biểu đồ...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.3.0/raphael.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css" rel="stylesheet" />

<script>
    function fetchChartData() {
        const start = $('#startDate').val();
        const end = $('#endDate').val();

        if (!start || !end) {
            alert("Please select both start and end dates.");
            return;
        }

        $('#revenue-profit-chart').html('<p class="text-center text-muted">Loading chart data...</p>');

        $.ajax({
            url: '{{ route('admin.statistics.data') }}',
            data: { start_date: start, end_date: end },
            dataType: 'json',
            success: function(data) {
                console.log("Dữ liệu API trả về:", data);

                $('#revenue-profit-chart').empty();

                if (data && data.length > 0) {
                    new Morris.Bar({
                        element: 'revenue-profit-chart',
                        data: data,
                        xkey: 'time',
                        ykeys: ['revenue'],
                        labels: ['Revenue'],
                        barColors: ['#28a745'],
                        hideHover: 'auto',
                        resize: true,
                        parseTime: false,
                        xLabelAngle: 45,
                        yLabelFormat: y =>  y.toFixed(2) + 'đ',
                        hoverCallback: function (index, options, content, row) {
    return `
        <div class='morris-hover-row-label'>${row.time}</div>
        <div class='morris-hover-point' style='color: #28a745;'>Revenue: ${row.revenue.toFixed(2)}đ</div>
    `;
}

                    });
                } else {
                    $('#revenue-profit-chart').html('<p class="text-center text-muted">No data found in selected range.</p>');
                }
            },
            error: function() {
                $('#revenue-profit-chart').html('<p class="text-danger text-center">Failed to load data.</p>');
            }
        });
    }

    // ✅ Không mở tab mới khi tải Excel
    $('#exportExcelBtn').on('click', function () {
        const start = $('#startDate').val();
        const end = $('#endDate').val();

        if (!start || !end) {
            alert("Please select both start and end dates.");
            return;
        }

        const url = `{{ route('admin.statistics.export') }}?start_date=${start}&end_date=${end}`;
        window.location.href = url; // ⬅️ tải trực tiếp
    });

    $(document).ready(function() {
        const today = new Date().toISOString().split('T')[0];
        $('#startDate').val(today);
        $('#endDate').val(today);
        fetchChartData();
    });
</script>
@endpush

@endsection

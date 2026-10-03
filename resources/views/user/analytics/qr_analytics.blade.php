@extends('adminLayouts.home')
@section('content')

<style>
    .qr_left_section{
        padding: 5px
    }
    .total_scan {
        border: 1px solid black;
        border-radius: 5px;
        padding: 10px;
    }
</style>

<div class="container-fluid">
    <!-- basic table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            <h5 class="mb-0 mt-2">Qr Track</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">

                            <div class="card">
                                <div class="qr_left_section">
                                <h4 class="text-center">My QR</h4>
                                <div class="qr_section text-center">
                                    @php
                                        $url = URL::to("u/".Auth::user()->name_url);
                                    @endphp
                                    {!! QrCode::size(200)->generate($url."?from=qr") !!}
                                </div>
                                <p class="mt-3">QR Links</p>
                                <a href="{{$url."?from=qr"}}" style="font-size: 10px" target="_blank" rel="noopener noreferrer">
                                    {{$url."?from=qr"}}
                                </a>
                                <hr>
                                <div class="total_scan">
                                    <h4>For All Time</h4>
                                    <hr>
                                    <div class="row text-center">
                                        <div class="col-md-6">
                                            <p>Total Scan</p>
                                            <b class="text-center">
                                                {{$total_scan}}
                                            </b>
                                        </div>
                                        <div class="col-md-6">
                                            <p>Today Scan</p>
                                            <b class="text-center">
                                                {{$today_scan}}
                                            </b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>

                            
                        </div>
                        <div class="col-md-9">
                            <div class="qr_right_section">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card">
                                        <div id="monthWisePieChart" style="width:100%; height:400px;"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                        <!-- Charts -->
                                        <div id="monthWiseChart" style="width:100%; height:400px;"></div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <hr>

                                <div class="card">
                                    <div class="card-header">
                                        
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ url('admin/qr_analytics') }}" method="GET" class="mb-4">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="from_date">From Date:</label>
                                                    <input type="date" name="from_date" id="from_date" class="form-control" value="{{ request('from_date') }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="to_date">To Date:</label>
                                                    <input type="date" name="to_date" id="to_date" class="form-control" value="{{ request('to_date') }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <label>&nbsp;</label>
                                                    <button type="submit" class="btn btn-primary btn-block" style="margin-top: 19px;">Search</button>
                                                </div>
                                            </div>
                                        </form>
                                        <div id="dateWiseChart" style="width:100%; height:400px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Month-Wise Chart
        Highcharts.chart('monthWiseChart', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Month-Wise QR Tracks'
            },
            xAxis: {
                type: 'category',
                title: {
                    text: 'Month'
                }
            },
            yAxis: {
                title: {
                    text: 'Total QR Counts'
                }
            },
            series: [{
                name: 'QR Count',
                colorByPoint: true,
                data: {!! json_encode($monthWiseData) !!}
            }],
            legend: {
                enabled: false
            },
            credits: {
                enabled: false // This removes the Highcharts.com link
            },
        });

        // Date-Wise Chart
        Highcharts.chart('dateWiseChart', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Date-Wise QR Tracks'
            },
            xAxis: {
                type: 'category',
                title: {
                    text: 'Date'
                }
            },
            yAxis: {
                title: {
                    text: 'Total QR Counts'
                }
            },
            series: [{
                name: 'QR Count',
                colorByPoint: true,
                data: {!! json_encode($dateWiseData) !!}
            }],
            legend: {
                enabled: false
            },
            credits: {
        enabled: false // This removes the Highcharts.com link
    },
        });

        // Pie Chart Initialization
        Highcharts.chart('monthWisePieChart', {
            chart: {
                type: 'pie'
            },
            title: {
                text: 'Month-Wise QR Tracks (Current Year)'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.y}'
                    }
                }
            },
            series: [{
                name: 'QR Count',
                colorByPoint: true,
                data: {!! json_encode($pieChart) !!}
            }],
            credits: {
        enabled: false // This removes the Highcharts.com link
    },
        });

    });
</script>
@endsection

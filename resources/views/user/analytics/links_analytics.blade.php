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
                            <h5 class="mb-0 mt-2">Links Click Track</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">

                            <div class="card">
                                <div class="qr_left_section">
                                <h4 class="text-center">My Page</h4>
                                <div class="qr_section text-center">
                                    @php
                                        $url = URL::to("u/".Auth::user()->name_url);
                                    @endphp
                                  
                                </div>
                                <a href="{{$url}}" style="font-size: 10px" target="_blank" rel="noopener noreferrer">
                                    {{$url}}
                                </a>
                                <hr>
                                <div class="total_scan">
                                    <h4>For All Time</h4>
                                    <hr>
                                    <div class="row text-center">
                                        <div class="col-md-6">
                                            <p>Total count</p>
                                            <b class="text-center">
                                                {{$total_count}}
                                            </b>
                                        </div>
                                        <div class="col-md-6">
                                            <p>Today count</p>
                                            <b class="text-center">
                                                {{$today_count}}
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
                                        <div id="typeWiseChart" style="width:100%; height:400px;"></div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <hr>

                                <div class="card">
                                    <div class="card-header">
                                        
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ url('admin/links_analytics') }}" method="GET" class="mb-4">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label for="from_date">From Date:</label>
                                                    <input type="date" name="from_date" id="from_date" class="form-control" value="{{ request('from_date') }}">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="to_date">To Date:</label>
                                                    <input type="date" name="to_date" id="to_date" class="form-control" value="{{ request('to_date') }}">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="to_date">Type:</label>
                                                    <select name="type" id="type" class="form-control" >
                                                        <option value="all" @if(request('type') == 'all') selected @endif>All</option>
                                                        <option value="google"  @if(request('type') == 'google') selected @endif>Google</option>
                                                        <option value="facebook"  @if(request('type') == 'facebook') selected @endif>Facebook</option>
                                                        <option value="whatsapp"  @if(request('type') == 'whatsapp') selected @endif>Whatsapp</option>
                                                        <option value="instagram"  @if(request('type') == 'instagram') selected @endif>Instagram</option>
                                                        <option value="youtube"  @if(request('type') == 'youtube') selected @endif>Youtube</option>
                                                        <option value="record"  @if(request('type') == 'record') selected @endif>Video Testimonial</option>
                                                        <option value="private"  @if(request('type') == 'private') selected @endif>Private Inquiry</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
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
        Highcharts.chart('typeWiseChart', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Type Wise Links Tracks'
            },
            xAxis: {
                type: 'category',
                title: {
                    text: 'Month'
                }
            },
            yAxis: {
                title: {
                    text: 'Total Links Counts'
                }
            },
            series: [{
                name: 'Links Count',
                colorByPoint: true,
                data: {!! json_encode($typeWiseData) !!}
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
                text: 'Month-Wise Links Tracks (Current Year)'
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
                name: 'Links Count',
                colorByPoint: true,
                data: {!! json_encode($pieChart) !!}
            }],
            credits: {
        enabled: false // This removes the Highcharts.com link
    },
        });


        const data = {!! json_encode($dateTypeWiseData) !!};

    // Process data for Highcharts
    const groupedData = {};
    data.forEach(item => {
        if (!groupedData[item.date]) {
            groupedData[item.date] = {};
        }
        groupedData[item.date][item.type] = item.total;
    });

    const categories = Object.keys(groupedData); // Dates as categories
    const seriesData = {};

    // Prepare series for each type
    data.forEach(item => {
        if (!seriesData[item.type]) {
            seriesData[item.type] = { name: item.type, data: [] };
        }
    });

    categories.forEach(date => {
        Object.keys(seriesData).forEach(type => {
            seriesData[type].data.push(groupedData[date][type] || 0);
        });
    });

    Highcharts.chart('dateWiseChart', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Date and Type Wise Analytics'
        },
        xAxis: {
            categories: categories,
            title: {
                text: 'Date'
            }
        },
        yAxis: {
            title: {
                text: 'Total'
            }
        },
        series: Object.values(seriesData),
        tooltip: {
            shared: true,
            crosshairs: true
        },
        credits: {
        enabled: false // This removes the Highcharts.com link
    },
    });

    });
</script>
@endsection

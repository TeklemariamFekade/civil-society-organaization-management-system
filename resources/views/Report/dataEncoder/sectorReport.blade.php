@extends('dataencoder.layouts.app')

@section('content')
    <title>CSO Report by Sector</title>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>

    <div class="content-wrapper bg-light">
        <div class="container mx-auto">


            <div id="sectorChart" style="height: 550px;"></div>

        </div>
    </div>
    <script>
        Highcharts.chart('sectorChart', {
            chart: {
                type: 'column' // Change to 'column' for horizontal bars
            },
            title: {
                text: 'CSO Report by Sector'
            },
            xAxis: {
                categories: @json($chartLabels),
                title: {
                    text: 'Sectors'
                }
            },
            yAxis: {
                title: {
                    text: 'Number of CSOs'
                }
            },
            series: [{
                name: 'Number of CSOs',
                data: @json($chartData)
            }]
        });
    </script>
@endsection

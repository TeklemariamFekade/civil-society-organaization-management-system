@extends('dataencoder.layouts.app')

@section('content')
    <div class="content-wrapper bg-light">
        <div class="container mx-auto">
            <div class="row">
                <div class="col-md-6">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold mb-4 p-3">Report by Sector</h5>
                            <hr class="my-4">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>sector name</th>
                                        <th>sub sector name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Data 1</td>
                                        <td>Data 2</td>
                                        <td>Data 3</td>
                                    </tr>
                                    <!-- Add more rows for your sector data -->
                                </tbody>
                            </table>
                            <hr class="my-4">
                            <button class="btn btn-secondary float-right" onclick="printTable()">Print Sector</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function printTable() {
            // Create a new window with the table content
            var printWindow = window.open('', '_blank');
            printWindow.document.open();
            printWindow.document.write('<html><head><title>Print Sector</title></head><body>');
            printWindow.document.write('<h1>Report by Sector</h1>');
            printWindow.document.write(document.querySelector('.table').outerHTML);
            printWindow.document.write('</body></html>');
            printWindow.document.close();

            // Wait for the content to load before printing
            printWindow.onload = function() {
                printWindow.print();
                printWindow.close();
            };
        }
    </script>
@endsection

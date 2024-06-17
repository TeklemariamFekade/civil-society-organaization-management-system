@extends('dataencoder.layouts.app')
@section('content')
    <div class="content-wrapper bg-white">
        <div class="container my-5">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">CSO List</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text" id="searchEnglishName" class="form-control"
                                    placeholder="Search English Name">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-danger bg-danger" type="button" onclick="clearEnglishSearch()">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text" id="searchAmharicName" class="form-control"
                                    placeholder="ስሞችን በአማርኛ ፈልግ ...">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-danger bg-danger" type="button" onclick="clearAmharicSearch()">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">CSO English Name</th>
                                    <th scope="col">Amharic Name</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Type</th>
                                    <th scope="col" class="py-4 px-6">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count = 0;
                                    $csos = App\Models\CSO::all();
                                @endphp
                                @foreach ($csos as $cso)
                                    <tr>
                                        <td>{{ ++$count }}</td>
                                        <td>{{ $cso->english_name }}</td>
                                        <td>{{ $cso->amharic_name }}</td>
                                        <td>{{ $cso->category }}</td>
                                        <td>{{ $cso->type }}</td>
                                        <td>
                                            <button type="button" class="btn btn-success" data-toggle="modal"
                                                data-target="#mdl{{ $cso->id }}">View</button>
                                            <div class="modal fade" id="mdl{{ $cso->id }}" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-center font-weight-bolder">Civil
                                                                Society Organization Detail</h5>
                                                            <button type="button" class="btn btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        @if ($errors->any())
                                                            <div class="alert alert-danger mb-1 mt-1">
                                                                <ul>
                                                                    @foreach ($errors->all() as $error)
                                                                        <li>{{ $error }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        @endif
                                                        <div class="modal-body">
                                                            <p><strong>Organization Name:</strong> {{ $cso->english_name }}
                                                            </p>
                                                            <p><strong>Category:</strong> {{ $cso->category }}</p>
                                                            <p><strong>Type:</strong> {{ $cso->type }}</p>
                                                            <p><strong> Region
                                                                    / City:</strong> {{ $cso->address->region }}</p>
                                                            <p><strong> Place of
                                                                    Work:</strong> {{ $cso->address->place_of_work }}</p>
                                                            <p><strong> Country:</strong> {{ $cso->address->country }}</p>
                                                            <p><strong> Zone/
                                                                    Subcity:</strong> {{ $cso->address->zone }}</p>
                                                            <p><strong> District: </strong> {{ $cso->address->district }}
                                                            </p>
                                                            <p><strong> Woreda:</strong> {{ $cso->address->Woreda }}</p>
                                                            <p><strong> Email:</strong> {{ $cso->address->email }}</p>
                                                            <p><strong> Mobile
                                                                    Number:</strong> {{ $cso->address->phone_no }}</p>
                                                            <p><strong> P.O.
                                                                    Box:</strong> {{ $cso->address->kebele }}</p>
                                                            <p><strong> Kebele:</strong> {{ $cso->address->po_box }}</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary"
                                                                onclick="printModal()">Print</button>
                                                            <button type="button" class="btn btn-danger bg-danger"
                                                                data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function printModal() {
            var printContents = document.querySelector('#mdl{{ $cso->id }} .modal-content').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>

    <script>
        // Add event listeners to the search input fields
        document.getElementById('searchEnglishName').addEventListener('input', filterTable);
        document.getElementById('searchAmharicName').addEventListener('input', filterTable);

        function filterTable() {
            var inputEnglishName = document.getElementById('searchEnglishName').value.toLowerCase();
            var inputAmharicName = document.getElementById('searchAmharicName').value.toLowerCase();

            var tableRows = document.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

            for (var i = 0; i < tableRows.length; i++) {
                var row = tableRows[i];
                var englishName = row.getElementsByTagName('td')[1].textContent.toLowerCase();
                var amharicName = row.getElementsByTagName('td')[2].textContent.toLowerCase();

                if (englishName.includes(inputEnglishName) && amharicName.includes(inputAmharicName)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        }

        function clearEnglishSearch() {
            document.getElementById('searchEnglishName').value = '';
            filterTable();
        }

        function clearAmharicSearch() {
            document.getElementById('searchAmharicName').value = '';
            filterTable();
        }
    </script>

    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
@endsection

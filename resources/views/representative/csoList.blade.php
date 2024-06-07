@extends('representative.layouts.app')

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

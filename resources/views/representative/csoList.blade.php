<!-- Include Bootstrap CSS -->

@extends('representative.layouts.app')

@section('content')
    <div class="content-wrapper">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th></th>
                    <th>
                        <div class="input-group">
                            <input type="text" id="searchEnglishName" class="form-control" placeholder="Search English Name">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-search"></i>
                                </span>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="statusDropdown"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    All
                                </button>
                                <div class="dropdown-menu" aria-labelledby="statusDropdown">
                                    <a class="dropdown-item" href="#" data-status="all">All</a>
                                    <a class="dropdown-item" href="#" data-status="registered">Registered</a>
                                    <a class="dropdown-item" href="#" data-status="inprogress">In Progress</a>
                                </div>
                            </div>
                        </div>
                    </th>

                    <th>
                        <div class="input-group">
                            <input type="text" id="searchAmharicName" class="form-control"
                                placeholder="ስሞችን በአማርኛ ፈልግ ...">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-search"></i>
                                </span>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="statusDropdown"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    ሁሉንም
                                </button>
                                <div class="dropdown-menu" aria-labelledby="statusDropdown">
                                    <a class="dropdown-item" href="#" data-status="all">ሁሉንም</a>
                                    <a class="dropdown-item" href="#" data-status="registered">የተመዘገቡትን</a>
                                    <a class="dropdown-item" href="#" data-status="inprogress">በመመዝገብ ሂደት ላይ ያሉ </a>
                                </div>
                            </div>
                        </div>
                    </th>
                </tr>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">CSO English Name</th>
                    <th scope="col">Amharic Name</th>
                    <th scope="col">catagory</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $count = 0;
                    $users = App\Models\User::all();
                    $csos = App\Models\CSO::all();
                @endphp
                @foreach ($csos as $cso)
                    <tr>
                        <td>{{ ++$count }}</td>
                        <td>{{ $cso->english_name }}</td>
                        <td>{{ $cso->amharic_name }}</td>
                        <td>{{ $cso->category }}</td>
                        <td>{{ $cso->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
    </script>
    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
@endsection

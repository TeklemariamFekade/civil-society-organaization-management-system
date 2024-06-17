@extends('dataencoder.layouts.app')

@section('content')
    <div class="content-wrapper bg-light">
        <div class="container mx-auto ">

            <section class="py-8">
                <div class="container">
                    <div class="bg-white rounded shadow">
                        <h4>All cso </h4>
                        <form action="{{ route('Report.dataEncoder.csoReport') }}" method="GET" class="mb-3">

                            <div class="row">

                                <div class="col-md-6 mb-2">

                                    <select name="category" id="category" class="form-select form-select-lg">
                                        <option value="">All Categories</option>
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat }}"
                                                {{ request('category') == $cat ? 'selected' : '' }}>
                                                {{ $cat }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <select name="type" id="type" class="form-select form-select-lg">
                                        <option value="">All Types</option>
                                        @foreach ($types as $t)
                                            <option value="{{ $t }}"
                                                {{ request('type') == $t ? 'selected' : '' }}>
                                                {{ $t }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn btn-primary" onclick="window.print()">Print</button>
                                    <a href="{{ route('Report.dataEncoder.csoReport.download', [
                                        'category' => request('category'),
                                        'type' => request('type'),
                                    ]) }}"
                                        class="btn bg-danger btn-danger">
                                        <i class="fas fa-download"></i>
                                    </a>

                                </div>

                            </div>
                        </form>

                        <div class="pt-4 table-responsive">
                            <table class="table mb-0 table-borderless table-striped small">
                                <thead>
                                    <tr>
                                        <th scope="col" class="py-4 px-6">English Name</th>
                                        <th scope="col" class="py-4 px-6">Amharic Name</th>
                                        <th scope="col" class="py-4 px-6">Category</th>
                                        <th scope="col" class="py-4 px-6">Type</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($csos as $cso)
                                        <tr>
                                            <td>{{ $cso->english_name }}</td>
                                            <td>{{ $cso->amharic_name }}</td>
                                            <td>{{ $cso->category }}</td>
                                            <td>{{ $cso->type }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

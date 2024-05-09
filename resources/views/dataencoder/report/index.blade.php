@extends('dataencoder.layouts.app')

@section('content')
    <div class="content-wrapper bg-light">
        <div class="container mx-auto mt-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold mb-4">Report by Sector</h5>
                            <hr class="my-4">
                            <p class="card-text mb-4">Communication</p>
                            <hr class="my-4">
                            <button class="btn btn-primary bg-primary float-right">Print</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold mb-4">Report by Category</h5>
                            <hr class="my-4">
                            <p class="card-text mb-4">Communication</p>
                            <hr class="my-4">
                            <button class="btn btn-primary bg-primary float-right">Print</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold mb-4">Report by Type</h5>
                            <hr class="my-4">
                            <p class="card-text mb-4">Communication</p>
                            <hr class="my-4">
                            <button class="btn btn-primary bg-primary float-right">Print</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold mb-4">Report by Status</h5>
                            <hr class="my-4">
                            <p class="card-text mb-4">Communication</p>
                            <hr class="my-4">
                            <a href="" class="btn btn-primary bg-primary float-right">Print</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

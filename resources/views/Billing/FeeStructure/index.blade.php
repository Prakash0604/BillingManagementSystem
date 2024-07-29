@extends('index')
@section('content')
    <div class="container">
      <h4 class="text-center">{{ $title }}</h4>
      <div class="card col-3 p-3">
        <a href="{{ url('billing/fee_structure/create') }}" class="btn btn-primary">Create</a>
        @include('Billing.Layout.main')
      </div>
      <div class="card-body p-3">
        <table class="table">
            <thead>
                <tr>
                    <th>Batch Year</th>
                    <th>Program</th>
                    <th>Semester</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="row"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
      </div>
    </div>
@endsection

@extends('index')
@section('content')
    <div class="container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h4>Setup</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Basic Tables</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-md-6 col-sm-12 text-right">
                            <div class="dropdown">
                                <a class="btn btn-primary dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown">
                                    January 2018
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Export List</a>
                                    <a class="dropdown-item" href="#">Policies</a>
                                    <a class="dropdown-item" href="#">View Assets</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             <!-- Responsive tables Batch  Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix mb-20">
                            <h4 class="text-blue text-center">Batch</h4>
                    </div>
                    <button class="btn btn-primary mb-4 align-middle"  data-toggle="modal" data-target="#addBatch">Add Batch</button>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">S.N</th>
                                    <th scope="col">Batch Name</th>
                                    <th scope="col">Starting Date</th>
                                    <th scope="col">Ending Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody >
                                @php
                                    $n=1;
                                @endphp
                                @foreach ($batches as $batch)
                                <tr class="text-center">
                                    <th scope="row">{{ $n }}</th>
                                    <td>{{ $batch->batch_name }}</td>
                                    <td>{{ $batch->starting_date }}</td>
                                    <td>{{ $batch->ending_date }}</td>
                                    <td><span class="badge badge-{{ $batch->status ? "success":"danger" }}">{{ $batch->status ? "Running":"Passout" }}</span></td>
                                    <td>
                                        <a data-id="{{ $batch->id }}" data-toggle="modal" id="btnedit" data-target="#editBatch"  class="btn btn-primary text-white editBatch">Edit</a>
                                        <a data-id="{{ $batch->id }}"  class="btn btn-danger text-white deleteBatch">Delete</a>
                                    </td>
                                </tr>
                                @php
                                    $n=$n+1;
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $batches->links('vendor.pagination.bootstrap-5') }}
                </div>

                <!-- Button trigger modal -->
                <!-- Modal -->
                <div class="modal fade" id="addBatch" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content ">
                            <form id="Batch_add">
                                <div class="modal-header bg-secondary">
                                        <h5 class="modal-title">Add Batch</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <div class="form-group">
                                        @csrf
                                      <label for="">Batch Name</label>
                                      <input type="text" name="batch_name" id="" class="form-control" placeholder="">
                                    </div>
                                    <div class="form-group">
                                      <label for="">Starting Date</label>
                                      <input type="date" name="starting_date" id="" class="form-control" placeholder="">
                                    </div>
                                    <div class="form-group">
                                      <label for="">Ending Date</label>
                                      <input type="date" name="ending_date" id="" class="form-control" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" id="btnbatch" class="btn btn-primary">Add Batch</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>

                {{-- Edit Modal of Batch Start  --}}
                <div class="modal fade" id="editBatch" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content ">
                            <form id="updateBatch">
                                <div class="modal-header bg-secondary">
                                        <h5 class="modal-title">Edit Batch</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <div class="form-group">
                                        @csrf
                                      <label for="">Batch Name</label>
                                      <input type="text" name="edit_batch_name" id="edit_batch_name" class="form-control" placeholder="">
                                      <input type="hidden" name="id" id="id">
                                    </div>
                                    <div class="form-group">
                                      <label for="">Starting Date</label>
                                      <input type="date" name="edit_starting_date" id="edit_stating_date" class="form-control" placeholder="">
                                    </div>
                                    <div class="form-group">
                                      <label for="">Ending Date</label>
                                      <input type="date" name="edit_ending_date" id="edit_ending_date" class="form-control" placeholder="">
                                    </div>
                                    <div class="form-group">
                                      <label for="">Status</label>
                                      <select class="form-control" name="edit_status" id="status">
                                        <option value="1">Running</option>
                                        <option value="0">Passout</option>
                                      </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"  data-dismiss="modal">Close</button>
                                <button type="submit" id="btnupdate" class="btn btn-primary">Update Batch</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>

                {{-- Edit Modal of Batch End --}}
                <!-- Responsive tables End -->

                  <!-- Responsive Add course tables Start -->
                  <div class="pd-20 card-box mb-30">
                    <div class="clearfix mb-20">
                            <h4 class="text-blue text-center">Course/Program</h4>
                    </div>
                    <span class="btn btn-primary mb-4 align-middle">Add Course</span>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">S.N</th>
                                    <th scope="col">Course Name</th>
                                    <th scope="col">Faculty</th>
                                    <th scope="col">University</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody >
                                <tr class="text-center">
                                    <th scope="row">1</th>
                                    <td>Bachelor of Computer Application</td>
                                    <td>Humanity</td>
                                    <td>Tribhuvan University</td>
                                    <td><span class="badge badge-success">Semester</span></td>
                                    <td>
                                        <a href="" class="btn btn-primary">Edit</a>
                                        <a href="" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Responsive tables End -->

                  <!-- Responsive  type tables Start -->
                  <div class="pd-20 card-box mb-30">
                    <div class="clearfix mb-20">
                            <h4 class="text-blue h4 text-center">Type</h4>
                    </div>
                    <span class="btn btn-primary mb-4 align-middle">Add Semester</span>
                    <span class="btn btn-primary mb-4 align-middle">View Semester</span>
                    <span class="btn btn-primary mb-4 align-middle">View Year</span>
                    {{-- Semester year view start --}}

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">S.N</th>
                                    <th scope="col">Semester</th>
                                    <th scope="col">Code</th>
                                    <th scope="col">Tag</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody >
                                <tr class="text-center">
                                    <th scope="row">1</th>
                                    <td>First Semester</td>
                                    <td>00245</td>
                                    <td><span class="badge badge-success">Active</span></td>
                                    <td>
                                        <a href="" class="btn btn-primary">Edit</a>
                                        <a href="" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                     {{-- Semester year view start --}}
                       {{-- Semester year view start --}}

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">S.N</th>
                                    <th scope="col">Year</th>
                                    <th scope="col">Code</th>
                                    <th scope="col">Tag</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody >
                                <tr class="text-center">
                                    <th scope="row">1</th>
                                    <td>First Year</td>
                                    <td>00245</td>
                                    <td><span class="badge badge-success">Active</span></td>
                                    <td>
                                        <a href="" class="btn btn-primary">Edit</a>
                                        <a href="" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                     {{-- Semester year view start --}}
                </div>
                <!-- Responsive tables End -->


            </div>
        </div>
    </div>
@endsection

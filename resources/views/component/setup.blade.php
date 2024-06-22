@extends('index')
@section('content')
    <div class="container">
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
                            <a class="btn btn-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
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


            {{-- Batch Modue Start --}}

            {{-- Batch View Table Start --}}

            <div class="pd-20 card-box mb-30">
                <div class="clearfix mb-20">
                    <h4 class="text-blue text-center">Batch</h4>
                </div>
                <button class="btn btn-primary mb-4 align-middle" data-toggle="modal" data-target="#addBatch">Add
                    Batch</button>
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
                        <tbody>
                            @php
                                $n = 1;
                            @endphp
                            @forelse ($batches as $batch)
                                <tr class="text-center">
                                    <th scope="row">{{ $n }}</th>
                                    <td>{{ $batch->batch_name }}</td>
                                    <td>{{ $batch->starting_date }}</td>
                                    <td>{{ $batch->ending_date }}</td>
                                    <td><span
                                            class="badge badge-{{ $batch->status ? 'success' : 'danger' }}">{{ $batch->status ? 'Running' : 'Passout' }}</span>
                                    </td>
                                    <td>
                                        <a data-id="{{ $batch->id }}" data-toggle="modal" id="btnedit"
                                            data-target="#editBatch" class="btn btn-primary text-white editBatch">Edit</a>
                                        <a data-id="{{ $batch->id }}" data-toggle="modal" id="btndelete"
                                            data-target="#deleteBatch"
                                            class="btn btn-danger text-white deleteBatch">Delete</a>
                                    </td>
                                </tr>
                                @php
                                    $n = $n + 1;
                                @endphp
                            @empty
                                <tr>
                                    <td class="text-center" colspan="6">No data found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $batches->links('vendor.pagination.bootstrap-5') }}
            </div>

            {{-- Batch View Table End --}}

            {{-- Add Batch Modal Start --}}
            <div class="modal fade" id="addBatch" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                aria-hidden="true">
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
                                        <input type="text" name="batch_name" id="" class="form-control"
                                            placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Starting Date</label>
                                        <input type="date" name="starting_date" id="" class="form-control"
                                            placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Ending Date</label>
                                        <input type="date" name="ending_date" id="" class="form-control"
                                            placeholder="">
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
            {{-- Add Batch Modal End --}}

            {{-- Edit Modal of Batch Start  --}}
            <div class="modal fade" id="editBatch" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                aria-hidden="true">
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
                                        <input type="text" name="edit_batch_name" id="edit_batch_name"
                                            class="form-control" placeholder="">
                                        <input type="hidden" name="id" id="id">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Starting Date</label>
                                        <input type="date" name="edit_starting_date" id="edit_stating_date"
                                            class="form-control" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Ending Date</label>
                                        <input type="date" name="edit_ending_date" id="edit_ending_date"
                                            class="form-control" placeholder="">
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
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" id="btnupdate" class="btn btn-primary">Update Batch</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- Edit Modal of Batch End --}}

            {{-- Delete Modal of Batch Start --}}
            <div class="modal fade" id="deleteBatch" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content ">
                        <form id="delete_Batch">
                            <div class="modal-header bg-danger">
                                <h5 class="modal-title">Delete Batch</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <h4 class="text-danger">Are you sure you want to delete batch ?</h4>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" id="btnDelete" class="btn btn-danger">Confirm Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Delete Modal of Batch End --}}

            {{-- Batch Modue End --}}



            <!-- Responsive Add course/Program tables Start -->
            <div class="pd-20 card-box mb-30">
                <div class="clearfix mb-20">
                    <h4 class="text-blue text-center">Course/Program</h4>
                </div>
                <span class="btn btn-primary mb-4 align-middle" data-toggle="modal" data-target="#addProgram">Add
                    Course</span>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">S.N</th>
                                <th scope="col">Program/Course Name</th>
                                <th scope="col">Faculty</th>
                                <th scope="col">University</th>
                                <th scope="col">Type</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $n = 1;
                            @endphp
                            @forelse ($programs as $program)
                                <tr class="text-center">
                                    <td scope="row">{{ $n }}</td>
                                    <td>{{ $program->program_name }}</td>
                                    <td>{{ $program->faculty }}</td>
                                    <td>{{ $program->univeristy }}</td>
                                    <td><span class="badge badge-success">{{ $program->types->Type }}</span></td>
                                    <td><span
                                            class="badge badge-pill badge-{{ $program->status ? 'success' : 'danger' }}">{{ $program->status ? 'Active' : 'Inactive' }}</span>
                                    </td>
                                    <td>
                                        <a data-id="{{ $program->id }}" class="btn btn-primary editProgram text-white"
                                            data-toggle="modal" data-target="#editProgram">Edit</a>
                                        <a data-id="{{ $program->id }}" data-toggle="modal"
                                            data-target="#deleteProgram"
                                            class="btn btn-danger text-white deleteProgram">Delete</a>
                                    </td>
                                </tr>
                                @php
                                    $n = $n + 1;
                                @endphp
                            @empty
                                <tr>
                                    <td class="text-center" colspan="7">No data found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $programs->links('vendor.pagination.bootstrap-5') }}
            </div>
            <!-- Responsive Add Course/Program table End -->

            {{-- Add Program Modal Start --}}
            <div class="modal fade" id="addProgram" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content ">
                        <form id="Program_add">
                            <div class="modal-header bg-secondary">
                                <h5 class="modal-title">Add Program</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <div class="form-group">
                                        @csrf
                                        <label for="">Program Name</label>
                                        <input type="text" name="program_name" id="" class="form-control"
                                            placeholder="BCA,BHM etc..">
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="">Faculty</label>
                                            <select class="form-control" name="faculty" id="">
                                                <option value="Humanity">Humanity</option>
                                                <option value="Management">Management</option>
                                                <option value="Science">Science</option>
                                                <option value="Health & Science">Health & Science</option>
                                                <option value="Science & Technology">Science & Technology</option>
                                                <option value="Law">Law</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">University</label>
                                            <select class="form-control" name="univeristy" id="">
                                                <option value="CTEVT">CTEVT</option>
                                                <option value="Gandaki univeristy">Gandaki univeristy</option>
                                                <option value="Kathmandu Univeristy">Kathmandu Univeristy</option>
                                                <option value="Tribhuvan Univeristy">Tribhuvan Univeristy</option>
                                                <option value="Pokhara Univeristy">Pokhara Univeristy</option>
                                                <option value="Purbanchal Univeristy">Purbanchal Univeristy</option>
                                                <option value="Neb">Neb</option>
                                                <option value="Others">Others</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">Types</label>
                                            <select class="form-control" name="type" id="">
                                                @forelse ($types as $type)
                                                    <option value="{{ $type->id }}">{{ $type->Type }}</option>
                                                @empty
                                                    <option>No data</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" id="btnprogram" class="btn btn-primary">Add Program</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- Add Program Modal End --}}

            {{-- Edit Modal of Program Start  --}}
            <div class="modal fade" id="editProgram" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content ">
                        <form id="updateProgram">
                            <div class="modal-header bg-secondary">
                                <h5 class="modal-title">Edit Program</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <div class="form-group">
                                        @csrf
                                        <label for="">Program Name</label>
                                        <input type="text" name="edit_program_name" id="edit_program_name"
                                            class="form-control" placeholder="BCA,BHM etc..">
                                        <input type="hidden" name="id" id="program_id">
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="">Faculty</label>
                                            <select class="form-control" name="edit_faculty" id="edit_faculty">
                                                <option value="Humanity">Humanity</option>
                                                <option value="Management">Management</option>
                                                <option value="Science">Science</option>
                                                <option value="Health & Science">Health & Science</option>
                                                <option value="Science & Technology">Science & Technology</option>
                                                <option value="Law">Law</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">University</label>
                                            <select class="form-control" name="edit_univeristy" id="edit_univeristy">
                                                <option value="CTEVT">CTEVT</option>
                                                <option value="Gandaki univeristy">Gandaki univeristy</option>
                                                <option value="Kathmandu Univeristy">Kathmandu Univeristy</option>
                                                <option value="Tribhuvan Univeristy">Tribhuvan Univeristy</option>
                                                <option value="Pokhara Univeristy">Pokhara Univeristy</option>
                                                <option value="Purbanchal Univeristy">Purbanchal Univeristy</option>
                                                <option value="Neb">Neb</option>
                                                <option value="Others">Others</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">Types</label>
                                            <select class="form-control" name="edit_type" id="edit_type">
                                                @forelse ($types as $type)
                                                    <option value="{{ $type->id }}">{{ $type->Type }}</option>
                                                @empty
                                                    <option>No data</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Status</label>
                                        <select class="form-control" name="edit_status" id="edit_status">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" id="btnprogramupdate" class="btn btn-primary">Update
                                        Batch</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- Edit Modal of Program End --}}

        {{-- Delete Modal of Batch Start --}}
        <div class="modal fade" id="deleteProgram" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content ">
                    <form id="delete_program">
                        <div class="modal-header bg-danger">
                            <h5 class="modal-title">Delete Programs</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <h4 class="text-danger">Are you sure you want to delete program ?</h4>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="btnProgramDelete" class="btn btn-danger">Confirm Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Delete Modal of Program End --}}


        <!-- Responsive  type tables Start -->
        <div class="pd-20 card-box mb-30">
            <div class="clearfix mb-20">
                <h4 class="text-blue h4 text-center">Type</h4>
            </div>
            <span class="btn btn-primary mb-4 align-middle hide" data-toggle="modal"  data-target="#addCourseProgram">Add Course Program</span>
            <span class="btn btn-primary mb-4 align-middle">View Semester</span>
            <span class="btn btn-primary mb-4 align-middle">View Year</span>
            {{-- Semester year view start --}}

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">S.N</th>
                            <th scope="col">Batch Name</th>
                            <th scope="col">Program Name</th>
                            <th scope="col">Types</th>
                            <th scope="col">Current Semester/Year</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td>1</td>
                            <td>First Semester</td>
                            <td>00245</td>
                            <td>1</td>
                            <td>First Semester</td>
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
                    <tbody>
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

        {{-- Course Batch Start --}}

        {{-- Add Course/Batch Modal Start --}}
        <div class="modal fade" id="addCourseProgram" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content ">
                    <form id="courseProgram_add">
                        <div class="modal-header bg-secondary">
                            <h5 class="modal-title">Add Course/Program</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="form-group">
                                  <label for="">Batch Name</label>
                                  <select class="form-control" name="batch_name" id="">
                                    @foreach ($batches as $batch)
                                    <option value="{{ $batch->id }}">{{ $batch->batch_name }}</option>
                                    @endforeach
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="">Program Name</label>

                                  <select class="form-control" name="program_name" id="">
                                      @foreach ($programs as $program)
                                      <option value="{{ $program->id }}">{{ $program->program_name }}</option>
                                      @endforeach
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="">Type</label>

                                  <select class="form-control" name="" id="">
                                      @foreach ($types as $type)
                                      <option>{{ $type->Type }}</option>
                                      @endforeach
                                    </select>
                                </div>
                                <div class="form-group" id="semesterhide">
                                  <label for="">Semester</label>
                                  <select class="form-control" name="semester" id="">
                                    <option value="1st semester">1st semester</option>
                                    <option value="2nd semester">2nd semester</option>
                                    <option value="3rd semester">3rd semester</option>
                                    <option value="4th semester">4th semester</option>
                                    <option value="5th semester">5th semester</option>
                                    <option value="6th semester">6th semester</option>
                                    <option value="7th semester">7th semester</option>
                                    <option value="8th semester">8th semester</option>
                                  </select>
                                </div>
                                <div class="form-group" id="yearhide">
                                  <label for="">Year</label>
                                  <select class="form-control" name="year" id="">
                                    <option value="1st year">1st year</option>
                                    <option value="2nd year">2nd year</option>
                                    <option value="3rd year">3rd year</option>
                                    <option value="4th year">4th year</option>
                                  </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="btnprogram" class="btn btn-primary">Add Program</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- Add Course/Batch Modal End --}}

        {{-- Course Batch End --}}
        <!-- Responsive  type tables End -->

    </div>
    </div>
@endsection

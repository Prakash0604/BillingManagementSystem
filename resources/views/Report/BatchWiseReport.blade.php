@extends('index')
@section('content')
    <div class="container  mb-4 p-3">
        <div class="card p-2 bg-secondary text-white">
            <form method="get">
                <div class="row">
                    <div class="form-group col-2">
                        <label for="">Batch</label>
                        <select class="form-control" name="batch_name" id="test1">
                            <option value="">Select ..</option>
                            @foreach ($academicyear as $year)
                                    <option class="id_batch" value="{{ $year->id }}" {{ request()->get('batch_name') == $year->id ? 'selected' : '' }}>
                                        {{ $year->batch_name }}
                                </option>
                            @endforeach
                        </select>
                        
                    </div>
                    <div class="form-group col-4">
                        <label for="">Program</label>
                        <select class="form-control program_id" name="program_name" id="program_id" {{ request()->get('program_name') ? 'selected' : '' }} >
                        </select>
                    </div>
                    <div class="form-group col-4">
                        <label for="">Year/Semester</label>
                        <select class="form-control" name="semester" id="semester_id">
                        </select>
                    </div>
                    <div class="form-group col-2 mt-4">
                        <button class="btn btn-primary mt-2" id="btnloading">Filter</button>
                    </div>
                </div>
            </form>
        </div>
        <a href="{{ route('batchWiseReport') }}" class="btn btn-primary mt-3 ml-3">Show All</a>
        {{-- <a  class="btn btn-primary mt-3 ml-3" onclick="print()">Print</a> --}}
        <button class="btn btn-primary" id="printdataofstudent">Print</button>
        <div class="container mt-4 mb-4 ml-3">
            <p class="text-danger">To hide the particular tick in the box</p>
            <form action="">
                <div class="card p-3 col-4 p-3">
                    <div class="form-check row">
                        <input class="form-check-input" type="checkbox" value="" id="hide_batch_id" />
                        <label class="form-check-label mr-4" for="">Batch </label>
                        <input class="form-check-input " type="checkbox" value="" id="hide_program_id" />
                        <label class="form-check-label mr-4" for=""> program </label>
                        <input class="form-check-input" type="checkbox" value="" id="hide_semester_id" />
                        <label class="form-check-label" for=""> Semester </label>
                    </div>
                </div>
            </form>
        </div>
        <div class="container mt-4 mb-4" id="printstudentdata">
            <table class="table table-bordered" id="studentDataTable">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th class="batch_hide">Batch</th>
                        <th class="program_hide">Program</th>
                        <th class="semester_hide">Semester/Year</th>
                        <th class="student_hide">Name</th>
                        <th class="email_hide">Email</th>
                        <th class="address_hide">Address</th>
                        <th class="contact_hide">Contact</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $n = 1;
                    @endphp
                    @forelse ($students as $student)
                        <tr>
                            <td>{{ $n }}</td>
                            @if ($student->batchname_id != null)
                                <td class="batch_hide">{{ $student->batch->batch_name }}</td>
                            @else
                                <td class="batch_hide">N/A</td>
                            @endif
                            @if ($student->programname_id != null)
                                <td class="program_hide">{{ $student->program->program_name }}</td>
                            @else
                                <td class="program_hide">N/A</td>
                            @endif
                            @if ($student->year_semester != null)
                                <td class="semester_hide">{{ $student->year_semester }}</td>
                            @else
                                <td class="semester_hide">N/A</td>
                            @endif
                            <td class="student_hide">{{ $student->student_name }}</td>
                            <td class="email_hide">{{ $student->email }}</td>
                            <td class="address_hide">{{ $student->address }}</td>
                            <td class="contact_hide">{{ $student->contact }}</td>
                        </tr>
                        @php
                            $n = $n + 1;
                        @endphp
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No data found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#hide_batch_id").on("click", function() {
                $(".batch_hide").toggle();
            });
            $("#hide_program_id").on("click", function() {
                $(".program_hide").toggle();
            });
            $("#hide_semester_id").on("click", function() {
                $(".semester_hide").toggle();
            });
        });
    </script>
@endsection

    @extends('index')
    @section('content')
        <!-- Form grid Start -->
        <div class="pd-20 card-box mb-30 border-primary">
            <div class="clearfix">
                <h4 class="text-blue text-center h4">Student Form</h4>
                <p class="mb-30 text-center">All Fields are mandatory</p>
            </div>
            <form method="POST" enctype="multipart/form-data" action="{{ route('students.update',$studentedit->id) }}">
                @csrf
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Students Name</label>
                            <input type="text" name="student_name"
                                class="form-control @error('student_name') is-invalid @enderror"
                                value="{{ old('student_name',$studentedit->student_name) }}">
                            @error('student_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Date of Birth</label>
                            <input type="date" name="date_of_birth"
                                class="form-control @error('date_of_birth') is-invalid @enderror"
                                value="{{ old('date_of_birth',$studentedit->date_of_birth) }}">
                            @error('date_of_birth')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="">Gender</label>
                            <select class="form-control @error('gender') is-invalid @enderror" name="gender"
                                id="">
                                <option value="{{ old('gender') }}">Select...</option>
                                @if ($studentedit->gender=='Male')
                                <option selected value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Others">Others</option>
                                @elseif($studentedit->gender=='Female')
                                <option value="Male">Male</option>
                                <option selected value="Female">Female</option>
                                <option value="Others">Others</option>
                                @else
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option selected value="Others">Others</option>

                                @endif
                            </select>
                            @error('gender')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" name="address"
                                value="{{ old('address',$studentedit->address) }}">
                            @error('address')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Contact</label>
                            <input type="number" name="contact" class="form-control @error('contact') is-invalid @enderror"
                                value="{{ old('contact',$studentedit->contact) }}">
                            @error('contact')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email',$studentedit->email) }}">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    </div>
                    <div class="row">
                    {{-- Batch Start --}}
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="">Batch</label>
                            <select class="form-control" name="batch_name" id="">
                                <option value="">Select...</option>
                                @forelse ($semesters as $semester)
                                <option value="{{ $semester->batch->id }}">{{ $semester->batch->batch_name }}</option>
                                @empty
                                No data found
                                @endforelse
                            </select>
                        </div>
                    </div>
                    {{-- Batch End --}}
                    {{-- Program Start  --}}
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="">Program</label>
                            <select class="form-control" name="program" id="">
                                <option value="">Select...</option>
                                @forelse ($semesters as $semester)
                                    <option value="{{ $semester->program->id }}">{{ $semester->program->program_name }}</option>
                                @empty
                                    No data found
                                @endforelse
                            </select>
                        </div>
                    </div>
                    {{-- Program End --}}

                    {{-- Semester start  --}}
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="">Program</label>
                            <select class="form-control" name="current_type" id="">
                                <option value="">Select...</option>
                                @forelse ($semesters as $semester)
                                @if ($semester->semester!="")
                                <option value="{{ $semester->semester }}">{{ $semester->semester }}</option>
                                @else
                                <option value="{{ $semester->year }}">{{ $semester->year }}</option>
                                @endif
                                @empty
                                No data found
                                @endforelse
                            </select>
                        </div>
                    </div>
                    {{-- Semester End --}}
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Father Name</label>
                            <input type="text" class="form-control" name="father_name" value="{{ old('father_name',$studentedit->father_name) }}">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Father Contact</label>
                            <input type="number" class="form-control" name="father_contact"
                                value="{{ old('father_contact',$studentedit->father_contact) }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Mother Name</label>
                            <input type="text" class="form-control" name="mother_name" value="{{ old('mother_name',$studentedit->mother_name) }}">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Mother Contact</label>
                            <input type="number" class="form-control" name="mother_contact"
                                value="{{ old('mother_contact',$studentedit->mother_contact) }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Previous College</label>
                            <input type="text" class="form-control" name="previous_college"
                                value="{{ old('previous_college',$studentedit->previous_college) }}">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Image </label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div>
                            <img src="{{ asset('storage/images/'.$studentedit->image) }}" alt="" width="100" height="100">
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary btn-lg">Update Student</button>
                <a href="{{ route('students.index') }}" class="btn btn-secondary btn-lg">Back</a>
            </form>
        </div>


        <!-- Form grid End -->
    @endsection

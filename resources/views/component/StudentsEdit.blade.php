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
                            <input type="text" name="student_name_edit"
                                class="form-control @error('student_name_edit') is-invalid @enderror"
                                value="{{ old('student_name_edit',$studentedit->student_name) }}">
                            @error('student_name_edit')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Date of Birth</label>
                            <input type="date" name="date_of_birth_edit"
                                class="form-control @error('date_of_birth_edit') is-invalid @enderror"
                                value="{{ old('date_of_birth_edit',$studentedit->date_of_birth) }}">
                            @error('date_of_birth_edit')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="">Gender</label>
                            <select class="form-control @error('gender_edit') is-invalid @enderror" name="gender_edit"
                                id="">
                                <option value="{{ old('gender_edit') }}">Select...</option>
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
                            @error('gender_edit')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control @error('address_edit') is-invalid @enderror" name="address_edit"
                                value="{{ old('address_edit',$studentedit->address) }}">
                            @error('address_edit')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Contact</label>
                            <input type="number" name="contact_edit" class="form-control @error('contact_edit') is-invalid @enderror"
                                value="{{ old('contact_edit',$studentedit->contact) }}">
                            @error('contact_edit')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control @error('email_edit') is-invalid @enderror" name="email_edit"
                                value="{{ old('email_edit',$studentedit->email) }}">
                            @error('email_edit')
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
                            <select class="form-control" name="batch_name_edit" id="">
                                <option value="">Select...</option>
                                @if ($studentedit->batch->id!="N/A")
                                <option class="form-control" readonly  selected value="{{ $studentedit->batch->id }}">{{ $studentedit->batch->batch_name }}</option>
                                @else
                                @foreach ($batches as $batch)
                                <option value="{{ $batch->id }}">{{ $batch->batch_name }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    {{-- Batch End --}}
                    {{-- Program Start  --}}
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="">Program</label>
                            <select class="form-control" name="program_edit" id="">
                                <option value="">Select...</option>
                                @if ($studentedit->program->program_name)
                                    <option selected value="{{ $studentedit->program->id }}">{{ $studentedit->program->program_name }}</option>
                                 @else
                                @forelse ($programs as $program)
                                <option value="{{ $program->id }}">{{ $program->program_name }}</option>
                                @empty
                                No data found
                                @endforelse
                                @endif
                            </select>
                        </div>
                    </div>
                    {{-- Program End --}}

                    {{-- Semester start  --}}
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="">Program</label>
                            <select class="form-control" name="current_type_edit" id="">
                                <option value="">Select...</option>
                                @if ($studentedit->year_semester!="N/A")
                                <option selected value="{{ $studentedit->year_semester }}">{{ $studentedit->year_semester }}</option>
                                @else
                                <option selected value="N/A">{{ $studentedit->year_semester }}</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    {{-- Semester End --}}
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Father Name</label>
                            <input type="text" class="form-control" name="father_name_edit" value="{{ old('father_name_edit',$studentedit->father_name) }}">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Father Contact</label>
                            <input type="number" class="form-control" name="father_contact_edit"
                                value="{{ old('father_contact_edit',$studentedit->father_contact) }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Mother Name</label>
                            <input type="text" class="form-control" name="mother_name_edit" value="{{ old('mother_name_edit',$studentedit->mother_name) }}">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Mother Contact</label>
                            <input type="number" class="form-control" name="mother_contact_edit"
                                value="{{ old('mother_contact_edit',$studentedit->mother_contact) }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Previous College</label>
                            <input type="text" class="form-control" name="previous_college_edit"
                                value="{{ old('previous_college_edit',$studentedit->previous_college) }}">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Image </label>
                            <input type="file" class="form-control @error('image_edit') is-invalid @enderror" name="image_edit">
                            @error('image_edit')
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
        </div>+












        <!-- Form grid End -->
    @endsection

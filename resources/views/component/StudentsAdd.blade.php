    @extends('index')
    @section('content')
        <!-- Form grid Start -->
        <div class="pd-20 card-box mb-30 border-primary">
            <div class="clearfix">
                <h4 class="text-blue text-center h4">Student Form</h4>
                <p class="mb-30 text-center">All Fields are mandatory</p>
            </div>
            <form method="POST" enctype="multipart/form-data" action="{{ route('students.store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Students Name</label>
                            <input type="text" name="student_name"
                                class="form-control @error('student_name') is-invalid @enderror"
                                value="{{ old('student_name') }}">
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
                                value="{{ old('date_of_birth') }}">
                            @error('date_of_birth')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Contact</label>
                            <input type="number" name="contact" class="form-control @error('contact') is-invalid @enderror"
                                value="{{ old('contact') }}">
                            @error('contact')
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
                                value="{{ old('address') }}">
                            @error('address')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <div class="form-group">
                            <label for="">Gender</label>
                            <select class="form-control @error('gender') is-invalid @enderror" name="gender"
                                id="">
                                <option value="{{ old('gender') }}">Select...</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Others">Others</option>
                            </select>
                            @error('gender')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <div class="form-group">
                            <label for="">Batch</label>
                            <select class="form-control" name="batch" id="">
                                <option value="">Select...</option>
                                @forelse ($semesters as $semester)
                                    <option value="{{ $semester->id }}">{{ $semester->batch_id }}</option>
                                @empty
                                    No data found
                                @endforelse
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Father Name</label>
                            <input type="text" class="form-control" name="father_name" value="{{ old('father_name') }}">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Father Contact</label>
                            <input type="number" class="form-control" name="father_contact"
                                value="{{ old('father_contact') }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Mother Name</label>
                            <input type="text" class="form-control" name="mother_name" value="{{ old('mother_name') }}">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Mother Contact</label>
                            <input type="number" class="form-control" name="mother_contact"
                                value="{{ old('mother_contact') }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Previous College</label>
                            <input type="text" class="form-control" name="previous_college"
                                value="{{ old('previous_college') }}">
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
                    </div>
                </div>
                <button class="btn btn-primary btn-lg">Add Student</button>
            </form>
        </div>


        <!-- Form grid End -->
    @endsection

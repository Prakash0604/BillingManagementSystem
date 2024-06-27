@extends('index')
@section('content')
    <div class="align-middle">
        <div class="page-header">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="title">
                        <h4>Profile</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('students.index') }}">Students</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="container">
            <div class=" card-box height-100-p">
                <div class="profile-photo">
                    <a href="{{ route('students.edit',$student->id) }}"class="edit-avatar"><i class="fa fa-pencil"></i></a>
                    @if ($student != '')
                        <img src="{{ asset('storage/images/' . $student->image) }}" alt="" class="avatar-photo">
                    @else
                        <img src="{{ asset('src/images/defaultim    age.png') }}" alt="No images" class="avatar-photo">
                    @endif
                </div>
                <h5 class="text-center h5 mb-0">{{ $student->student_name }}</h5>
                <p class="text-center text-danger font-14">{{ $student->username }}</p>
                <div class="profile-info">

                    <table class="table table-bordered">
                        <h5 class="mb-20 h5 text-blue text-center">Academic Information</h5>
                        <tr>
                            <th>Batch</th>
                            <td>{{ $student->batch_name }}</td>
                        </tr>
                        <tr>
                            <th>Program</th>
                            <td>{{ $student->program }}</td>
                        </tr>
                        <tr>
                            <th>Semester</th>
                            <td>{{ $student->type }}</td>
                        </tr>
                    </table>
                    <table class="table table-bordered">
                        <h5 class="mb-20 h5 text-blue text-center">Personal Information</h5>
                        <tr>
                            <th>Gender</th>
                            <td>{{ $student->gender }}</td>
                        </tr>
                        <tr>
                            <th>Date of Birth</th>
                            <td>{{ $student->date_of_birth }}</td>
                        </tr>
                        <tr>
                            <th>Email Address</th>
                            <td>{{ $student->email }}</td>
                        </tr>
                        <tr>
                            <th>Phone Number</th>
                            <td>{{ $student->contact }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $student->address }}</td>
                        </tr>
                        <tr>
                            <th>Email Address</th>
                            <td>{{ $student->email }}</td>
                        </tr>
                        <tr>
                            <th>Previous College</th>
                            <td>{{ $student->previous_college }}</td>
                        </tr>
                    </table>

                    <table class="table table-bordered">
                        <h5 class="mb-20 h5 text-blue text-center">Gurantians Information</h5>
                        <tr>
                            <div>
                            <th>Father Name</th>
                            <td>{{ $student->father_name }}</td>
                          </div>
                           <div>
                            <th>Contact</th>
                            <td>{{ $student->father_contact }}</td>
                          </div>
                        </tr>
                        <tr>
                            <div>
                            <th>Mother Name</th>
                            <td>{{ $student->mother_name }}</td>
                            </div><div>
                            <th>Contact</th>
                            <td>{{ $student->mother_contact }}</td>
                            </div>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

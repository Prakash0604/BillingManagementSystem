
@extends('index')
@section('content')
    {{-- Student Detail Page Start --}}
				<div class="container pd-0">
					<div class="page-header">
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div class="title">
									<h4>Student Dictionary</h4>
								</div>
								<nav aria-label="breadcrumb" role="navigation">
									<ol class="breadcrumb">
										<li class="breadcrumb-item"><a href="index.html">Home</a></li>
										<li class="breadcrumb-item active" aria-current="page">All Student List</li>
									</ol>
								</nav>
							</div>
						</div>
					</div>

                    <div class="container">
                        <a href="{{ route('students.create') }}" class="btn btn-primary btn-lg mb-4">Add Student</a>
                    </div>
                    <div class="container">
                        @if (session()->has('message'))
                            <div class="alert alert-success text-center alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    <span class="sr-only">Close</span>
                                </button>
                                <strong>{{ session()->get('message') }}</strong>
                            </div>
                        @endif
                    </div>
					<div class="contact-directory-list">
						<ul class="row">
                            @forelse ($students as $student)
							<li class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
								<div class="contact-directory-box">
									<div class="contact-dire-info text-center">
										<div class="contact-avatar">
                                            <span>
                                                @if ($student->image!="")
												<img src="{{ asset('storage/images/'.$student->image) }}" alt="No image">
                                                @else
												<img src="{{ asset('src/images/defaultimage.png') }}" alt="No image">
                                                @endif
											</span>
                                            <a href="{{ route('students.edit',$student->id) }}" class="text-primary bi bi-pencil-square"></a>
                                            <a href="" class="text-danger bi bi-trash"></a>
										</div>
										<div class="contact-name">
											<h4>{{ $student->student_name }}</h4>
											<p>{{ $student->email }}</p>
											<p class="work text-danger">{{ $student->username }}</p>
											<div class="work text-success"><i class="bi bi-telephone-outbound"></i> {{ $student->contact }}</div>
										</div>
									</div>
									<div class="view-contact">
										<a href="{{ route('students.show',$student->id) }}">View Profile</a>
									</div>
								</div>
							</li>
                            @empty
                            <div class="container text-center">No data found</div>
                            @endforelse
						</ul>
					</div>
				</div>

    {{-- Student Detail Page End --}}
 @endsection

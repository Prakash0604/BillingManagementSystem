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
                                        @if ($student->image != '')
                                            <img src="{{ asset('storage/images/' . $student->image) }}" alt="No image">
                                        @else
                                            <img src="{{ asset('src/images/defaultimage.png') }}" alt="No image">
                                        @endif
                                    </span>
                                    <a href="{{ url('students/edit/'.$student->id) }}"
                                        class="text-primary bi bi-pencil-square"></a>
                                    <a class="text-danger bi bi-trash idforstudentdelete" data-id="{{ $student->id }}" data-toggle="modal"
                                        data-target="#modelId"></a>
                                </div>
                                <div class="contact-name">
                                    <h4>{{ $student->student_name }}</h4>
                                    <p>{{ $student->email }}</p>
                                    <p class="work text-danger">{{ $student->username }}</p>
                                    <div class="work text-success"><i class="bi bi-telephone-outbound"></i>
                                        {{ $student->contact }}</div>
                                </div>
                            </div>
                            <div class="view-contact">
                                <a href="{{ route('students.show', $student->id) }}">View Profile</a>
                            </div>
                        </div>
                    </li>
                    {{-- Student Modal Start --}}
                    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form id="StudentDelete">
                                    @csrf
                                    <div class="modal-header bg-secondary">
                                        <h5 class="modal-title">Delete Student</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container-fluid">
                                            <h5 class="text-danger"> Are you sure you want to delete student ?</h5>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger" id="stuDelete">Confirm Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Student Modal End --}}
                @empty
                    <h4 class="container text-center p-4">No data found</h4>
                @endforelse
            </ul>
        </div>
    </div>

    {{-- Student Detail Page End --}}

    <script>
        $(document).ready(function(){
            $(".idforstudentdelete").on("click",function(){
                let id=$(this).attr("data-id");
                console.log(id);
                $("#StudentDelete").submit(function(event){
                    event.preventDefault();
                    $("#stuDelete").text("Deleting...");
                    $("#stuDelete").prop("disabled",true);
                    $.ajax({
                        url:"students/delete/"+id,
                        method:"get",
                        success:function(data){
                            console.log(data);
                            if(data.success==true){
                                Swal.fire({
                                    icon:"success",
                                    title:"Student deleted successfully",
                                    showConfirmButton:false,
                                    timer:1500
                                });
                                $("#stuDelete").prop("disabled",false);
                                $("#stuDelete").text("Confirm Delete");
                                setTimeout(() => {
                                    location.reload();
                                }, 1500);
                            }
                        }
                    })
                })
            })

        })
    </script>
@endsection



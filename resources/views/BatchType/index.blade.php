@extends('index')
@section('content')
    <div class="container">
        <h4 class="text-center">{{ $title }}</h4>
        <button class="btn btn-primary" data-toggle="modal" data-target="#modelId">Create Semester/Year</button>
        <div class="container-fluid mt-4 d-flex">
            <table class="table table-bordered" id="typeTable">
                <thead class="thead-dark">
                    <tr>
                        <th>S.N</th>
                        <th>Year Name</th>
                        <th>Type</th>
                        <th>Running</th>
                        <th>Status</th>
                        <th colspan="2" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $n=1;
                    @endphp
                    @foreach ($Years as $year)
                    <tr>
                        <td>{{ $n }}</td>
                        <td>{{ $year->name }}</td>
                        <td>{{ $year->batch_type->Type ?? 'N/A' }}</td>
                        <td><span class="badge badge-pill badge-{{ $year->running  ? 'success':'danger'}}">{{ $year->running  ? 'Running':'Passout'}}</span></td>
                        <td><span class="badge badge-{{ $year->status ?'success':'danger' }} badge-pill">{{ $year->status ? 'Active':'Inactive' }}</span></td>
                        <td>
                            <span class="btn btn-primary btn-sm editYear" data-id="{{ $year->id }}" data-toggle="modal" data-target="#editYear"><i class="bi bi-pencil-square"></i>Edit</span>
                        </td>
                        <td>

                            <span  class="btn btn-danger btn-sm deleteYear" data-id="{{ $year->id }}" data-toggle="modal" data-target="#deleteYear"><i class="bi bi-trash"></i>Delete</span>
                        </td>
                    </tr>
                    @php
                        $n=$n+1;
                    @endphp
                    @endforeach
                </tbody>
            </table>

            {{-- Semester Wise Fetch Data --}}
            <table class="table table-bordered ml-4 border-dark" id="typeTable">
                <thead class="thead-dark">
                    <tr>
                        <th>S.N</th>
                        <th>Semester Name</th>
                        <th>Type</th>
                        <th>Running</th>
                        <th>Status</th>
                        <th colspan="2" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $n=1;
                    @endphp
                    @foreach ($Semesters as $sem)
                    <tr>
                        <td>{{ $n }}</td>
                        <td>{{ $sem->name }}</td>
                        <td>{{ $sem->batch_type->Type ?? 'N/A' }}</td>
                        <td><span class="badge badge-pill badge-{{ $sem->running  ? 'success':'warning'}}">{{ $sem->running  ? 'Running':'Passout'}}</span></td>
                        <td><span class="badge badge-pill badge-{{ $sem->status ? 'success':'danger' }}">{{ $sem->status ? 'Active':'Inactive' }}</span></td>
                        <td class="p-2">
                            <span class="btn btn-primary btn-sm editSemester " data-id="{{ $sem->id }}" data-toggle="modal" data-target="#editsemesterModal"><i class="bi bi-pencil-square"></i>Edit</span>
                        </td>
                        <td>
                            <span  class="btn btn-danger btn-sm deleteSemester" data-id="{{ $sem->id }}" data-toggle="modal" data-target="#deletesemesterModal"><i class="bi bi-trash"></i>Delete</span>
                        </td>
                    </tr>
                    @php
                        $n=$n+1;
                    @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="typesubmit">
                    <div class="modal-header">
                        @csrf
                            <h5 class="modal-title">Semester/Year</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-group">
                          <label for="">Type</label>
                          <select class="form-control" name="type_id" id="">
                            @foreach ($type as $t)
                            <option value="{{ $t->id }}">{{ $t->Type }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="">Name</label>
                          <input type="text" name="type_name" id="type_name_id" class="form-control" placeholder="" aria-describedby="helpId">
                        </div>
                        <div class="form-group">
                          <label for="">Activity Type</label>
                          <select class="form-control" name="running_status" id="">
                            <option value="1">Running</option>
                            <option value="0">Passout</option>
                          </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btntype">Save</button>
                </div>
            </div>
        </form>
        </div>
    </div>

    {{-- Edit Year Modal  --}}
    <div class="modal fade" id="editYear" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="typeUpdate">
                    <div class="modal-header">
                        @csrf
                            <h5 class="modal-title">Year</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-group">
                          <label for="">Type</label>
                          <input type="hidden" name="edit_year_id" id="edit_year_data_id">
                          <select class="form-control" name="editType_id" id="edit_type_id">
                            @foreach ($type as $t)
                            <option value="{{ $t->id }}">{{ $t->Type }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="">Name</label>
                          <input type="text" name="editType_name" id="edit_type_name_id" class="form-control" placeholder="" aria-describedby="helpId">
                        </div>
                        <div class="form-group">
                          <label for="">Activity Type</label>
                          <select class="form-control" name="editRunning_status" id="edit_activity_id">
                            <option value="1">Running</option>
                            <option value="0">Passout</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="">Status</label>
                          <select class="form-control" name="edit_status" id="edit_status_id">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                          </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btntypeUpdate">Update</button>
                </div>
            </div>
        </form>
        </div>
    </div>

    {{-- Edit Year Modal  --}}

    {{-- Delete Year Modal --}}
    <div class="modal fade" id="deleteYear" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="deleteTypeData">
                    <div class="modal-header bg-danger">
                        @csrf
                            <h5 class="modal-title">Year</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <h4 class="text-danger">Are you sure you want to delete ?</h4>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" id="btntypeDelete">Confirm Delete</button>
                </div>
            </div>
        </form>
        </div>
    </div>
    {{-- Delete Year Modal --}}



    {{-- Semester Modal Start  --}}
        {{-- Edit Semester Modal  --}}
        <div class="modal fade" id="editsemesterModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="SemesterTypeUpdate">
                        <div class="modal-header">
                            @csrf
                                <h5 class="modal-title">Semester</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="form-group">
                              <label for="">Type</label>
                              <input type="hidden" name="edit_year_id" id="editSemester_id">
                              <select class="form-control" name="editType_id" id="editSemesterType_id">
                                @foreach ($type as $t)
                                <option value="{{ $t->id }}">{{ $t->Type }}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="">Name</label>
                              <input type="text" name="editType_name" id="editSemesterName_id" class="form-control" placeholder="" aria-describedby="helpId">
                            </div>
                            <div class="form-group">
                              <label for="">Activity Type</label>
                              <select class="form-control" name="editRunning_status" id="editSemesterActivity_id">
                                <option value="1">Running</option>
                                <option value="0">Passout</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="">Status</label>
                              <select class="form-control" name="edit_status" id="editSemesterStatus_id">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                              </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btnSemester">Update</button>
                    </div>
                </div>
            </form>
            </div>
        </div>

        {{-- Edit Smester Modal  --}}

        {{-- Delete Semester Modal --}}
        <div class="modal fade" id="deletesemesterModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="deleteSemester_id">
                        <div class="modal-header bg-danger">
                            @csrf
                                <h5 class="modal-title">Semester</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <h4 class="text-danger">Are you sure you want to delete ?</h4>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger" id="btnSemesterDelete">Confirm Delete</button>
                    </div>
                </div>
            </form>
            </div>
        </div>

    {{-- Semester Modal End --}}
    <script>
        // Add Functionality
        $("#typesubmit").on("submit",function(event){
            event.preventDefault();
            $("#btntype").text("Saving...");
            $("#btntype").prop("disabled",true);
            let formdata=new FormData(this);
            console.log(formdata);
            $.ajax({
                url:"batchtype/store",
                method:"POST",
                data:formdata,
                contentType:false,
                processData:false,
                success:function(data){
                    console.log(data);
                    if(data.success==true){
                        Swal.fire({
                            icon:"success",
                            title:"Type has been added",
                            showConfirmButton:false,
                            timer:1500
                        });
                        $("input[type='text']").val("");
                        $("#btntype").text("Save");
                        $("#btntype").prop("disabled",false);
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    }else{
                        Swal.fire({
                            icon:"info",
                            title:data.message,
                            showConfirmButton:false,
                            timer:1500,
                        });
                        $("#btntype").text("Save");
                        $("#btntype").prop("disabled",false);
                    }
                }
            })
        })

        // Year Wise Edit/Delete Ajax Query Start

        $(document).ready(function(){
            $(".editYear").on("click",function(){
                var id=$(this).attr("data-id");
                console.log(id);
                $.ajax({
                    method:"get",
                    url:"data/get/"+id,
                    success:function(data){
                        console.log(data);
                        if(data.success==true){
                            $("#edit_type_id").val(data.batch_data.data_id);
                            $("#edit_type_name_id").val(data.batch_data.name);
                            $("#edit_activity_id").val(data.batch_data.running);
                            $("#edit_status_id").val(data.batch_data.status);
                            $("#edit_year_data_id").val(data.batch_data.id);
                        }
                    }
                });
            });
        })

        $(document).ready(function(){
            $("#typeUpdate").submit(function(event){
                event.preventDefault();
                $("#btntypeUpdate").text("Updating...");
                $("#btntypeUpdate").prop("disabled",true);
                var formdata=new FormData(this);
                console.log(formdata);
                $.ajax({
                    method:"POST",
                    url:"batchtype/update",
                    data:formdata,
                    contentType:false,
                    processData:false,
                    success:function(data){
                        console.log(data);
                        if(data.success==true){
                            Swal.fire({
                                icon:"success",
                                title:"Type has been updated successfully",
                                showConfirmButton:false,
                                timer:1500
                            });
                            $("#btntypeUpdate").text("Update");
                            $("#btntypeUpdate").prop("disabled",false);
                            setTimeout(() => {
                                location.reload();
                            }, 1500);
                        }

                    }
                })
            })
        });

        $(document).ready(function(){
            $(".deleteYear").on("click",function(){
                var id=$(this).attr("data-id");
                console.log(id);
                $("#deleteTypeData").submit(function(event){
                    event.preventDefault();
                    $("#btntypeDelete").text("Deleting...");
                    $("#btntypeDelete").prop("disabled",true);
                    $.ajax({
                        method:"get",
                        url:"batchtype/delete/"+id,
                        success:function(data){
                            if(data.success==true){
                                Swal.fire({
                                    icon:"success",
                                    title:"Type has been deleted",
                                    showConfirmButton:false,
                                    timer:1500,
                                });
                                setTimeout(() => {
                                    location.reload();
                                }, 1500);
                            }else{
                                console.log(data.message)
                                Swal.fire({
                                    icon:"warning",
                                    title:"Something went wrong",
                                    showConfirmButton:false,
                                    timer:1500,
                                });
                                $("#btntypeDelete").text("Confirm Delete");
                                $("#btntypeDelete").prop("disabled",false);
                            }

                        }
                    })
                })
            })
        })
        // Year Wise Edit/Delete Ajax Query End


        // Semester Wise Edit/Delete Ajax Query Start
        $(document).ready(function(){
            $(".editSemester").on("click",function(){
                var id=$(this).attr("data-id");
                console.log(id);
                $.ajax({
                    method:"get",
                    url:"data/get/"+id,
                    success:function(data){
                        console.log(data);
                        if(data.success==true){
                            $("#editSemesterType_id").val(data.batch_data.data_id);
                            $("#editSemesterName_id").val(data.batch_data.name);
                            $("#editSemesterActivity_id").val(data.batch_data.running);
                            $("#editSemesterStatus_id").val(data.batch_data.status);
                            $("#editSemester_id").val(data.batch_data.id);
                        }
                    }
                });
            });
        })

        $(document).ready(function(){
            $("#SemesterTypeUpdate").submit(function(event){
                event.preventDefault();
                $("#btnSemester").text("Updating...");
                $("#btnSemester").prop("disabled",true);
                var formdata=new FormData(this);
                console.log(formdata);
                $.ajax({
                    method:"POST",
                    url:"batchtype/update",
                    data:formdata,
                    contentType:false,
                    processData:false,
                    success:function(data){
                        console.log(data);
                        if(data.success==true){
                            Swal.fire({
                                icon:"success",
                                title:"Type has been updated successfully",
                                showConfirmButton:false,
                                timer:1500
                            });
                            $("#btnSemester").text("Update");
                            $("#btnSemester").prop("disabled",false);
                            setTimeout(() => {
                                location.reload();
                            }, 1500);
                        }

                    }
                })
            })
        });

        $(document).ready(function(){
            $(".deleteSemester").on("click",function(){
                var id=$(this).attr("data-id");
                console.log(id);
                $("#deleteSemester_id").submit(function(event){
                    event.preventDefault();
                    $("#btnSemesterDelete").text("Deleting...");
                    $("#btnSemesterDelete").prop("disabled",true);
                    $.ajax({
                        method:"get",
                        url:"batchtype/delete/"+id,
                        success:function(data){
                            if(data.success==true){
                                Swal.fire({
                                    icon:"success",
                                    title:"Type has been deleted",
                                    showConfirmButton:false,
                                    timer:1500,
                                });
                                setTimeout(() => {
                                    location.reload();
                                }, 1500);
                            }else{
                                console.log(data.message)
                                Swal.fire({
                                    icon:"warning",
                                    title:"Something went wrong",
                                    showConfirmButton:false,
                                    timer:1500,
                                });
                                $("#btnSemesterDelete").text("Confirm Delete");
                                $("#btnSemesterDelete").prop("disabled",false);
                            }

                        }
                    })
                })
            })
        })

        // Semester Wise Edit/Delete Ajax Query End
    </script>
@endsection

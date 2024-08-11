@extends('index')
@section('content')
    <div class="container">
      <h4 class="text-center">Fee Structure</h4>
      <div class="card col-3 p-3">
        <a href="{{ url('billing/fee_structure/create') }}" class="btn btn-primary">Create</a>
        @include('Billing.Layout.main')
      </div>
      <div class="card-body p-3">
        <table class="table">
            <thead>
                <tr>
                    <th>S.N</th>
                    <th>Batch Year</th>
                    <th>Program</th>
                    <th>Faculty</th>
                    <th>Type</th>
                    <th>Total</th>
                    <td>Status</td>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $n=1;
                @endphp
                @forelse ($feestructures as $fee_structure)
                <tr>
                    <td scope="row">{{ $n }}</td>
                    {{-- @php
                        dd($feestructures);
                    @endphp --}}
                    <td>{{ $fee_structure->batch_name  }}</td>
                    <td>{{ $fee_structure->program_name ?? 'N/A' }}</td>
                    <td>{{ $fee_structure->faculty }}</td>
                    <td>{{ $fee_structure->semester ? 'semester':'year' }}</td>
                    <td>{{ $fee_structure->net_amounts }}</td>
                    <td><span class="badge badge-pill bg-{{ $fee_structure->status ? 'success':'danger' }}">{{ $fee_structure->status ? 'Active':'Inactive' }}</span></td>
                    <td>
                        <a  class="btn btn-primary">Edit</a>
                        <a  class="btn btn-danger deletecourseFee" data-toggle="modal" data-id="{{ $fee_structure->id }}" data-target="#modelId">Delete</a>
                    </td>


                </tr>
                @empty
                <tr>
                    <td class="text-center" colspan="8">
                        No data Found
                    </td>
                </tr>

                @php
                    $n=$n+1;
                @endphp
                @endforelse
            </tbody>
        </table>
      </div>
    </div>
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="formDelete">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">Delete Course Fee</h5>
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
                    <button type="submit"  class="btn btn-danger btndelete">Confirm Delete</button>
                </div>
            </div>
        </form>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $(".deletecourseFee").on("click",function(){
                let id=$(this).attr("data-id");
                console.log(id);
                $("#formDelete").submit(function(event){
                    event.preventDefault();
                    $(".btndelete").text("Deleting...");
                    $(".btndelete").prop("disabled",true);
                    $.ajax({
                        url:"/billing/delete/coursefee/"+id,
                        method:"get",
                        success:function(data){
                            console.log(data);
                            if(data.success==true && data.value==200){
                                Swal.fire({
                                    icon:"success",
                                    title:data.message,
                                    showConfirmButton:false,
                                    timer:1500
                                });
                                $(".btndelete").text("Confirm Delete");
                                $(".btndelete").prop("disabled",false);
                                setTimeout(() => {
                                    location.reload();
                                }, 1500);
                            }else{
                                Swal.fire({
                                    icon:"warning",
                                    title:data.message,
                                    showConfirmButton:false,
                                    timer:1500
                                });
                                $(".btndelete").text("Confirm Delete");
                                $(".btndelete").prop("disabled",false);
                            }
                        }
                    })

                });
            })
        })
    </script>
@endsection

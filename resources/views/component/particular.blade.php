@extends('index')
@section('content')
    <div class="container">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-lg mb-4 mt-4" data-toggle="modal" data-target="#modelId"><i class="bi bi-plus-square"></i>
          Add Fee Partiuclar
        </button>

        <!-- Modal -->
        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="addParticular">
                        <div class="modal-header bg-secondary">
                                <h5 class="modal-title">Particular Add</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                    <div class="modal-body">
                        @csrf
                        <div class="container-fluid">
                            <div class="form-group">
                              <label for="">Particular Name</label>
                              <input type="text" name="particular_name" id="" class="form-control" placeholder="Enter the name of partiuclar" aria-describedby="helpId">
                            </div>
                            <div class="form-group">
                              <label for="">Description</label>
                              <textarea class="form-control" name="description" id="" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div id="app" data-particular-route="{{ route('store.particular') }}"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnparticular" class="btn btn-primary">Add Particular</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <table class="table table-bordered" id="myTable">
            <thead class="thead-dark">
                <tr>
                    <th>S.N</th>
                    <th>Particular</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody >
                @php
                    $n=1;
                @endphp
                @forelse ($particulars as $particular)
                <tr>
                    <td scope="row">{{ $n }}</td>
                    <td>{{ $particular->particular_name }}</td>
                    <td>{{ $particular->description }}</td>
                    <td><span class="badge badge-{{ $particular->status ? "success":"danger" }}">{{ $particular->status ? "Active":"Inactive" }}</span></td>
                    <td>
                        <a data-toggle="modal" data-target="#editModal" data-id="{{ $particular->id }}" id="editButton" class="btn btn-primary text-white"><i class="bi bi-pencil-square"></i> Edit</a>
                        <a data-toggle="modal" data-target="#deleteModal" data-id="{{ $particular->id }}" id="deleteButton"  class="btn btn-danger text-white"><i class="bi bi-trash"></i> Delete</a>
                    </td>
                </tr>
                @php
                    $n=$n+1;
                @endphp
                @empty
                <td colspan="5" class="text-center">No data found</td>

                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Edit Particular Start --}}

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="updateParticular">
                    <div class="modal-header bg-secondary">
                            <h5 class="modal-title">Particular Edit</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    @csrf
                    <div class="container-fluid">
                        <div class="form-group">
                          <label for="">Particular Name</label>
                          <input type="hidden" name="id" id="particular_id">
                          <input type="text" name="particular_name" id="editParticularName" class="form-control" placeholder="Enter the name of partiuclar" aria-describedby="helpId">
                        </div>
                        <div class="form-group">
                          <label for="">Description</label>
                          <textarea class="form-control" name="description" id="editDescription" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                          <label for="">Status</label>
                          <select class="form-control" name="status" id="status">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                          </select>
                        </div>
                    </div>
                </div>
                <div id="app" data-particular-route="{{ route('store.particular') }}"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="btneditParticular" class="btn btn-primary">Update Particular</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    {{-- Edit Particular End --}}

    {{-- Delete Particular Start --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="deleteParticular">
                    <div class="modal-header bg-secondary">
                            <h5 class="modal-title">Particular Edit</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    @csrf
                    <div class="container-fluid">
                        <div class="form-group">
                         <input type="hidden" id="deleteid">
                         <h5 class="text-danger">Are you sure you want to delete particular ?</h5>
                    </div>
                </div>
                <div id="app" data-particular-route="{{ route('store.particular') }}"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="btndeleteParticular" class="btn btn-danger"><i class="bi bi-trash"></i> Confirm Delete</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    {{-- Delete Particular End --}}
   
@endsection

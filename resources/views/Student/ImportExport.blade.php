@extends('index')
@section('content')
<div class="container">
    @if (session()->has('success'))
        <div
            class="alert alert-success alert-dismissible fade show"
            role="alert"
        >
            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"
            ></button>

            <strong>{{session()->get('success')}}</strong>
        </div>

    @endif
    <div class="jumbotron">
        <h3 class="display-3">Import/Export</h3>
        <p class="lead">Please Import the excel format according to the student enrolled</p>
        <hr class="my-2">
        <p class="text-danger">Note:Please review and import only excel files</p>
        <p class="lead">
        <form action="{{route('student.import')}}" method="POST" enctype="multipart/form-data">
            <div class="card">
                @csrf
                    {{-- Batch Start --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Batch</label>
                            <select class="form-control @error('batch_name') is-invalid @enderror" name="batch_name" id="">
                                <option value="">Select...</option>
                                @forelse ($batchdata as $batch)
                                <option id="excelExportbatch" value="{{ $batch->id }}">{{ $batch->batch_name }}</option>
                                @empty
                                No data found
                                @endforelse
                            </select>
                            @error('batch_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    {{-- Batch End --}}
                    {{-- Program Start  --}}
                    <div class="col-md-4 ">
                        <div class="form-group">
                            <label for="">Program</label>
                            <select class="form-control @error('program_name') is-invalid @enderror" name="program_name" id="excelExportProgram">
                                    {{-- <option id="program_batch_id" value=""></option> --}}
                            </select>
                            @error('program_name')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    {{-- Program End --}}

                    {{-- Semester start  --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Semester</label>
                            <select class="form-control @error('year_semester') is-invalid @enderror" name="year_semester" id="excelExportSemesters">

                            </select>
                            @error('year_semester')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                        </div>
                    </div>
                    {{-- Semester End --}}
            <div class="form-group col-md-4 p-2">
              <label for="">Import Student Files</label>
              <input type="file" class="form-control-file" name="file" id="" placeholder="" aria-describedby="fileHelpId">
              @error('file')
                  <div class="text-danger">{{$message}}</div>
              @enderror
            </div>
            <button class="btn btn-danger mt-2"> <i class="bi bi-file-earmark-excel "></i> Import Excel</button>
        </div>
        </form>

        <div class="form-group card col-7 mt-3 p-3">
            <p><i class="bi bi-file-earmark-excel"></i> Export Student Excel Format</p>
          <a href="{{route('student.export')}}" class="btn btn-primary">Export Excel</a>
        </div>
        </p>
    </div>
</div>
@endsection

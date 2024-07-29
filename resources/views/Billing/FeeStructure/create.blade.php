@extends('index')
@section('content')
    <div class="container">
        <h1 class="text-center">{{ $title }}</h1>
            <form action="" method="post">
                <div class="row">
                <div class="form-group">
                  <label for="">Batch</label>
                  <select class="form-control" name="" id="">
                    <option value="N/A">Select...</option>
                    @foreach ($batch as $batch)
                    <option value="{{ $batch->id }}">{{ $batch->batch_name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group mr-2 ml-2">
                  <label for="">Program</label>
                  <select class="form-control" name="" id="">
                    @foreach ($program as $program)
                    <option>{{ $program->program_name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group mr-2 ml-2">
                  <label for="">Semester</label>
                  <select class="form-control" name="" id="">
                    @foreach ($semester as $s)
                    <option value=""> {{ $s }}</option>

                    @endforeach
                  </select>
                </div>
                <div class="form-group mr-2 ml-2">
                    <label for="">Ending Date</label>
                    <input type="date" name="" id="" class="form-control" placeholder="" aria-describedby="helpId">
                    <small id="helpId" class="text-muted">Help text</small>
                  </div>
                <div class="form-group">
                  <label for="">Ending Date</label>
                  <input type="date" name="" id="" class="form-control" placeholder="" aria-describedby="helpId">
                  <small id="helpId" class="text-muted">Help text</small>
                </div>
                <div class="form-group mt-2">
                    <label for=""></label>
                    <button class="btn btn-primary mt-4">Filter</button>
                </div>
            </div>
     </form>
    </div>
@endsection

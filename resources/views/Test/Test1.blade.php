@extends('index')
@section('content')
<div class="container">
    <button class="btn btn-primary mb-3" id="addMoreButton">Add More</button>
<form action="">
    <div class="row" id="NameData">
    <div class="form-group">
      <label for="">Add More</label>
      <input type="text" name="" id="" class="form-control" placeholder="" aria-describedby="helpId">
      <small id="helpId" class="text-muted">Help text</small>
    </div>
</div>
</form>
</div>

<script>
    $(document).ready(function(){
        let maxFields=6;

        let x=1;
        let filedlist=`<div class="form-group testing">
                    <label for="">Add More</label>
                    <input type="text" name="" id="" class="form-control" placeholder="" aria-describedby="helpId">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span> </button>
                    </div>`;
        $("#addMoreButton").on("click",function(){
            let currentFieldCount=$(".form-group").length;
            if(currentFieldCount < maxFields){
                $("#NameData").append(filedlist);
                }
        });

        $(document).on("click",'.close',function(){
            $(this).parent(".form-group").remove();
        });

    })
</script>
@endsection

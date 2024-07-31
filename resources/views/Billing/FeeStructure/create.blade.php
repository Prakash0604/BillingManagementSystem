@extends('index')
@section('content')
    <div class="container d-flex">
        <form action="" method="get">
            <div class="row col-12" >
            <div class="form-group mr-2 ">
              <label for="">Batch</label>
              <select class="form-control col-12" name="" id="">
                <option value="">Choose...</option>
                @foreach ($batches as $batch)
                <option value="{{ $batch->id }}" class="batch_data">{{ $batch->batch_name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group mr-1 ml-1  ">
              <label for="">Program</label>
              <select class="form-control col-12" name="" id="program_data_id">
                <option value="">Select any one </option>
              </select>
            </div>
            <div class="form-group">
              <label for="">Semester</label>
              <select class="form-control" name="" id="semester_data_id">
            </select>
            </div>
        </div>


    <div class="container">
        <button type="button" class="btn btn-primary addMore mb-3">Add More</button>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Particular</th>
                    <th>Times</th>
                    <th>Amount</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="fetchFormData">
                <tr class="maindatarow">
                    <div class="row">
                    <td>
                    <div class="form-group mr-3">
                      <select class="form-control" name="particulars[]" id="">
                        <option value="">Select..</option>
                        @foreach ($particular as $part)
                        <option value="{{ $part->id }}">{{ $part->particular_name }}</option>
                        @endforeach
                      </select>
                    </div>
                   </td>
                   <td>
                    <div class="form-group mr-3">
                      <input type="number" name="times[]" id="" class="form-control timesCalculate" placeholder="times">
                    </div>
                    </td>
                    <td>
                    <div class="form-group">
                      <input type="number" name="amount[]" id="" class="form-control netTotalCalculate" placeholder="net total">
                    </div>
                     </td>
                     <td>
                    <div class="form-group">
                      <input type="number" name="totalamount[]" id="" class="form-control grossTotalCalculate" placeholder="gross total" disabled>
                    </div>
                    </td>
                     <td>
                    </td>
                </div>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2"></td>
                    <td><b>Net Amount : <input type="number" id="netAmount" class="form-control" readonly/></b></td>
                    <td><b>Gross Amount:<input type="number" id="grossAmount" class="form-control" readonly/> </b></td>
                </tr>
            </tfoot>
        </table>
        <div class="container">
            <button class="btn btn-success col float-end ">Save</button>
        </div>

    </div>
</form>
</div>
    <script>
        $(document).ready(function(){
            let inputtype= `
            <tr class="maindatarow"><div class="row"><td><div class="form-group mr-3"><select class="form-control" name="particulars[]"><option value="">Select..</option>@foreach ($particular as $part) <option value="{{ $part->id }}">{{ $part->particular_name }}</option>@endforeach</select></div></td><td><div class="form-group mr-3">
                <input type="number" name="times[]" id="" class="form-control timesCalculate" placeholder=""></div> </div> </td><td><div class="form-group">
                    <input type="number" name="amounts[]" id="" class="form-control netTotalCalculate" placeholder=""></div></div> </td><td><div class="form-group ">
                        <input type="number" name="totalamounts[]" id="" disabled class="form-control grossTotalCalculate" placeholder=""></div></td><td><button class="btn btn-danger ml-2 btnclose" type="button">Remove</button></td></tr>`;
        let limit=8;
        let x=1;

            $(".addMore").click(function(){
                let count1=$(".maindatarow").length;
                if(count1 < limit){
                    $(".fetchFormData").append(inputtype);
                }else{
                    $(".fetchFormData").append(`<tr><td colspan="5" class="text-center text-danger">Reached max limit<button type="button" class="close" data-dismiss="modal" aria-label="Close"></td></tr>`);
                }
            })

            $(document).on("click",".btnclose",function(){
                $(this).closest(".maindatarow").remove();
                x--;
            })
        })

        $(document).ready(function(){
            // Fetch program
            $(".batch_data").on("click",function(){
                let batch_id=$(this).attr('value');
                console.log(batch_id);
                $.ajax({
                    method:"get",
                    url:"program/data/get/"+batch_id,
                    success:function(data){
                        console.log(data);

                        let program_data= $("#program_data_id");
                        // program_data.empty();
                        if(data.success==true && data.batch_data.length >0){
                            data.batch_data.forEach(element => {
                                program_data.append(`<option class="fetch_program"  value="${element.program.id}">${element.program.program_name}</option>`);
                            });
                        }
                        else{
                            program_data.append(`<option>No data found</option>`)
                        }
                    }
                })
            });
            $(document).on("click",".fetch_program",function(){
                let data=$(this).attr('value');
                console.log(data);
                $.ajax({
                    method:"get",
                    url:"semester/data/get/"+data,
                    success:function(data){
                        console.log(data);
                        if(data.success==true && data.semester.length > 0){
                            data.semester.forEach(element => {
                                if(element.semester!=null){
                                    $("#semester_data_id").append(`<option class="fetch_program" selected value="${element.semester}">${element.semester}</option>`);
                                }else{
                                    $("#semester_data_id").append(`<option class="fetch_program" selected value="${element.year}">${element.year}</option>`);
                                }
                            });
                        }else{

                            $("#semester_data_id").append(`<option class="fetch_program" value="">No data found</option>`);
                        }
                    }
                })
            });
        });

        $(document).on("input", ".timesCalculate, .netTotalCalculate", function(){
        let row = $(this).closest('.maindatarow');
        let times = parseFloat(row.find('.timesCalculate').val()) || 0;
        let amount = parseFloat(row.find('.netTotalCalculate').val()) || 0;
        let total = times * amount;
        row.find('.grossTotalCalculate').val(total);
        updateTotals();

         });
         function updateTotals() {
                let netTotal = 0;
                let grossTotal = 0;

                $(".netTotalCalculate").each(function() {
                    netTotal += parseFloat($(this).val()) || 0;
                });

                $(".grossTotalCalculate").each(function() {
                    grossTotal += parseFloat($(this).val()) || 0;
                });

                $("#netAmount").val(netTotal);
                $("#grossAmount").val(grossTotal);
            }

    </script>
@endsection

@extends('index')
@section('content')

    <div class="container d-flex">
        <form id="storeFeeStructure">
            @csrf
            <div class="row col-12">
                <div class="form-group col-2">
                    <label for="">Batch</label>
                    <select class="form-control" name="batch_name" id="test1">
                        <option value="">Select ..</option>
                        @foreach ($batches   as $year)
                                <option class="id_batch" value="{{ $year->id }}" {{ request()->get('batch_name') == $year->id ? 'selected' : '' }}>
                                    {{ $year->batch_name }}
                            </option>
                        @endforeach
                    </select>

                </div>
                <div class="form-group col-4">
                    <label for="">Program</label>
                    <select class="form-control program_id" name="program_name" id="program_id" {{ request()->get('program_name') ? 'selected' : '' }} >
                    </select>
                </div>
                <div class="form-group col-4">
                    <label for="">Year/Semester</label>
                    <select class="form-control" name="currentbatch_id" id="semester_id">
                    </select>
                </div>
            </div>


            <div class="container">
                <button type="button" class="btn btn-primary addMore mb-3" id="addMoreData">Add More</button>
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
                    <tbody id="fetchFormData">
                        <tr class="maindatarow">
                            <div class="row">
                                <td>
                                    <div class="form-group mr-3">
                                        <select class="form-control" name="inputs[0][particular_name]" id="">
                                            <option value="">Select..</option>
                                            @foreach ($particular as $part)
                                                <option value="{{ $part->id }}">{{ $part->particular_name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger error-particulars"></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mr-3">
                                        <input type="number" name="inputs[0][times]" id=""
                                            class="form-control timesCalculate" placeholder="times">
                                        <span class="text-danger error-times"></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" name="inputs[0][amounts]" id=""
                                            class="form-control netTotalCalculate" placeholder="amount">
                                        <span class="text-danger error-amounts"></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" name="inputs[0][total_amounts]" id=""
                                            class="form-control grossTotalCalculate" placeholder="total amount" readonly>
                                        <span class="text-danger error-totalamounts"></span>
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
                            <td><b>Net Amount : <input type="number" id="netAmount" name="netAmount" class="form-control"
                                        readonly /></b></td>
                            <td><b>Gross Amount:<input type="number" id="grossAmount" name="grossAmount"
                                        class="form-control" readonly /> </b></td>
                        </tr>
                    </tfoot>
                </table>
                <div class="container">
                    <button class="btn btn-success col float-end" id="btnSaveFee" type="submit">Save</button>
                </div>

            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
    let x = 1;
    let limit = 8;
    $("#addMoreData").click(function() {
        let count1 = $(".maindatarow").length;
        let i = 1;
        if (count1 < limit) {
            $("#fetchFormData").append(
                `
        <tr class="maindatarow"><div class="row"><td><div class="form-group mr-3"><select class="form-control" name="inputs[` +
                i + `][particular_name]">
        <option value="">Select..</option>
        @foreach ($particular as $part)
        <option value="{{ $part->id }}">{{ $part->particular_name }}</option>@endforeach
        </select></div></td><td><div class="form-group mr-3">
        <input type="number" name="inputs[` + i + `][times]" id="" class="form-control timesCalculate" placeholder=""></div> </div> </td>
        <td>
            <div class="form-group"><input type="number" name="inputs[` + i + `][amounts]" id="" class="form-control netTotalCalculate" placeholder=""></div></div>
        </td>
        <td>
            <div class="form-group "><input type="number" name="inputs[` + i + `][total_amounts]" readonly id="" class="form-control grossTotalCalculate" placeholder=""></div>
        </td>
        <td>
            <button class="btn btn-danger ml-2 btnclose" type="button">Remove</button>
        </td>
        </tr>`);
            i++;
            $("#addMoreData").prop("disabled", false);
            $("#addMoreData").text("Add More");
        } else {
            alert('Total Max limit is '+limit);
            i--;
        }
    });
});

$(document).on("click", ".btnclose", function() {
    $(this).closest(".maindatarow").remove();
});

$(document).ready(function() {
    // Get the selected program name from the request
    var selectedProgram = "{{ request()->get('program_name') }}";

    $("#test1").on("change", function() {
        var id = $(this).val();
        console.log(id);
        $.ajax({
            url: "program/data/get/" + id,
            method: "get",
            success: function(data) {
                console.log(data);

                // Clear previous options
                let $selectProgram = $("#program_id");
                $selectProgram.empty();

                // Add default option
                $selectProgram.append(`<option value="">Select....</option>`);

                // Populate program options
                if (data.success && data.message.length > 0) {
                    data.message.forEach(element => {
                        if (element.program && element.program.program_name) {
                            let selected = selectedProgram == element.program.id ? 'selected' : '';
                            $selectProgram.append(`<option value="${element.program.id}" ${selected}>${element.program.program_name}</option>`);
                        }
                    });
                } else {
                    $selectProgram.append('<option value="">No data found</option>');
                    console.error("data not found");
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX error: " + status + " - " + error);
            }
        });
    });

    // Trigger change event to load the program options when the page loads
    $("#test1").trigger("change");
});

    // Batch wise Filter Report End
    $(document).ready(function(){
        $("#program_id").on("change",function(){
            let id=$(this).val();
            console.log(id);
            $.ajax({
                url:"semester/data/get/"+id,
                method:"get",
                success:function(data){
                    console.log(data);
                    let $selectSemester = $("#semester_id");
                    $selectSemester.append(`<option value="N/A">Select....</option>`);
                    if(data.success && data.message.length > 0){
                        data.message.forEach(element => {
                            if(element.program && element.semester!=null && element.year!=null){
                                $selectSemester.empty();
                                $selectSemester.append(`<option selected value="${element.id}">${element.semester}</option>`);
                            }else{
                                $selectSemester.empty();
                                $selectSemester.append(`<option selected value="${element.id}">${element.year}</option>`);
                            }
                        });
                    }
                }
            })
        })
    })

$(document).on("input", ".timesCalculate, .netTotalCalculate", function() {
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

$(document).ready(function() {
    $("#storeFeeStructure").submit(function(event) {
        event.preventDefault();
        $("#btnSaveFee").text("Saving...");
        $("#btnSaveFee").prop("disabled", true);

        let formdata = new FormData(this);

        $.ajax({
            method: "POST",
            url: "/billing/fee_structure/store",
            data: formdata,
            contentType: false,
            processData: false,
            success: function(data) {
                $("#btnSaveFee").prop("disabled", false);
                $("#btnSaveFee").text("Save");

                if (data.success === true) {
                    Swal.fire({
                        icon: "success",
                        title: "Fee Structure has been Created",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $("input[type='number']").val("");
                    window.location.href = "/billing/fee_structure";
                } else {
                        Swal.fire({
                        icon: "error",
                        title: "Validation errors",
                        text:"Fill up all the fields",
                        confirmButtonText: "OK"
                    });
                    $("#btnSaveFee").prop("disabled", false);
                    $("#btnSaveFee").text("Save");
                }
            },
        });
    });
});

    </script>
@endsection

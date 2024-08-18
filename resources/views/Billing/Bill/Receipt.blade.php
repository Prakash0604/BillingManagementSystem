@extends('index')
@section('content')
    <div class="card text-left">
        <img class="card-img-top" src="holder.js/100px180/" alt="">
        <div class="card-body">
            <h4 class="card-title">Billing Receipt/Cash Basic</h4>
            <form id="storeFeeStructure">
                @csrf
                <div class="row">
                    <div class="form-group col-3">
                        <label for="">Batch</label>
                        <select class="form-control" name="batch_name" id="filter_batch">
                            <option value="">Select ..</option>
                            @foreach ($batches as $year)
                                <option class="id_batch" value="{{ $year->id }}"
                                    {{ request()->get('batch_name') == $year->id ? 'selected' : '' }}>
                                    {{ $year->batch_name }}
                                </option>
                            @endforeach
                        </select>

                    </div>
                    <div class="form-group col-3">
                        <label for="">Program</label>
                        <select class="form-control program_id" name="program_name" id="program_id"
                            {{ request()->get('program_name') ? 'selected' : '' }}>
                        </select>
                    </div>
                    <div class="form-group col-3">
                        <label for="">Year/Semester</label>
                        <select class="form-control" name="currentbatch_id" id="semester_id">
                        </select>
                    </div>
                    <div class="form-group col-3">
                        <label for="">Students</label>
                        <select class="form-control" name="currentbatch_id" id="students_list">
                        </select>
                    </div>
                </div>
                {{-- <div class="container">
                <button type="button" class="btn btn-primary addMore mb-3" id="addMoreData">Add More</button>
            </div> --}}
            </form>
        </div>
    </div>

   <script>
    $(document).ready(function() {
    // Get the selected program name from the request
    var selectedProgram = "{{ request()->get('program_name') }}";

    // Function to handle the batch filter change
    function handleBatchChange() {
        var id = $("#filter_batch").val();
        console.log(id);

        $.ajax({
            url: "/billing/fee/program/data/" + id,
            method: "GET",
            success: function(data) {
                console.log(data);

                let $selectProgram = $("#program_id");
                $selectProgram.empty(); // Clear existing options

                // Add 'Select...' option before appending dynamic data
                $selectProgram.append('<option value="">Select....</option>');

                if (data.success && Array.isArray(data.message) && data.message.length > 0) {
                    data.message.forEach(element => {
                        if (element.program && element.program.program_name) {
                            $selectProgram.append( `<option value="${element.id}" ${selected}>${element.program.program_name}</option>`
                            );
                        }
                    });
                } else {
                    $selectProgram.append('<option value="">No data found</option>');
                    console.error("Data not found");
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX error: " + status + " - " + error);
            }
        });
    }

    // Function to handle the program filter change
    function handleProgramChange() {
        let id = $("#program_id").val();
        console.log(id);

        $.ajax({
            url: "/billing/fee/semester/data/" + id,
            method: "GET",
            success: function(data) {
                console.log(data);
                let $selectSemester = $("#semester_id");
                $selectSemester.empty(); // Clear existing options

                // Add 'Select...' option first
                $selectSemester.append('<option selected value="">Select....</option>');

                if (data.success && Array.isArray(data.message) && data.message.length > 0) {
                    data.message.forEach(element => {
                        if (element.semester != null) {
                            $selectSemester.append(`<option value="${element.id}">${element.semester}</option>`);
                        } else if (element.year != null) {
                            $selectSemester.append(`<option value="${element.id}">${element.year}</option>`);
                        }
                    });
                } else {
                    $selectSemester.append('<option value="N/A">No data found</option>');
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX error: " + status + " - " + error);
            }
        });
    }

    // Function to handle the semester filter change
    function handleSemesterChange() {
        let id = $("#semester_id").val();
        console.log(id);

        $.ajax({
            url: "/billing/fee/students/data/" + id,
            method: "GET",
            success: function(data) {
                console.log(data);
                if(data.success && data.message.length > 0){
                    data.message.forEach(element => {
                        if(element.semester!=null){
                            $.ajax({
                                url:"/billing/fee/type/"+element.semester,
                                method:"get",
                                success:function(semester_stu){
                                    console.log(semester_stu);
                                }
                            })
                        }else if(element.year!=null){
                            $ajax({
                                url:"/billing/fee/type/"+element.year,
                                method:"get",
                                success:function(year_stu){
                                    console.log(year_stu);
                                }
                            })
                        }
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX error: " + status + " - " + error);
            }
        });
    }

    // Attach event handlers
    $("#filter_batch").on("change", handleBatchChange);
    $("#program_id").on("change", handleProgramChange);
    $("#semester_id").on("change", handleSemesterChange);

    // Trigger the change events to initialize data on page load
    handleBatchChange();
});

   </script>
@endsection

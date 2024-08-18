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

            $("#filter_batch").on("change", function() {
                var id = $(this).val();
                console.log(id);
                $.ajax({
                    url: "/billing/fee/program/data/" + id,
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
                                    let selected = selectedProgram == element.program
                                        .id ? 'selected' : '';
                                    $selectProgram.append(
                                        `<option value="${element.id}" ${selected}>${element.program.program_name}</option>`
                                    );
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
            $("#filter_batch").trigger("change");
            $("#program_id").trigger("change");
            $("#semester_id").trigger("change");

            $(document).ready(function() {
                $("#program_id").on("change", function() {
                    let id = $(this).val();
                    console.log(id);
                    $.ajax({
                        url: "/billing/fee/semester/data/" + id,
                        method: "get",
                        success: function(data) {
                            console.log(data);
                            let $selectSemester = $("#semester_id");
                            // Add default option
                            $selectSemester.append(`<option value="">Select....</option>`);
                            if (data.success && data.message.length > 0) {
                                data.message.forEach(element => {
                                    if (element.message && element.semester!= null || element.year!=null) {
                                        $selectSemester.empty();
                                        $selectSemester.append(`<option  value="">Select....</option><option class="semester"   value="${element.id}">${element.semester}</option>`);
                                    } else {
                                        $selectSemester.empty();
                                        $selectSemester.append(
                                            `<option  value="">Select....</option><option class="year" value="${element.id}">${element.year}</option>`
                                        );
                                    }
                                });
                            }
                        }
                    })
                })
            })
        });

        $(document).ready(function() {
            $("#semester_id").on("change", function() {
                let id = $(this).val();
                console.log(id);
                $.ajax({
                    url: "/billing/fee/students/data/" + id,
                    method: "get",
                    success: function(data) {
                        console.log(data);

                        // Clear previous options

                    }
                });
            })
        })
    </script>
@endsection

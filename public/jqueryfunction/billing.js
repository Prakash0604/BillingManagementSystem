$(document).ready(function(){
    $("#addParticular").submit(function(event){
        event.preventDefault();
        $("#btnparticular").text("Loading...");
        $("#btnparticular").prop("disabled",true);
        let formdata=new FormData(this);
        let url=$("#app").data("particular-route");
        console.log(url);
        $.ajax({
            url:url,
            method:"POST",
            data:formdata,
            processData:false,
            contentType:false,
            success:function(data){
                console.log(data);
                if(data.success==true){
                    Swal.fire({
                        icon:"success",
                        title:"Particular has been added",
                        showConfirmButton:false,
                        timer:1500
                    });
                    $("#btnparticular").prop("disabled",false);
                    $("#btnparticular").text("Add Particular");
                    $("input[type='text']").val("");
                    $("textarea").val("");
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                }
                if(data.success==false){
                    Swal.fire({
                        icon:"warning",
                        title:data.message,
                        showConfirmButton:false,
                        timer:1500
                    });
                    $("#btnparticular").text("Add Particular");
                    $("#btnparticular").prop("disabled",false);
                }
            }
        });
    });

    $("#editButton").click(function(){
        let id=$(this).attr("data-id");
        console.log(id);
        $.ajax({
            url:"/billing/particular/data/"+id,
            method:"GET",
            success:function(data){
                console.log(data);
                $("#editParticularName").val(data.message.particular_name);
                $("#editDescription").val(data.message.description);
                $("#status").val(data.message.status);
                $("#particular_id").val(data.message.id);
            }
        });
    });

    $("#updateParticular").submit(function(event){
        event.preventDefault();
        $("#btneditParticular").prop("disabled",true);
        $("#btneditParticular").text("updating...");
        let formdata=new FormData(this);
        $.ajax({
            method:"POST",
            url:"/billing/particular/update",
            data:formdata,
            processData:false,
            contentType:false,
            success:function(data){
                console.log(data);
                if(data.success==true){
                    Swal.fire({
                        icon:"success",
                        title:"Particular has been added successfully",
                        showConfirmButton:false,
                        timer:1500,
                    });
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                }
                if(data.success==false){
                    Swal.fire({
                        icon:"info",
                        title:"Something went wrong please try again",
                        showConfirmButton:false,
                        timer:1500
                    });
                    $("#btneditParticular").text("Update Particular");
                    $("#btneditParticular").prop("disabled",false);
                }
            }
        });
    });

    $("#deleteButton").on("click",function(){
        var id=$(this).attr('data-id');
        console.log(id);
        $("#deleteParticular").submit(function(event){
            event.preventDefault();
            $("#btndeleteParticular").text('Deleting...');
            $("#btndeleteParticular").prop("disabled",true);
            $.ajax({
                method:"GET",
                url:"particular/delete/"+id,
                success:function(data){
                    console.log(data);
                    if(data.success==true){
                        Swal.fire({
                            icon:"success",
                            title:"Fee particular has been deleted successfully",
                            showConfirmButton:false,
                            timer:1500
                        });
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    }
                    if(data.success==false){
                        Swal.fire({
                            icon:"warning",
                            title:"Something went wrong",
                            showConfirmButton:false,
                            timer:1500,
                        });
                        $("#btndeleteParticular").text("Confirm Delete");
                        $("#btndeleteParticular").prop("disabled",false);
                    }
                }

            })
        });
    });


    // Batch wise Filter Report Start
    $(document).ready(function() {
        $("#test1").on("change", function() {
            var id = $(this).val();
            console.log(id);
            $.ajax({
                url: "batch/data/" + id,
                method: "get",
                success: function(data) {
                    console.log(data);

                    // Clear previous options
                    let $selectProgram = $("#program_id");

                    $selectProgram.empty();

                    // Add default option
                    $selectProgram.append(`<option value="N/A">Select....</option>`);

                    // Populate program options
                    if (data.success && data.message.length > 0) {
                        data.message.forEach(element => {
                            if (element.program && element.program.program_name) {
                                $selectProgram.append(`<option value="${element.program.id}">${element.program.program_name}</option>`);
                            }
                        });
                    }
                  else {
                        $selectProgram.append('<option value="">No data found</option>');
                        console.error("data not found");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX error: " + status + " - " + error);
                }
            });
        });
    });
        // Batch wise Filter Report End
        $(document).ready(function(){
            $("#program_id").on("change",function(){
                let id=$(this).val();
                console.log(id);
                $.ajax({
                    url:"semester/data/"+id,
                    method:"get",
                    success:function(data){
                        console.log(data);
                        let $selectSemester = $("#semester_id");
                        $selectSemester.append(`<option value="N/A">Select....</option>`);
                        if(data.success && data.data.length > 0){
                            data.data.forEach(element => {
                                if(element.program && element.semester!=null){
                                    $selectSemester.empty();
                                    $selectSemester.append(`<option value="${element.id}">${element.semester}</option>`);
                                }else{
                                    $selectSemester.empty();
                                    $selectSemester.append(`<option value="${element.id}">${element.year}</option>`);
                                }
                            });
                        }
                    }
                })
            })
        })

        // Fetch Student Data Start
        $(document).ready(function(){

            $("#fetchStudentdata").submit(function(event){
                event.preventDefault();
                $("#btnloading").text("Filtering...");
                $("#btnloading").prop("disabled",true);
                $.ajax({
                    url:"batchwise/report/get",
                    method:"get",
                    success:function(data){
                        if(data.success==true){
                        }

                    }
                })
            })
        })
        // Fetch Student Data End
});

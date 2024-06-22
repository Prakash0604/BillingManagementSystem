$(document).ready(function () {

    // Batch Add Function
    $("#Batch_add").submit(function (event) {
        event.preventDefault();
        $("#btnbatch").text("Saving...");
        $("#btnbatch").prop("disabled", true);
        let formdata = new FormData(this);
        console.log(formdata);
        $.ajax({
            method: "POST",
            url: "/add/batch",
            data: formdata,
            processData: false,
            contentType: false,
            success: function (output) {
                if (output.success == true) {
                    Swal.fire({
                        icon: "success",
                        title: "Batch has been added Successfully",
                        showConfirmButton: false,
                        timer: 2000,
                    });
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                    $("input[type='date']").val("");
                    $("input[type='text']").val("");
                }
                if (output.success == false) {
                    console.log(output);
                    Swal.fire({
                        icon: "error",
                        title: "Something went wrong!!",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    $("#btnbatch").text("Add Batch");
                    $("#btnbactch").prop("disabled", false);
                }
            }
        });
    });
    // Batch Add Function

    // Batch Edit Function
    $(".editBatch").on("click", function () {
        let id = $(this).attr('data-id');
        console.log(id);
        $.ajax({
            url: '/setup/edit/batch/' + id,
            method: "get",
            processData: false,
            contentType: false,
            success: function (message) {
                if(message.success==true){
                    console.log(message);
                    $("#edit_batch_name").val(message.message.batch_name);
                    $("#edit_stating_date").val(message.message.starting_date);
                    $("#edit_ending_date").val(message.message.ending_date);
                    $("#status").val(message.message.status);
                    $("#id").val(message.message.id);
                }
            }
        });
    });
    // Batch Edit Function

    $("#updateBatch").submit(function(event){
        event.preventDefault();
        let formdata=new FormData(this);
        $("#btnupdate").prop("disabled",true);
        $("#btnupdate").text("Updating...");
        $.ajax({
            url:"/setup/update/batch",
            method:"POST",
            data:formdata,
            processData:false,
            contentType:false,
            success:function(data){
                console.log(data)
                if(data.success==true){
                    Swal.fire({
                        icon:"success",
                        title:"Batch Update Successfully",
                        showConfirmButton:false,
                        timer:2000,
                    });
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                }
                 if(data.success==false){
                    Swal.fire({
                        icon:"error",
                        title:"Something went wrong !!",
                        showConfirmButton:false,
                        timer:2000,
                    });
                    $("#btnupdate").text("Edit Batch");
                    $("#btnupdate").prop("disabled",false);
                }
            }
        })
    });
    // Batch Edit Function
});



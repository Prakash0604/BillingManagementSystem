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
                if (message.success == true) {
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

    // Batch Update Function
    $("#updateBatch").submit(function (event) {
        event.preventDefault();
        let formdata = new FormData(this);
        $("#btnupdate").prop("disabled", true);
        $("#btnupdate").text("Updating...");
        $.ajax({
            url: "/setup/update/batch",
            method: "POST",
            data: formdata,
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data)
                if (data.success == true) {
                    Swal.fire({
                        icon: "success",
                        title: "Batch Update Successfully",
                        showConfirmButton: false,
                        timer: 2000,
                    });
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                }
                if (data.success == false) {
                    Swal.fire({
                        icon: "error",
                        title: "Something went wrong !!",
                        showConfirmButton: false,
                        timer: 2000,
                    });
                    $("#btnupdate").text("Edit Batch");
                    $("#btnupdate").prop("disabled", false);
                }
            }
        })
    });
    // Batch Update Function

    // Batch Delete Function Start
    $(document).on("click", ".deleteBatch", function () {
        let id = $(this).attr("data-id");
        $("#delete_Batch").submit(function (event) {
            event.preventDefault();
            $("#btnDelete").text("Deleting...");
            $("#btnDelete").prop("disabled", true);
            $.ajax({
                url: "setup/batch/delete/" + id,
                method: "get",
                success: function (data) {
                    console.log(data);
                    if (data.success == true) {
                        Swal.fire({
                            icon: "success",
                            title: "Batch Delete successfully",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    }
                    if (data.success == false) {
                        Swal.fire({
                            icon: "error",
                            title: "Something went wrong",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $("#btnDelete").text("Confirm Delete");
                        $("#btnDelete").prop("disabled", false);
                    }
                }
            });
        });
    });
    // Batch Delete Function End







    // Program Function Start

    // Program Add Function
    $("#Program_add").submit(function (event) {
        event.preventDefault();
        $("#btnprogram").text("Saving...");
        $("#btnprogram").prop("disabled", true);
        let formdata = new FormData(this);
        console.log(formdata);
        $.ajax({
            method: "POST",
            url: "/add/program",
            data: formdata,
            processData: false,
            contentType: false,
            success: function (output) {
                if (output.success == true) {
                    Swal.fire({
                        icon: "success",
                        title: "Program has been added Successfully",
                        showConfirmButton: false,
                        timer: 2000,
                    });
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
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
                    $("#btnbatch").text("Add Program");
                    $("#btnbactch").prop("disabled", false);
                }
            }
        });
    });
    // Program Add Function

    // Batch Edit Function
    $(".editProgram").on("click", function () {
        let id = $(this).attr('data-id');
        console.log(id);
        $.ajax({
            url: '/setup/edit/program/' + id,
            method: "get",
            processData: false,
            contentType: false,
            success: function (message) {
                if (message.success == true) {
                    console.log(message);
                    $("#edit_program_name").val(message.message.program_name);
                    $("#edit_faculty").val(message.message.faculty);
                    $("#edit_univeristy").val(message.message.univeristy);
                    $("#edit_status").val(message.message.status);
                    $("#edit_type").val(message.message.type_id);
                    $("#program_id").val(message.message.id);
                }
            }
        });
    });
    // Batch Edit Function

    // Batch Update Function
    $("#updateProgram").submit(function (event) {
        event.preventDefault();
        let formdata = new FormData(this);
        $("#btnprogramupdate").prop("disabled", true);
        $("#btnprogramupdate").text("Updating...");
        $.ajax({
            url: "/setup/update/program",
            method: "POST",
            data: formdata,
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data)
                if (data.success == true) {
                    Swal.fire({
                        icon: "success",
                        title: "Program Update Successfully",
                        showConfirmButton: false,
                        timer: 2000,
                    });
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                }
                if (data.success == false) {
                    Swal.fire({
                        icon: "error",
                        title: "Something went wrong !!",
                        showConfirmButton: false,
                        timer: 2000,
                    });
                    $("#btnprogramupdate").text("Edit Batch");
                    $("#btnprogramupdate").prop("disabled", false);
                }
            }
        })
    });
    // Batch Update Function

    // Batch Delete Function Start
    $(document).on("click", ".deleteProgram", function () {
        let id = $(this).attr("data-id");
        $("#delete_program").submit(function (event) {
            event.preventDefault();
            $("#btnProgramDelete").text("Deleting...");
            $("#btnProgramDelete").prop("disabled", true);
            $.ajax({
                url: "setup/program/delete/" + id,
                method: "get",
                success: function (data) {
                    console.log(data);
                    if (data.success == true) {
                        Swal.fire({
                            icon: "success",
                            title: "Program Delete successfully",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    }
                    if (data.success == false) {
                        Swal.fire({
                            icon: "error",
                            title: "Something went wrong",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $("#btnProgramDelete").text("Confirm Delete");
                        $("#btnProgramDelete").prop("disabled", false);
                    }
                }
            });
        });
    });
    // Batch Delete Function End

    // Program Function End

    // Hide Function
    $(document).on("click", ".hide", function () {
        $("#semesterhide").hide();

        $("#yearhide").hide();
    });
    $(document).on("click", '.pid', function () {
        let id = $(this).attr("value");
        console.log(id);
        $.ajax({
            method: "get",
            url: "setup/program/select/filter/" + id,
            success: function (data) {
                console.log(data.message);
                if (data.message.type_id == 2) {
                    $("#yearhide").show();
                    $("#semesterhide").hide();

                } else {
                    $("#yearhide").hide();
                    $("#semesterhide").show();
                }

            }
        })
    });
    // Hide Function End

    $("#courseProgram_add").submit(function (event) {
        event.preventDefault();
        let formdata = new FormData(this);
        console.log(formdata);
        $("#btncurrentprogram").text("Saving...");
        $("#btncurrentprogram").prop("disabled", true);
        $.ajax({
            method: "POST",
            url: "setup/current/runing/semester",
            data: formdata,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.success == true) {
                    Swal.fire({
                        icon: "success",
                        title: "Semester has been added",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                    $("#batch_name_id").val("");
                    $("#semester_id").val("");
                    $("#year_id").val("");
                    $("#program_name_id").val("");
                    $("#btncurrentprogram").text("Add Semester");
                    $("#btncurrentprogram").prop("disabled", false);
                }
                if (data.success == false) {
                    console.log(data.message);
                    Swal.fire({
                        icon: "error",
                        title: "Something went wrong",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $("#btncurrentprogram").text("Add Semester");
                    $("#btncurrentprogram").prop("disabled", false);

                }
            }
        })
    })


    // $(".hidesemester").hide();
    // $(".hideyear").hide();
    // $(".viewsemester").on("click",function(){
    //     $(".hidesemester").toggle(2000);
    // })
    //  $(".viewyear").on("click",function(){
    //     $(".hideyear").toggle(2000);
    // });


    $(document).on("click",'.editsemester', function () {
        $("#editsemesterhide").hide();
        $("#edityearhide").hide();
        let data = $(this).attr("data-id");
        console.log(data);
        $.ajax({
            url: "setup/current/running/edit/" + data,
            method: "get",
            success: function (msg) {
                console.log(msg);
                if (msg.success == 101) {
                    $("#editsemesterhide").show();
                    $("#edit_batch_name").val(msg.semester.batch_id);
                    $("#edit_program_name").val(msg.semester.program_id);
                    $("#edit_semester_name").val(msg.semester.semester);
                }
                if (msg.success == 102) {
                    $("#edityearhide").show();
                }
            }
        });
    });




});



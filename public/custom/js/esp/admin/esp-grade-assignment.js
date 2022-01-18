$(document).ready(function(){

    $('[data-score]').submit(function (event) {

        // get route
        let route = $(this).data('route');
        let assignmentId = $(this).attr('id');

        // prevent default form submission
        event.preventDefault();

        // get all form data and create an instance
        let formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: route,
            data: formData,
            contentType : false,
            processData : false,
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            beforeSend: function () {
                console.log(formData);

                // Show image container
                $("#update_score"+assignmentId).html("<span class='fa fa-refresh fa-spin fa-4x text-success'></span>");
            },
            success: function (Response) {
                console.log(Response);

                let status = '<p class="bg-success p-1 text-white text-center">Score updated</p>';

                let updateScore = '<input class="form-control" type="number" name="score" value="'+Response.score+'"' +
                    '                                       placeholder="Score assignment">' +
                    '                                <button type="submit" class="btn btn-info btn-sm mt-2">Update Score</button>';

                $("#update_score"+assignmentId).html(updateScore);
                $("#update_score"+assignmentId).append(status);
            }
        });
    });

    $('[data-mark-status]').submit(function (event) {
        // get route
        let route = $(this).data('route');
        let formId = $(this).attr('id');

        // prevent default form submission
        event.preventDefault();

        // get all form data and create an instance
        let formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: route,
            data: formData,
            contentType : false,
            processData : false,
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            beforeSend: function () {
                console.log(formData);

                // Show image container
                $("#mark-status-field").html("<span class='fa fa-refresh fa-spin fa-3x text-success'></span>");
            },
            success: function (Response) {
                console.log(Response);

                let status = '<p class="bg-success p-1 text-white text-center width-200">Status updated</p>';

                let updateStatus = '<label>Marking Status</label>' +
                '                   <select name="status" class="form-control width-200">' +
                '                      <option selected value="'+Response.status+'">'+Response.status+'</option>' +
                '                      <option value="Archived">Archived</option>' +
                '                      <option value="Marked">Marked</option>' +
                '                      <option value="Pending">Pending</option>' +
                '                   </select>' +
                '                   <button class="btn btn-success btn-sm mt-2" type="submit">' +
                '                         Update Status</button>';

                $("#mark-status-field").html(updateStatus);
                $("#mark-status-field").append(status);
            }
        });
    });

});

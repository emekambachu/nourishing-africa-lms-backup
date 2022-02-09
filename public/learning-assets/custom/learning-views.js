$(function(){
    $(document).ready(function(){

        // Use the timerAlert ID to get completed-course status
        // If the course has been completed ignore pop-up
        if($("#timerAlert").data("completed-course") === 'incomplete'){
            // wait 1 second before showing session warning popup
            setTimeout(function(){
                $("#timerAlert").modal('show');
            }, 1000);
        }

        // on clicking yes, start timer
        $('.startCourse').click(function(){

            // get route and minute from modal button in course view page
            let route = $(this).data('route');
            let minute = $(this).data('study-timer');
            let nextCourseRoute = $("#timerAlert").data('next-route');
            let assessmentRoute = $("#timerAlert").data('assessment-route');
            let nextCourse = $("#timerAlert").data("next-course");

            function startTimer(duration, display){
                let timer = duration, minutes, seconds;
                let courseInterval = setInterval(function () {
                    minutes = parseInt(timer / 60, 10);
                    seconds = parseInt(timer % 60, 10);

                    minutes = minutes < 10 ? "0" + minutes : minutes;
                    seconds = seconds < 10 ? "0" + seconds : seconds;

                    display.textContent = minutes + ":" + seconds;

                    // When time is up, initiate course completion and clear interval
                    if(--timer < 0){
                        // initiate course completion
                        recordCourseCompletion(route);
                        // clear time interval
                        clearInterval(courseInterval);
                        // if there is a next course, add next course button else add assessment button
                        if(nextCourse === 'has-next'){
                            console.log("has next");
                            $(".module-btn").addClass("bg-light-brown").removeClass("bg-gray");
                            $(".next-course-link").prop("disabled", false).attr('href', nextCourseRoute);
                        }else{
                            console.log("no next");
                            $(".module-btn").addClass("bg-light-brown").removeClass("bg-gray");
                            $(".next-course-link").prop("disabled", false).attr('href', assessmentRoute);
                        }
                        $('#courseCountdown').html("Course session has been recorded, you can start the next course");
                    }
                }, 1000);
            }

            // Convert minutes to seconds
            const duration = 60 * minute,
                display = document.querySelector('#courseCountdown');
                $("#courseCountdown").addClass('bg-light-green');
            startTimer(duration, display);

            function recordCourseCompletion(route){
                $.ajax({
                    type: 'POST',
                    url: route,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    cache: false,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },

                    beforeSend: function (){
                        console.log('working');
                    },

                    success:function (response){
                        console.log('worked');
                        $('#courseCountdown').html("Course session has been recorded, you can start the next course");
                    },

                    error: function (response){
                        console.log(response.responseText);
                    }
                });
            }

        });

    });

    // let timeleft = 10;
    // const downloadTimer = setInterval(function () {
    //     if (timeleft <= 0) {
    //         clearInterval(downloadTimer);
    //     }
    //     document.getElementById("progressBar").value = 10 - timeleft;
    //     timeleft -= 1;
    // }, 1000);

});

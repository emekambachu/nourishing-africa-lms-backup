$(function(){

    // on page load, wait 1 second before triggering pop-up
    $(document).ready(function(){
        setTimeout(function(){
            $("#timerAlert").modal('show');
        }, 1000);

        $('.startCourse').click(function() {

            let userId = $(this).data('user-id');
            let moduleId = $(this).data('module-id');
            let courseId = $(this).data('course-id');

            let minute = 10;
            let sec = 60;
            setInterval(function () {
                $("#courseCountdown").removeClass('d-none');
                document.getElementById("courseCountdown").innerHTML = minute + " : " + sec;
                sec--;
                if (sec === 0o0) {
                    minute--;
                    sec = 60;
                    if (minute === 0) {
                        recordCourseCompletion(userId, moduleId, courseId);
                    }
                }
            }, 1000);

            function recordCourseCompletion(){

            }

        });

    });

    let timeleft = 10;
    const downloadTimer = setInterval(function () {
        if (timeleft <= 0) {
            clearInterval(downloadTimer);
        }
        document.getElementById("progressBar").value = 10 - timeleft;
        timeleft -= 1;
    }, 1000);

});

$(function(){
    $(document).ready(function(){

        // localStorage.removeItem('intro-shown');
        let introShown = localStorage.getItem('intro-shown')
        if (!introShown) {
            setTimeout(function(){
                $("#intro-dialogue").modal('show');
            }, 1000);
            // on click intro close forever, store in local storage to show once
            // also remove the video iframe
            $('#intro-close-forever').click(function(){
                localStorage.setItem('intro-shown', 1);
                $('#intro-iframe').remove();
            });
            // on clicked intro close once, only remove video iframe
            $('#intro-close-once').click(function(){
                $('#intro-iframe').remove();
            });
        }

    });

});

var audio = ""; // audio object
var thumbnail = ""; // album cover // element where progress bar appears
var pPause = ""; // element where play and pause image appears
var playing = false;
var progressBar = "";

function init(id){
    this.audio = document.querySelector('#song'+id); // audio object
    this.thumbnail = document.querySelector('#thumbnail'+id); //f album cover  // element where progress bar appears
    this.pPause = document.querySelector('#play-pause'+id); // element where play and pause image appears
    
    if(this.progressBar == "" || this.progressBar == null){
        this.progressBar = document.querySelectorAll('.progress-bar')[id];
    }
}

function playPause(id) {
    let status = $("#audiostatus"+id).val();
    init(id);
    if (status == 'stop') {
        this.audio.playbackRate = 1;
        this.pPause.src = "../images/pause.png"; 
        this.thumbnail.style.transform = "scale(1.10)";
        this.audio.play(); 
        $("#audiostatus"+id).val("play");
    } else {
        this.pPause.src = "../images/play.png";
        this.thumbnail.style.transform = "scale(1)";
        this.audio.pause();
        $("#audiostatus"+id).val("stop");
    }
}

function playPauseCue(id) {
    this.pPause.src = "../images/play.png"; 
    this.thumbnail.style.transform = "scale(1)";
    this.thumbnail.style.transform = "scale(1.10)";
    $("#audiostatus"+id).val("stop");
    this.audio.play(); 
    //$("#audiostatus"+id).val("play");
}

function audioBack(id){
    init(id);
    this.audio.currentTime = this.audio.currentTime - 6;
    this.progressBar.value = this.audio.currentTime;
}

function audioForward(id){
    init(id);
    playPauseCue(id);
    this.audio.playbackRate = this.audio.playbackRate + 6;
    this.progressBar.value = this.audio.currentTime;
}

// update progressBar.max to song object's duration, same for progressBar.value, update currentTime/duration DOM
function updateProgressValue() {
    /*if (audio.readyState > 0) {
        displayDuration();
        setSliderMax();
        displayBufferedAmount();
    } else {
        audio.addEventListener('loadedmetadata', () => {
            displayDuration();
            setSliderMax();
            displayBufferedAmount();
        });
    }*/
    let progressBar = document.querySelectorAll('.progress-bar'); 
    if(progressBar.length > 1){
        for(var i = 0; i < progressBar.length; i++){
            let id = progressBar[i].id;
            progressBar[i].max = document.querySelector('#song'+id).duration;
            progressBar[i].value = document.querySelector('#song'+id).currentTime;
            document.querySelector('.currentTime'+id).innerHTML = (formatTime(Math.floor(document.querySelector('#song'+id).currentTime)));
            if (document.querySelector('.durationTime'+id).innerHTML === "NaN:NaN") {
                document.querySelector('.durationTime'+id).innerHTML = "0:00";
            } else {
                document.querySelector('.durationTime'+id).innerHTML = (formatTime(Math.floor(document.querySelector('#song'+id).duration)));
            }
        }
    }else{
        let id = "";
        if(this.progressBar.id == null || this.progressBar.id == ""){
            id = progressBar[0].id;
            init(id);
        }
        id = this.progressBar.id;
        this.progressBar.max = this.audio.duration;
        this.progressBar.value = this.audio.currentTime;
        document.querySelector('.currentTime'+id).innerHTML = (formatTime(Math.floor(this.audio.currentTime)));
        if (document.querySelector('.durationTime'+id).innerHTML === "NaN:NaN") {
            document.querySelector('.durationTime'+id).innerHTML = "0:00";
        } else {
            document.querySelector('.durationTime'+id).innerHTML = (formatTime(Math.floor(this.audio.duration)));
        }
    }
}

// convert song.currentTime and song.duration into MM:SS format
function formatTime(seconds) {
    let min = Math.floor((seconds / 60));
    let sec = Math.floor(seconds - (min * 60));
    if (sec < 10){ 
        sec  = `0${sec}`;
    };
    return `${min}:${sec}`;
};

// run updateProgressValue function every 1/2 second to show change in progressBar and song.currentTime on the DOM
setInterval(updateProgressValue, 500);

// function where progressBar.value is changed when slider thumb is dragged without auto-playing audio
function changeProgressBar(element) {
    this.progressBar = element;
    let id = this.progressBar.id;
    init(id);
    this.audio.currentTime = this.progressBar.value;
};

function toggleSound(id) {
    init(id);
    this.audio.muted = !this.audio.muted;
    if(this.audio.muted){
        $("#togglesound"+id).removeClass("fa-volume-up");
        $("#togglesound"+id).addClass("fa-volume-mute");
        document.querySelector('#song'+id).volume = 0;
    }else{
        $("#togglesound"+id).addClass("fa-volume-up");
        $("#togglesound"+id).removeClass("fa-volume-mute");
        document.querySelector('#song'+id).volume = 1;
    }
}

function volumeSlider (e, id) {
    const value = e.value;
    document.querySelector('#volume-output'+id).textContent = value;
    document.querySelector('#song'+id).volume = value / 100;
    if(document.querySelector('#song'+id).volume == 0){
        this.audio.muted =  true;
        $("#togglesound"+id).removeClass("fa-volume-up");
        $("#togglesound"+id).addClass("fa-volume-mute");
    }else{
        this.audio.muted =  false;
        $("#togglesound"+id).addClass("fa-volume-up");
        $("#togglesound"+id).removeClass("fa-volume-mute");
    }
}


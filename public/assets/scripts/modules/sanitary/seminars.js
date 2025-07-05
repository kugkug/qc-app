let player;
let next_trigger;

$(document).ready(function () {
    onYouTubeIframeAPIReady();
});

function onYouTubeIframeAPIReady() {
    player = new YT.Player("iframe-player", {
        height: "390",
        width: "640",
        videoId: "cSNaBui2IM8",
        playerVars: {
            playsinline: 1,
        },
        events: {
            onReady: onPlayerReady,
            onStateChange: onPlayerStateChange,
        },
    });
}

function onPlayerReady(event) {
    document.getElementById("iframe-player").style.borderColor = "#FF6D00";
}

function onPlayerStateChange(event) {
    changeBorderColor(event.data);
}

function changeBorderColor(playerStatus) {
    var color;
    if (playerStatus == -1) {
        color = "#37474F"; // unstarted = gray
    } else if (playerStatus == 0) {
        seminarEnded();
        color = "#FFFF00"; // ended = yellow
    } else if (playerStatus == 1) {
        color = "#33691E"; // playing = green
    } else if (playerStatus == 2) {
        color = "#DD2C00"; // paused = red
    } else if (playerStatus == 3) {
        color = "#AA00FF"; // buffering = purple
    } else if (playerStatus == 5) {
        color = "#FF6DOO"; // video cued = orange
    }

    if (color) {
        document.getElementById("iframe-player").style.borderColor = color;
    }
}

function seminarEnded() {
    ajaxSubmit(
        "/executor/applicant/update-application/" + $("[type=hidden]").val(),
        "",
        $(this)
    );
}

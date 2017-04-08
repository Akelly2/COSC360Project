// this is obviously not jquery, these have a numeric id so I'm a bit lost
function showreplyform (id) {
    if (document.getElementById('r' + id).className === "replyformshown") {
        document.getElementById('r' + id).className = "replyformhidden";
    } else if (document.getElementById('r' + id).className === "replyformhidden") {
        document.getElementById('r' + id).className = "replyformshown";
    }
}

// I wanted to practice jquery
function showcommentform () {
    if ($('#addcomment').attr('class') === "replyformshown") {
        $('#addcomment').attr('class', 'replyformhidden');
    } else if ($('#addcomment').attr('class') === "replyformhidden") {
        $('#addcomment').attr('class', 'replyformshown');
    }
}

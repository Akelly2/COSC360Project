function showreplyform (id) {
    if (document.getElementById('r' + id).className === "replyformshown") {
        document.getElementById('r' + id).className = "replyformhidden";
    } else if (document.getElementById('r' + id).className === "replyformhidden") {
        document.getElementById('r' + id).className = "replyformshown";
    }
}

function showcommentform () {
    if (document.getElementById('parent').className === "replyformshown") {
        document.getElementById('parent').className = "replyformhidden";
    } else if (document.getElementById('parent').className === "replyformhidden") {
        document.getElementById('parent').className = "replyformshown";
    }
}

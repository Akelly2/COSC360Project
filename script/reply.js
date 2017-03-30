function showreplyform (id) {
    if (document.getElementById('r' + id).className === "replyformshown") {
        document.getElementById('r' + id).className = "replyformhidden";
    } else if (document.getElementById('r' + id).className === "replyformhidden") {
        document.getElementById('r' + id).className = "replyformshown";
    }
}

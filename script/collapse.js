
function collapsethread (id) {
    if ($('#' + id).attr('class') === "parent") {
        $('#' + id).slideUp();
        $('#' + id).attr('class', 'collapsed');
        $('#' + "collapsebutton" + id).html("&#9658;")
    } else if ($('#' + id).attr('class') === "collapsed") {
        $('#' + id).slideDown();
        $('#' + id).attr('class', 'parent');
        $('#' + "collapsebutton" + id).html("&#9660;")
    }
}

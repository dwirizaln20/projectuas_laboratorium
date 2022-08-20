/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

$(document).ready(function() {

    $('.internal').click(function() {
        $('#uploadFile').attr('disabled', '');
        $('.section_download').fadeOut();
    });

    $('.eksternal').click(function() {
        $('#uploadFile').removeAttr('disabled');
        $('.section_download').fadeIn();
    });

});


function submitDel(id) {
    $('#del-'+id).submit();
}

function submitDel() {
    $('#del-semua').submit();
}




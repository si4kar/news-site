$(function() {

    var arr = JSON.parse('<?php Tag::getTagsListForAutocomplite(); ?>');
    //autocomplete
    $("#searchHeader").autocomplete({
        source: "arr",
        minLength: 1
    });

});
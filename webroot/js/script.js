$(function() {

    //autocomplete
    $("#searchHeader").autocomplete({
        source: "/autocomplite/index",
        minLength: 1
    });

});
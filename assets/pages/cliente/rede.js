$(document).ready(function() {

    $("#org").jOrgChart({
        chartElement : '#chart',
        collapse: false
    });

    $('.tooltipster').tooltipster({
        contentAsHTML: true
    });

}); /* ready */
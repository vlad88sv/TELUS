$(function(){
    $("#visitors_generateLimitedReport").click(function(e){
        e.preventDefault();
        var url = $(this).attr('baseurl').replace('XXX',$("#visitors_daysForLimitedReport").val());
        console.log(url);
        window.location = url;
        return false;
    });
});
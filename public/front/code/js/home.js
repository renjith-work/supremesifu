$(document).ready(function() {  

    bloghHeadHeight();
    function bloghHeadHeight(){
        var highestBox = 0;
        $('.home-blog-title').each(function(){
            if($(this).height() > highestBox) {
                highestBox = $(this).height();
            }
        });
        $('.home-blog-title').height(highestBox); 
    }

    function homeSp(){
        var highestTitle = 0;
        $(".home-sp-h3").each(function() {
            if ($(this).height() > highestTitle) {
                highestTitle = $(this).height();
            }
        }).height(highestTitle);
        console.log(highestTitle);
    }

    setTimeout(function(){
        homeSp();
    }, 100); 

});
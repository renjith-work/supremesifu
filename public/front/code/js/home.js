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
});
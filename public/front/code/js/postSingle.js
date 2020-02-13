$(document).ready(function() {  

    sidebarBlogTitle();
    function sidebarBlogTitle(){
        var highestBox = 0;
        $('.sidebar-post-inner-content').each(function(){
            if($(this).height() > highestBox) {
                highestBox = $(this).height();
            }
        });
        $('.sidebar-post-inner-content').height(highestBox); 
    }
});
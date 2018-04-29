$(document).ready(function(){
    var i = 0;
    var j = 0;
    var limit = 20;
    $('.post').each(function(){
        i++;
        if(i>limit){
            $(this).hide();
        }
    });

    $('.show-posts').on('click', function(){
        limit +=20;
        $('.post').each(function(){
            j++;
            if(j>limit){
                $(this).hide();
            }else{
                $(this).show();
            }
        })
        j=0;
    })
})
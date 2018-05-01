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
});

$('#btn-comment').on("click", function (e) {
    var text = $('.comment-text').val();
    var user = $('#welcome strong').val();

    $.ajax({
        method: "POST",
        url: "ajax/ajax_comment.php",
        data: { text: text, user: user }
    })
        .done(function( res ) {
            if (res.status == "success") {
                var comment = `<li class="comment-li" style="display: none;">
                                <strong>${res.user}</strong>
                                <p> ${res.text}</p>
                            </li>`;

                $(".comment-ul").prepend(comment);
                $(".comment-li").first().slideDown();
            }

        });

    e.preventDefault();
});
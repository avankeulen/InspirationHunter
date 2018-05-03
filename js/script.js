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

// COMMENT WITH AJAX
$('.btn-comment').on("click", function (e) {
    var post_id = $(this).data('id');
    var element = $(this);
    var text = element.closest('li.post').find('.comment-text').val();
    var user = $('.username').text();

    $.ajax({
        method: "POST",
        url: "./ajax/ajax_comment.php",
        data: { text: text, user: user, post_id: post_id }
    })
    .done(function( res ) {
        if (res.status == "success") {
            var comment = `<li class="comment-li" >
                            <strong> ${res.user} </strong>
                            <p> ${res.text} </p>
                          </li>`;

            element.closest('li.post').find(".comment-ul").prepend(comment);
            element.closest('li.post').find(".comment-li").first().slideDown();
            $('.comment-text').val("");

        }

    });
    e.preventDefault();
});

$('.flag-btn').on("click", function (e) {
    var post_id = $(this).data('id');
    var element = $(this);
    var flagcount = parseInt(element.closest('li.post').find(".flag-count").text());


    $.ajax({
        method: "POST",
        url: "./ajax/ajax_flag.php",
        data: { post_id: post_id }
    })
        .done(function( res ) {
            if (res.status == "flagged") {
                var newValue = flagcount + 1;
                element.closest('li.post').find(".flag-count").text(newValue);

                if (newValue > 2) {
                    element.closest('li.post').hide();
                }
                
                if (newValue == 1) {
                    element.closest('li.post').find('span').hide();
                }

            } else {

            }
            });

    e.preventDefault();
});

//update posts set flag = 0
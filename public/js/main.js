$(document).ready(function () {

    $('.btn-edit_post').click(function () {
        postID = $(this).data('postid');
        console.log(postID);
        $('#post_id').attr('value', postID);
        $('#post-body').val($('p#' + postID).text());
        $('#edit_post').modal().show();
    });

    $('.btn-save_post').click(function () {
        console.log($('#post_id').val());
        postBody = $('#post-body').val();
        postID = $('#post_id').val();
        $.ajax({
            url: baseUrl + '/post/edit',
            data: {
                post_id: postID,
                _token: token,
                body: postBody
            },
            type: 'post',
            datatype: 'jsonp',
            success: function (data) {
                $('p#' + postID).html(data.body);
                $('#edit_post').modal('hide');
            }
        });
    });
    $('.like').click(function (event) {
        event.preventDefault();
        isLike = $(this).data("islike");
        postID = $(this).data('id');
        console.log(isLike);
        console.log(postID);
        $.ajax({
            url: baseUrl + '/like',
            type: 'POST',
            data: {isLike: isLike, _token: token, post_id: postID},
            datatype: 'jsonp',
            success: function (data) {
                console.log(data);
                if (data.status == 1) {
                    like = 'Unlike';
                    unlike = 'Dislike';
                } else if (data.status == 0) {
                    like = 'Like';
                    unlike = 'Undislike';
                }else if(data.status===null){
                    console.log(data.status);
                    like = 'Like';
                    unlike = 'Dislike';
                }
                $('#like-'+postID).text('('+data.likes+') '+like);
                $('#dislike-'+postID).text('('+data.dislikes+') '+unlike);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            }
        });

    });

});
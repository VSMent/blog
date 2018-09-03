jQuery(document).ready(function() {
    let arrows = $('.arrow');
    let mainBlock = $('main');
    let post = $(mainBlock).children('article.post');
    var postId = parseInt($(post).attr('id').substr(4));

// local navigations
    var postsAmount;
    $.get( '/__returnPost', {type:"posts"}, function( data ) {
        postsAmount = data > 0 ? data : 1;
    });

// export click
    $( "section main" ).on( "click", "#exportToCSV", function() {
        post = $(mainBlock).children('article.post');
        postId = parseInt($(post).attr('id').substr(4));
        $.post( '/__returnCSV', {postId:postId}, function( data ) {
            if (data!='Error') {
                var blob = new Blob([data], { type: 'application/csv' });
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = `Post${postId}.csv`;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            } else {
                console.log(data);
            }
        });
    });

// arrow for posts
    for (var i = 0; i < arrows.length; i++) {
        $(arrows[i]).on( "click", function () {
            if ($(this).attr('id') == 'left') {
                postId = postId == postsAmount ? postsAmount : postId+1;
            } else {
                postId = postId == 1 ? 1 : postId-1;
            }
            $(mainBlock).load('/__returnPost',{postId: postId});
            document.title = `Post #${postId}`;
            history.pushState(null, '', `/post/${postId}`);
        });
    }

});
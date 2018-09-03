jQuery(document).ready(function() {
    let arrows = $('.arrow');
    let mainBlock = $('main');

// local navigations
    var pagesAmount;
    $.get( '/__returnPage', {type:"pages"}, function( data ) {
        pagesAmount = data > 0 ? data : 1;
    });

// post clicks

    $( "section main" ).on( "click", "article.post", function() {
        window.location.href = `/post/${$(this).attr('id').substr(4)}`;
    });

    

// arrow for pages
    for (var i = 0; i < arrows.length; i++) {
        $(arrows[i]).on( "click", function () {
            var wlh = window.location.href;
            var page = parseInt(wlh.substring(wlh.lastIndexOf("/") + 1));
            if ($(this).attr('id') == 'left') {
                page = page == 1 ? 1 : page-1;
            } else {
                page = page == pagesAmount ? pagesAmount : page+1;
            }
            $(mainBlock).load('/__returnPage', {page: page});
            document.title = `All posts, page ${page}`;
            history.pushState(null, '', `/page/${page}`);
        });
    }
});
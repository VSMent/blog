jQuery(document).ready(function() {
	let base = '..';
	let postIDValue = $('#postIDValue');
	let postIDSubmit = $('#postIDSubmit');
	let arrows = $('.arrow');
	let mainBlock = $('main');
	let phpCurrentPage = $('#currentPage');

// local navigations
	var pagesAmount;
	$.get( `${base}/C/aGetAmounts.php`, {type:"pages"}, function( data ) {
  		pagesAmount = data > 0 ? data : 1;
	});

// post clicks

	$( "section main" ).on( "click", "article.post", function() {
		$(postIDValue).val( $(this).attr('id').substr(4) );
			postIDSubmit.click();
	});

	

// arrow for pages
	var page = parseInt($(phpCurrentPage).val());
	for (var i = 0; i < arrows.length; i++) {
		$(arrows[i]).on( "click", function () {
			if($(this).attr('id') == 'left'){
				page = page == 1 ? 1 : page-1;
			}else{
				page = page == pagesAmount ? pagesAmount : page+1;
			}
			$(mainBlock).load(`${base}/C/getPosts.php`, {page: page});
			history.pushState(null, '', `index.php?page=${page}`);
		});
	}
});
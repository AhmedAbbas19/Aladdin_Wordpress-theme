jQuery(function($){
	$('.aladdin_loadmore').click(function(){
 
		var button = $(this),
		    data = {
			'action': 'loadmore',
			'query': aladdin_loadmore_params.posts, // that's how we get params from wp_localize_script() function
			'page' : aladdin_loadmore_params.current_page
		};
 
		$.ajax({
			url : aladdin_loadmore_params.ajaxurl, // AJAX handler
			data : data,
			type : 'POST',
			beforeSend : function ( xhr ) {
				button.text('Loading...'); // change the button text, you can also add a preloader image
			},
			success : function( data ){
				if( data ) { 
					button.text( 'More posts' ).prev().append(data); // insert new posts
					aladdin_loadmore_params.current_page++;
 
					if ( aladdin_loadmore_params.current_page == aladdin_loadmore_params.max_page ) 
                    button.text( 'No More posts' ).addClass('disabledbutton'); // if last page, remove the button
 
					// you can also fire the "post-load" event here if you use a plugin that requires it
					// $( document.body ).trigger( 'post-load' );
				} else {
					button.text( 'No More posts' ).addClass('disabledbutton'); // if no data, remove the button as well
				}
			}
		});
	});
});
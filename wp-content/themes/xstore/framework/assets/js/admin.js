jQuery(document).ready(function($){

	/* Promo banner in admin panel */
	
	jQuery('.promo-text-wrapper .close-btn').click(function(){
		
		var confirmIt = confirm('Are you sure?');
		
		if(!confirmIt) return;
		
		var widgetBlock = jQuery(this).parent();
	
		var data =  {
			'action':'et_close_promo',
			'close': widgetBlock.attr('data-etag')
		};
		
		widgetBlock.hide();
		
		jQuery.ajax({
			url: ajaxurl,
			data: data,
			success: function(response){
				widgetBlock.remove();
			},
			error: function(data) {
				alert('Error while deleting');
				widgetBlock.show();
			}
		});
	});
	
	/* UNLIMITED SIDEBARS */
	
	var delSidebar = '<div class="delete-sidebar">delete</div>';
	
	jQuery('.sidebar-etheme_custom_sidebar').find('.handlediv').before(delSidebar);
	
	jQuery('.delete-sidebar').click(function(){
		
		var confirmIt = confirm('Are you sure?');
		
		if(!confirmIt) return;
		
		var widgetBlock = jQuery(this).closest('.sidebar-etheme_custom_sidebar');
	
		var data =  {
			'action':'etheme_delete_sidebar',
			'etheme_sidebar_name': jQuery(this).parent().find('h2').text()
		};
		
		widgetBlock.hide();
		
		jQuery.ajax({
			url: ajaxurl,
			data: data,
			success: function(response){
				console.log(response);
				widgetBlock.remove();
			},
			error: function(data) {
				alert('Error while deleting sidebar');
				widgetBlock.show();
			}
		});
	});

	
	/* end sidebars */
    
    $(document).on("click", ".widgets-holder-wrap .upload_image_button", function() {

        jQuery.data(document.body, 'prevElement', $(this).prev());

        window.send_to_editor = function(html) {
            var imgurl = jQuery('img',html).attr('src');
            var inputText = jQuery.data(document.body, 'prevElement');

            if(inputText != undefined && inputText != '')
            {
                inputText.val(imgurl);
            }

            tb_remove();
        };

        tb_show('', 'media-upload.php?type=image&TB_iframe=true');
        return false;
    });

    $(document).ready(function(){
		setTimeout(function() {
			$('.et-tab-label.vc_tta-section-append').removeClass('vc_tta-section-append').addClass('et-tab-append');
		}, 1000);
	});

	$(document).on('click', '#et_tabs', function(event) {
		setTimeout(function() {
			$('.et-tab-label.vc_tta-section-append').removeClass('vc_tta-section-append').addClass('et-tab-append');
		}, 1000);
	});

    $(document).on('click', '.et-tab-label.et-tab-append', function(event) {
    	if( typeof vc == 'undefined' ) return;

        var newTabTitle = 'Tab', 
        	params, 
        	shortcode,
        	modelId = $(this).parents('.wpb_et_tabs').data('model-id'),
        	prepend = false;

        params = {
            shortcode: "et_tab",
            params: {
                title: newTabTitle
            },
            parent_id: modelId,
            order: _.isBoolean(prepend) && prepend ? vc.add_element_block_view.getFirstPositionIndex() : vc.shortcodes.getNextOrder(),
            prepend: prepend
        }

        shortcode = vc.shortcodes.create(params);

    });


	// **********************************************************************//
	// ! Actions for expired support
	// **********************************************************************//

	if ( $( '#et_options-support_chat .switch-options .cb-enable' ).hasClass( 'selected' ) ) {
		$( '#et_options-support_chat .et-expired-support' ).removeClass( 'hidden' );
	}

	$( '#et_options-support_chat' ).on( 'click', '.cb-disable, .cb-enable', function() {
		if ( $(this).is( '.cb-disable' ) ){
			$( '#et_options-support_chat .et-expired-support' ).addClass( 'hidden' );
		} else {
			$( '#et_options-support_chat .et-expired-support' ).removeClass( 'hidden' );
		}
	});


	// **********************************************************************//
	// ! Theme deactivating action
	// **********************************************************************//

	$( '.et_theme-deactivator' ).on( 'click', function(event) {
		event.preventDefault();

		var confirmIt = confirm( 'Are you sure that you want to deactivate theme on this domain?' );
		if( ! confirmIt ) return;

		var data =  {
			'action':'etheme_deactivate_theme',
		};

		var redirect = window.location.href;

		jQuery.ajax({
			type: 'POST',
			dataType: 'JSON',
			url: ajaxurl,
			data: data,
			success: function(data){
				console.log(data);
				var out = ''
				if ( data == 'deleted' ) {
					redirect = redirect.replace( '_options&tab=1', 'xstore_activation_page' );
					redirect = redirect.replace( '_options', 'xstore_activation_page' );
					window.location.href=redirect;
				} else {
					$.each( data, function( e, t ){
						$( '#redux-header' ).prepend( '<span class="et_deactivate-error">' + t + '</span>' );
					});
				}
			},
			error: function(data) {
				alert( 'Error while deactivating' );
			},
		});
	});

	// ! Set major-update message
	if (  $( '.et_major-version' ).length > 0 && $( 'body' ).is( '.themes-php' ) ) {
		$.each( $( '.themes .theme' ), function( i, t ) {
			if ( $(this).data( 'slug' ) == 'xstore'){
				$(this).find( '.update-message' ).append( '<p class="et_major-update">' + $( '.et_major-version' ).data( 'message' ) + '</p>' );
			}
		});

		// ! show it for multisites
		$.each( $( '.plugin-update-tr.active' ), function( i, t ) {
			if ( $(this).is( '#xstore-update' ) ){
				$(this).find( '.update-message' ).append( '<p class="et_major-update">' + $( '.et_major-version' ).data( 'message' ) + '</p>' );
			}
		});

	};

});
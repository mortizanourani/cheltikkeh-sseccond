/* ------------------------------------- */
/* Editor Settings Form jQuery Functions */

var hidden_char = '\u200b';
var target = [];

var dp = false;
var ref, ref_p, color, color_p;

var src;

function hex2int( input ){
	var digit = [];
	
	for( i = 0; i < 2; i++ ){
		digit[i] = input.substr( i, 1 ).toLowerCase();
		digit[i] = digit[i] === 'a' ? 10 : digit[i] === 'b' ? 11 : digit[i] === 'c' ? 12 : digit[i] === 'd' ? 13 : digit[i] === 'e' ? 14 : digit[i] === 'f' ? 15 : parseInt( digit[i] );
	}
	result = ( digit[0] * 16 ) + digit[1];
	
	return result;
}

function get_color( type, property, r, g, b, a ){
	var color_max = Math.max( r, g, b );
	var color_min = Math.min( r, g, b );
	
	var color_pY = ( color_max / 255 );
	var color_pX = ( color_min / color_max );
	
	switch( color_max ){
		case( r ):
			if( color_min === b ){
				ref_r = 255;
				ref_g = parseInt( ( ( g / color_pY ) - ( 255 * color_pX ) ) / ( 1 - color_pX ) );
				ref_b = 0;
				
				ref_pY = ( ( ref_g / 255 ) * 40 );
			}else{
				ref_r = 255;
				ref_g = 0;
				ref_b = parseInt( ( ( b / color_pY ) - ( 255 * color_pX ) ) / ( 1 - color_pX ) );
				
				ref_pY = 240 - ( ( ref_b / 255 ) * 40 );
			}
			break;
		case( g ):
			if( color_min === b ){
				ref_r = parseInt( ( ( r / color_pY ) - ( 255 * color_pX ) ) / ( 1 - color_pX ) );
				ref_g = 255;
				ref_b = 0;
				
				ref_pY = 80 - ( ( ref_r / 255 ) * 40 );
			}else{
				ref_r = 0;
				ref_g = 255;
				ref_b = parseInt( ( ( b / color_pY ) - ( 255 * color_pX ) ) / ( 1 - color_pX ) );
				
				ref_pY = 80 + ( ( ref_b / 255 ) * 40 );
			}
			break;
		case( b ):
			if( color_min === r ){
				ref_r = 0;
				ref_g = parseInt( ( ( g / color_pY ) - ( 255 * color_pX ) ) / ( 1 - color_pX ) );
				ref_b = 255;
				
				ref_pY = 160 - ( ( ref_g / 255 ) * 40 );
			}else{
				ref_r = parseInt( ( ( r / color_pY ) - ( 255 * color_pX ) ) / ( 1 - color_pX ) );
				ref_g = 0;
				ref_b = 255;
				
				ref_pY = 160 + ( ( ref_r / 255 ) * 40 );
			}
			break;
	}
	
	ref_pY = ref_pY - 1;
	color_pY = 235 * ( 1 - color_pY );
	color_pX = 235 * ( 1 - color_pX );
	
	ref_c = 'rgba(' + ref_r + ', ' + ref_g + ', ' + ref_b + ', 1)';
	$(".cheltikkeh-settings-menu div." + type + " #" + property + " #color #color-picker").css({ 'background-color': ref_c });
	
	$(".cheltikkeh-settings-menu div." + type + " #" + property + " #color #reference #pointer").css({ 'top': ref_pY + 'px' });
	$(".cheltikkeh-settings-menu div." + type + " #" + property + " #color #color-picker #pointer").css({ 'top': color_pY + 'px', 'left': color_pX + 'px' });
	
	rgba = 'rgba(' + r + ', ' + g + ', ' + b + ', ' + a + ')';
	
	r = ( ( r < 16 ? '0' : '' ) + r.toString(16) ).toUpperCase();
	g = ( ( g < 16 ? '0' : '' ) + g.toString(16) ).toUpperCase();
	b = ( ( b < 16 ? '0' : '' ) + b.toString(16) ).toUpperCase();
	
	$(".cheltikkeh-settings-menu div." + type + " #" + property + " #color #value").val( '#' + r + g + b );
	$(".cheltikkeh-settings-menu div." + type + " #" + property + " #color #alpha").val( parseInt( a * 100 ) + '%' );
	$(".cheltikkeh-settings-menu div." + type + " #" + property + " #color #preview").css({ 'background-color': rgba });
	
	return;
}
/* ---------------------------------------------------------------------------------------------------- */
$( function(){
	
	/* -------------------- */
	/* Essentials Functions */
	/* -------------------- */
	
	$(".cheltikkeh-settings-menu #dismiss").click( function( event ){
		menu_operation( 'close' );
	});
	
	$("#cheltikkeh-editor-settings-tabs button").click( function( event ){
		var tab = $(this).attr( 'class' ).split( ' ' )[0];
		$(".cheltikkeh-settings-menu div").hide();
		$(".cheltikkeh-settings-menu div." + tab).show();
		
		$("#cheltikkeh-editor-settings-tabs button").attr({ 'disabled': false });
		$(this).attr({ 'disabled': true });
	});
	
	/* Content Settings Box Functions */
	/* ------------------------------ */
	$(".cheltikkeh-settings-menu #content select#type").live( 'change', function( event ){
		$(".cheltikkeh-settings-menu #content #text").hide();
		$(".cheltikkeh-settings-menu #content #category").hide();
		
		if( $(this).find( 'option:selected' ).val() === 'static' )
			$(".cheltikkeh-settings-menu #content #text").show();
		
		if( $(this).find( 'option:selected' ).val() === 'محتوای پست' )
			$(".cheltikkeh-settings-menu #content #category").show();
	});
	
	/* Image Settings Box Functions */
	/* ---------------------------- */
	$(".cheltikkeh-settings-menu #image button#remove").live( 'click', function( event ){
		$(this).closest( 'nav' ).find( '#src' ).attr({ 'src': '' });
	});
	$(".cheltikkeh-settings-menu #image button#change").live( 'click', function( event ){
		src = $(this).parent().find( '#src' );
		$(".cheltikkeh-settings-photos").animate({ 'height': '100%', 'opacity': '1' });
	});
	
	$(".cheltikkeh-settings-photos button#close").live( 'click', function( event ){
		$(".cheltikkeh-settings-photos").animate({ 'height': '0px', 'opacity': '0' });
	});
	$(".cheltikkeh-settings-photos .photo").live( 'click', function( event ){
		src.attr({ 'src': $(this).find( 'img' ).attr( 'src' ) });
		$(".cheltikkeh-settings-photos").animate({ 'height': '0px', 'opacity': '0' });
	});
	
	/* Color Picker Box Functions */
	/* -------------------------- */
	$(".cheltikkeh-settings-menu #color #reference").live( 'mousedown', function( event ){
		ref = $(this);
		color = $(this).parent().find( '#color-picker' );
		
		dp = 'ref';
	});
	
	$(".cheltikkeh-settings-menu #color #color-picker").live( 'mousedown', function( event ){
		color = $(this);
		ref = $(this).parent().find( '#reference' );
		dp = 'color';
	});
	
	$(".cheltikkeh-settings-menu #color input").live( 'change', function( event ){
		var property = $(this).closest('nav').attr( 'id' ).split( ' ' )[0];
		var type = $(this).closest('div').attr( 'class' ).split( ' ' )[0];
		var value = $(this).closest( 'tr' ).find( '#value' );
		var alpha = $(this).closest( 'tr' ).find( '#alpha' );
		
		r = hex2int( value.val().substr(1, 2) );
		g = hex2int( value.val().substr(3, 2) );
		b = hex2int( value.val().substr(5, 2) );
		
		a = property === 'font' ? 1 : property === 'border' ? 1 : ( $(this).closest( 'tr' ).find( '#alpha' ).val().replace(  /[^0-9\.]/g, '' ) / 100 );
				
		get_color( type, property, r, g, b, a );
	});
	
	$(".cheltikkeh-settings-menu").live( 'mousemove', function( event ){
		if( ref ) var ref_p = ref.find( '#pointer' );
		if( color ) var color_p = color.find( '#pointer' );
		if( color ) var property = color.closest( 'nav' ).attr( 'id' );
		
		if( color ){
			var mouseX = event.pageX - color.offset().left;
			mouseX = mouseX <= 0 ? 0 : mouseX >= 235 ? 235 : mouseX;

			var mouseY = event.pageY - color.offset().top;
			mouseY = mouseY <= 0 ? 0 : mouseY >= 235 ? 235 : mouseY;
		}
		
		if( dp ){
			switch( dp ){
				case( 'ref' ):
					ref_p.css({ 'top': mouseY  + 'px' });
					break;
				
				case( 'color' ):
					color_p.css({ 'top': mouseY  + 'px', 'left': mouseX  + 'px' });
					break;
			}
			
			var ref_pY = 1 - ( ( 1 + ref_p.offset().top - ref.offset().top ) / 235 );
			
			var color_pY = 1 - ( ( 2 + color_p.offset().top - color.offset().top ) / 235 );
			var color_pX = 1 - ( ( 2 + color_p.offset().left - color.offset().left ) / 235 );
			
			var ref_c = parseInt( 240 * ref_pY );
			
			ref_r = Math.max( parseInt( 255 * ( ( ref_c - 160 ) / 40 ) ),  parseInt( 255 * ( ( 80 - ref_c ) / 40 ) ) );
			ref_r = ref_r <= 0 ? 0 : ref_r >= 255 ? 255 : ref_r;
			
			ref_g = Math.min( parseInt( 255 * ( ( 240 - ref_c ) / 40 ) ), parseInt( 255 * ( ( ref_c - 80 ) / 40 ) ) );
			ref_g = ref_g <= 0 ? 0 : ref_g >= 255 ? 255 : ref_g;
			
			ref_b = Math.min( parseInt( 255 * ( ( 160 - ref_c ) / 40 ) ), parseInt( 255 * ( ref_c / 40 ) ) );
			ref_b = ref_b <= 0 ? 0 : ref_b >= 255 ? 255 : ref_b;
			
			var r = parseInt( color_pY * ( ref_r + ( color_pX * ( 255 - ref_r ) ) ) );
			var g = parseInt( color_pY * ( ref_g + ( color_pX * ( 255 - ref_g ) ) ) );
			var b = parseInt( color_pY * ( ref_b + ( color_pX * ( 255 - ref_b ) ) ) );
			
			a = property === 'font' ? 1 : property === 'border' ? 1 : ( color.closest( 'table' ).find( '#alpha' ).val().replace(  /[^0-9\.]/g, '' ) / 100 );
			
			color.css({ 'background-color': 'rgb(' + ref_r + ', ' + ref_g + ', ' + ref_b + ')' });
			color.closest( 'table' ).find( '#preview' ).css({ 'background-color': 'rgba(' + r + ', ' + g + ', ' + b + ', ' + a + ')' });
			
			r = ( ( r < 16 ? '0' : '' ) + r.toString(16) ).toUpperCase();
			g = ( ( g < 16 ? '0' : '' ) + g.toString(16) ).toUpperCase();
			b = ( ( b < 16 ? '0' : '' ) + b.toString(16) ).toUpperCase();
			
			color.closest( 'table' ).find( '#value' ).val( '#' + r + g + b );
		}
	});
	
	$(document).live( 'mouseup', function( event ){
		dp = false;
	});
	
	/* -------------------- */
	
	/* ----------------------------------------------- */
	/* Elements Properties Reading & Setting Functions */
	/* ----------------------------------------------- */
	
	/* Elements Remove Functions */
	/* ------------------------- */
	$(".cheltikkeh-settings-menu .remove #remove").live( 'click', function( event ){
		for( i = 0; i < (target.length - 2); i++ ){
			var type = target[i].get(0).tagName.toLowerCase();
			if( $(this).closest( 'div' ).hasClass( type ) ){
				target[i].remove();
			}
		}
		menu_operation( 'close' );
		
		update();
	});
	
	/* Elements Properties Reading Functions */
	/* ------------------------------------- */
	$(".cheltikkeh-editor-content .module").find('*').live( 'click', function( event ){
		event.preventDefault();
		
		if( target[ target.length - 1 ] === 'final' ) target = [];
		
		target[ target.length ] = $(this);
		
		if( $(this).parent().hasClass( 'module' ) ){
			$(".cheltikkeh-settings-menu div").hide();
			$(".cheltikkeh-settings-menu #cheltikkeh-editor-settings-tabs button").hide();
			
			for( c = 0; c < target.length; c++ ){
				var type = target[c].get(0).tagName.toLowerCase();
				
				switch( type ){
					case( 'a' ):
					case( 'p' ):
					case( 'h1' ):
					case( 'h2' ):
					case( 'h3' ):
					case( 'h4' ):
					case( 'h5' ):
					case( 'nav' ):
					case( 'img' ):
					case( 'menu' ):
					case( 'form' ):
					case( 'input' ):
					case( 'button' ):
					case( 'textarea' ):
					
						/* --------------------------------------------- */
						/* Read the <input> & <textarea> tag placeholder */
						
						if( $(".cheltikkeh-settings-menu div." + type + " #content #placeholder").attr( 'id' ) )
							$(".cheltikkeh-settings-menu div." + type + " #content #placeholder").val( target[c].attr( 'placeholder' ) );
						/* --------------------------------------------- */
					
						/* ------------------------------ */
						/* Read the <a> tag href property */
						
						if( $(".cheltikkeh-settings-menu div." + type + " #content #href").attr( 'id' ) )
							$(".cheltikkeh-settings-menu div." + type + " #content #href").val( target[c].attr( 'href' ) );
						/* ------------------------------ */
						
						/* ------------------------------ */
						/* Read the content of every tags */
						
						if( $(".cheltikkeh-settings-menu div." + type + " #content #text").attr( 'id' ) ){
							$(".cheltikkeh-settings-menu div." + type + " #content #text").show();
							if( $(".cheltikkeh-settings-menu div." + type + " #content #text").get(0).tagName.toLowerCase() === 'input' ){
								var content = target[c].text();
							}else{
								var content = target[c].html();
								while( content.indexOf( "<br>" ) >= 0 ){
									content = content.replace( "<br>", "\n" );
								}
								while( content.indexOf( "\t" ) >= 0 ){
									content = content.replace( "\t", "" );
								}
							}
							
							if( $(".cheltikkeh-settings-menu div." + type + " #content #type").attr( 'id' ) ){
								if( content.indexOf( hidden_char ) > -1 ){
									while( content.indexOf( hidden_char ) > -1 ) var content = content.replace( hidden_char, '' );
									$(".cheltikkeh-settings-menu div." + type + " #content #text").hide();
									$('.cheltikkeh-settings-menu div.' + type + ' #content #type option[value="' + content + '"]').attr({ 'selected': true });
									if( content.indexOf( 'محتوای پست' ) > -1 ){
										$(".cheltikkeh-settings-menu div." + type + " #content #category").show();
										$('.cheltikkeh-settings-menu div.' + type + ' #content #type option[value="محتوای پست"]').attr({ 'selected': true });
										$('.cheltikkeh-settings-menu div.' + type + ' #content #category option[value="' + content + '"]').attr({ 'selected': true });
									}else{
										$(".cheltikkeh-settings-menu div." + type + " #content #category").hide();
									}
								}else{
									$(".cheltikkeh-settings-menu div." + type + " #content #category").hide();
									$('.cheltikkeh-settings-menu div.' + type + ' #content #type #static').attr({ 'selected': true });
								}
							}
							
							$(".cheltikkeh-settings-menu div." + type + " #content #text").val( content );
						}
						/* ------------------------------ */
						
						/* --------------------------------- */
						/* Read the font-style of every tags */
						
						var font_family = target[c].css( 'font-family' ).split(',')[0];
						while( font_family.indexOf('"') != -1 ){ font_family = font_family.replace('"', ''); }
						if( $(".cheltikkeh-settings-menu div." + type + " #font #family").attr( 'id' ) ){
							$(".cheltikkeh-settings-menu div." + type + " #font #family #default" ).attr({ 'selected': true });
							if( $(".cheltikkeh-settings-menu div." + type + " #font #family #" + font_family ).attr( 'id' ) )
								$(".cheltikkeh-settings-menu div." + type + " #font #family #" + font_family ).attr({ 'selected': true });
						}
						
						if( $(".cheltikkeh-settings-menu div." + type + " #font #size").attr( 'id' ) )
							$(".cheltikkeh-settings-menu div." + type + " #font #size").val( target[c].css( 'font-size' ) );
						
						var color = target[c].css( 'color' ).split(',');
						var r = parseInt( color[0].replace( /[^0-9\.]/g, '' ), 10 );
						var g = parseInt( color[1].replace( /[^0-9\.]/g, '' ), 10 );
						var b = parseInt( color[2].replace( /[^0-9\.]/g, '' ), 10 );
						if( $(".cheltikkeh-settings-menu div." + type + " #font #color").attr( 'id' ) )
							get_color( type, 'font', r, g, b, '1' );
						/* --------------------------------- */
						
						/* ---------------------------- */
						/* Read every tags border-style */
						
						var border_style = ! target[c].css( 'border-style' ) ? 'none' : target[c].css( 'border-style' );
						if( $(".cheltikkeh-settings-menu div." + type + " #border #style").attr( 'id' ) ){
							$(".cheltikkeh-settings-menu div." + type + " #border #style #none").attr({ 'selected': 'true' });
							if( $(".cheltikkeh-settings-menu div." + type + " #border #style #" + border_style ).attr( 'id' ) )
								$(".cheltikkeh-settings-menu div." + type + " #border #style #" + border_style ).attr({ 'selected': 'true' });
						}
						
						if( $(".cheltikkeh-settings-menu div." + type + " #border #width").attr( 'id' ) )
							$(".cheltikkeh-settings-menu div." + type + " #border #width").val( target[c].css( 'border-width' ) );
						
						if( ! target[c].css( 'border-color' ) ){
							$(".cheltikkeh-settings-menu div." + type + " #border #style #none").attr({ 'selected': 'true' });
							var color =  ('rgb(0, 0, 0)').split(',');
						}else{
							var color = target[c].css( 'border-color' ).split(',');
						}
						var r = parseInt( color[0].replace( /[^0-9\.]/g, '' ), 10 );
						var g = parseInt( color[1].replace( /[^0-9\.]/g, '' ), 10 );
						var b = parseInt( color[2].replace( /[^0-9\.]/g, '' ), 10 );
						if( $(".cheltikkeh-settings-menu div." + type + " #border #color").attr( 'id' ) )
							get_color( type, 'border', r, g, b, '1' );
						/* ---------------------------- */
						
						/* -------------------------------------- */
						/* Read text-align property of every tags */
						
						if( $(".cheltikkeh-settings-menu div." + type + " #text-align").attr( 'id' ) ){
							var option_value = target[c].css( 'direction' ) + target[c].css( 'text-align' );
							$(".cheltikkeh-settings-menu div." + type + " #text-align option[value='" + option_value + "']").prop({ 'selected': true });
						}
						/* -------------------------------------- */
						
						/* ------------------------------------- */
						/* Read the background-color of all tags */
						
						if( ( ! target[c].css( 'background-color' ) ) || ( target[c].css( 'background-color' ) === 'transparent' ) ){
							var color =  ('rgba(0, 0, 0, 0)').split(',');
						}else{
							var color = target[c].css( 'background-color' ).split(',');
						}
						var r = parseInt( color[0].replace( /[^0-9\.]/g, '' ), 10 );
						var g = parseInt( color[1].replace( /[^0-9\.]/g, '' ), 10 );
						var b = parseInt( color[2].replace( /[^0-9\.]/g, '' ), 10 );
						var a = color[3] ? color[3].replace( /[^0-9\.]/g, '' ) : 1;
						if( $(".cheltikkeh-settings-menu div." + type + " #background #color").attr( 'id' ) )
							get_color( type, 'background', r, g, b, a );
						/* ------------------------------------- */
						
						/* --------------------------------- */
						/* Read the background-image of tags */
						
						if( $(".cheltikkeh-settings-menu div." + type + " #background #image").attr( 'id' ) ){
							var src = target[c].css( 'background-image' ).replace( "url('", '' );
							src = src.replace( 'url("', '' );
							src = src.replace( "')", '' );
							src = src.replace( '")', '' );
							$(".cheltikkeh-settings-menu div." + type + " #background #image #src").attr({ 'src': src });
						}
						/* --------------------------------- */
					
						/* ------------------------------ */
						/* Read src property of <img> tag */
						
						if( $(".cheltikkeh-settings-menu div." + type + " #image #src").attr( 'id' ) )
							$(".cheltikkeh-settings-menu div." + type + " #image #src").attr({ 'src': target[c].attr( 'src' ) });
						/* ------------------------------ */
						
						break;
				}
				
				$(".cheltikkeh-settings-menu #cheltikkeh-editor-settings-tabs button." + type).show();
			}
			
			visible_tab = target[0].get(0).tagName.toLowerCase();
			$(".cheltikkeh-settings-menu ." + visible_tab).show();
			$(".cheltikkeh-settings-menu #cheltikkeh-editor-settings-tabs button").attr({ "disabled": false });
			$(".cheltikkeh-settings-menu #cheltikkeh-editor-settings-tabs button." + visible_tab).attr({ "disabled": true });
			
			if( $('.cheltikkeh-settings-menu').children('div:visible').length > 0 ){
				menu_operation( 'open', 'settings' );
			}else{
				menu_operation( 'close' );
			}
			
			target[ target.length ] = 'final';
		}
	});
	
	/* Elements Properties Writing Functions */
	/* ------------------------------------- */
	$(".cheltikkeh-settings-menu #apply").click( function( event ){
		for( c = 0; c < target.length - 1; c++ ){
			var type = target[c].get(0).tagName.toLowerCase();
			
			switch( type ){
				case( 'a' ):
				case( 'p' ):
				case( 'h1' ):
				case( 'h2' ):
				case( 'h3' ):
				case( 'h4' ):
				case( 'h5' ):
				case( 'nav' ):
				case( 'img' ):
				case( 'menu' ):
				case( 'form' ):
				case( 'input' ):
				case( 'button' ):
				case( 'textarea' ):
					
					/* -------------------------- */
					/* Write the href for <a> tag */
						
					if( $(".cheltikkeh-settings-menu div." + type + " #href").attr( 'id' ) )
						target[c].attr({ 'href': $(".cheltikkeh-settings-menu div." + type + " #href").val() });
					/* -------------------------- */
					
					// $('head').append('<style>.' + target[c].attr( 'class' ) + ':before{ color: ' + $(".cheltikkeh-settings-menu div." + type + " #font #color").val() + ' !important; }</style>');
				
					/* --------------------------------------------------- */
					/* Write the placeholder for <input> or <textarea> tag */
					
					if( $(".cheltikkeh-settings-menu div." + type + " #placeholder").attr( 'id' ) )
						target[c].attr( {'placeholder': $(".cheltikkeh-settings-menu div." + type + " #placeholder").val() });
					/* --------------------------------------------------- */
					
					/* ------------------------------ */
					/* Write the content for all tags */
					
					if( $(".cheltikkeh-settings-menu div." + type + " #content #text").attr( 'id' ) ){
						var content = $(".cheltikkeh-settings-menu div." + type + " #content #text").val();
						if( type === 'p' ){
							while( content.indexOf( "\n" ) >= 0 ){
								content = content.replace( "\n", '<br>' );
							}
							target[c].html( content.replace( "\n", '<br>' ) );
						}else{
							target[c].text( content );
						}
						
						if( $(".cheltikkeh-settings-menu div." + type + " #content #type").attr( 'id' ) ){
							var content_type = $(".cheltikkeh-settings-menu div." + type + " #content #type option:selected").val();
							if(  content_type != 'static' ){
								if( content_type.indexOf( 'محتوای پست' ) > -1 )
									var content_type = $(".cheltikkeh-settings-menu div." + type + " #content #category option:selected").val();
								
								target[c].html( hidden_char + hidden_char + content_type + hidden_char + hidden_char );
							}
						}
					}
					/* ------------------------------ */
					
					/* ----------------------------- */
					/* Write font-style for all tags */
					
					if( $(".cheltikkeh-settings-menu div." + type + " #font #family option:selected").attr( 'id' ) != 'default' )
						target[c].css({ 'font-family': $(".cheltikkeh-settings-menu div." + type + " #font #family option:selected").val() });
					
					if( $(".cheltikkeh-settings-menu div." + type + " #font #size").attr( 'id' ) )
						target[c].css({ 'font-size': $(".cheltikkeh-settings-menu div." + type + " #font #size").val().replace( /[^0-9\.]/g, '' ) + 'px' });
					
					if( $(".cheltikkeh-settings-menu div." + type + " #font #color #preview").attr( 'id' ) )
						target[c].css({ 'color': $(".cheltikkeh-settings-menu div." + type + " #font #color #preview").css( 'background-color' ) });
					/* ----------------------------- */
					
					/* ----------------------------------- */
					/* Write text-align style for all tags */
					
					if( $(".cheltikkeh-settings-menu div." + type + " #text-align").attr( 'id' ) ){
						var text_align = $(".cheltikkeh-settings-menu div." + type + " #text-align option:selected").val();
						target[c].css({ 'direction': text_align.substr( 0, 3 ) });
						target[c].css({ 'text-align': text_align.substr( 3 ) });
					}
					/* ----------------------------------- */
					
					/* --------------------------------- */
					/* Write border-style for every tags */
					
					if( $(".cheltikkeh-settings-menu div." + type + " #border #style option").attr( 'id' ) )
						target[c].css({ 'border-style': $(".cheltikkeh-settings-menu div." + type + " #border #style option:selected").val() });
					
					if( $(".cheltikkeh-settings-menu div." + type + " #border #width").attr( 'id' ) )
						target[c].css({ 'border-width': $(".cheltikkeh-settings-menu div." + type + " #border #width").val().replace( /[^0-9\.]/g, '' ) + 'px' });
					
					if( $(".cheltikkeh-settings-menu div." + type + " #border #color #preview").attr( 'id' ) )
						target[c].css({ 'border-color': $(".cheltikkeh-settings-menu div." + type + " #border #color #preview").css( 'background-color' ) });
					/* --------------------------------- */
					
					/* ------------------------------------- */
					/* Write background-color for every tags */
					
					if( $(".cheltikkeh-settings-menu div." + type + " #background #color #preview").attr( 'id' ) )
						target[c].css({ 'background-color': $(".cheltikkeh-settings-menu div." + type + " #background #color #preview").css( 'background-color' ) });
					/* ------------------------------------- */
					
					/* ------------------------------------- */
					/* Write background-image for every tags */
					
					if( $(".cheltikkeh-settings-menu div." + type + " #background #image #src").attr( 'id' ) ){
						target[c].css({ 'background-image': "url('" + $(".cheltikkeh-settings-menu div." + type + " #background #image #src").attr( 'src' ) + "')" });
					}
					/* ------------------------------------- */
					
					/* ----------------------- */
					/* Write src for <img> tag */
					
					if( $(".cheltikkeh-settings-menu div." + type + " #image #src").attr( 'id' ) )
						target[c].attr({ 'src': $(".cheltikkeh-settings-menu div." + type + " #image #src").attr( 'src' ) });
					/* ----------------------- */
					
					break;
			}
		}
		
		menu_operation( 'close' );
		
		update();
	});
	
	/* ----------------------------------------------- */
	
} );
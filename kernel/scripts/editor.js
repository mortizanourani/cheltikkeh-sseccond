/* ----------------------- */
/* Editor jQuery Functions */
/* ----------------------- */

/* Editor Graphical Functions */
/* -------------------------- */
function menu_operation( operation, menu ){
	switch( operation ){
		case( 'open' ):
			$(".cheltikkeh-editor-content").animate({"margin-top": "80px"});
			$(".cheltikkeh-editor-header").animate({"height": "60px", "opacity": "1"});
			$(".cheltikkeh-editor-content .module-place-menu").animate({"height": "55px", "opacity": "1"});

			$(".cheltikkeh-modules-menu").css({"width": "0px"});
			$(".cheltikkeh-settings-menu").css({"width": "0px"});
			$(".cheltikkeh-templates-menu").css({"width": "0px"});
			switch( menu ){
				case( 'modules' ):
					$(".cheltikkeh-modules-menu").css({"width": "317px"});
					break;
				case( 'settings' ):
					$(".cheltikkeh-settings-menu").css({"width": "317px"});
					break;
				case( 'templates' ):
					$(".cheltikkeh-templates-menu").css({"width": "317px"});
					break;
			}
			break;
		
		case( 'close' ):
			$(".cheltikkeh-modules-menu").css({"width": "0px"});
			$(".cheltikkeh-settings-menu").css({"width": "0px"});
			$(".cheltikkeh-templates-menu").css({"width": "0px"});
			break;
	}
}

/* Editor SubRoutins Functions */
/* --------------------------- */
function selector( element, target ){
	var output;
	switch( target ){
		case( 'module-row' ):
			output = element.parent().parent().parent().parent();
			break;
		case( 'module-column' ):
			output = element.parent().parent().parent();
			break;
		case( 'module-place' ):
			output = element.parent().parent();
			break;
		case( 'module' ):
			output = element.parent().parent().find(".module");
			break;
		default:
			return -1;
	}
	return output;
}

function update(){
	var decoded_html = $(".cheltikkeh-editor-content").html();
	var encoded_html = window.btoa( unescape( encodeURIComponent( decoded_html ) ) );
	$(".operation-menu .operation-form #encoded-html").val( encoded_html );
	
	if( $(".cheltikkeh-editor-content div").hasClass( 'module-row' ) ){
		$(".operation-menu #preview").removeAttr( 'disabled' );
		$(".operation-menu .operation-form button").removeAttr( 'disabled' );
	}else{
		$(".operation-menu #preview").prop({ 'disabled': true });
		$(".operation-menu .operation-form button").prop({ 'disabled': true });
	}
	
	return;
}

function dragover( event, element ){
	event.preventDefault();
	
	var droped_row = element.parent().parent();
	
	var height = element.height();
	var offset = element.offset();
	var mouseY = ( ( height / 2 ) - ( event.pageY - offset.top ) );
	
	if( droped_row.hasClass( 'module-row' ) ){
		if( mouseY >= 0 ){
			if( !droped_row.prev().hasClass( 'locator' ) ){
				droped_row.before('<div class="locator"></div>');
				if( droped_row.next().hasClass( 'locator' ) )
					droped_row.next().remove();
			}
		}else{
			if( !droped_row.next().hasClass( 'locator' ) ){
				droped_row.after('<div class="locator"></div>');
				if( droped_row.prev().hasClass( 'locator' ) )
					droped_row.prev().remove();
			}
		}
	}
	
	return;
}

function drop(){
	if( $(".dragged").attr("class") ){
		var dragged_row = $(".dragged").parent().parent();
		var dragged_module = dragged_row.html();
		
		dragged_row.remove();
	}else{
		if( $(".dragged-new").hasClass( 'cheltikkeh-module-item' ) ){
			var css = $(".dragged-new #css").val();
			var html = $(".dragged-new #html").val();
			var decoded_css = decodeURIComponent( escape( window.atob( css ) ) );
			var decoded_html = decodeURIComponent( escape( window.atob( html ) ) );
			
			var div_before_module = '<div class="module-column">';
			div_before_module += '<div class="module-place dropable" ondragover="dragover( event, $(this) )">';
			div_before_module += '<nav class="module-place-menu">';
			div_before_module += '<div id="btndelete"></div><img id="btnmove" src="/themes/default/includes/images/module-move.jpg" />';
			div_before_module += '</nav>';
			div_before_module += '<nav class="module">';
			
			var div_after_module = '</nav>';
			div_after_module += '</div>';
			div_after_module += '</div>';

			var dragged_module = div_before_module + '<style>' + decoded_css + '</style>' + decoded_html + div_after_module;
		}else{
			var html = $(".dragged-new #html").val();
			var decoded_html = decodeURIComponent( escape( window.atob( html ) ) );
			
			$(".cheltikkeh-editor-content").html( decoded_html );
			
			return;
		}
	}
	$(".locator").html( dragged_module );
	$(".locator").addClass( 'module-row' );
	$(".locator").removeClass( 'dropable' );
	$(".locator").removeClass( 'locator' );
	
	$(".dragged").removeClass( 'dragged' );
	$(".dragged-new").removeClass( 'dragged-new' );
	
	$(".locator").remove();
	
	update();
	
	return;
}
/* ----------------------- */

/* --------------------- */
/* Editor Main Functions */
/* --------------------- */
$( function(){
	
	/* -------------------- */
	/* Essentials Functions */
	/* -------------------- */
	$(".cheltikkeh-editor-header .operation-menu #preview").click( function(){
		menu_operation( 'close' );
		$(".cheltikkeh-editor-content .locator.dropable").fadeToggle( 'fast' );
		$(".cheltikkeh-editor-content").animate({"margin-top": "0px"});
		$(".cheltikkeh-editor-header").animate({"height": "0px", "opacity": "0"});
		$(".cheltikkeh-editor-content .module-place-menu").animate({"height": "0px", "opacity": "0"});
	});
	
	$(".cheltikkeh-editor-header .operation-menu .operation-form").live( 'submit', function( event ){
		var encoded_html = $(".operation-menu .operation-form #encoded-html").val();
		$(".cheltikkeh-editor-content").html( decodeURIComponent( escape( window.atob( encoded_html ) ) ) );
		$(".module-place-menu").remove();
		$(".module-row").removeClass();
		$(".module-column").removeClass();
		$(".module-place").removeClass();
		$(".module").removeClass();
		var cleared_html = $(".cheltikkeh-editor-content").html();
		cleared_html = cleared_html.replace( 'ondragover="dragover( event, $(this) )"', '' );
		var encoded_cleared_html = window.btoa( unescape( encodeURIComponent( cleared_html ) ) );
		$(".operation-menu .operation-form #encoded-cleared-html").val( encoded_cleared_html );
	});
	
	$(".elements #modules").click( function(){
		if( $(".cheltikkeh-modules-menu").width() <= 150 ){
			menu_operation( 'open', 'modules' );
		}else{
			menu_operation( 'close' );
		}
	});
	$(".elements #templates").click( function(){
		if( $(".cheltikkeh-templates-menu").width() <= 150 ){
			menu_operation( 'open', 'templates' );
		}else{
			menu_operation( 'close' );
		}
	});
	/* -------------------- */
	
	
	
	/* ------------------------------ */
	/* Elements Drag & Drop Functions */
	/* ------------------------------ */
	
	/* Elements Drag Functions */
	/* ----------------------- */
	$(".module-place-menu #btnmove").live( 'dragstart', function( event ){
		var dragged_module = selector( $(this), 'module-place' );
		dragged_module.addClass( 'dragged' );
		$(".cheltikkeh-modules-menu").css({"width": "0px"});
	});
	
	$(".cheltikkeh-module-item img").live( 'dragstart', function( event ){
		var dragged_new_module = $(this).parent();
		dragged_new_module.addClass( 'dragged-new' );
		$(".cheltikkeh-modules-menu").css({"width": "0px"});
	});
	$(".cheltikkeh-template-item img").live( 'dragstart', function( event ){
		var dragged_new_template = $(this).parent();
		dragged_new_template.addClass( 'dragged-new' );
		$(".cheltikkeh-templates-menu").css({"width": "0px"});
	});
	
	$(".dropable.locator").live( 'dragover', function( event ){
		event.preventDefault();
	});

	/* Elements Drop Functions */
	/* ----------------------- */
	$(".dropable").live( 'drop', function( event ){
		event.preventDefault();
		drop();
	});
	
	/* Elements Click Functions */
	/* ------------------------ */
	$(".module-place-menu #btndelete").live( 'click', function( event ){
		var module_row = selector( $(this), 'module-row' );
		
		if( module_row.next().hasClass( 'module-row' ) || module_row.prev().hasClass( 'module-row' ) ){
			module_row.remove();
		}else{
			var first_module_place = '<div class="locator dropable"><h4>با کشیدن یک ماژول یا قالب آماده به این قسمت، طراحی صفحه را از سر بگیرید.</h4></div>';
			$(".cheltikkeh-editor-content").html( first_module_place );
		}
		
		update();
	});
	/* ------------------------------ */
	
	document.ondragend = function(){
		$(".dragged").removeClass( 'dragged' );
		$(".dragged-new").removeClass( 'dragged-new' );
		if( !$(".locator").hasClass("dropable") ){
			$(".locator").remove();
		}
	}
	
	$(".cheltikkeh-editor-content .module").find('*').attr('draggable', false);
	$(".cheltikkeh-editor-content .module").find('br').removeAttr( 'draggable' );
	
} );
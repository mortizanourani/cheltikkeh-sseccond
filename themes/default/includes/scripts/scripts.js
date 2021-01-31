/********************/
/* jQuery Functions */

function initialize(){
	
}

$(function(){
	initialize();
	
	/* Register Page Valid Data Check */
	$(".text").change( function(){
		if( $(this).val().length === 0 ){
			$(this).removeClass("ok");
			$(this).addClass("wrong");
		}else{
			$(this).addClass("ok");
			$(this).removeClass("wrong");
		}
	});

	$("#username").change( function(){
		if( $("#username").val().length < 6 ){
			$("#username").removeClass("ok");
			$("#username").addClass("wrong");
			$("#username").next().show();
			$("#username").next().next().hide();
		}else{
			$.post( '/api/functions/jqueryposts.php', { operation: 'unique_check', username: $("#username").val() } )
			.done( function( result ){
				switch( result ){
					case( '1' ):
						$("#username").removeClass("wrong");
						$("#username").addClass("ok");
						$("#username").next().hide();
						$("#username").next().next().hide();
						break;
					case( '-1' ):
						$("#username").removeClass("ok");
						$("#username").addClass("wrong");
						$("#username").next().hide();
						$("#username").next().next().show();
						break;
				}
			});
		}
	});
	
	$("#password").change( function(){
		if( $("#password").val().length < 8 ){
			$("#password").removeClass("ok");
			$("#password").addClass("wrong");
			$("#password").next().show();
		}else{
			$("#password").addClass("ok");
			$("#password").removeClass("wrong");
			$("#password").next().hide();
		}
		if( $("#password-retype").val() != $("#password").val() ){
			$("#password-retype").removeClass("ok");
			$("#password-retype").addClass("wrong");
			$("#password-retype").next().show();
		}else{
			$("#password-retype").addClass("ok");
			$("#password-retype").removeClass("wrong");
			$("#password-retype").next().hide();
		}
	});
	
	$("#password-retype").change( function(){
		if( $("#password-retype").val() != $("#password").val() ){
			$("#password-retype").removeClass("ok");
			$("#password-retype").addClass("wrong");
			$("#password-retype").next().show();
		}else{
			$("#password-retype").addClass("ok");
			$("#password-retype").removeClass("wrong");
			$("#password-retype").next().hide();
		}
	});
	
	$("#email").change( function(){
		if( $("#email").val().indexOf('@') === -1 || $("#email").val().indexOf('.') === -1 ){
			$("#email").removeClass("ok");
			$("#email").addClass("wrong");
			$("#email").next().show();
		}else{
			$("#email").removeClass("wrong");
			$("#email").addClass("ok");
			$("#email").next().hide();
		}
	});
	
	$("#email-retype").change( function(){
		if( $("#email-retype").val() != $("#email").val() ){
			$("#email-retype").removeClass("ok");
			$("#email-retype").addClass("wrong");
			$("#email-retype").next().show();
		}else{
			$("#email-retype").addClass("ok");
			$("#email-retype").removeClass("wrong");
			$("#email-retype").next().hide();
		}
	});
	
	$("#phone").change( function(){
		if( $("#phone").val().length < 11 || $("#phone").val().indexOf('-') > 0  || $("#phone").val().indexOf(' ') > 0 ){
			$("#phone").removeClass("ok");
			$("#phone").addClass("wrong");
			$("#phone").next().show();
		}else{
			$("#phone").addClass("ok");
			$("#phone").removeClass("wrong");
			$("#phone").next().hide();
		}
	});
	
	$(".register-box form").submit( function( event ){
		if( $("input.wrong").val() )
			event.preventDefault();
	});
	
	/* ------------------------------ */
	
	/* Password Page Valid Data Check */

	$(".password-form").submit( function( event ){
		if( $("input.wrong").val() )
			event.preventDefault();
	});
	
	/* ------------------------------ */
	
	/* Informations Page Valid Data Check */

	$(".informations-form").submit( function( event ){
		if( $("input.wrong").val() )
			event.preventDefault();
	});
	
	/* ---------------------------------- */
	
	
	
	
	
	/* Forget Page Valid Data Check */

	$(".forget form input.text").change( function(){
		if( $(this).val().indexOf('@') === -1 || $(this).val().indexOf('.') === -1 ){
			$(this).removeClass("ok");
			$(this).addClass("wrong");
			$(this).next().show();
		}else{
			$(this).removeClass("wrong");
			$(this).addClass("ok");
			$(this).next().hide();
		}
	});
	
	$(".forget form").submit( function( event ){
		if( $("input.wrong").val() )
			event.preventDefault();
	});
	
	/* ---------------------------------- */
	
	
	
	
	
	/* Token Page Valid Data Check */

	$(".token form input#password").change( function(){
		if( $("#password").val().length < 8 ){
			$("#password").removeClass("ok");
			$("#password").addClass("wrong");
			$("#password").next().show();
		}else{
			$("#password").addClass("ok");
			$("#password").removeClass("wrong");
			$("#password").next().hide();
		}
		if( $("#password-retype").val() != $("#password").val() ){
			$("#password-retype").removeClass("ok");
			$("#password-retype").addClass("wrong");
			$("#password-retype").next().show();
		}else{
			$("#password-retype").addClass("ok");
			$("#password-retype").removeClass("wrong");
			$("#password-retype").next().hide();
		}
	});
	
	$(".token form input#password-retype").change( function(){
		if( $("#password-retype").val() != $("#password").val() ){
			$("#password-retype").removeClass("ok");
			$("#password-retype").addClass("wrong");
			$("#password-retype").next().show();
		}else{
			$("#password-retype").addClass("ok");
			$("#password-retype").removeClass("wrong");
			$("#password-retype").next().hide();
		}
	});
	
	$(".token form").submit( function( event ){
		if( $("input.wrong").val() )
			event.preventDefault();
	});
	
	/* ---------------------------------- */
	
	
	
	
	
	/* --------------------- */
	/* Cart jQuery Functions */
	/* --------------------- */
	
	/* Add To Cart */
	/* ----------- */
	$("button.addtocart").click( function(){
		var type = $(this).attr( 'type' );
		var id = $(this).attr( 'id' );
		$.post( '/api/functions/jqueryposts.php', { operation: 'addto', type: type, id: id } )
		.done( function( result ){
			switch( type ){
				case( 'plans' ):
					page = 'طرح';
					break;
				case( 'modules' ):
					page = 'ماژول';
					break;
				case( 'templates' ):
					page = 'قالب آماده ی';
					break;
			}
			switch( result ){
				case( '1' ):
					alert( page + ' مورد نظر با موفقیت به سبد خرید اضافه شد.' );
					$("button.addtocart#" + id).remove();
					break;
				case( '0' ):
					alert( 'محصولی با مشخصات انتخاب شده موجود نمی باشد.' );
					break;
				case( '-1' ):
					alert( 'جهت خرید محصولات لازم است به حساب کاربری خود ورود نمایید.' );
					break;
				case( '-2' ):
					alert( 'محصولی با مشخصات انتخاب شده موجود نمی باشد.' );
					break;
				case( '-3' ):
					alert( page + ' مورد نظر قبلا خریداری شده است.' );
					break;
				case( '-4' ):
					alert( page + ' مورد نظر در سبد خرید موجود است.' );
					break;
				default:
					alert( "خطایی در انجام عملیات درخواستی رخ داده است.\nلطفا مجددا تلاش نمایید." );
					break;
			}
		});
	});
	
	/* Remove From Cart */
	/* ---------------- */
	$("button.remove").click( function(){
		var type = $(this).attr( 'type' );
		var id = $(this).attr( 'id' );
		var target = $(this);
		$.post( '/api/functions/jqueryposts.php', { operation: 'remove', type: type, id: id } )
		.done( function( result ){
			switch( result ){
				case( '-1' ):
					alert( "خطایی در انجام عملیات درخواستی رخ داده است.\nلطفا مجددا تلاش نمایید." );
					break;
				case( 'empty' ):
					location.reload();
					break;
				default:
					$(".cart-price").text( result );
					$(".final-cart-price").text( result );
					target.closest( 'tr' ).remove();
			}
		});
	});
	
	/* --------------------- */
});
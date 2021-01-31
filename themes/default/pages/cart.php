<?php
	if( !isset( $_SESSION ) ) session_start();
	
	switch( $content['operation_answer'] ){
		case( -2 ):
			$_SESSION['low_credit'] = true;
			header( 'location: /cart/' );
			die();
			break;
		case( 1 ):
			$_SESSION['done'] = true;
			header( 'location: /cart/' );
			die();
			break;
	}
?>
<header>
	<a class="header-logo" href="/" title="چل تیکه"><img src="/includes/images/logo.png"></a>
	<menu class="main-menu">
	<?php if( !isset( $_SESSION ) ) session_start(); ?>
	<?php if( !isset( $_SESSION['login_user'] ) ): ?>
		<a href="/login/" title="ورود به حساب کاربری"><button class="button">ورود</button></a>
	<?php else: ?>
		<a href="/controlpanel/posts/" title="حساب کاربری"><button class="button bold">حساب کاربری</button></a>
	<?php endif; ?>
		<a href="/store/plans/" title="طرح ها"><button class="button">طرح ها</button></a>
		<a href="/store/modules/" title="ماژول ها"><button class="button">ماژول ها</button></a>
		<a href="/store/templates/" title="قالب های آماده"><button class="button">قالب ها</button></a>
		<a href="/contact/" title="تماس با ما"><button class="button">تماس با ما</button></a>
	<?php if( !isset( $_SESSION['login_user'] ) ): ?>
		<a href="http://blog.cheltikkeh.com" title="وبلاگ"><button class="button">وبلاگ</button></a>
		<a href="/register/" title="ثبت نام" class="circle-button">ثبت نام</a>
	<?php else: ?>
		<form method="POST" style="display: inline;"><button class="button" name="submit" value="logout">خروج</button></form>
	<?php endif; ?>
	</menu>
</header>
<content class="body">
	<div class="main">
		<div class="full-row cart white">
			<h3 class="right black-text">سبد خرید</h3>
			<h5 class="cart-title right">عنوان هر طرح، یا ماژول یا قالب آماده ای که انتخاب فرموده اید در لیست سبد خرید نوشته شده است. با کلیک بر روی عنوان هر کدام از آن ها، ماژول یا قالب آماده ی مورد نظر نمایش داده می شود تا شما آخرین بررسی های لازم را برای در اختیار گرفتن آنچه نیاز دارید انجام دهید.</h5>
			<?php if( $_SESSION['cart']['plans'] != NULL || $_SESSION['cart']['modules'] != NULL || $_SESSION['cart']['templates'] != NULL ): ?>
			<table class="cart-items-table">
				<tr>
					<td class="clear">
						<form method="POST">
							<button class="button icon remove" name="submit" value="clearcart"></button>
						</form>
					</td>
					<td class="bold">نام محصول</td>
					<td class="bold">شرح محصول</td>
					<td class="bold">قیمت محصول</td>
					<td class="bold">تخفیف محصول</td>
					<td class="bold">قیمت نهایی محصول</td>
				</tr>
				
				<?php if( !empty( $_SESSION['cart']['plans'] ) ): ?>
				<tr>
					<td><button class="button icon remove" type="plans" id="1"></button></td>
					<td class="items-title blue-text"><?php echo $_SESSION['cart']['plans']['title']; ?></td>
					<td>
					<?php
						$description = 'طرح '. intval( substr( $_SESSION['cart']['plans']['title'], 1, 2 ) ). ' ماهه، ';
						$description .= 'با '. $_SESSION['cart']['plans']['host']. ' مگابایت فضای میزبانی ';
						$description .= 'و '. $_SESSION['cart']['plans']['bandwidth']. ' گیگابایت ترافیک ماهیانه ';
						if( $_SESSION['cart']['plans']['credit'] != 0 )
							$description .= '+ '. $_SESSION['cart']['plans']['credit']. ' تومان اعتبار هدیه ';
						echo $description;
					?>
					</td>
					<td><?php echo number_format( $_SESSION['cart']['plans']['price'] / 10 ). ' تومان'; ?></td>
					<td><?php echo number_format( $_SESSION['cart']['plans']['price'] * ( $_SESSION['cart']['plans']['off'] ) / 1000 ) . ' تومان'; ?></td>
					<td><?php echo number_format( $_SESSION['cart']['plans']['price'] * ( 100 - $_SESSION['cart']['plans']['off'] ) / 1000 ) . ' تومان'; ?></td>
				</tr>
				<?php endif; ?>
				
				
				
				<?php if( !empty( $_SESSION['cart']['modules'] ) ): ?>
				
				<?php $keys = array_keys( $_SESSION['cart']['modules'] ); $c = 0; ?>
				
				<?php while( each( $keys ) ): ?>
				<tr>
					<td><button class="button icon remove" type="modules" id="<?php echo $keys[$c]; ?>"></td>
					<td class="items-title"><a href="/store/modules/<?php echo base64_encode( 'sh'. $_SESSION['cart']['modules'][$keys[$c]]['id']. 'ow' ); ?>" target="_blank"><?php echo $_SESSION['cart']['modules'][$keys[$c]]['title']; ?></a></td>
					<td>
					<img src="/includes/images/store/modules/<?php echo $_SESSION['cart']['modules'][$keys[$c]]['image']; ?>" style="height: 25px;" />
					</td>
					<td><?php echo number_format( $_SESSION['cart']['modules'][$keys[$c]]['price'] / 10 ). ' تومان'; ?></td>
					<td><?php echo number_format( $_SESSION['cart']['modules'][$keys[$c]]['price'] * ( $_SESSION['cart']['modules'][$keys[$c]]['off'] ) / 1000 ) . ' تومان'; ?></td>
					<td><?php echo number_format( $_SESSION['cart']['modules'][$keys[$c]]['price'] * ( 100 - $_SESSION['cart']['modules'][$keys[$c]]['off'] ) / 1000 ) . ' تومان'; ?></td>
				</tr>
				<?php $c++; endwhile; ?>
				
				<?php endif; ?>
				
				
				
				<?php if( !empty( $_SESSION['cart']['templates'] ) ): ?>
				
				<?php $keys = array_keys( $_SESSION['cart']['templates'] ); $c = 0; ?>
				
				<?php while( each( $keys ) ): ?>
				<tr>
					<td><button class="button icon remove" type="templates" id="<?php echo $keys[$c]; ?>"></td>
					<td class="items-title"><a href="/store/templates/<?php echo base64_encode( 'sh'. $_SESSION['cart']['templates'][$keys[$c]]['id']. 'ow' ); ?>" target="_blank"><?php echo $_SESSION['cart']['templates'][$keys[$c]]['title']; ?></a></td>
					<td>
					<img src="/includes/images/store/templates/<?php echo $_SESSION['cart']['templates'][$keys[$c]]['image']; ?>" style="height: 25px;" />
					</td>
					<td><?php echo number_format( $_SESSION['cart']['templates'][$keys[$c]]['price'] / 10 ). ' تومان'; ?></td>
					<td><?php echo number_format( $_SESSION['cart']['templates'][$keys[$c]]['price'] * ( $_SESSION['cart']['templates'][$keys[$c]]['off'] ) / 1000 ) . ' تومان'; ?></td>
					<td><?php echo number_format( $_SESSION['cart']['templates'][$keys[$c]]['price'] * ( 100 - $_SESSION['cart']['templates'][$keys[$c]]['off'] ) / 1000 ) . ' تومان'; ?></td>
				</tr>
				<?php $c++; endwhile; ?>
				
				<?php endif; ?>
			</table>
			<?php
				$cart_price = 0;
				if( !empty( $_SESSION['cart']['plans'] ) )
					$cart_price += $_SESSION['cart']['plans']['price'] * ( 100 - $_SESSION['cart']['plans']['off'] ) / 1000;
				
				if( !empty( $_SESSION['cart']['modules'] ) ){
					$keys = array_keys( $_SESSION['cart']['modules'] );
					$c = 0;
					while( each( $keys ) ){
						$cart_price += $_SESSION['cart']['modules'][$keys[$c]]['price'] * ( 100 - $_SESSION['cart']['modules'][$keys[$c]]['off'] ) / 1000;
						$c++;
					}
				}
				
				if( !empty( $_SESSION['cart']['templates'] ) ){
					$keys = array_keys( $_SESSION['cart']['templates'] );
					$c = 0;
					while( each( $keys ) ){
						$cart_price += $_SESSION['cart']['templates'][$keys[$c]]['price'] * ( 100 - $_SESSION['cart']['templates'][$keys[$c]]['off'] ) / 1000;
						$c++;
					}
				}
				
				$final_cart_price = $cart_price;
			?>
			<nav class="total right">
				<h4 class="right blue-text top-padding">جمع کل سبد خرید</h4>
				<h5 class="right">جمع کل سبد خرید:</h5>
				<h5 class="right cart-price"><?php echo number_format( $cart_price ). ' تومان'; ?></h5>
				<hr>
				<h5 class="right">کد تخفیف:</h5>
				<input class="discount" /><a></a>
				<hr>
				<h5 class="right red-text">مبلغ نهایی سبد خرید:</h5>
				<h5 class="right red-text final-cart-price"><?php echo number_format( $final_cart_price ). ' تومان'; ?></h5>
				<hr>
				<form method="POST">
					<nav>
						<input type="radio" id="credit" class="radio" name="type" value="credit" checked /><label for="credit">پرداخت از اعتبار</label><br>
						<input type="radio" id="cash" class="radio" name="type" value="cash" /><label for="cash">پرداخت از طریق درگاه اینترنتی</label>
					</nav>
					<button class="button texture light-red" name="submit" value="pay">تکمیل فرآیند خرید</button>
				</form>
				<?php if( !isset( $_SESSION ) ) session_start(); ?>
				<?php if( isset( $_SESSION['low_credit'] ) ): ?>
				<h5 class="cart-title right red-text">میزان اعتبار شما کافی نیست.</h5>
				<?php unset( $_SESSION['low_credit'] ); ?>
				<?php endif; ?>
			</nav>
			<?php else: ?>
				<?php if( !isset( $_SESSION ) ) session_start(); ?>
				<?php if( isset( $_SESSION['done'] ) ): ?>
				<h5 class="cart-title right green-text">سبد خرید با موفقیت خریداری شد.</h5>
				<?php unset( $_SESSION['done'] ); ?>
				<?php else: ?>
				<h5 class="cart-title right red-text">سبد خرید شما در حال حاضر خالی است.</h5>
				<?php endif; ?>
			<?php endif; ?>
		</div>
	</div>
</content>

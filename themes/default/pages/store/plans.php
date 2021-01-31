<header>
	<a class="header-logo" href="/" title="چل تیکه"><img src="/includes/images/logo.png"></a>
	<menu class="main-menu">
	<?php if( !isset( $_SESSION ) ) session_start(); ?>
	<?php if( !isset( $_SESSION['login_user'] ) ): ?>
		<a href="/login/" title="ورود به حساب کاربری"><button class="button">ورود</button></a>
	<?php else: ?>
		<a href="/controlpanel/posts/" title="حساب کاربری"><button class="button bold">حساب کاربری</button></a>
	<?php endif; ?>
		<a href="/store/modules/" title="ماژول ها"><button class="button">ماژول ها</button></a>
		<a href="/store/templates/" title="قالب های آماده"><button class="button">قالب ها</button></a>
		<a href="/contact/" title="تماس با ما"><button class="button">تماس با ما</button></a>
	<?php if( isset( $_SESSION['login_user'] ) ): ?>
		<a href="/cart/" title="سبد خرید"><button class="button">سبد خرید</button></a>
		<form method="POST"><button class="button" name="submit" value="logout">خروج</button></form>
	<?php else: ?>
		<a href="http://blog.cheltikkeh.com" title="وبلاگ"><button class="button">وبلاگ</button></a>
		<a href="/register/" title="ثبت نام" class="circle-button">ثبت نام</a>
	<?php endif; ?>
	</menu>
</header>
<content class="body">
	<div class="main">
		<div class="full-row white">
			<h3 class="row-topic blue-text">طرح های استفاده از سامانه « چل تیکه »</h3>
			<h5 class="row-title gray-text">تیم « چل تیکه » طرح های مختلفی را برای کاربردهای متفاوت به شرح زیر ارائه می کند تا کاربران بتوانند به تناسب نیاز خود دوره زمانی مورد نیاز، میزان فضای میزبانی و یا پهنای باند مورد نیاز خود را اانتخاب کنند و مجبور به پرداخت هزینه ی بیشتر از نیازشان نباشند. این طرح ها در بسته های زمانی 3 ماه، 6 ماه و 12 ماه ( یک سال ) در اختیار شما خواهد بود تا با انتخاب حجم فضای میزبانی و پهنای باند مورد نیازتان بسته ی دلخواه خود را خریداری نمایید.</h5>
			<nav class="plans">
			<?php for( $c = 1; $c <= $content['nums']; $c++ ): ?>
				<?php
					switch( intval( substr( $content[$c]['title'], 1, 2 ) ) ){
						case( 3 ):
							$class = 'P3M';
							$color = 'green';
							break;
						case( 6 ):
							$class = 'P6M';
							$color = 'orange';
							break;
						case( 12 ):
							$class = 'P12M';
							$color = 'blue';
							break;
					}
				?>
				
				<div class="plans-item">
					<div class="plans-item">
						<h5 class="plans-item-title black-text"><?php echo $content[$c]['title']; ?></h5>
						<div class="square terms white h-<?php echo $color; ?>-border <?php echo $class; ?>">
						<?php if( isset( $_SESSION['login_user'] ) ): ?>
						<button class="button icon addtocart <?php echo $class; ?>" type="<?php echo $page['sub']; ?>" id="<?php echo $content[$c]['id']; ?>"></button>
						<?php endif; ?>
						</div>
						<?php if( $content[$c]['off'] > 0 ): ?>
						<p class="plans-item-off"><?php echo '%'. $content[$c]['off']; ?></p>
						<?php endif; ?>
						<p class="plans-item-text top-padding">قیمت: <?php echo number_format( $content[$c]['price'] / 10 ); ?> تومان</p>
						<hr class="square-line <?php echo $color; ?>-border" />
						<p class="plans-item-text final-price red-text">قیمت نهایی: <?php echo number_format( ( $content[$c]['price'] * ( 100 - $content[$c]['off'] ) ) / 1000 ); ?> تومان</p>
						<p class="plans-item-text h-<?php echo $color; ?>-border">
							<?php echo $content[$c]['host']; ?> مگابایت فضای میزبانی
							<br>
							<?php echo $content[$c]['bandwidth']; ?> گیگابایت ترافیک ماهیانه
							<br>
							اعتبار هدیه: <?php echo $content[$c]['credit']; ?> تومان
						</p>
					</div>
				</div>
			<?php endfor; ?>
			</nav>
		</div>
	</div>
</content>

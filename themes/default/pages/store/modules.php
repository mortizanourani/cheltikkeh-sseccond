<?php if( isset( $content['nums'] ) ): ?>
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
		<a href="/store/templates/" title="قالب ها"><button class="button">قالب ها</button></a>
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
	<div class="background about-header"></div>



	<div class="main">
		<div class="full-row white">
			<h3 class="row-topic blue-text">ماژول های سامانه « چل تیکه »</h3>
			<h5 class="row-title gray-text">این ماژول ها که توسط تیم « چل تیکه » منطبق بر استانداردهای روز جهان طراحی و آماده شده اند، همچون تکه های پازل عمل کرد و این امکان را به شما می دهند که با کنار هم قرار دادن آنها، صفحات وبسایت خود را به سادگی و بدون نیاز به دانش فنی، طبق سلیقه خود طراحی نمایید.</h5>
			<nav class="modules">
			<?php for( $c = 1; $c <= $content['nums']; $c++ ): ?>
				<?php
					switch( $content[$c]['type'] ){
						case( 'header' ):
							$class = 'P0';
							$color = 'green';
							break;
						case( 'content' ):
							$class = 'P1';
							$color = 'orange';
							break;
						case( 'footer' ):
							$class = 'P2';
							$color = 'blue';
							break;
						case( 'float' ):
							$class = 'P3';
							$color = 'red';
							break;
					}
				?>
				
				<div class="modules-item">
					<h5 class="modules-item-title black-text"><?php echo $content[$c]['title']; ?></h5>
					
					<div class="square-box">
					<div class="square h-<?php echo $color; ?>-border <?php echo $class; ?>">
					<?php if( isset( $_SESSION['login_user'] ) && !$content[$c]['owned'] ): ?>
					<button class="button icon addtocart <?php echo $class; ?>" type="<?php echo $page['sub']; ?>" id="<?php echo $content[$c]['id']; ?>"></button>
					<?php endif; ?>
					<a href="<?php echo base64_encode( 'sh'. $content[$c]['id']. 'ow' ); ?>" target="_blank"><button class="button icon preview <?php echo $class; ?>"></button></a>
					<img src="/includes/images/store/modules/<?php echo $content[$c]['image']; ?>" />
					</div>
					</div>
					
					<?php if( $content[$c]['off'] > 0 ): ?>
					<p class="modules-item-off"><?php echo '%'. $content[$c]['off']; ?></p>
					<?php endif; ?>
					<p class="modules-item-text top-padding">قیمت: <?php echo number_format( $content[$c]['price'] / 10 ); ?> تومان</p>
					<hr class="square-line <?php echo $color; ?>-border" />
					<p class="modules-item-text final-price red-text">قیمت نهایی: <?php echo number_format( ( $content[$c]['price'] * ( 100 - $content[$c]['off'] ) ) / 1000 ); ?> تومان</p>
					<?php if( !empty( $content[$c]['description'] ) ): ?>
					<p class="modules-item-text h-<?php echo $color; ?>-border">
						<?php echo $content[$c]['description']; ?>
					</p>
					<?php endif; ?>
				</div>
			<?php endfor; ?>
			</nav>
		</div>
	</div>
</content>
<?php else: ?>
<content class="body">
	<div class="main">
		<?php echo '<style>'. base64_decode( $content['css'] ). '</style>'. base64_decode( $content['html'] ); ?>
	</div>
</content>
<?php endif; ?>


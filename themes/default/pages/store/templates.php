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
			<a href="/store/modules/" title="ماژول ها"><button class="button">ماژول ها</button></a>
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
				<h3 class="row-topic blue-text">قالب های آماده ی « چل تیکه »</h3>
				<h5 class="row-title gray-text">این قالب ها توسط تیم « چل تیکه » و با استفاده از ماژول های موجود در سامانه سایت ساز « چل تیکه » طراحی و آماده شده اند. شما می توانید به سادگی و با استفاده از این قالب های آماده در وقت خود صرفه جویی کرده و سایت خود را آماده نمایید. پس از در اختیار گرفتن هر کدام از این قالب های آماده، می توانید از طریق سامانه « چل تیکه » در صفحه ی طراحی قالب همین قالب ها را به رنگ و تنظیمات دلخواه خود برگردانده و سایت خود را بسازید.</h5>
				<nav class="templates">
				<?php for( $c = 1; $c <= $content['nums']; $c++ ): ?>
					<?php
						switch( $c % 4 ){
							case( 1 ):
								$class = 'P0';
								$color = 'green';
								break;
							case( 2 ):
								$class = 'P1';
								$color = 'orange';
								break;
							case( 3 ):
								$class = 'P2';
								$color = 'blue';
								break;
							case( 0 ):
								$class = 'P3';
								$color = 'red';
								break;
						}
					?>
					
					<div class="templates-item">
						<h5 class="templates-item-title black-text"><?php echo $content[$c]['title']; ?></h5>
						
						<div class="square-box">
						<div class="square h-<?php echo $color; ?>-border <?php echo $class; ?>">
						<?php if( isset( $_SESSION['login_user'] ) && !$content[$c]['owned'] ): ?>
						<button class="button icon addtocart <?php echo $class; ?>" type="<?php echo $page['sub']; ?>" id="<?php echo $content[$c]['id']; ?>"></button>
						<?php endif; ?>
						<a href="<?php echo base64_encode( 'sh'. $content[$c]['id']. 'ow' ); ?>" target="_blank"><button class="button icon preview <?php echo $class; ?>"></button></a>
						<img src="/includes/images/store/templates/<?php echo $content[$c]['image']; ?>" />
						</div>
						</div>
						
						<?php if( $content[$c]['off'] > 0 ): ?>
						<p class="templates-item-off"><?php echo '%'. $content[$c]['off']; ?></p>
						<?php endif; ?>
						<p class="templates-item-text top-padding">قیمت: <?php echo number_format( $content[$c]['price'] / 10 ); ?> تومان</p>
						<hr class="square-line <?php echo $color; ?>-border" />
						<p class="templates-item-text final-price red-text">قیمت نهایی: <?php echo number_format( ( $content[$c]['price'] * ( 100 - $content[$c]['off'] ) ) / 1000 ); ?> تومان</p>
						<?php if( !empty( $content[$c]['sponsor'] ) ): ?>
						<p class="templates-item-text h-<?php echo $color; ?>-border">
							این قالب به سفارش شرکت <a href="http://<?php echo $content[$c]['sponsor_link']; ?>" target="_blank"><?php echo $content[$c]['sponsor']; ?></a> طراحی و آماده شده است.
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
			<?php
				if( isset( $content['html'] ) ){
					$html = base64_decode( $content['html'] );
					$replacements = 'ondragover="dragover( event, $(this) )"';
					$html = str_replace( $replacements, "", $html );
					echo $html;
				}
			?>
		</div>
	</content>
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<script>
		$(document).ready( function(){
			$(".module-row").removeClass();
			$(".module-column").removeClass();
			$(".module-place").removeClass();
			$(".module").removeClass();
			$(".module-place-menu").remove();
		});
	</script>
	
<?php endif; ?>
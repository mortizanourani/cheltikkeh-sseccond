<header>
	<a class="header-logo" href="/" title="چل تیکه"><img src="/includes/images/logo.png"></a>
	<menu class="main-menu">
	<?php if( !isset( $_SESSION ) ) session_start(); ?>
	<?php if( !isset( $_SESSION['login_user'] ) ): ?>
		<a href="/login/" title="ورود به حساب کاربری"><button class="button">ورود</button></a>
	<?php else: ?>
		<a href="/controlpanel/posts/" title="حساب کاربری"><button class="button bold">حساب کاربری</button></a>
	<?php endif; ?>
		<a href="/terms/" title="قوانین و مقررات"><button class="button">قوانین</button></a>
		<a href="/store/plans/" title="طرح ها"><button class="button">طرح ها</button></a>
		<a href="/store/templates/" title="قالب های آماده"><button class="button">قالب ها</button></a>
		<a href="/about/" title="درباره ما"><button class="button">درباره ما</button></a>
	<?php if( !isset( $_SESSION['login_user'] ) ): ?>
		<a href="http://blog.cheltikkeh.com" title="وبلاگ"><button class="button">وبلاگ</button></a>
		<a href="/register/" title="ثبت نام" class="circle-button">ثبت نام</a>
	<?php else: ?>
		<form method="POST" style="display: inline;"><button class="button" name="submit" value="logout">خروج</button></form>
	<?php endif; ?>
	</menu>
</header>
<content class="body">
	<script>
		$(window).scroll( function(){
			if( $(window).scrollTop() < 50 ){
				$(".gotop").hide();
			}else{
				$(".gotop").show();
			}
		});
	</script>
	
	
	
	<div class="main">
		<div class="full-row h-features faq white">
			<h3 class="faq-topic">سوالات متداول</h3>
			<h5 class="h-features-title">اینجا صفحه ی سوالاتی است که عموما پرسیده می شوند و به درک بهتر شما از چل تیکه کمک خواهند کرد. در لیست زیر با کلیک روی هر کدام از موارد می توانید پاسخ سوال مورد نظرتان را بیابید.</h5>
			<?php for( $c = 1; $c <= $content['nums']; $c++ ): ?>
				<a href="#<?php echo base64_encode( 'Q'. $c . 'A' ); ?>"><h5 class="question"><?php echo $content[$c]['question']; ?></h5></a><br>
			<?php endfor; ?>
		</div>



		<div class="full-row h-features faq-answers gray" id="<?php echo $c; ?>">
		<?php for( $c = 1; $c <= $content['nums']; $c++ ): ?>
			<?php $cn = $c % 4;
				switch( $cn ){
					case( 1 ):
						$color = 'red';
						break;
					case( 2 ):
						$color = 'blue';
						break;
					case( 3 ):
						$color = 'orange';
						break;
					case( 0 ):
						$color = 'green';
						break;
				}
			?>
			<div class="h-features-row" id="<?php echo base64_encode( 'Q'. $c. 'A' ); ?>">
				<div class="little-circle <?php echo $color; ?>-border"><?php echo $c; ?></div>
				<nav class="h-features-col">
					<h5 class="h-features-col-title"><?php echo $content[$c]['question']; ?></h5>
					<hr class="little-circle-line <?php echo $color; ?>-border">
					<p class="h-features-col-text h-<?php echo $color; ?>-border"><?php echo str_replace( "\n", '<br>', $content[$c]['answer'] ); ?></p>
				</nav>
			</div>
		<?php endfor; ?>
		</div>
		
		
		
		<a class="gotop h-red-border" href="#"></a>
	</div>
</content>
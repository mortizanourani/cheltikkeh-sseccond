<?php
	if( !isset( $_SESSION ) ) session_start();
	
	if( isset( $_SESSION['login_user'] ) ) header( 'location: /' );
	
	switch( $content['operation_answer'] ){
		case( -1 ):
			$_SESSION['not_valid'] = true;
			header( 'location: /forget/' );
			die();
			break;
	}
?>
<header>
	<a class="header-logo" href="/" title="چل تیکه"><img src="/includes/images/logo.png"></a>
	<menu class="main-menu">
		<a href="/terms/" title="قوانین و مقررات"><button class="button">قوانین</button></a>
		<a href="/store/plans/" title="طرح ها"><button class="button">طرح ها</button></a>
		<a href="/store/templates/" title="قالب های آماده"><button class="button">قالب ها</button></a>
		<a href="/about/" title="درباره ما"><button class="button">درباره ما</button></a>
		<a href="http://blog.cheltikkeh.com" title="وبلاگ"><button class="button">وبلاگ</button></a>
	</menu>
</header>
<content class="body">
	<div class="background forget-header"></div>



	<div class="main">
		<div class="center features white-shadow forget">
			<h3 class="features-topic forget-topic blue-text">بازیابی رمز ورود به سامانه « چل تیکه »</h3>
			<div class="forget-col">
				<h4 class="forget-col-title black-text">روند بازیابی رمز عبور چگونه است؟</h4>
				<h5 class="forget-col-text black-text">
				جهت بازیابی رمزعبور خود، پست الکترونیکی که با آن در سامانه سایت ساز « چل تیکه » ثبت نام کرده اید را در فرم مقابل وارد نمایید.
				
				سپس بر روی کلید « ارسال لینک بازسازی رمزعبور » کلیک نمایید.
				<br>
				چنانچه پست الکترونیک وارد شده صحیح باشد، یک لینک جهت ایجاد رمزعبور جدید، به همین پست الکترونیک ارسال می گردد.
				</h5>
				<br>
				<br>
				<h4 class="forget-col-title black-text">چرا بازیابی رمزعبور به این شکل است؟</h4>
				<h5 class="forget-col-text black-text">
				سامانه سایت ساز « چل تیکه » جهت حفظ امنیت اطلاعات شما، رمزعبور شما را به وسیله الگوریتم های محافظت متن، تبدیل به عبارتی گنگ و ناشناخته می کند.
				<br>
				این عمل یک طرفه بوده و امکان بازگشت ندارد. به این دلیل سامانه « چل تیکه » قادر به بازسازی رمزعبور پیشین شما نخواهد بود.
				</h5>
			</div>

			<form method="POST" class="shadow4">
				<h5 class="row-title right white-text">پست الکترونیک</h5>
				<input type="text" class="text ltr h-blue-border white-text" name="email" placeholder="پست الکترونیک" required />
				<h5 class="forget-col-text error red-text">پست الکترونیک وارد شده معتبر نیست.</h5>
				<br><br><br>
				<?php if( isset( $_SESSION['not_valid'] ) ): ?>
				<h5 class="forget-col-text red-text">در سامانه « چل تیکه » هیچ نام کاربری، با پست الکترونیک وارد شده وجود ندارد.</h5>
				<?php unset( $_SESSION['not_valid'] ); else: ?>
				<br><br><br>
				<?php endif; ?>
				
				<button class="button texture submit green white-text" name="submit" value="forget">ارسال لینک بازسازی رمزعبور</button>
			</form>
		</div>
	</div>
</content>

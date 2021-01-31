<?php
	if( !isset( $_SESSION ) ) session_start();
	
	if( isset( $_SESSION['login_user'] ) ) header( 'location: /' );
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
	<div class="background token-header"></div>



	<div class="main">
		<div class="center features white-shadow token">
			<h3 class="features-topic token-topic blue-text">بازسازی رمز ورود به سامانه « چل تیکه »</h3>
			<div class="token-col">
				<h4 class="token-col-title black-text">روند بازسازی رمز عبور چگونه است؟</h4>
				<h5 class="token-col-text black-text">
				برای ایجاد رمزعبور جدید، به منظور ورود به سامانه ی سایت ساز « چل تیکه »، پس از وارد کردن رمزعبور جدید و تکرار آن در فرم مقابل بر روی کلید « تایید رمزعبور جدید » کلیک نمایید.
				</h5>
				<br>
				<br>
				<h4 class="token-col-title black-text">چرا کلید مورد نظر دیده نمی شود؟</h4>
				<h5 class="token-col-text black-text">
				ژتون هایی که جهت ایجاد رمزعبور جدید مورد استفاده قرار می گیرند، یکتا بوده و تنها برای یک پست الکترونیک معتبر است.
				<br>
				همچنین هر ژتون، تنها 15 دقیقه اعتبار دارد و پس از آن منقضی تلقی می شود. این زمان از لحظه ی ارسال محاسبه می شود.
				<br>
				علاوه بر این، ژتون های تغییر رمزعبور یکبار مصرف بوده و هر کدام از آنها پس از تایید رمزعبور جدید، غیرفعال می شود.
				</h5>
			</div>

			<form method="POST" class="shadow4">
				<h5 class="row-title right white-text">رمزعبور جدید</h5>
				<input type="password" class="text ltr h-blue-border white-text" id="password" name="password" placeholder="رمزعبور جدید" required />
				<h5 class="token-col-text error red-text">رمزعبور وارد شده معتبر نیست.</h5>
				<input type="password" class="text ltr h-green-border white-text" id="password-retype" name="password-retype" placeholder="تکرار رمزعبور جدید" required />
				<h5 class="token-col-text error red-text">رمزعبور و تکرار آن یکسان نیستند.</h5>
				<br><br><br>
				<?php if( $content['operation_answer'] > 0 ): ?>
				<button class="button texture submit light-blue white-text" name="submit" value="change">تایید رمزعبور جدید</button>
				<?php elseif( $content['operation_answer'] === -1 ): ?>
				<h5 class="token-col-text red-text">ژتون های تغییر رمزعبور، رشته های مشخصی هستند.<br>این ژتون معتبر نمی باشد.</h5><br>
				<?php elseif( $content['operation_answer'] === -2 ): ?>
				<h5 class="token-col-text red-text">ژتون های تغییر رمزعبور یکبار مصرف هستند.<br>این ژتون قبلا مورد استفاده قرار گرفته است.</h5><br>
				<?php elseif( $content['operation_answer'] === -3 ): ?>
				<h5 class="token-col-text red-text">هر ژتون از لحظه ی ارسال 15 دقیقه اعتبار دارد.<br>این ژتون منقضی شده است.</h5><br>
				<?php endif; ?>
				
			</form>
		</div>
	</div>
</content>

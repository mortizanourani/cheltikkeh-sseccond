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
	<div class="background help-header"></div>



	<div class="main">
		<div class="full-row help white-shadow">
			<h3 class="help-topic blue-text">راهنمای استفاده از چل تیکه</h3>
			<h5 class="help-title h-red-border">گر چه سامانه سایت ساز چل تیکه تا حد ممکن ساده و مطابق با پیش فرض های ذهنی افراد ساخته شده است اما با این حال تیم چل تیکه در حال آماده سازی آموزش های استفاده از این سامانه ی سایت ساز در دو فرمت متنی و ویدیویی هستند تا استفاده از این سامانه را برای شما ساده تر از پیش کنند.</h5>
		</div>
	</div>
</content>

<header>
	<a class="header-logo" href="/" title="چل تیکه"><img src="/includes/images/logo.png"></a>
	<menu class="main-menu">
	<?php if( !isset( $_SESSION ) ) session_start(); ?>
	<?php if( !isset( $_SESSION['login_user'] ) ): ?>
		<a href="/login/" title="ورود به حساب کاربری"><button class="button">ورود</button></a>
	<?php endif; ?>
		<a href="/terms/" title="قوانین و مقررات"><button class="button">قوانین</button></a>
		<a href="/about/" title="درباره ما"><button class="button">درباره ما</button></a>
		<a href="/contact/" title="تماس با ما"><button class="button">تماس با ما</button></a>
		<a href="http://blog.cheltikkeh.com" title="وبلاگ"><button class="button">وبلاگ</button></a>
		<a href="/register/" title="ثبت نام" class="btnregister">ثبت نام</a>
	</menu>
</header>
<content class="body">
	<div class="background permission-header"></div>



	<div class="permission">
		<div class="full-row white-shadow">
			<h1 class="header-topic red-text">این صفحه برای شما مجاز نیست</h1>
			<h5 class="permission-title gray-text">برای مشاهده ی این صفحه نیاز به ورود به حساب کاربری خود دارید. چنانچه هنوز در سامانه « چل تیکه » ثبت نام نکرده اید پس از مطالعه <a href="/terms/">قوانین</a> از طریق صفحه ی <a href="/register/">ثبت نام</a> نسبت به ایجاد حساب کاربری اقدام نموده و سپس به حساب کاربری خود <a href="/login/">ورود</a> کنید.<br>با احترام، <a href="/">« چل تیکه »</a></h5>
		</div>
	</div>
</content>
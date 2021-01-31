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
	<div class="background notfound-header"></div>



	<div class="main">
		<div class="full-row white-shadow">
			<h1 class="header-topic blue-text">صفحه مورد نظر یافت نشد</h1>
			<h5 class="features-title gray-text">صفحه ای با این آدرس وجود ندارد. اگر از لینک های خارج از سایت چل تیکه به این صفحه ارجاع داده شده اید لطفا از صفحه ی <a href="/contact/">تماس با ما</a> این مساله را اطلاع دهید.<br>با احترام، <a href="/">« چل تیکه »</a></h5>
		</div>
	</div>
</content>
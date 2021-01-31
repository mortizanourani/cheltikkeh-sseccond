<header>
	<a class="header-logo" href="http://cheltikkeh.com" title="چل تیکه"><img src="http://cheltikkeh.com/includes/images/logo.png"></a>
	<menu class="main-menu">
	<?php if( !isset( $_SESSION ) ) session_start(); ?>
	<?php if( !isset( $_SESSION['login_user'] ) ): ?>
		<a href="http://cheltikkeh.com/login/" title="ورود به حساب کاربری"><button class="button">ورود</button></a>
	<?php endif; ?>
		<a href="http://cheltikkeh.com/terms/" title="قوانین و مقررات"><button class="button">قوانین</button></a>
		<a href="http://cheltikkeh.com/about/" title="درباره ما"><button class="button">درباره ما</button></a>
		<a href="http://cheltikkeh.com/contact/" title="تماس با ما"><button class="button">تماس با ما</button></a>
		<a href="http://blog.cheltikkeh.com" title="وبلاگ"><button class="button">وبلاگ</button></a>
		<a href="http://cheltikkeh.com/register/" title="ثبت نام" class="btnregister">ثبت نام</a>
	</menu>
</header>
<content class="body">
	<div class="background user-undefined-header"></div>



	<div class="main">
		<div class="full-row shadow4">
			<h1 class="header-topic white-text">حساب کاربری یافت نشد</h1>
			<h5 class="features-title gray-text h-white-border">
				این صفحه برای نمایش صفحه های طراحی شده توسط کاربران است و کارایی سامانه ی سایت ساز <a href='http://cheltikkeh.com/'>« چل تیکه »</a> را به نمایش می گذارد.
				<br>
				برای مشاهده وبسایت طراحی شده توسط خودتان لازم است از صفحه ی  <a href="http://cheltikkeh.com/login/">« ورود به حساب کاربری »</a> استفاده نمایید و به حساب کاربری خود ورود نمایید.
				<br>با احترام، <a href='http://cheltikkeh.com/'>« چل تیکه »</a>
			</h5>
		</div>
	</div>
</content>
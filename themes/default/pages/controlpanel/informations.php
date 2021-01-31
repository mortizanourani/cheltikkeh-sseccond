<?php
	if( !isset( $_SESSION ) ) session_start();
	
	switch( $content['operation_answer'] ){
		case( 1 ):
			$_SESSION['informations_updated'] = true;
			header( 'location: /controlpanel/informations/' );
			die();
			break;
	}
?>
<header class="header">
	<a class="header-logo" href="/" title="چل تیکه"><img src="/includes/images/logo.png"></a>
	<menu class="main-menu">
		<a href="/store/modules/" title="ماژول ها"><button class="button">ماژول ها</button></a>
		<a href="/store/templates/" title="قالب ها"><button class="button">قالب ها</button></a>
		<a href="/cart/" title="سبد خرید"><button class="button">سبد خرید</button></a>
		<form method="POST"><button class="button" name="submit" value="logout">خروج</button></form>
	</menu>
</header>
<content class="body">
	<div class="sidebar right white">
		<a href="/controlpanel/posts/"><button class="button right">مدیریت پست ها</button></a>
		<a href="/controlpanel/photos/"><button class="button right">مدیریت عکس ها</button></a>
		<a href="/controlpanel/pages/"><button class="button right">مدیریت صفحه ها</button></a>
		<a href="/designer/"><button class="button right" style="color: rgba(250, 50, 50, 1);">مدیریت ظاهر صفحه ها</button></a>
		<a href="/controlpanel/messages/"><button class="button right">صندوق پیام ها</button></a>
		<a><button class="button right" disabled>اطلاعات حساب کاربری</button></a>
		<a href="/controlpanel/password/"><button class="button right">تغییر رمز عبور</button></a>
		<a href="/controlpanel/transactions/"><button class="button right">تراکنش ها</button></a>
		<a href="/controlpanel/status/"><button class="button right">وضعیت طرح ها</button></a>
		<a href="/controlpanel/support/"><button class="button right">پشتیبانی</button></a>
	</div>
	
	
	
	<div class="main">
		<div class="informations right">
			<h4 class="controlpanel-topic right">
			اطلاعات حساب کاربری
			<hr class="square-line green-border" />
			</h4>
			<div class="informations-col right-col">
				<h5 class="controlpanel-title right gray-text">
				اطلاعات حساب کاربری شما جهت شناسایی شما و در صورت نیاز به تماس با شما مورد استفاده قرار می گیرند.
				این اطلاعات، طبق قوانین « حریم خصوصی » که در صفحه ی قوانین سایت ذکر شده است در اختیار هیچ کس قرار نمی گیرند.
				<nav class="center">
				<a href="/terms/"><button class="button texture light-orange">قوانین حریم خصوصی</button></a>
				</nav>
				<br>
				<font class="blue-text">
				اطلاعات فردی شما می توانند، حقیقی و یامستعار باشند. از دید کارشناسان « چل تیکه » این اطلاعات، حقیقی بوده و شما با این نام شناخته می شود.
				<br>
				<font class="red-text">پیشنهاد می کنیم از نام حقیقی خود استفاده نمایید.</font>
				<br>
				<br>
				اطلاعات تماس شما مهمترین اطلاعاتی است که سامانه ی سایت ساز « چل تیکه » به آن احتیاج دارد.
				این اطلاعات برای اطلاع تاریخ اتمام طرح ها، ارسال پیوند ( لینک ) بازیابی رمزعبور و دیگر اموری که نیاز به تماس با شما داشته باشند استفاده می گردند.
				<br>
				<font class="red-text">در وارد کردن پست الکترونیک و شماره تماس خود دقت فرمایید.</font>
				<br>
				<br>
				اطلاعات وبسایت شما، اطلاعاتی است که به وسیله ی ماژول های مربوطه در وبسایت شما نمایش داده می شود.
				عنوان ( title ) وبسایت شما، همان نام وبسایت شما به حساب می آید و توضیحات ( description ) وبسایت شما، اطلاعاتی مختصر درباره ی زمینه کاری سایت شما است.
				</font>
				</h5>
			</div>
			<div class="informations-col left-col right">
				<form class="informations-form center" method="POST" target="">
					<h5 class="right">اطلاعات فردی</h5>
					<input type="text" class="text blue-text h-orange-border rtl" name="firstname" placeholder="نام" value="<?php echo $content['firstname']; ?>" required />
					<input type="text" class="text blue-text h-red-border rtl" name="lastname" placeholder="نام خانوادگی" value="<?php echo $content['lastname']; ?>" required />
					<h5 class="right">اطلاعات تماس</h5>
					<input type="email" class="text blue-text h-blue-border ltr" id="email" name="email" placeholder="پست الکترونیک" value="<?php echo $content['email']; ?>" required />
					<h5 class="form-error red-text">پست الکترونیک وارد شده معتبر نیست.</h5>
					<h5 class="form-instruction right gray-text">شماره تماس باید 11 رقمی و بدون خط یا فاصله باشد.</h5>
					<input type="phone" class="text blue-text h-green-border ltr" id="phone" name="phone" placeholder="شماره تماس" value="<?php echo $content['phone']; ?>" required />
					<h5 class="form-error red-text">شماره تماس وارد شده معتبر نیست.</h5>
					<h5 class="right">اطلاعات وبسایت</h5>
					<input type="text" class="text blue-text h-orange-border" name="title" placeholder="عنوان سایت شما" value="<?php echo $content['title']; ?>" required />
					<textarea class="text blue-text h-red-border" rows="3" name="description" placeholder="توضیحی مختصر درباره سایت شما" required ><?php echo $content['description']; ?></textarea>
					
					<?php if( !isset( $_SESSION ) ) session_start(); ?>
					<?php if( isset( $_SESSION['informations_updated'] ) ): ?>
						<h5 class="controlpanel-title result green-text">اطلاعات حساب کاربری با موفقیت به روز رسانی شد.</h5>
						<?php unset( $_SESSION['informations_updated'] ); ?>
					<?php endif; ?>
					<button class="button texture submit blue white-text center" name="submit" value="informations">به روز رسانی اطلاعات حساب کاربری</button>
				</form>
			</div>
		</div>
	</div>
</content>
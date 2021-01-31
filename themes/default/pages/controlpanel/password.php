<?php
	if( !isset( $_SESSION ) ) session_start();
	
	switch( $content['operation_answer'] ){
		case( -1 ):
			unset( $_SESSION['password_changed'] );
			$_SESSION['wrong_password'] = true;
			header( 'location: /controlpanel/password/' );
			die();
			break;
			
		case( 1 ):
			unset( $_SESSION['wrong_password'] );
			$_SESSION['password_changed'] = true;
			header( 'location: /controlpanel/password/' );
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
		<a href="/controlpanel/informations/"><button class="button right">اطلاعات حساب کاربری</button></a>
		<a><button class="button right" disabled>تغییر رمز عبور</button></a>
		<a href="/controlpanel/transactions/"><button class="button right">تراکنش ها</button></a>
		<a href="/controlpanel/status/"><button class="button right">وضعیت طرح ها</button></a>
		<a href="/controlpanel/support/"><button class="button right">پشتیبانی</button></a>
	</div>
	
	
	
	<div class="main">
		<div class="password right">
			<h4 class="controlpanel-topic right">
			تغییر رمز عبور
			<hr class="square-line blue-border" />
			</h4>
			<div class="password-col right-col">
				<h5 class="controlpanel-title right gray-text">
				آنچه شما را به سامانه سایت ساز « چل تیکه » معرفی می کند، نام کاربری و رمز عبور شما است.
				رمز عبور شما، کلید ورود به « حساب کاربری » شما، مهمترین عنصر در به هم پیوستگی اطلاعات شما و تنها راه تغییر و یا دسترسی به این اطلاعات می باشد.
				<br>
				<br>
				<br>
				<br>
				<font class="red-text">بنا بر این پیشنهاد می کنیم:</font>
				<br>
				<font class="blue-text">
				1. از در اختیار دیگران قرار دادن رمز عبور خود جدا پرهیز نمایید.
				<br>
				2. رمز عبوری پیچیده، طولانی و متشکل از حروف، اعداد و علائم انتخاب نمایید.
				<br>
				3. به صورت دوره ای <font class="red-text">( به عنوان مثال هر 3 ماه یک بار )</font> نسبت به تغییر آن اقدام نمایید.
				</font>
				</h5>
			</div>
			<div class="password-col left-col right">
				<form class="password-form center" method="POST" target="">
					<input type="password" class="text blue-text h-green-border ltr" id="current" name="current" placeholder="رمز عبور کنونی" required />
					<input type="password" class="text blue-text h-orange-border ltr" id="password" name="password" placeholder="رمز عبور جدید" required />
					<h5 class="form-error red-text">رمز عبور وارد شده نا معتبر است. رمز عبور باید حداقل 8 کارکتر باشد.</h5>
					<input type="password" class="text blue-text h-red-border ltr" id="password-retype" name="password-retype" placeholder="تکرار رمز عبور جدید" required />
					<h5 class="form-error red-text">دو رمز عبور وارد شده یکسان نیستند.</h5>
					
					<?php if( !isset( $_SESSION ) ) session_start(); ?>
					<?php if( isset( $_SESSION['password_changed'] ) ): ?>
						<h5 class="controlpanel-title result green-text">رمز عبور با موفقیت به روز رسانی شد.</h5>
						<?php unset( $_SESSION['password_changed'] ); ?>
					<?php elseif( isset( $_SESSION['wrong_password'] ) ): ?>
						<h5 class="controlpanel-title result red-text">رمز عبور وارد شده نا درست است.</h5>
						<?php unset( $_SESSION['wrong_password'] ); ?>
					<?php endif; ?>
					<button class="button texture submit green white-text center" name="submit" value="change">به روز رسانی رمز عبور</button>
				</form>
			</div>
		</div>
	</div>
</content>
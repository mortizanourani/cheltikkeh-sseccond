<?php
	if( !isset( $_SESSION ) ) session_start();
	
	switch( $content['operation_answer'] ){
		case( 1 ):
			header( 'location: /login/' );
			break;
			
		case( -1 ):
			$_SESSION['login_fail'] = true;
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
	<div class="background register-header"></div>



	<div class="main">
		<div class="full-row center features shadow4 register">
			<h3 class="features-topic register-topic white-text">ثبت نام در سامانه سایت ساز «چل تیکه»</h3>
			<div class="register-col">
				<h4 class="white-text register-col-title">قوانین «چل تیکه » را مطالعه نموده اید؟</h4>
				<h5 class="register-col-text white-text">ثبت نام در سامانه سایت ساز « چل تیکه » به معنی آگاهی شما نسبت به قوانین استفاده از آن و همچنین پذیرش این قوانین از جانب شما خواهد بود. پس چنانچه تا کنون این قوانین را مطالعه نفرموده اید، هم اکنون نسبت به مطالعه آن ها اقدام نمایید.</h5>
				<a href="/terms/"><button class="button texture register-col-button red">مطالعه ی قوانین</button></a>
				
				<h4 class="white-text register-col-title">ثبت نام رایگان است</h4>
				<h5 class=" register-col-text white-text">ثبت نام در سامانه سایت ساز « چل تیکه » رایگان است و امکانات و سرویس های این سامانه برای مدت 14 روز ( معادل دو هفته ) به صورت رایگان در اختیار شما خواهد بود. این زمان به عنوان مرحله ی آزمایشی برای شما و آشنایی بهتر شما با این سامانه در نظر گرفته شده است.</h5>
			</div>

			<div class="register-box white">
				<form method="POST" target="">
					<h5 class="row-title right">اطلاعات فردی</h5>
					<input type="text" class="text h-blue-border black-text rtl" id="firstname" name="firstname" placeholder="نام" required />
					<input type="text" class="text h-blue-border black-text rtl" id="lastname" name="lastname" placeholder="نام خانوادگی" required />
					<h5 class="row-title right">نام کاربری</h5>
					<h5 class="form-instruction right gray-text">نام کاربری باید حداقل 6 کارکتر باشد.</h5>
					<input type="text" class="text h-blue-border black-text ltr" id="username" name="username" placeholder="نام کاربری" required />
					<h5 class="form-error right red-text">این نام کاربری مجاز نیست.</h5>
					<h5 class="form-error right red-text">این نام کاربری قبلا ثبت شده است.</h5>
					<h5 class="row-title right">رمز عبور</h5>
					<h5 class="form-instruction right gray-text">رمز عبور باید حداقل 8 کارکتر باشد.</h5>
					<input type="password" class="text h-blue-border black-text ltr" id="password" name="password" placeholder="رمز عبور" required />
					<h5 class="form-error right red-text">رمز عبور وارد شده نا معتبر است.</h5>
					<input type="password" class="text h-blue-border black-text ltr" id="password-retype" name="password-retype" placeholder="تکرار رمز عبور" required />
					<h5 class="form-error right red-text">دو رمز عبور وارد شده یکسان نیستند.</h5>
					<h5 class="row-title right">اطلاعات تماس</h5>
					<input type="text" class="text h-blue-border black-text ltr" id="email" name="email" placeholder="پست الکترونیک" required />
					<h5 class="form-error right red-text">پست الکترونیک وارد شده معتبر نیست.</h5>
					<input type="text" class="text h-blue-border black-text ltr" id="email-retype" name="email-retype" placeholder="تکرار پست الکترونیک" required />
					<h5 class="form-error right red-text">پست الکترونیک های وارد شده یکسان نیستند.</h5>
					<h5 class="form-instruction right gray-text">شماره تماس باید 11 رقمی و بدون خط یا فاصله باشد.</h5>
					<input type="text" class="text h-blue-border black-text ltr" id="phone" name="phone" placeholder="شماره تماس" required />
					<h5 class="form-error right red-text">شماره تماس وارد شده معتبر نیست.</h5>
					<br>
					<input type="checkbox" class="checkbox" id="terms" name="terms" required /><label for="terms"><h5 class="checkbox-label">تمامی قوانین سایت را مطالعه کرده ام و با آگاهی از آن ها، تمامی این قوانین را می پذیرم.</h5></label>
					<button class="button texture submit green white-text" name="submit" value="signup">ثبت نام</button>
				</form>
			</div>
		</div>
	</div>
</content>

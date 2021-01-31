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
	<div class="background contact-header"></div>



	<div class="main">
		<div class="full-row white">
			<h3 class="features-topic contact-topic blue-text"><?php echo $content['text']; ?></h3>
			<h5 class="features-title">تیم چل تیکه همواره در جهت فراهم آوردن رضایت بیشتر شما می کوشد. در نتیجه نظرات شما ما را در بهتر شدن یاری خواهد کرد.</h5>
			<nav class="contact">
				<div class="contact-icon">
					<div class="circle phone white h-green-border"></div>
					<h5 class="features-col-title ltr"><?php echo $content['phone']; ?></h5>
					<hr class="circle-line green-border" />
					<p class="features-col-text h-green-border">تیم چل تیکه هر روز -بجز پنج شنبه و جمعه- از ساعت 9 الی 15 آماده پاسخگویی به شما عزیزان خواهد بود.</p>
				</div>
				<div class="contact-icon">
					<div class="circle address white h-red-border"></div>
					<h5 class="features-col-title">آدرس پستی</h5>
					<hr class="circle-line red-border" />
					<p class="features-col-text h-red-border"><?php echo str_replace( "\n", '<br>', $content['address'] ); ?></p>
				</div>
				<div class="contact-icon">
					<div class="circle mail white h-blue-border"></div>
					<h5 class="features-col-title"><?php echo $content['email']; ?></h5>
					<hr class="circle-line blue-border" />
					<p class="features-col-text h-blue-border">سامانه ایمیلی چل تیکه، هفت روز هفته و 24 ساعت روز آماده پاسخگویی به شما خواهد بود.</p>
				</div>
			</nav>
		</div>
		
		
		
		<div class="full-row message-row">
			<form class="message shadow3" method="POST" target="">
				<input type="text" class="text h-orange-border" name="name" placeholder="نام و نام خانوادگی" required />
				<br>
				<input type="mail" class="text h-blue-border ltr left" name="email" placeholder="پست الکترونیکی" required />
				<br>
				<textarea name="text" rows="5" class="h-red-border" placeholder="پیام شما" required></textarea>
				<br>
				<button class="button texture submit green white-text" name="submit" value="message">ارسال پیام</button>
			</form>
		</div>
	</div>
</content>

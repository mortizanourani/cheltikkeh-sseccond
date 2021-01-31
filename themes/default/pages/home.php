<header>
	<a class="header-logo" title="چل تیکه"><img src="/includes/images/logo.png"></a>
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
	<div class="background header">
		<script>
			$(window).scroll( function(){
				var scrolled = $(window).scrollTop();
				if( scrolled <= 600 ){
					var background = 1;
				}else if( scrolled <= 2200 ){
					var background = 2;
				}else{
					var background = 3;
				}
				$(".background").css({ "background-image": "url('/themes/default/includes/images/background/" + background + ".jpg')" });
			});
		</script>
	</div>



	<div class="main">
		<div class="full-row shadow3 center">
			<h1 class="header-topic white-text">چل تیکه چیست و به چه کار می آید؟</h1>
			<a href="/about/"><button class="button texture default-outline">ما را بیشتر بشناسید</button></a>
			<a href="/faq/"><button class="button texture default">پاسخ سوالاتتان را اینجا بیابید</button></a>
		</div>



		<div class="full-row center features white">
			<h3 class="features-topic black-text">ویژگی های چل تیکه</h3>
			<h5 class="features-title">ویژگی هایی که « چل تیکه » در اختیار شما قرار می دهد این امکان را فراهم می کند تا به سادگی به یک سایت با کیفیت مناسب دست پیدا کنید</h5>
			<div class="features-row">
				<div class="features-col">
					<div class="circle personalize white h-red-border"></div>
					<h5 class="features-col-title">قابلیت شخصی سازی</h5>
					<hr class="circle-line red-border" />
					<p class="features-col-text h-red-border">با استفاده از ابزارهای طراحی سایت که سامانه « چل تیکه » در اختیارتان قرار می دهد، شما می توانید وبسایت مورد علاقه اتان را طبق سلیقه ی خود طراحی کنید.</p>
				</div>
				<div class="features-col">
					<div class="circle easyuse white h-green-border"></div>
					<h5 class="features-col-title">استفاده آسان</h5>
					<hr class="circle-line green-border" />
					<p class="features-col-text h-green-border">سامانه سایت ساز « چل تیکه » به گونه ای طراحی شده است که شما می توانید به سادگی و با استفاده از پیشفرض های ذهنی خود از آن استفاده کنی، چه در بخش طراحی صفحات و چه در بخش مدیریت محتوا.</p>
				</div>
				<div class="features-col">
					<div class="circle responsive white h-blue-border"></div>
					<h5 class="features-col-title">کاملا واکنشگرا</h5>
					<hr class="circle-line blue-border" />
					<p class="features-col-text h-blue-border">سایت ها و صفحه هایی که با استفاده از ماژول ها و قالب های طراحی شده در سامانه « چل تیکه » ساخته می شوند، در همه ی دستگاه های هوشمند به درستی نمایش داده می شوند.</p>
				</div>
				<div class="features-col">
					<div class="circle cheap white h-orange-border"></div>
					<h5 class="features-col-title">صرفه ی اقتصادی</h5>
					<hr class="circle-line orange-border" />
					<p class="features-col-text h-orange-border">شما با استفاده از « چل تیکه » هزینه ای را که باید برای برنامه نویسی، طراحی گرافیکی و تجهیزات لازم پرداخت کنید، به صورت مجتمع و با تخفیفی باور نکردنی پرداخت خواهید کرد.</p>
				</div>
			</div>
		</div>



		<div class="full-row center tools white-shadow">
			<h3 class="tools-topic">ابزار و امکانات</h3>
			<h5 class="tools-title">چل تیکه با توجه به نیاز شما امکاناتی را در اختیارتان قرار داده است. این امکانات شامل ماژول های طراحی سایت، قالب های آماده و بخش مدیریت محتواست که به شما این امکان را می دهد با صرف تنها چند ساعت زمان یک وبسایت حرفه ای برای خود آماده نمایید.</h5>
			<div class="tools-row">
				<div class="tools-col">
					<a href="/store/modules/">
					<h5 class="tools-col-title black-text">ماژول های طراحی</h5>
					<div class="square modules white h-red-border"></div>
					<hr class="square-line red-border" />
					<p class="tools-col-text h-red-border">تیم چل تیکه ماژول  هایی را آماده کرده است که شما بدون نیاز به دانش فنی و برنامه نویسی صفحات وبسایت خود را بسازید. این ماژول ها مشابه قطعات پازلی هستند که در کنار هم قرار می گیرند و صفحات وبسایت شما را تشکیل می دهند.</p>
					</a>
				</div>
				<div class="tools-col">
					<h5 class="tools-col-title black-text">سامانه طراحی صفحه</h5>
					<div class="square designer white h-green-border"></div>
					<hr class="square-line green-border" />
					<p class="tools-col-text h-green-border">این سامانه این امکان را برای شما فراهم می آورد که ماژول های مورد نظرتان را در کنار هم قرار دهید، رنگ ها و قلم ها را تغییر داده و صفحه های سایتتان را باب میل خودتان طراحی نمایید.</p>
				</div>
				<div class="tools-col">
					<a href="/store/templates/">
					<h5 class="tools-col-title black-text">قالب های آماده</h5>
					<div class="square templates white h-orange-border"></div>
					<hr class="square-line orange-border" />
					<p class="tools-col-text h-orange-border">برای افزایش کارایی چل تیکه و صرفه جویی در زمان، تیم چل تیکه قالب های کاملی را برای صفحات مختلف و کاربردهای مختلف آماده کرده است که در اختیار شما قرار دارد و می توانید از آن ها در سامانه ی طراحی صفحات وبسایت استفاده کنید.</p>
					</a>
				</div>
			</div>
		</div>



		<div class="quarter-row center light-blue">
			<h4 class="quarter-row-topic horizental white-text">چگونه باید از چل تیکه استفاده کنم؟</h4>
			<a href="/help/"><button class="button texture blue">راهنمای استفاده</button></a>
		</div>



		<div class="full-row center h-features gray">
			<h3 class="h-features-topic white-text">تنوع طرح ها و تعرفه ها</h3>
			<h5 class="h-features-title">ویژگی هایی که « چل تیکه » در اختیار شما قرار می دهد این امکان را فراهم می کند تا به سادگی به یک سایت با کیفیت مناسب دست پیدا کنید</h5>
			<div class="h-features-row">
				<div class="little-circle blue-border">1</div>
				<nav class="h-features-col">
					<h5 class="h-features-col-title">تنوع زمانی</h5>
					<hr class="little-circle-line blue-border">
					<p class="h-features-col-text h-blue-border">در دسته بندی طرح های چل تیکه، بسته های زمانی با اعتبار 3 ماه، 6 ماه و یک سال پیشبینی شده اند که این امکان را فراهم می کنند تا شما مجبور نباشید هزینه ای بیش از نیاز خود صرف کنید.</p>
				</nav>
			</div>
			<div class="h-features-row">
				<div class="little-circle red-border">2</div>
				<nav class="h-features-col">
					<h5 class="h-features-col-title">تنوع حجمی</h5>
					<hr class="little-circle-line red-border">
					<p class="h-features-col-text h-red-border">با توجه به هدف شما از ایجاد وبسایت تان و یا نوع استفاده ی شما از سامانه ی سایت ساز چل تیکه میزان فضای میزبانی مورد استفاده ی شما متفاوت خواهد بود. بنابراین این امکان برای شما فراهم آمده است که یکی از بسته های مورد نیاز خود را خریداری نمایید.</p>
				</nav>
			</div>
			<div class="h-features-row">
				<div class="little-circle green-border">3</div>
				<nav class="h-features-col">
					<h5 class="h-features-col-title">تخفیف تمدید طرح</h5>
					<hr class="little-circle-line green-border">
					<p class="h-features-col-text h-green-border">با توجه به این که اعتبار چل تیکه نتیجه ی اعتماد شما است، چل تیکه به پاس تجدید اعتماد شما به این سامانه، برای کسانی که بیش از 12 ماه از خدمات این سامانه استفاده کرده باشند، تخفیفی را با عنوان هدیه ی وفاداری در نظر گرفته است.</p>
				</nav>
			</div>
		</div>



		<div class="half-row center green-shadow">
			<h4 class="half-row-topic white-text">استفاده از چل تیکه تا 15 روز رایگان است.</h4>
			<a href="/store/plans/"><button class="button texture dark-green">طرح ها و تعرفه ها</button></a>
			<a href="/register/"><button class="button texture orange">چل تیکه را تجربه کنید</button></a>
		</div>
		
		
		
		<div class="full-row center h-features light-gray">
			<h3 class="features-topic black-text">قوانین و مقررات</h3>
			<h5 class="h-features-title square-title">ویژگی هایی که « چل تیکه » در اختیار شما قرار می دهد این امکان را فراهم می کند تا به سادگی به یک سایت با کیفیت مناسب دست پیدا کنید</h5>
			<div class="h-features-row">
				<a href="/terms/">
				<div class="little-square green-border">1</div>
				<nav class="h-features-col square-col">
					<h5 class="h-features-col-title square-col-title black-text">قوانین عمومی سایت</h5>
					<hr class="little-square-line green-border">
				</nav>
				<p class="h-features-col-text square-col-text h-green-border">سامانه سایت ساز چل تیکه از قوانین رسمی کشور جمهوری اسلامی ایران طبعیت می کند و هر گونه فعالیت مغایر با قوانین ایران، از دیدگاه چل تیکه مقارن تخلف محسوب می گردد و این حق برای تیم چل تیکه محفوظ است که طبق قواعد مذکور در سایت با فرد متخلف برخورد نماید.</p>
				</a>
			</div>
			<div class="h-features-row">
				<a href="/privacy/">
				<div class="little-square orange-border">2</div>
				<nav class="h-features-col square-col">
					<h5 class="h-features-col-title square-col-title black-text">قوانین رفع مسئولیت</h5>
					<hr class="little-square-line orange-border">
				</nav>
				<p class="h-features-col-text square-col-text h-orange-border">طبعا تمامی کاربرانی که از خدمات چل تیکه استفاده می کنند قادر خواهند بود هر گونه فعالیتی که مد نظر خودشان است، انجام دهند، در نتیجه چل تیکه قواعد و قواننی رفع مسئولیت از چل تیکه را بیان می کند که بر اساس آن مواردی که چل تیکه هیچ گونه مسئولیتی در قبال آنها بر عهده نمی گیرد مشخص می گردند. این موارد می توانند به فعالیت های کاربران و یا به بخشی از خدمات ارائه شده توسط چل تیکه مربوط باشند.</p>
				</a>
			</div>
			<div class="h-features-row">
				<a href="/disclaim/">
				<div class="little-square red-border">3</div>
				<nav class="h-features-col square-col">
					<h5 class="h-features-col-title square-col-title black-text">قوانین حفظ حریم خصوصی</h5>
					<hr class="little-square-line red-border">
				</nav>
				<p class="h-features-col-text square-col-text h-red-border square-col-text">چل تیکه در قبال اطلاعاتی که از کاربران و بازدیدکنندگان وبسایت به دست می آورد مسئول بوده و برای مشخص شدن نوع مسئولیت خود قوانین حفظ حریم خصوصی کاربران را وضع کرده و اعلام می دارد. این قوانین نوع اطلاعات به دست آمده و میزان دسترسی به این اطلاعات را بیان می دارند.</p>
			</div>
		</div>



		<div class="quarter-row center light-red">
			<h4 class="quarter-row-topic horizental white-text">ثبت نام در چل تیکه به منزله ی پذیرش قوانین فوق می باشد.</h4>
			<a href="/register/"><button class="button texture red">ثبت نام کنید</button></a>
		</div>
	</div>
</content>

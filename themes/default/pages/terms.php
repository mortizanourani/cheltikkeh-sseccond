<header>
	<a class="header-logo" href="/" title="چل تیکه"><img src="/includes/images/logo.png"></a>
	<menu class="main-menu">
	<?php if( !isset( $_SESSION ) ) session_start(); ?>
	<?php if( !isset( $_SESSION['login_user'] ) ): ?>
		<a href="/login/" title="ورود به حساب کاربری"><button class="button">ورود</button></a>
	<?php else: ?>
		<a href="/controlpanel/posts/" title="حساب کاربری"><button class="button bold">حساب کاربری</button></a>
	<?php endif; ?>
		<a href="/store/plans/" title="طرح ها"><button class="button">طرح ها</button></a>
		<a href="/store/templates/" title="قالب های آماده"><button class="button">قالب ها</button></a>
		<a href="/about/" title="درباره ما"><button class="button">درباره ما</button></a>
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
	<script>
		$(window).scroll( function(){
			if( $(window).scrollTop() < 50 ){
				$(".gotop").hide();
			}else{
				$(".gotop").show();
			}
		});
	</script>



	<?php
		for( $c = 1; $c <= $content['nums']; $c++ ){
			$terms[$content[$c]['type']][$content[$c]['title']] = $content[$c];
		}
	?>
	<div class="main">
		<div class="full-row light-gray">
			<h3 class="features-topic contact-topic black-text">قوانین استفاده از چل تیکه</h3>
			<h5 class="features-title">استفاده از هر سامانه ی مدیریت محتوا ملزم به رعایت قوانینی است. استفاده از سامانه ی سایت ساز چل تیکه نیز از این قاعده پیروی می کند. در نتیجه قوانین استفاده از این سامانه را به شرح زیر بیان می کنیم.</h5>
			<nav class="terms-row">
			
				<a href="#<?php echo base64_encode( 'terms' ); ?>">
				<div class="contact-icon">
					<h5 class="tools-col-title black-text">قوانین عمومی سایت</h5>
					<div class="square terms white h-blue-border"></div>
					<hr class="square-line blue-border" />
					<p class="tools-col-text h-blue-border">سامانه سایت ساز چل تیکه از قوانین رسمی کشور جمهوری اسلامی ایران طبعیت می کند و با هر گونه فعالیت مغایر با قوانین ایران، طبق ضوابط زیر برخورد می گردد.</p>
				</div>
				</a>
				
				<a href="#<?php echo base64_encode( 'disclaim' ); ?>">
				<div class="contact-icon">
					<h5 class="tools-col-title black-text">قوانین رفع مسئولیت</h5>
					<div class="square disclaim white h-orange-border"></div>
					<hr class="square-line orange-border" />
					<p class="tools-col-text h-orange-border">شما مجاز به استفاده از تمامی خدمات سامانه سایت ساز چل تیکه می باشید اما مسئولیت فعالیت های شما با خودتان بوده و چل تیکه در قبال این فعالیت ها هیچ گونه مسئولیتی را نمی پذیرد.</p>
				</div>
				</a>
				
				<a href="#<?php echo base64_encode( 'privacy' ); ?>">
				<div class="contact-icon">
					<h5 class="tools-col-title black-text">قوانین حفظ حریم خصوصی</h5>
					<div class="square privacy white h-green-border"></div>
					<hr class="square-line green-border" />
					<p class="tools-col-text h-green-border">هر شخصی که وارد سایت چل تیکه می شود، مستقل از این که به حساب کاربری خو وارد شود یا خیر اطلاعاتی را به سامانه چل تیکه وارد می کند. این اطلاعات به منزله حریم شخصی شما بوده و طبق قواعد زیر نسبت به حفظ و نگهداری آنها برخورد می شود.</p>
				</div>
				</a>
			
			</nav>
		</div>
		



		<div class="full-row terms-cases h-features white" id="<?php echo base64_encode( 'terms' ); ?>">
			<h3 class="black-text">قوانین عمومی سایت</h3>
			<h5 class="h-features-title">قوانین زیر، قوانین عمومی استفاده از سامانه سایت ساز چل تیکه است و حضور شما در سایت چل تیکه به معنی التزام شما به اجرای این قوانین می باشد.</h5>
			<div class="h-features-row">
				<div class="little-square blue-border"></div>
				<nav class="h-features-col square-col">
					<h5 class="h-features-col-title square-col-title black-text">موارد وابسته به قوانین کشور</h5>
					<hr class="little-square-line blue-border">
				</nav>
				<p class="h-features-col-text square-col-text h-blue-border">
					<?php echo str_replace( "\n", '<br>', $terms['terms']['موارد وابسته به قوانین کشور']['text'] ); ?>
				</p>
			</div>
			<div class="h-features-row">
				<div class="little-square red-border"></div>
				<nav class="h-features-col square-col">
					<h5 class="h-features-col-title square-col-title black-text">مدت اعتبار حساب کاربری</h5>
					<hr class="little-square-line red-border">
				</nav>
				<p class="h-features-col-text square-col-text h-red-border">
					<?php echo str_replace( "\n", '<br>', $terms['terms']['مدت اعتبار حساب کاربری']['text'] ); ?>
				</p>
			</div>
			<div class="h-features-row">
				<div class="little-square green-border"></div>
				<nav class="h-features-col square-col">
					<h5 class="h-features-col-title square-col-title black-text">حقوق معنوی سایت « چل تیکه »</h5>
					<hr class="little-square-line green-border">
				</nav>
				<p class="h-features-col-text square-col-text h-green-border">
					<?php echo str_replace( "\n", '<br>', $terms['terms']['حقوق معنوی سایت « چل تیکه »']['text'] ); ?>
				</p>
			</div>
			<div class="h-features-row">
				<div class="little-square orange-border"></div>
				<nav class="h-features-col square-col">
					<h5 class="h-features-col-title square-col-title black-text">تعهد اجرای قوانین</h5>
					<hr class="little-square-line orange-border">
				</nav>
				<p class="h-features-col-text square-col-text h-orange-border">
					<?php echo str_replace( "\n", '<br>', $terms['terms']['تعهد اجرای قوانین']['text'] ); ?>
				</p>
			</div>
		</div>
		
		
		
		<div class="full-row terms-cases h-features light-gray" id="<?php echo base64_encode( 'disclaim' ); ?>">
			<h3 class="blue-text">قوانین رفع مسئولیت</h3>
			<h5 class="h-features-title">در مواردی که در زیر ذکر شده اند، تیم چل تیکه دقیقا طبق همین دستورالعمل اقدام خواهند کرد و هیچگونه مسئولیتی در قبال نتایج کوتاهی شما در این موارد بر عهده نمی گیرد، خواه این کوتاهی از سوی شما به عمد یا به سهو باشد.</h5>
			<div class="h-features-row">
				<div class="little-square orange-border"></div>
				<nav class="h-features-col square-col">
					<h5 class="h-features-col-title square-col-title blue-text">رعایت حقوق معنوی آثار</h5>
					<hr class="little-square-line orange-border">
				</nav>
				<p class="h-features-col-text square-col-text h-orange-border">
					<?php echo str_replace( "\n", '<br>', $terms['disclaim']['رعایت حقوق معنوی آثار']['text'] ); ?>
				</p>
			</div>
			<div class="h-features-row">
				<div class="little-square blue-border"></div>
				<nav class="h-features-col square-col">
					<h5 class="h-features-col-title square-col-title blue-text">اطلاعات بخش های عمومی</h5>
					<hr class="little-square-line blue-border">
				</nav>
				<p class="h-features-col-text square-col-text h-blue-border">
					<?php echo str_replace( "\n", '<br>', $terms['disclaim']['اطلاعات بخش های عمومی']['text'] ); ?>
				</p>
			</div>
			<div class="h-features-row">
				<div class="little-square red-border"></div>
				<nav class="h-features-col square-col">
					<h5 class="h-features-col-title square-col-title blue-text">پیگرد قانونی</h5>
					<hr class="little-square-line red-border">
				</nav>
				<p class="h-features-col-text square-col-text h-red-border">
					<?php echo str_replace( "\n", '<br>', $terms['disclaim']['پیگرد قانونی']['text'] ); ?>
				</p>
			</div>
			<div class="h-features-row">
				<div class="little-square green-border"></div>
				<nav class="h-features-col square-col">
					<h5 class="h-features-col-title square-col-title blue-text">حذف حساب کاربری</h5>
					<hr class="little-square-line green-border">
				</nav>
				<p class="h-features-col-text square-col-text h-green-border">
					<?php echo str_replace( "\n", '<br>', $terms['disclaim']['حذف حساب کاربری']['text'] ); ?>
				</p>
			</div>
			<div class="h-features-row">
				<div class="little-square orange-border"></div>
				<nav class="h-features-col square-col">
					<h5 class="h-features-col-title square-col-title blue-text">تعهد اجرای قوانین</h5>
					<hr class="little-square-line orange-border">
				</nav>
				<p class="h-features-col-text square-col-text h-orange-border">
					<?php echo str_replace( "\n", '<br>', $terms['disclaim']['تعهد اجرای قوانین']['text'] ); ?>
				</p>
			</div>
		</div>
		
		
		
		<div class="full-row terms-cases h-features white" id="<?php echo base64_encode( 'privacy' ); ?>">
			<h3 class="black-text">قوانین حفظ حریم خصوصی</h3>
			<h5 class="h-features-title">موارد ذکر شده در زیر نوع برخورد و محافظت از اطلاعات شما در سایت چل تیکه را اعلام و مشخص می کند. این موارد شامل حضور شما به عنوان یک بیننده ی آزاد یا به عنوان عضوی که از خدمات سامانه سایت ساز چل تیکه استفاده می کند می شود.</h5>
			<div class="h-features-row">
				<div class="little-square green-border"></div>
				<nav class="h-features-col square-col">
					<h5 class="h-features-col-title square-col-title black-text">حریم خصوصی بازدید کنندگان سایت</h5>
					<hr class="little-square-line green-border">
				</nav>
				<p class="h-features-col-text square-col-text h-green-border">
					<?php echo str_replace( "\n", '<br>', $terms['privacy']['حریم خصوصی بازدید کنندگان سایت']['text'] ); ?>
				</p>
			</div>
			<div class="h-features-row">
				<div class="little-square red-border"></div>
				<nav class="h-features-col square-col">
					<h5 class="h-features-col-title square-col-title black-text">حریم خصوصی کاربران سایت</h5>
					<hr class="little-square-line red-border">
				</nav>
				<p class="h-features-col-text square-col-text h-red-border">
					<?php echo str_replace( "\n", '<br>', $terms['privacy']['حریم خصوصی کاربران سایت']['text'] ); ?>
				</p>
			</div>
			<div class="h-features-row">
				<div class="little-square blue-border"></div>
				<nav class="h-features-col square-col">
					<h5 class="h-features-col-title square-col-title black-text">کوکی های مرورگرها</h5>
					<hr class="little-square-line blue-border">
				</nav>
				<p class="h-features-col-text square-col-text h-blue-border">
					<?php echo str_replace( "\n", '<br>', $terms['privacy']['کوکی های مرورگرها']['text'] ); ?>
				</p>
			</div>
			<div class="h-features-row">
				<div class="little-square orange-border"></div>
				<nav class="h-features-col square-col">
					<h5 class="h-features-col-title square-col-title black-text">گزارش گیری از کاربران</h5>
					<hr class="little-square-line orange-border">
				</nav>
				<p class="h-features-col-text square-col-text h-orange-border">
					<?php echo str_replace( "\n", '<br>', $terms['privacy']['گزارش گیری از کاربران']['text'] ); ?>
				</p>
			</div>
			<div class="h-features-row">
				<div class="little-square green-border"></div>
				<nav class="h-features-col square-col">
					<h5 class="h-features-col-title square-col-title black-text">اطلاعات به دست آمده از گزارش گیری ها</h5>
					<hr class="little-square-line green-border">
				</nav>
				<p class="h-features-col-text square-col-text h-green-border">
					<?php echo str_replace( "\n", '<br>', $terms['privacy']['اطلاعات به دست آمده از گزارش گیری ها']['text'] ); ?>
				</p>
			</div>
			<div class="h-features-row">
				<div class="little-square red-border"></div>
				<nav class="h-features-col square-col">
					<h5 class="h-features-col-title square-col-title black-text">اطلاعات به دست آمده از حساب کاربری</h5>
					<hr class="little-square-line red-border">
				</nav>
				<p class="h-features-col-text square-col-text h-red-border">
					<?php echo str_replace( "\n", '<br>', $terms['privacy']['اطلاعات به دست آمده از حساب کاربری']['text'] ); ?>
				</p>
			</div>
			<div class="h-features-row">
				<div class="little-square blue-border"></div>
				<nav class="h-features-col square-col">
					<h5 class="h-features-col-title square-col-title black-text">اطلاعات بخش های عمومی</h5>
					<hr class="little-square-line blue-border">
				</nav>
				<p class="h-features-col-text square-col-text h-blue-border">
					<?php echo str_replace( "\n", '<br>', $terms['privacy']['اطلاعات بخش های عمومی']['text'] ); ?>
				</p>
			</div>
			<div class="h-features-row">
				<div class="little-square orange-border"></div>
				<nav class="h-features-col square-col">
					<h5 class="h-features-col-title square-col-title black-text">پیگرد قانونی</h5>
					<hr class="little-square-line orange-border">
				</nav>
				<p class="h-features-col-text square-col-text h-orange-border">
					<?php echo str_replace( "\n", '<br>', $terms['privacy']['پیگرد قانونی']['text'] ); ?>
				</p>
			</div>
			<div class="h-features-row">
				<div class="little-square green-border"></div>
				<nav class="h-features-col square-col">
					<h5 class="h-features-col-title square-col-title black-text">حذف حساب کاربری</h5>
					<hr class="little-square-line green-border">
				</nav>
				<p class="h-features-col-text square-col-text h-green-border">
					<?php echo str_replace( "\n", '<br>', $terms['privacy']['حذف حساب کاربری']['text'] ); ?>
				</p>
			</div>
		</div>
		
		
		
		<a class="gotop h-blue-border" href="#"></a>
	</div>
</content>
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
	<div class="background about-header"></div>



	<div class="main">
		<div class="full-row team light-gray">
			<h3 class="team-topic black-text">تیم چل تیکه</h3>
			<h5 class="team-title">آنچه در حال حاضر به عنوان سامانه سایت ساز پویای چل تیکه در اختیار شماست نتیجه ی تلاش تیمی است که در طول یک سال اخیر بارها و بارها تغییر کرده است و دوستانی که به تیم اضافه می شدند، به دلیل مشغله زیاد پس از اندکی ما را تنها می گذاشتند. بنابر این در زیر تنها اعضای ثابت تیم چل تیکه ذکر شده اند.</h5>
			<div class="team-row">
				<div class="members nourani">
					<button class="button members-rarrow btnnavidpj"></button>
					<img class="member-image" src="/includes/images/team/nourani.jpg" />
					<button class="button members-larrow btnnavidpj"></button>
					<br>
					<button class="button members-circle btnnourani" disabled></button>
					<button class="button members-circle btnnavidpj"></button>
				</div>
				<div class="members navidpj">
					<button class="button members-rarrow btnnourani"></button>
					<img class="member-image" src="/includes/images/team/navidpj.jpg" />
					<button class="button members-larrow btnnourani"></button>
					<br>
					<button class="button members-circle btnnourani"></button>
					<button class="button members-circle btnnavidpj" disabled></button>
				</div>
				<script>
					$(".btnnourani").click( function(){
						$(".navidpj").css({ "opacity": "0" });
						setTimeout( function(){
							$(".navidpj").hide();
						}, 150 );
						setTimeout( function(){
							$(".nourani").show();
							$(".nourani").css({ "opacity": "1" });
						}, 150 );
					});
					$(".btnnavidpj").click(function(){
						$(".nourani").css({ "opacity": "0" });
						setTimeout( function(){
							$(".nourani").hide();
						}, 150 );
						setTimeout( function(){
							$(".navidpj").show();
							$(".navidpj").css({ "opacity": "1" });
						}, 150 );
					});
				</script>
			</div>
		</div>
		
		
		
		<div class="full-row h-features white-shadow">
			<h3 class="h-features-topic about-topic"><?php echo $content['title']; ?></h3>
			<h5 class="h-features-title about-sutitr">پروژه ی چل تیکه هم مانند هر مساله یا واقعه ی دیگری از جایی آغاز شد و داستانی دارد. داستان چل تیکه داستان ساده و در عین حال پر فراز و نشیبی است.</h5>
			<p class="about-text"><?php echo str_replace( "\n", '<br>', $content['text'] ); ?></p>
			<p class="about-sign left"><?php echo $content['signature']; ?></p>
		</div>
	</div>
</content>

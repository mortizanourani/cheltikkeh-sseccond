<?php
	if( !isset( $_SESSION ) ) session_start();
	
	switch( $content['operation_answer'] ){
		case( 1 ):
			$_SESSION['page_created'] = true;
			if( isset( $_GET['token'] ) ){
				header( 'location: /controlpanel/pages/'. $_GET['token'] );
				die();
			}
			header( 'location: /controlpanel/pages/' );
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
		<a><button class="button right" disabled>مدیریت صفحه ها</button></a>
		<a href="/designer/"><button class="button right" style="color: rgba(250, 50, 50, 1);">مدیریت ظاهر صفحه ها</button></a>
		<a href="/controlpanel/messages/"><button class="button right">صندوق پیام ها</button></a>
		<a href="/controlpanel/informations/"><button class="button right">اطلاعات حساب کاربری</button></a>
		<a href="/controlpanel/password/"><button class="button right">تغییر رمز عبور</button></a>
		<a href="/controlpanel/transactions/"><button class="button right">تراکنش ها</button></a>
		<a href="/controlpanel/status/"><button class="button right">وضعیت طرح ها</button></a>
		<a href="/controlpanel/support/"><button class="button right">پشتیبانی</button></a>
	</div>
	
	
	
	<div class="main">
		<div class="pages right">
			<?php if( !isset( $_GET['token'] ) ): ?>

				<h4 class="controlpanel-topic right">
				مدیریت صفحه ها
				<hr class="square-line green-border" />
				</h4>
				
				<div class="pages-col right-col">
					<h5 class="controlpanel-title right gray-text">
					صفحه های وب سایت شما، بخش های مختلف سایت شما را به نمایش در می آورند. بخش هایی که هر کدام می توانند مختص به موضوع یا فعالیت مشخصی باشند.
					<br>
					به عنوان مثال « صفحه ی اصلی » سایت، صفحه ی « تماس با ما » و یا هر صفحه ی دیگر با هر موضوع یا فعالیت دیگر که برای تکمیل محتوای سایت خود به آن ها نیاز دارید.
					<br>
					<br>
					<font class="blue-text">
					نام صفحه ها، کلمه ای است فارسی یا انگلیسی که به عنوان عنوان صفحه در نمایش وب سایت مورد استفاده قرار می گیرد.
					مثلا در لیست منوی سایت نام صفحه برای نمایش آیتم ها مورد استفاده قرار می گیرد.
					<br>
					<br>
					آدرس صفحه، همان پیوند ( Link ) صفحه ی مورد نظر است که در آدرس بار مرورگر نمایش داده می شود.
					بنا بر این، آدرس صفحه، کلماتی هستند انگلیسی و بدون فاصله که برای جدا کردن بخش ها باید از « / » استفاده شود.
					<br>
					مثلا باید به صورت « page/subpage/ » نوشته شود.
					</font>
					</h5>
				</div>
				
				<div class="pages-col left-col right">
				
					<form class="pages-form center" method="POST" target="">
						<h5 class="right">افزودن صفحه</h5>
						<input type="text" class="text blue-text h-blue-border rtl" name="name" placeholder="نام صفحه" required />
						<input type="text" class="text blue-text h-green-border ltr" name="link" placeholder="آدرس صفحه" required />
						<br>
						<br>
						<input type="checkbox" class="checkbox right" id="status" name="status" />
						<label for="status"><h5 class="checkbox-label">صفحه ی ساخته شده نمایش داده شود</h5></label>
						<br>
						<br>
						
						<?php if( !isset( $_SESSION ) ) session_start(); ?>
						<?php if( isset( $_SESSION['page_created'] ) ): ?>
							<h5 class="controlpanel-title result green-text">صفحه ی مورد نظر با موفقیت ساخته شد.</h5>
							<?php unset( $_SESSION['page_created'] ); ?>
						<?php endif; ?>
						<button class="button texture submit orange white-text center" name="submit" value="save">ساخت صفحه جدید</button>
					</form>
				
				</div>
				
				<div class="topic-box">
					<h4 class="controlpanel-topic right">لیست صفحه ها</h4>
					<hr class="square-line blue-border" />
				</div>
				<div class="right">
				<?php if( isset( $content['nums'] ) ): ?>
				
					<?php for( $c = 1; $c <= $content['nums']; $c++ ): ?>
					
						<div class="page-item <?php echo $content[$c]['status']; ?>">
							<input type="checkbox" class="checkbox" <?php if( $content[$c]['id'] === '1' ){ echo 'disabled'; } ?> />
							<a <?php if( $content[$c]['id'] != '1' ): ?>href="<?php echo base64_encode( 'ed'. $content[$c]['id']. 'it' ); ?>"<?php endif; ?>>
							<h5 class="name rtl right"><?php echo $content[$c]['name']; ?></h5>
							<h5 class="link ltr left"><?php echo 'http://preview.cheltikkeh.com'. $content[$c]['link']; ?></h5>
							</a>
						</div>
						
					<?php endfor; ?>
				
				<?php else: ?>
				
					<div class="page-item visible">
							<input type="checkbox" class="checkbox" disabled />
							<h5 class="name rtl right"><?php echo $content['name']; ?></h5>
							<h5 class="link ltr left"><?php echo 'http://preview.cheltikkeh.com'. $content['link']; ?></h5>
					</div>
				
				<?php endif; ?>
				
				</div>
				
			<?php else: ?>
				
				<div class="topic-box">
					<a href="/controlpanel/pages/"><button class="button icon back"></button></a>
					<h4 class="controlpanel-topic right">ویرایش صفحه</h4>
					<hr class="square-line orange-border" />
				</div>
				
				<div class="pages-col right-col">
					<h5 class="controlpanel-title right gray-text">
					تمامی صفحه هایی که توسط شما برای پیشبرد اهدافتان در ساخت سایتی پویا و کارآمد ساخته می شوند، قابل ویرایش یا حذف می باشند.
					به استثنای صفحه ی اصلی سایت که توسط سامانه ی سایت ساز « چل تیکه » ساخته شده و قابل ویرایش نمی باشد.
					<br>
					<br>
					<font class="blue-text">
					چنانچه قصد ویرایش صفحه ای را دارید، می توانید با استفاده از فرم روبرو که اطلاعات مربوط به صفحه ی مورد نظر را نمایش می دهد، نسبت به تغییر نام، لینک و یا حتی نمایش یا عدم نمایش صفحه اقدام نمایید.
					<br>
					<br>
					</font>
					<font class="red-text">
					و همانطور که ذکر شد، شما حتی می توانید نسبت به حذف صفحه ی مورد نظرتان اقدام نمایید.
					برای این کار کافی است روی دکمه « حذف صفحه مورد نظر » کلیک نمایید.
					</font>
					<form class="center" method="POST">
						<input type="text" class="text" name="id" value="<?php echo $content['id']; ?>" hidden />
						<button class="button texture light-red" name="submit" value="delete" >حذف صفحه ی مورد نظر</button>
					</form>
					</h5>
				</div>
				
				<div class="pages-col left-col right">
				
					<form class="pages-form center" method="POST" target="">
						
						<h5 class="right">ویرایش صفحه</h5>
						<input type="text" name="id" value="<?php echo $content['id']; ?>" required hidden />
						<input type="text" class="text blue-text h-orange-border rtl" name="name" placeholder="نام صفحه" value="<?php echo $content['name']; ?>" required />
						<input type="text" class="text blue-text h-red-border ltr" name="link" placeholder="آدرس صفحه" value="<?php echo $content['link']; ?>" required />
						<br>
						<br>
						<input type="checkbox" class="checkbox right" id="status" name="status" <?php if( $content['status'] === 'visible' ) echo 'checked'; ?> />
						<label for="status"><h5 class="checkbox-label">صفحه ی ساخته شده نمایش داده شود</h5></label>
						<br>
						<br>
						
						<?php if( !isset( $_SESSION ) ) session_start(); ?>
						<?php if( isset( $_SESSION['page_created'] ) ): ?>
							<h5 class="controlpanel-title result green-text">اطلاعات صفحه ی مورد نظر با موفقیت به روز رسانی شد.</h5>
							<?php unset( $_SESSION['page_created'] ); ?>
						<?php endif; ?>
						<button class="button texture submit green white-text center" name="submit" value="update">به روز رسانی</button>
						
					</form>
				
				</div>
				
			<?php endif; ?>
			
		</div>
	</div>
</content>
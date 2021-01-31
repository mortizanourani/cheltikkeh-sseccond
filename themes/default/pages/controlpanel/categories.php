<?php
	if( !isset( $_SESSION ) ) session_start();
	
	switch( $content['operation_answer'] ){
		case( 1 ):
			$_SESSION['category_created'] = true;
			if( isset( $_GET['token'] ) ){
				if( $_GET['token'] != 'new' ){
					header( 'location: /controlpanel/categories/'. $_GET['token'] );
					die();
				}else{
					unset( $_SESSION['category_created'] );
				}
			}
			header( 'location: /controlpanel/posts/' );
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
		<a><button class="button right" disabled>مدیریت پست ها</button></a>
		<a href="/controlpanel/photos/"><button class="button right">مدیریت عکس ها</button></a>
		<a href="/controlpanel/pages/"><button class="button right">مدیریت صفحه ها</button></a>
		<a href="/designer/"><button class="button right" style="color: rgba(250, 50, 50, 1);">مدیریت ظاهر صفحه ها</button></a>
		<a href="/controlpanel/messages/"><button class="button right">صندوق پیام ها</button></a>
		<a href="/controlpanel/informations/"><button class="button right">اطلاعات حساب کاربری</button></a>
		<a href="/controlpanel/password/"><button class="button right">تغییر رمز عبور</button></a>
		<a href="/controlpanel/transactions/"><button class="button right">تراکنش ها</button></a>
		<a href="/controlpanel/status/"><button class="button right">وضعیت طرح ها</button></a>
		<a href="/controlpanel/support/"><button class="button right">پشتیبانی</button></a>
	</div>
	
	
	
	<div class="main">
		<div class="categories right">
			<?php if( !isset( $_GET['token'] ) ): ?>
				
				<?php header( 'location: /controlpanel/posts/' ); die(); ?>
				
			<?php else: ?>
				
				<?php if( isset( $content['id'] ) ): ?>
				
					<div class="topic-box">
						<a href="/controlpanel/posts/"><button class="button icon back"></button></a>
						<h4 class="controlpanel-topic right">ویرایش دسته</h4>
						<hr class="square-line green-border" />
					</div>
							
					<div class="categories-col right-col">
						<h5 class="controlpanel-title right gray-text">
						نام هر دسته ای که شما برای طبقه بندی مطالب سایتتان مورد استفاده قرار می دهید، قابل تغییر و اصلاح می باشد.
						با تغییر نام دسته ی مورد نظر، پست ها و مطالب مربوط به آن دسته هیچ تغییری نخواهند کرد و در طبقه بندی آن ها هیچ تفاوتی به وجود نمی آید.
						<br>
						<br>
						<font class="blue-text">
						همچنین می توانید برای دستیابی به اهدافتان، اقدام به ساخت دسته ای جدید برای طبقه بندی مطالب سایت خود نمایید.
						<nav class="center">
							<a href="/controlpanel/categories/new"><button class="button texture light-orange">ساخت دسته ی جدید</button></a>
						</nav>
						</font>
						<font class="red-text">
						سامانه « چل تیکه » این امکان را به شما می دهد که دسته مورد نظر خود را حذف نمایید اما
						توجه داشته باشید که با حذف این دسته، وضعیت تمام پست های موجود در آن، به حالت دسته بندی نشده، تغییر خواهد کرد.
						<br>
						</font>
						</h5>
					</div>
					
					<div class="categories-col left-col">
						<form class="category-form center" method="POST" target="">
							<h5 class="right">ویرایش دسته</h5>
							<input type="text" name="id" value="<?php echo $content['id']; ?>" required hidden />
							<input type="text" class="text blue-text h-blue-border rtl" name="name" placeholder="نام دسته" value="<?php echo $content['name']; ?>" required />
							<br>
							<br>
							
							<?php if( !isset( $_SESSION ) ) session_start(); ?>
							<?php if( isset( $_SESSION['category_updated'] ) ): ?>
							
							<h5 class="controlpanel-title result green-text">به روز رسانی با موفقیت انجام شد.</h5>
							
							<?php unset( $_SESSION['category_updated'] ); ?>
							<?php else: ?>
							
							<button class="button texture submit green white-text center" name="submit" value="update">به روز رسانی</button>
							
							<?php endif; ?>
							<?php if( $content['id'] !== '1' ): ?>
							
							<button class="button texture submit light-red white-text center" name="submit" value="delete">حذف دسته ی مورد نظر</button>
							
							<?php endif; ?>
							
						</form>
					</div>
						
					<div class="topic-box">
						<h4 class="controlpanel-topic right">پست های این دسته</h4>
						<hr class="square-line orange-border" />
					</div>
					<?php if( isset( $content['posts']['id'] ) ): ?>
					
						<div class="post <?php echo $content['posts']['status']; ?>">
							<input type="checkbox" class="checkbox" />
							<a href="/controlpanel/posts/<?php echo base64_encode( 'ed'. $content['posts']['id']. 'it' ); ?>">
							<h5 class="title rtl right"><?php echo $content['posts']['title']; ?></h5>
							<h5 class="content rtl right"><?php echo base64_decode( $content['posts']['content'] ); ?></h5>
							<h5 class="date ltr left"><?php echo date_format( date_create( $content['posts']['date'] ), 'M d' ); ?></h5>
							</a>
						</div>
						
					<?php elseif( isset( $content['posts']['nums'] ) ): ?>
					
						<?php for( $c = $content['posts']['nums']; $c >= 1; $c-- ): ?>
						
							<div class="post <?php echo $content['posts'][$c]['status']; ?>">
								<input type="checkbox" class="checkbox" />
								<a href="/controlpanel/posts/<?php echo base64_encode( 'ed'. $content['posts'][$c]['id']. 'it' ); ?>">
								<h5 class="title rtl right"><?php echo $content['posts'][$c]['title']; ?></h5>
								<h5 class="content rtl right"><?php echo base64_decode( $content['posts'][$c]['content'] ); ?></h5>
								<h5 class="date ltr left"><?php echo date_format( date_create( $content['posts'][$c]['date'] ), 'M d' ); ?></h5>
								</a>
							</div>
							
						<?php endfor; ?>
						
					<?php else: ?>
					
						<h5 class="controlpanel-title result blue-text">هیچ پستی در این دسته قرار نگرفته است.</h5>
						
					<?php endif; ?>
				
				<?php else: ?>
				
					<div class="topic-box">
						<a href="/controlpanel/posts/"><button class="button icon back"></button></a>
						<h4 class="controlpanel-topic right">دسته ی جدید</h4>
						<hr class="square-line red-border" />
					</div>
					
					<div class="categories-col right-col">
						<h5 class="controlpanel-title right gray-text">
						دسته بندی های متعدد و مطلوب این امکان را به شما می دهد که دسترسی ساده تر و سریع تری به مطالب وبسایت خود داشته باشید.
						و یا همچنین برای نمایش مطالب خود از این دسته بندی ها کمک بگیرید.
						<br>
						<br>
						<font class="blue-text">
						پس از ساخت یک دسته می توانید هر مطلبی که جهت استفاده در وبسایت خود نوشته اید را در دسته مورد نظرتان قرار دهید.
						<nav class="center">
							<a href="/controlpanel/posts/new"><button class="button texture light-blue">نوشتن پست جدید</button></a>
						</nav>
						</font>
						</h5>
					</div>
					
					<div class="categories-col left-col">
						<form class="category-form center" method="POST" target="">
							<h5 class="right">دسته ی جدید</h5>
							<input type="text" class="text blue-text h-green-border rtl" name="name" placeholder="نام دسته" required />
							<br>
							<br>
							
							<?php if( !isset( $_SESSION ) ) session_start(); ?>
							<?php if( isset( $_SESSION['category_created'] ) ): ?>
							
							<h5 class="controlpanel-title result green-text">دسته ی جدید با موفقیت ساخته شد.</h5>
							
							<?php unset( $_SESSION['category_created'] ); ?>
							<?php else: ?>
							
							<button class="button texture submit light-orange white-text center" name="submit" value="save">ساخت دسته ی جدید</button>
							
							<?php endif; ?>
							
						</form>
					</div>
						
				<?php endif;?>
			
			<?php endif;?>
		</div>
	</div>
</content>

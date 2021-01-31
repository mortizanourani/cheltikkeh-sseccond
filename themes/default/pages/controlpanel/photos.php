<?php
	if( !isset( $_SESSION ) ) session_start();
	
	if( isset( $content['operation_answer'] ) ){
		switch( $content['operation_answer'] ){
			case( -4 ):
				$_SESSION['photo_uploaded'] = -4;
				break;
			case( -3 ):
				$_SESSION['photo_uploaded'] = -3;
				break;
			case( -2 ):
				$_SESSION['photo_uploaded'] = -2;
				break;
			case( 1 ):
				$_SESSION['photo_uploaded'] = 1;
				if( isset( $_GET['token'] ) ){
					header( 'location: /controlpanel/photos/'. $_GET['token'] );
					die();
				}
				break;
		}
		header( 'location: /controlpanel/photos/' );
		die();
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
		<a><button class="button right" disabled>مدیریت عکس ها</button></a>
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
		<div class="photos right">
			<?php if( !isset( $_GET['token'] ) ): ?>

				<h4 class="controlpanel-topic right">
				مدیریت عکس ها
				<hr class="square-line red-border" />
				</h4>
				
				<div class="photos-col right-col">
					<h5 class="controlpanel-title right gray-text">
					عکس هایی که در سایت خود استفاده می کنید، چه در بخش طراحی سایت استفاده شده باشند و چه در محتوای سایت و پست ها مورد استفاده قرار گرفته باشند، در این قسمت مدیریت خواهند شد.
					<br>
					<br>
					<font class="blue-text">
					تمامی عکس هایی که شما از طریق فرم مقابل اقدام به اضافه کردن آن ها به لیست عکس هایتان می نمایید، در اندازه ای که هستند، در سایت بارگذاری می شوند.
					<br>
					این عکس ها علاوه بر قابل استفاده بودن در ویرایش ماژول ها و قالب های آماده، می توانند در پست های سایت شما نیز مورد استفاده قرار گیرند.
					<br>
					<br>
					</font>
					<font class="red-text">
					طبیعتا می توانید در هر زمان که مایل باشید، از طریق آلبوم عکس ها، نسبت به حذف یا ویرایش عنوان عکس هایی که بارگذاری نموده اید، اقدام نمایید.
					</font>
					</h5>
				</div>
				
				<div class="photos-col left-col">
				
					<form class="photo-form center" method="POST" target="" enctype="multipart/form-data">
						<h5 class="right">بارگذاری عکس</h5>
						<input type="text" class="text blue-text h-orange-border rtl" name="title" placeholder="عنوان عکس" required />
						<input type="file" class="text blue-text h-red-border ltr" name="image" placeholder="فایل عکس" required />
						<br>
						
						<?php if( !isset( $_SESSION ) ) session_start(); ?>
						<?php if( isset( $_SESSION['photo_uploaded'] ) ): ?>
						
							<?php
								switch( $_SESSION['photo_uploaded'] ){
									case( 1 ):
										echo '<h5 class="controlpanel-title result green-text">عکس مورد نظر با موفقیت بارگذاری شد.</h5>';
										break;
									case( -2 ):
										echo '<h5 class="controlpanel-title result red-text">پسوند فایل بارگذاری شده مجاز نیست.</h5>';
										break;
									case( -3 ):
										echo '<h5 class="controlpanel-title result red-text">فایل بارگذاری شده بزرگتر از حد مجاز است.</h5>';
										break;
									case( -4 ):
										echo '<h5 class="controlpanel-title result red-text">فایلی با این نام قبلا بارگذاری شده است.</h5>';
										break;
								}
								
								unset( $_SESSION['photo_uploaded'] );
							?>
						
						<?php endif; ?>
						
						<button class="button texture submit green white-text center" name="submit" value="save">بارگذاری عکس</button>
					</form>
					
				</div>
				
				<div class="topic-box">
					<h4 class="controlpanel-topic right">آلبوم عکس ها</h4>
					<hr class="square-line blue-border" />
				</div>
				
				<?php if( isset( $content['nums'] ) ): ?>
					
				<?php if( $content['nums'] > 4 ): ?><div class="center rtl"><?php endif; ?>
				
					<?php for( $c = $content['nums']; $c >= 1; $c-- ): ?>
					
					<?php
						switch( $c % 4 ){
							case( 1 ):
								$color = 'red';
								break;
							case( 2 ):
								$color = 'blue';
								break;
							case( 3 ):
								$color = 'orange';
								break;
							case( 0 ):
								$color = 'green';
								break;
						}
					?>
					
					<a href="<?php echo base64_encode( 'ed'. $content[$c]['id']. 'it' ); ?>">
						<div class="photo square h-<?php echo $color; ?>-border">
							<div class="frame">
								<?php
									$image = '/users/'. $_SESSION['login_user']. '/includes/images/'. $content[$c]['image'];
									list( $width, $height ) = getimagesize( ROOT. $image );
									
									$class = "vertical";
									if( $width >= $height ) $class = "horizental";
								?>
								<img class="<?php echo $class; ?>" src="<?php echo $image; ?>" />
							</div>
							<div class="title shadow4 center"><?php echo $content[$c]['title']; ?></div>
						</div>
					</a>
						
					<?php endfor; ?>
					
				<?php if( $content['nums'] > 4 ): ?></div><?php endif; ?>
				
				<?php elseif( isset( $content['id'] ) ): ?>
				
					<a href="<?php echo base64_encode( 'ed'. $content['id']. 'it' ); ?>">
						<div class="photo square h-red-border">
							<div class="frame">
								<?php
									$image = '/users/'. $_SESSION['login_user']. '/includes/images/'. $content['image'];
									list( $width, $height ) = getimagesize( ROOT. $image );
									
									$class = "vertical";
									if( $width >= $height ) $class = "horizental";
								?>
								<img class="<?php echo $class; ?>" src="<?php echo $image; ?>" />
							</div>
							<div class="title shadow4 center"><?php echo $content['title']; ?></div>
						</div>
					</a>
					
				<?php else: ?>
					
					<h5 class="controlpanel-title right blue-text">شما هنوز هیچ عکسی در آلبوم خود بارگذاری ننموده اید.</h5>
				
				<?php endif; ?>
				
			<?php else: ?>
				
				<div class="topic-box">
					<a href="/controlpanel/photos/"><button class="button icon back"></button></a>
					<h4 class="controlpanel-topic right">ویرایش عکس</h4>
					<hr class="square-line green-border" />
				</div>
				
				<div class="photos-col right-col">
					<h5 class="controlpanel-title right gray-text">
					امکان ویرایش عکس ها برای شما این امکان را ایجاد می نماید تا عنوان عکس مورد نظر خود را تغییر دهید.
					عناوین عکس ها به شما در تشخیص و یافتن عکس مورد نظرتان کمک می کند.
					<br>
					<br>
					<font class="blue-text">
					از آنجا که عکس ها قابل تغییر نمی باشند، تنها امکانی که در ویرایش عکس های موجود در آلبوم عکس ها در اختیار دارید، امکان تغییر نام یا عنوان عکس است.
					<br>
					<br>
					</font>
					<font class="red-text">
					طبیعتا شما مجاز هستید که هر یک از عکس هایی را که نیاز ندارید، جهت استفاده ی بهینه از فضای میزبانی که در اختیار دارید حذف نمایید.
					<br>
					اما لازم به ذکر است که بدانید حذف عکس مورد نظر، به معنای حذف همیشگی آن است و امکان بازیابی مجدد آن وجود نخواهد داشت.
					</font>
					</h5>
				</div>
				
				<div class="photos-col left-col">
				
					<form class="photo-form center" method="POST" target="">
						<h5 class="right">بارگذاری عکس</h5>
						<input type="text" name="id" value="<?php echo $content['id']; ?>" required hidden />
						<input type="text" class="text blue-text h-orange-border rtl" name="title" placeholder="عنوان عکس" value="<?php echo $content['title']; ?>" required />
						<br>
						
						<?php if( !isset( $_SESSION ) ) session_start(); ?>
						<?php if( isset( $_SESSION['photo_uplaoded'] ) ): ?>
							<h5 class="controlpanel-title result green-text">به روز رسانی با موفقیت انجام شد.</h5>
							<?php unset( $_SESSION['photo_uplaoded'] ); ?>
						<?php endif; ?>
						<button class="button texture submit light-blue white-text center" name="submit" value="update">به روز رسانی عکس</button>
						
						<button class="button texture submit light-red white-text center" name="submit" value="delete">حذف عکس مورد نظر</button>
					</form>
					
				</div>
				
				<div class="preview center">
					<?php $image = '/users/'. $_SESSION['login_user']. '/includes/images/'. $content['image']; ?>
					<img class="horizental" src="<?php echo $image; ?>" />
				</div>
				
			<?php endif; ?>
		</div>
	</div>
</content>
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
		<a href="/controlpanel/password/"><button class="button right">تغییر رمز عبور</button></a>
		<a href="/controlpanel/transactions/"><button class="button right">تراکنش ها</button></a>
		<a><button class="button right" disabled>وضعیت طرح ها</button></a>
		<a href="/controlpanel/support/"><button class="button right">پشتیبانی</button></a>
	</div>
	
	
	
	<div class="main">
		<div class="status right">

			<h4 class="controlpanel-topic right">
			وضعیت طرح ها
			<hr class="square-line blue-border" />
			</h4>
			
			<div class="status-col right-col">
				<h5 class="controlpanel-title right gray-text">
				طرح های خریداری شده توسط شما، مدت زمان، حجم فضای میزبانی و همچنین ترافیک ماهیانه ی مجاز برای شما را تعیین می کند.
				<br>
				<font class="blue-text">
				فضای میزبانی استفاده شده توسط شما و همچنین تاریخ انقضای آخرین طرح خریداری شده توسط شما در لیست روبرو نوشته شده است.
				<br>
				</font>
				<font class="red-text">
				توجه داشته باشید که پس از این تاریخ وبسایت شما، نمایش داده نخواهد شد.
				</font>
			</div>
			
			<div class="status-col left-col">
			
				<div class="status-info">
					<h5 class="rtl right">فضای استفاده شده</h5>
					<h5 class="ltr left">
						<?php
							if( isset( $content['nums'] ) ){
								function folderSize( $dir ){
									$size = 0;
									foreach( scandir( $dir ) as $key => $file ){
										if( $file != '..' && $file != '.' )
											$size += is_file( $dir. '/'. $file ) ? filesize( $dir. '/'. $file ) : folderSize( $dir. '/'. $file );
									}
									return $size;
								}
								
								function sizeFormat( $size ){
									$KB = 1024;
									$MB = $KB * 1024;
									$GB = $MB * 1024;
									
									$output = ( $size < $KB ) ? $size : $size;
									$output = ( $output < $MB && $output > $KB ) ? round( $output / $KB ). ' KB' : $output;
									$output = ( $output < $GB && $output > $MB ) ? round( $output / $MB ). ' MB' : $output;
									
									return $output;
								}
								
								$folder = ROOT. '/users/'. $_SESSION['login_user']. '/';
								$size = folderSize( $folder );
								$size = sizeFormat( $size );
								
								echo $size. ' / ';
								
								for( $c = $content['nums']; $c >= 1; $c-- ){
									if( $content[$c]['expired'] > date( 'Y-m-d' ) ){
										echo $content[$c]['host']. ' MB';
										break;
									}
								}
							}
						?>
					</h5>
				</div>
				<div class="status-info">
					<h5 class="rtl right">تاریخ انقضاء سرویس</h5>
					<h5 class="ltr left">
						<?php if( isset( $content[1] ) ) echo date_format( date_create( $content[1]['expired'] ), 'Y M d' ); ?>
					</h5>
				</div>
				
			</div>
			
			<div class="topic-box">
				<h4 class="controlpanel-topic right">لیست طرح ها</h4>
				<hr class="square-line red-border" />
			</div>
			
			<?php if( $content['nums'] > 0 ): ?>
				
				<div class="status-items center">
					
					<div class="status-item center">
						<h5 class="rtl right">عنوان طرح</h5>
						<h5 class="rtl center">فضای میزبانی طرح</h5>
						<h5 class="rtl center">ترافیک ماهیانه طرح</h5>
						<h5 class="ltr left">تاریخ آغاز طرح</h5>
						<h5 class="ltr left">تاریخ انقضاء طرح</h5>
					</div>
					
					<?php for( $c = 1; $c <= $content['nums']; $c++ ): ?>
						
						<?php
							if( $content[$c]['expired'] > date( 'Y-m-d' ) ){
								$class = 'valid';
							}else{
								$class = 'expired';
							}
						?>
						<div class="status-item center <?php echo $class; ?>">
							<h5 class="title rtl right"><?php echo $content[$c]['title']; ?></h5>
							<h5 class="content rtl center"><?php echo $content[$c]['host']. ' مگابایت'; ?></h5>
							<h5 class="content rtl center"><?php echo $content[$c]['bandwidth']. ' گیگابایت'; ?></h5>
							<h5 class="date ltr left">
								<?php
									if( isset( $content[$c+1]['bought'] ) ){
										echo date_format( date_create( $content[$c+1]['expired'] ), 'Y M d' );
									}else{
										echo date_format( date_create( $content[$c]['bought'] ), 'Y M d' );
									}
								?>
							</h5>
							<h5 class="date ltr left"><?php echo date_format( date_create( $content[$c]['expired'] ), 'Y M d' ); ?></h5>
						</div>
						
					<?php endfor; ?>
					
				</div>
			
			<?php else: ?>
			
				<h5 class="controlpanel-title content right red-text">شما هنوز هیچ طرحی فعال نکرده اید.</h5>
			
			<?php endif; ?>
		</div>
	</div>
</content>

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
		<a><button class="button right" disabled>صندوق پیام ها</button></a>
		<a href="/controlpanel/informations/"><button class="button right">اطلاعات حساب کاربری</button></a>
		<a href="/controlpanel/password/"><button class="button right">تغییر رمز عبور</button></a>
		<a href="/controlpanel/transactions/"><button class="button right">تراکنش ها</button></a>
		<a href="/controlpanel/status/"><button class="button right">وضعیت طرح ها</button></a>
		<a href="/controlpanel/support/"><button class="button right">پشتیبانی</button></a>
	</div>
	
	
	
	<div class="main">
		<div class="messages right">
			<?php if( !isset( $_GET['token'] ) ): ?>

				<h4 class="controlpanel-topic right">
				صندوق پیام ها
				<hr class="square-line orange-border" />
				</h4>
				<h5 class="controlpanel-title right gray-text">
				پیام های موجود در این صفحه پیام هایی است که از سمت مدیریت یا کارشناسان سامانه « چل تیکه » برای اطلاع شما ارسال می گردد، و یا از سمت کاربران و بازدیدکنندگان سایت شما و از طریق ارسال پیام در سایت شما برایتان ارسال شده است.
				</h5>
				
				<?php if( isset( $content['nums'] ) ): ?>
				
					<?php for( $c = $content['nums']; $c >= 1; $c-- ): ?>
					
						<div class="message-item <?php echo $content[$c]['status']; ?>">
							<input type="checkbox" class="checkbox" />
							<a href="<?php echo base64_encode( 'sh'. $content[$c]['id']. 'ow' ); ?>">
							<h5 class="name rtl right"><?php echo $content[$c]['name']; ?></h5>
							<h5 class="message rtl right"><?php echo $content[$c]['message']; ?></h5>
							<h5 class="date ltr left"><?php echo date_format( date_create( $content[$c]['date'] ), 'M d' ); ?></h5>
							</a>
						</div>
						
					<?php endfor; ?>
				
				<?php elseif( isset( $content['id'] ) ): ?>
				
					<div class="message-item <?php echo $content['status']; ?>">
						<input type="checkbox" class="checkbox" />
						<a href="<?php echo base64_encode( 'sh'. $content['id']. 'ow' ); ?>">
						<h5 class="name rtl right"><?php echo $content['name']; ?></h5>
						<h5 class="message rtl right"><?php echo $content['message']; ?></h5>
						<h5 class="date ltr left"><?php echo date_format( date_create( $content['date'] ), 'M d' ); ?></h5>
						</a>
					</div>
				
				<?php else: ?>
				
					<h5 class="controlpanel-title message right red-text">شما هیچ پیامی در صندوق پیام های خود ندارید.</h5>
				
				<?php endif; ?>
				
			<?php else: ?>
			
				<div class="topic-box">
					<a href="/controlpanel/messages/"><button class="button icon back"></button></a>
					<h4 class="controlpanel-topic right">صندوق پیام ها</h4>
					<hr class="square-line orange-border" />
				</div>
				
				<div class="info-box center">
					<h5 class="name rtl right"><?php echo $content['name']; ?></h5>
					<h5 class="email ltr center"><?php echo $content['email']; ?></h5>
					<h5 class="date ltr left"><?php echo date_format( date_create( $content['date'] ), 'M d ( H:i:s )' ); ?></h5>
				</div>
				
				<div class="message-box left">
					<h5 class="message rtl right"><?php echo str_replace( "\n", '<br>', $content['message'] ); ?></h5>
					<form method="POST">
						<input name="id" value="<?php echo $content['id']; ?>" hidden />
						<button class="button texture light-red" name="submit" value="delete">حذف پیام</button>
					</form>
				</div>
				
			<?php endif;?>
		</div>
	</div>
</content>
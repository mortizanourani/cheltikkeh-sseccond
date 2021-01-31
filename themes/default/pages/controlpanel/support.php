<?php
	if( !isset( $_SESSION ) ) session_start();
	
	switch( $content['operation_answer'] ){
		case( 1 ):
			$_SESSION['ticket_sent'] = true;
			header( 'location: /controlpanel/support/' );
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
		<a href="/controlpanel/pages/"><button class="button right">مدیریت صفحه ها</button></a>
		<a href="/designer/"><button class="button right" style="color: rgba(250, 50, 50, 1);">مدیریت ظاهر صفحه ها</button></a>
		<a href="/controlpanel/messages/"><button class="button right">صندوق پیام ها</button></a>
		<a href="/controlpanel/informations/"><button class="button right">اطلاعات حساب کاربری</button></a>
		<a href="/controlpanel/password/"><button class="button right">تغییر رمز عبور</button></a>
		<a href="/controlpanel/transactions/"><button class="button right">تراکنش ها</button></a>
		<a href="/controlpanel/status/"><button class="button right">وضعیت طرح ها</button></a>
		<a><button class="button right" disabled>پشتیبانی</button></a>
	</div>
	
	
	
	<div class="main">
		<?php if( !isset( $_GET['token'] ) ): ?>
		
			<div class="ticket right">
				<h4 class="controlpanel-topic right">
				ارسال تیکت برای پشتیبانی
				<hr class="square-line red-border" />
				</h4>
				<div class="ticket-col right-col">
					<h5 class="controlpanel-title right gray-text">
					چنانچه مشکلی در کار کردن با « چل تیکه » دارید ابتدا می توانید صفحه ی سوالات متداول را مطالعه نمایید. ممکن است پاسخ مشکل شما در این صفحه ذکر شده باشد.
					<br>
					در صورتی که پاسخ سوال شما در صفحه ی سوالات متداول نیست می توانید مشکل خود را از طریق یکی از راه های ارتباطی ذکر شده در صفحه ی تماس با ما با کارشناسان سامانه « چل تیکه » در میان بگذارید.
					<nav class="center">
						<a href="/faq/"><button class="button texture light-blue">سوالات متداول</button></a>
						<a href="/contact/"><button class="button texture green">تماس با ما</button></a>
					</nav>
					<font class="blue-text">
					اما چنانچه مشکل پیش آمده نیاز به پیگیری توسط تیم پشتیبانی دارد، لازم است که مشکل پیش آمده را توسط ارسال تیکت از طریق فرم روبرو به تیم پشتیبانی اطلاع دهید.
					کارشناسان « چل تیکه » در اسرع وقت نسبت به تماس با شما و رفع مشکل پیش آمده اقدام خواهند کرد.
					</font>
					</h5>
				</div>
				<div class="ticket-col left-col">
					<form class="ticket-form center" method="POST" target="">
						<input type="text" class="text blue-text h-green-border" name="title" placeholder="عنوان مشکل" required />
						<textarea class="text blue-text h-blue-border" rows="6" name="text" placeholder="توضیح کامل مشکل" required ></textarea>
						<?php if( !isset( $_SESSION ) ) session_start(); ?>
						<?php if( isset( $_SESSION['ticket_sent'] ) ): ?>
						<h5 class="controlpanel-title result green-text">تیکت شما با موافقت ارسال شد.</h5>
						<?php unset( $_SESSION['ticket_sent'] ); else: ?>
						<?php endif; ?>
						<button class="button texture submit light-red white-text center" name="submit" value="ticket">ارسال تیکت</button>
					</form>
				</div>
				
				<div class="topic-box">
					<h4 class="controlpanel-topic right">
					تیکت های ارسال شده
					</h4>
					<hr class="square-line blue-border" />
				</div>
				<div class="ticket-items center">
					<?php for( $c = 1; $c <= $content['nums']; $c++ ): ?>
						
						<div class="ticket-item center <?php echo $content[$c]['class']; ?>">
							<a href="<?php echo base64_encode( 'sh'. $content[$c]['ticket_num']. 'ow' ); ?>">
							<h5 class="title rtl right"><?php echo $content[$c]['title']; ?></h5>
							<h5 class="status rtl right"><?php echo $content[$c]['status']; ?></h5>
							<h5 class="date ltr left"><?php echo date_format( date_create( $content[$c]['date'] ), 'M d' ); ?></h5>
							</a>
						</div>
						
					<?php endfor; ?>
				</div>
			</div>
		
		<?php else: ?>
			
			<div class="ticket right">
				<div class="topic-box">
					<a href="/controlpanel/support/"><button class="button icon back"></button></a>
					<h4 class="controlpanel-topic right">
					<?php echo $content[1]['title']; ?>
					</h4>
					<hr class="square-line green-border" />
				</div>
				
				<div class="ticket-item center admin white" style="padding: 5px;">
					<form class="answer-form center" method="POST" target="">
						<input type="text" class="text" name="no" value="<?php echo $content[1]['ticket_num']; ?>" hidden required />
						<input type="text" class="text" name="title" value="<?php echo $content[1]['title']; ?>" hidden required />
						<textarea class="text blue-text h-blue-border" rows="3" name="text" placeholder="پاسخ تیکت" required ></textarea>
						<h3 class="left"><button class="texture orange white-text center" name="submit" value="answer">ارسال پاسخ</button></h3>
					</form>
				</div>
		
				<div class="ticket-items center">
					<?php for( $c = 1; $c <= $content['nums']; $c++ ): ?>
						<?php
							if( $content[$c]['phone'] === NULL ){
								$class = 'admin';
							}else{
								$class = 'user';
							}
						?>
						<div class="ticket-item center <?php echo $class; ?>" style="padding: 5px;">
							<h5 class="name rtl right"><?php echo $content[$c]['firstname']. ' '. $content[$c]['lastname']. ' ['. $content[$c]['username']. ']'; ?></h5>
							<h5 class="date ltr left"><?php echo date_format( date_create( $content[$c]['date'] ), 'M d ( H:i:s )' ); ?></h5>
							<h5 class="message rtl right"><?php echo str_replace( "\n", '<br>', $content[$c]['text'] ); ?></h5>
						</div>
						
					<?php endfor; ?>
				</div>
			</div>
			
		<?php endif; ?>
	</div>
</content>
<?php
	if( !isset( $_SESSION ) ) session_start();
	
	switch( $content['operation_answer'] ){
		case( 1 ):
			$_SESSION['charge_done'] = true;
			header( 'location: /controlpanel/transactions/' );
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
		<a><button class="button right" disabled>تراکنش ها</button></a>
		<a href="/controlpanel/status/"><button class="button right">وضعیت طرح ها</button></a>
		<a href="/controlpanel/support/"><button class="button right">پشتیبانی</button></a>
	</div>
	
	
	
	<div class="main">
		<div class="transactions right">
			<?php if( !isset( $_GET['token'] ) ): ?>
				
				<h4 class="controlpanel-topic right">
				وضعیت مالی سایت
				<hr class="square-line green-border" />
				</h4>
				
				<div class="transactions-col right-col">
					<h5 class="controlpanel-title right gray-text">
					خرید طرح ها، ماژول ها و یا قالب های آماده و پرداخت مبلغ نهایی سبد خرید و به عبارتی تمامی فعالیت های شما در فروشگاه، به دو شیوه نقدی و اعتباری امکان پذیر است.
					<br>
					<font class="red-text">
					تمامی این تراکنش ها در لیست تراکنش ها نمایش داده می شود.
					</font>
					<nav class="center">
						<a href="list"><button class="button texture light-blue">لیست تراکنش ها</button></a>
					</nav>
					<br>
					<font class="blue-text">
					در روش نقدی جهت پرداخت مبلغ نهایی سبد خرید به صورت مستقیم به درگاه بانک انتقال یافته و نسبت به پرداخت مبلغ اقدام می نمایید.
					<br>
					<br>
					در روش پرداخت از اعتبار، مبلغ نهایی از موجودی اعتبار شما که در این صفحه و در لیست تراکنش ها نمایش داده می شود برداشت می شود.
					</font>
					</h5>
				</div>
				
				<div class="transactions-col left-col right">
				
					<div class="last-credit center">
						<h5 class="description rtl right">اعتبار کنونی</h5>
						<h5 class="description rtl left">
						<?php echo number_format( $content['credit'] ); ?> ریال
						</h5>
					</div>
					
					<form class="transactions-form center" method="POST" target="">
						<h5 class="right">افزایش اعتبار</h5>
						<h5 class="form-instruction right gray-text">مبلغ مورد نظر خود را به ریال وارد نمایید و توجه فرمایید که تراکنش با مبلغ زیر 10,000 ریال مجاز نمی باشد.</h5>
						<input type="text" class="text blue-text h-green-border ltr" name="amount" placeholder="مبلغ افزایش اعتبار" required />
						
						<?php if( !isset( $_SESSION ) ) session_start(); ?>
						<?php if( isset( $_SESSION['charge_done'] ) ): ?>
						<h5 class="controlpanel-title result green-text">افزایش اعتبار با موفقیت انجام شد.</h5>
						<?php unset( $_SESSION['charge_done'] ); ?>
						<?php endif; ?>
						<?php if( isset( $_SESSION['no_bank'] ) ): ?>
						<h5 class="controlpanel-title result red-text">ضمن عرض پوزش، صفحه ی بانک در حال حاضر در دسترس نمی باشد.</h5>
						<?php unset( $_SESSION['no_bank'] ); ?>
						<?php endif; ?>
						<button class="button texture submit light-orange white-text center" name="submit" value="charge">انتقال به صفحه ی بانک</button>
					</form>
				
				</div>
				
			<?php else: ?>
				
				<div class="topic-box">
					<a href="/controlpanel/transactions/"><button class="button icon back"></button></a>
					<h4 class="controlpanel-topic right">لیست تراکنش ها</h4>
					<hr class="square-line blue-border" />
					<h5 class="controlpanel-title right gray-text">
					تمامی تراکنش های انجام شده، چه تراکنش های اعتبار و چه به صورت نقدی در این لیست نمایش داده خواهد شد.
					به این ترتیب که خریدهای نقدی ابتدا به عنوان افزایش اعتبار در لیست تراکنش های شما ثبت می گردند و سپس به عنوان کسر از اعتبار مورد محاسبه قرار می گیرند.
					</h5>
				</div>
				<div class="transfer-item title">
					<h5 class="transfer rtl right">زمان تراکنش</h5>
					<h5 class="description rtl right">شرح تراکنش</h5>
					<h5 class="transfer rtl right">مبلغ تراکنش ( ریال )</h5>
					<h5 class="credit rtl right">مانده اعتبار ( ریال )</h5>
				</div>
				
				<?php if( isset( $content['nums'] ) ): ?>
				
					<?php for( $c = $content['nums']; $c >= 1; $c-- ): ?>
					
						<div class="transfer-item <?php if( $content[$c]['transfer'] <= 0 && $content[$c]['id'] != 1 ){ echo 'dec'; }else{ echo 'inc'; } ?>">
							<h5 class="date ltr right"><?php echo date_format( date_create( $content[$c]['date'] ), 'M d ( H:i:s )' ); ?></h5>
							<h5 class="description rtl right"><?php echo $content[$c]['description']; ?></h5>
							<h5 class="transfer ltr right"><?php echo number_format( $content[$c]['transfer'] ); ?></h5>
							<h5 class="credit ltr right"><?php echo number_format( $content[$c]['credit'] ); ?></h5>
						</div>
						
					<?php endfor; ?>
				
				<?php else: ?>
				
					<div class="transfer-item inc">
						<h5 class="date ltr left"><?php echo date_format( date_create( $content['date'] ), 'M d ( H:i:s )' ); ?></h5>
						<h5 class="description rtl right"><?php echo $content['description']; ?></h5>
						<h5 class="transfer rtl right"><?php echo $content['transfer']; ?></h5>
						<h5 class="credit rtl right"><?php echo $content['credit']; ?></h5>
					</div>
				
				<?php endif; ?>
				
			<?php endif; ?>
		</div>
	</div>
</content>
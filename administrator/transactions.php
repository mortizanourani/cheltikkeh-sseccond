<?php
	$factors = database( 'read', DB_NAME, array(
		'table_name'			=> 'factors',
		'order'					=> 'id DESC LIMIT 50',
		'single'				=> false,
	) );
?>
<div class="sidebar right white">
	<?php $address = $_GET['user'] ? '/' : '/administrators/'; ?>
	<a href="<?php echo $address; ?>visits/"><button class="button right">بازدید ها</button></a>
	<a href="<?php echo $address; ?>users/"><button class="button right">مدیریت کاربران</button></a>
	<a href="<?php echo $address; ?>plans/"><button class="button right">مدیریت طرح ها</button></a>
	<a href="<?php echo $address; ?>modules/"><button class="button right">مدیریت ماژول ها</button></a>
	<a href="<?php echo $address; ?>templates/"><button class="button right">مدیریت قالب ها</button></a>
	<a href="<?php echo $address; ?>messages/"><button class="button right">صندوق پیام ها</button></a>
	<a href="<?php echo $address; ?>tickets/"><button class="button right">صندوق تیکت ها</button></a>
	<a><button class="button right" disabled>تراکنش ها</button></a>
	<a href="<?php echo $address; ?>password/"><button class="button right">تغییر رمز عبور</button></a>
</div>


<div class="main">
	<div class="content right">
		<h4 class="topic right">
		لیست فاکتور ها
		<hr class="square-line red-border" />
		</h4>
		<h5 class="title right gray-text">
		پیام های موجود در این صفحه تیکت هایی هستنذ که کاربران سامانه سایت ساز « چل تیکه » برای تیم پشتیبانی این سامانه ارسال نموده و مشکلی را که با آن مواجه اند مطرح کرده اند.
		شما می توانید هر پیامی را به صلاحدید خود حذف نمایید یا جهت بررسی های بعدی نگاه دارید.
		</h5>
		
		<div class="item bar center">
			<h5 class="number rtl right">شماره فاکتور</h5>
			<h5 class="username rtl right">نام کاربری</h5>
			<h5 class="source rtl right">نوع فاکتور</h5>
			<h5 class="amount rtl right">مبلغ فاکتور</h5>
			<h5 class="date rtl left">تاریخ و زمان</h5>
		</div>
		<?php for( $c = 1; $c <= $factors['nums']; $c++ ): ?>
			
			<div class="item <?php echo $factors[$c]['type']; ?> center">
				<h5 class="number rtl right"><?php echo $factors[$c]['number']; ?></h5>
				<h5 class="username ltr right"><?php echo $factors[$c]['username']; ?></h5>
				<h5 class="source ltr right"><?php switch( $factors[$c]['source'] ){ case( 'credit' ): echo 'شارژ حساب'; break; case( 'cart' ): echo 'پرداخت نقدی'; break; } ?></h5>
				<h5 class="amount ltr right"><?php echo number_format( $factors[$c]['amount'] ); ?></h5>
				<h5 class="date ltr left"><?php echo date_format( date_create( $factors[$c]['date'] ), 'M d ( H:i:s )' ); ?></h5>
			</div>
			
		<?php endfor; ?>
	</div>
</div>

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
	<a href="<?php echo $address; ?>transactions/"><button class="button right">تراکنش ها</button></a>
	<a><button class="button right" disabled>تغییر رمز عبور</button></a>
</div>


<div class="main">
	<div class="content right">
		<h4 class="topic right">
		تغییر رمز عبور
		<hr class="square-line green-border" />
		</h4>
		
		<div class="col right-col center">
			<h5 class="title right gray-text">
			برای تغییر رمز ورود به سامانه ی مدیریت سایت سامانه سایت ساز « چل تیکه »، پس از وارد کردن رمزعبور پیشین خود،
			رمز عبور جدیدی را با حفظ اصول امنیتی که در زیر ذکر شده اند وارد نمایید و پس از تکرار آن، فرم تغییر رمزعبور را تایید نمایید.
			<br>
			<br>
			<font class="blue-text">
			1. رمزعبوری که انتخاب می کنید در حد کافیت طولانی باشد ( بیش از 12 کارکتر. )
			<br>
			2. دارای کارکترهایی غیر از حروف و اعداد باشد.
			<br>
			3. کاملا تصادفی و غیرقابل پیش بینی باشد.
			</font>
			<br>
			<br>
			<br>
			<font class="red-text">
			لازم به ذکر است که این رمزعبور امکان دسترسی به مدیریت سامانه « چل تیکه » را در اختیار شما قرار می دهد، 
			پس برای حفاظت از سامانه، از در اختیار دیگران قرار دادن این رمزعبور جدا خودداری نمایید.
			</font>
			</h5>
		</div>
		
		<div class="col left-col right">
			<form class="form center" method="POST" target="">
				<h5 class="right">رمزعبور پیشین</h5>
				<input type="password" class="text black-text h-orange-border ltr" name="current" placeholder="رمزعبور پیشین" required />
				<h5 class="right">رمزعبور جدید</h5>
				<input type="password" class="text black-text h-blue-border ltr" name="password" placeholder="رمزعبور جدید" required />
				<input type="password" class="text black-text h-red-border ltr" name="password-retype" placeholder="تکرار رمزعبور جدید" required />
				
				<?php if( !isset( $_SESSION ) ) session_start(); ?>
				<?php if( isset( $_SESSION['wrong_password'] ) ): ?>
					<h5 class="title right center red-text">رمزعبور وارد شده نادرست است</h5>
				<?php unset( $_SESSION['wrong_password'] ); endif; ?>
				
				<?php if( isset( $_SESSION['different_password'] ) ): ?>
					<h5 class="title right center red-text">تکرار رمزعبور با رمزعبور یکسان نیست</h5>
				<?php unset( $_SESSION['different_password'] ); endif; ?>
				
				<?php if( isset( $_SESSION['password_changed'] ) ): ?>
					<h5 class="title right center green-text">رمزعبور با موفقیت به روز رسانی شد</h5>
				<?php unset( $_SESSION['password_changed'] ); endif; ?>
				
				<button class="button texture submit green white-text center" name="submit" value="password">تایید رمزعبور</button>
			</form>
		</div>
	</div>
</div>

<?php
	if( !isset( $_GET['sub'] ) ){
		$messages = database( 'read', DB_NAME, array(
			'table_name'			=> 'messages',
			'single'				=> false,
		) );
		
		for( $c = 1; $c <= $messages['nums']; $c++ ){
			switch( $messages[$c]['status'] ){
				case( '1' ):
					$messages[$c]['status'] = 'unread';
					break;
				case( '0' ):
					$messages[$c]['status'] = 'readed';
					break;
			}
		}
	}else{
		if( preg_replace( '/[^a-z]+/', '', strtolower( $_GET['sub'] ) )  === 'show' ){
			$messages = database( 'read', DB_NAME, array(
				'table_name'			=> 'messages',
				'conditions'			=> 'id="'. preg_replace( '/[^0-9]+/', '', strtolower( $_GET['sub'] ) ). '"',
			) );
			
			database( 'update', DB_NAME, array(
				'table_name'			=> 'messages',
				'update_values'			=> 'status="0"',
				'conditions'			=> 'id="'. preg_replace( '/[^0-9]+/', '', strtolower( $_GET['sub'] ) ). '"',
			) );
		}
	}
?>
<div class="sidebar right white">
	<?php $address = $_GET['user'] ? '/' : '/administrators/'; ?>
	<a href="<?php echo $address; ?>visits/"><button class="button right">بازدید ها</button></a>
	<a href="<?php echo $address; ?>users/"><button class="button right">مدیریت کاربران</button></a>
	<a href="<?php echo $address; ?>plans/"><button class="button right">مدیریت طرح ها</button></a>
	<a href="<?php echo $address; ?>modules/"><button class="button right">مدیریت ماژول ها</button></a>
	<a href="<?php echo $address; ?>templates/"><button class="button right">مدیریت قالب ها</button></a>
	<a><button class="button right" disabled>صندوق پیام ها</button></a>
	<a href="<?php echo $address; ?>tickets/"><button class="button right">صندوق تیکت ها</button></a>
	<a href="<?php echo $address; ?>transactions/"><button class="button right">تراکنش ها</button></a>
	<a href="<?php echo $address; ?>password/"><button class="button right">تغییر رمز عبور</button></a>
</div>


<div class="main">
	<?php $sub = ( isset( $_GET['sub'] ) ) ? strtolower( $_GET['sub'] ) : NULL; ?>
	<?php if( !$sub ): ?>
	
	<div class="content right">
		<h4 class="topic right">
		صندوق پیام ها
		<hr class="square-line blue-border" />
		</h4>
		<h5 class="title right gray-text">
		پیام های موجود در این صفحه پیام هایی است که کاربران و یا بازدیدکنندگان وب سایت « چل تیکه » برای مدیران سامانه ی سایت ساز « چل تیکه » ارسال نموده اند.
		شما می توانید هر پیامی را به صلاحدید خود حذف نمایید یا جهت بررسی های بعدی نگاه دارید.
		</h5>
		
		<?php for( $c = $messages['nums']; $c >= 1; $c-- ): ?>
			
			<div class="item <?php echo $messages[$c]['status']; ?>">
				<input type="checkbox" class="checkbox" />
				<a href="<?php echo 'show'. $messages[$c]['id']; ?>">
				<h5 class="name rtl right"><?php echo $messages[$c]['name']; ?></h5>
				<h5 class="message rtl right"><?php echo $messages[$c]['message']; ?></h5>
				<h5 class="date ltr left"><?php echo date_format( date_create( $messages[$c]['date'] ), 'M d' ); ?></h5>
				</a>
			</div>
			
		<?php endfor; ?>
	</div>

	<?php elseif( preg_replace( '/[^a-z]+/', '', strtolower( $_GET['sub'] ) ) === 'show' ): ?>
	
	<div class="content right">
		<div class="topic-box">
			<a href="<?php echo $address; ?>messages/"><button class="button icon back"></button></a>
			<h4 class="topic right">صندوق پیام ها</h4>
			<hr class="square-line orange-border" />
		</div>
		
		<div class="info-box center">
			<h5 class="name rtl right"><?php echo $messages['name']; ?></h5>
			<h5 class="email ltr center"><?php echo $messages['email']; ?></h5>
			<h5 class="date ltr left"><?php echo date_format( date_create( $messages['date'] ), 'M d ( H:i:s )' ); ?></h5>
		</div>
		
		<div class="message-box left">
			<h5 class="message rtl right"><?php echo str_replace( "\n", '<br>', $messages['message'] ); ?></h5>
			<form method="POST">
				<input name="id" value="<?php echo $messages['id']; ?>" hidden />
				<button class="button texture light-red" name="submit" value="deletemessage">حذف پیام</button>
			</form>
		</div>
	</div>
	
	<?php endif; ?>
</div>

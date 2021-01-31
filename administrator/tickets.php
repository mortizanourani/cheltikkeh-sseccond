<?php
	if( !isset( $_GET['sub'] ) ){
		$tickets = database( 'read', DB_NAME, array(
			'table_name'			=> 'tickets',
			'group'					=> 'ticket_num',
			'order'					=> 'ticket_num DESC',
			'single'				=> false,
		) );
		for( $c = 1; $c <= $tickets['nums']; $c++ ){
			$last = database( 'read', DB_NAME, array(
				'table_name'			=> 'tickets',
				'conditions'			=> 'ticket_num="'. $tickets[$c]['ticket_num']. '"',
				'order'					=> 'id DESC',
				'single'				=> true,
			) );
			$tickets[$c]['status'] = $last['status'];
		}
	}else{
		if( preg_replace( '/[^a-z]+/', '', strtolower( $_GET['sub'] ) )  === 'show' ){
			$tickets = database( 'read', DB_NAME, array(
				'table_name'			=> 'tickets',
				'conditions'			=> 'ticket_num="'. preg_replace( '/[^0-9]+/', '', strtolower( $_GET['sub'] ) ). '"',
				'order'					=> 'id DESC',
				'single'				=> false,
			) );
			
			database( 'update', DB_NAME, array(
				'table_name'			=> 'tickets',
				'update_values'			=> 'status="2"',
				'conditions'			=> 'ticket_num="'. preg_replace( '/[^0-9]+/', '', strtolower( $_GET['sub'] ) ). '" AND phone!="NULL"',
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
	<a href="<?php echo $address; ?>messages/"><button class="button right">صندوق پیام ها</button></a>
	<a><button class="button right" disabled>صندوق تیکت ها</button></a>
	<a href="<?php echo $address; ?>transactions/"><button class="button right">تراکنش ها</button></a>
	<a href="<?php echo $address; ?>password/"><button class="button right">تغییر رمز عبور</button></a>
</div>


<div class="main">
	<?php $sub = ( isset( $_GET['sub'] ) ) ? strtolower( $_GET['sub'] ) : NULL; ?>
	<?php if( !$sub ): ?>
	
	<div class="content right">
		<h4 class="topic right">
		صندوق تیکت ها
		<hr class="square-line blue-border" />
		</h4>
		<h5 class="title right gray-text">
		پیام های موجود در این صفحه تیکت هایی هستنذ که کاربران سامانه سایت ساز « چل تیکه » برای تیم پشتیبانی این سامانه ارسال نموده و مشکلی را که با آن مواجه اند مطرح کرده اند.
		شما می توانید هر پیامی را به صلاحدید خود حذف نمایید یا جهت بررسی های بعدی نگاه دارید.
		</h5>
		
		<?php for( $c = 1; $c <= $tickets['nums']; $c++ ): ?>
			<?php
				switch( $tickets[$c]['status'] ){
					case( '0' ):
						$class = 'closed';
						$status = 'بسته شده';
						break;
					case( '1' ):
						$class = 'agent-waiting';
						$status = 'در انتظار بررسی';
						break;
					case( '2' ):
						$class = 'in-process';
						$status = 'در حال اقدام';
						break;
					case( '3' ):
						$class = 'user-waiting';
						$status = 'مشاهده نشده';
						break;
					case( '4' ):
						$class = 'read';
						$status = 'مشاهده شده';
						break;
				}
			?>
			<div class="item center <?php echo $class; ?>">
				<a href="<?php echo 'show'. $tickets[$c]['ticket_num']; ?>">
				<h5 class="name rtl right"><?php echo $tickets[$c]['firstname']. ' '. $tickets[$c]['lastname']. ' ['. $tickets[$c]['username']. ']'; ?></h5>
				<h5 class="title rtl right"><?php echo $tickets[$c]['title']; ?></h5>
				<h5 class="status rtl right"><?php echo $status; ?></h5>
				<h5 class="date ltr left"><?php echo date_format( date_create( $tickets[$c]['date'] ), 'M d' ); ?></h5>
				</a>
			</div>
			
		<?php endfor; ?>
	</div>

	<?php elseif( preg_replace( '/[^a-z]+/', '', strtolower( $_GET['sub'] ) ) === 'show' ): ?>
	
	<div class="content right">
		<div class="topic-box">
			<a href="<?php echo $address; ?>tickets/"><button class="button icon back"></button></a>
			<h4 class="topic right">تیکت</h4>
			<hr class="square-line orange-border" />
		</div>
		
		<div class="info-box center" style="padding: 5px;">
			<form method="POST" target="" style="margin-bottom: 0px;">
				<input type="text" name="no" value="<?php echo $tickets[1]['ticket_num']; ?>" hidden />
				<input type="text" name="title" value="<?php echo $tickets[1]['title']; ?>" hidden />
				<input type="text" class="name text h-red-border" name="firstname" placeholder="نام" />
				<input type="text" class="name text h-red-border" name="lastname" placeholder="نام خانوادگی" />
				<input type="text" class="email text h-orange-border" name="post" placeholder="سمت سازمانی"  />
				<h5 class="date ltr left"></h5>
				<div class="messagebox left">
					<textarea class="message rtl right" rows="4" name="answer" placeholder="پاسخ تیکت" ></textarea>
				</div>
				<h3 class="left">
				<button class="button texture red white-text center" name="submit" value="closeticket">بستن تیکت</button>
				<button class="button texture green white-text center" name="submit" value="ticket">ارسال پاسخ تیکت</button>
				</h3>
			</form>
		</div>
		
		<?php for( $c = 1; $c <= $tickets['nums']; $c++ ): ?>
			<div class="info-box center" style="padding: 5px;">
				<h5 class="name rtl right"><?php echo $tickets[$c]['firstname']. ' '. $tickets[$c]['lastname']. ' ['. $tickets[$c]['username']. ']'; ?></h5>
				<h5 class="email ltr center"><?php echo $tickets[$c]['email']. ' <br> '. $tickets[$c]['phone']; ?></h5>
				<h5 class="date ltr left"><?php echo date_format( date_create( $tickets[$c]['date'] ), 'M d ( H:i:s )' ); ?></h5>
				<div class="messagebox left">
					<h5 class="message rtl right"><?php echo str_replace( "\n", '<br>', $tickets[$c]['text'] ); ?></h5>
				</div>
			</div>
		<?php endfor; ?>
	</div>
	
	<?php endif; ?>
</div>

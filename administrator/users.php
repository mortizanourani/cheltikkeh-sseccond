<?php
	if( !isset( $_GET['sub'] ) ){
		$day = database( 'num_rows', DB_NAME, array(
			'table_name'			=> 'users',
			'conditions'			=> 'signup_date >= "'. date( 'Y-m-d' ). '"',
			'order'					=> 'username DESC',
		) );
		
		$month = database( 'num_rows', DB_NAME, array(
			'table_name'			=> 'users',
			'conditions'			=> 'signup_date >= "'. date( 'Y-m' ). '"',
			'order'					=> 'username DESC',
		) );
		
		$total = database( 'num_rows', DB_NAME, array(
			'table_name'			=> 'users',
			'order'					=> 'username DESC',
		) );
	}else{
		if( preg_replace( '/[^a-z]+/', '', strtolower( $_GET['sub'] ) ) === 'show' ){
			$date = preg_replace( '/[^0-9]+/', '', strtolower( $_GET['sub'] ) );
			if( strlen( $date ) <= 8 ){
				$date_in_format = substr( $date, 0, 4 ). '-'. substr( $date, 4, 2 ). '-'. substr( $date, 6, 2 );
				$conditions = 'signup_date BETWEEN "'. $date_in_format. '" AND "'. date( 'Y-m-d', strtotime( '+1 day', strtotime( $date_in_format ) ) ). '"';
				if( strlen( $date ) < 8 ){
					$date_in_format = substr( $date, 0, 4 ). '-'. substr( $date, 4, 2 ). '-01';
					$conditions = 'signup_date BETWEEN "'. $date_in_format. '" AND "'. date( 'Y-m-d', strtotime( '+1 month', strtotime( $date_in_format ) ) ). '"';
				}
				$users = database( 'read', DB_NAME, array(
					'table_name'			=> 'users',
					'conditions'			=> $conditions,
					'order'					=> 'username DESC',
					'single'				=> false,
				) );
			}
		}else{
			$user = database( 'read', DB_NAME, array(
				'table_name'			=> 'users',
				'conditions'			=> 'username="'. $_GET['sub']. '"',
			) );
			
			$prefix = $user['site_id']. '_';
			$user_plans = database( 'read', DB_NAME, array(
				'table_name'			=> $prefix. 'plans',
				'order'					=> 'id DESC',
				'single'				=> false,
			) );
		}
	}
?>
<div class="sidebar right white">
	<?php $address = $_GET['user'] ? '/' : '/administrators/'; ?>
	<a href="<?php echo $address; ?>visits/"><button class="button right">بازدید ها</button></a>
	<a><button class="button right" disabled>مدیریت کاربران</button></a>
	<a href="<?php echo $address; ?>plans/"><button class="button right">مدیریت طرح ها</button></a>
	<a href="<?php echo $address; ?>modules/"><button class="button right">مدیریت ماژول ها</button></a>
	<a href="<?php echo $address; ?>templates/"><button class="button right">مدیریت قالب ها</button></a>
	<a href="<?php echo $address; ?>messages/"><button class="button right">صندوق پیام ها</button></a>
	<a href="<?php echo $address; ?>tickets/"><button class="button right">صندوق تیکت ها</button></a>
	<a href="<?php echo $address; ?>transactions/"><button class="button right">تراکنش ها</button></a>
	<a href="<?php echo $address; ?>password/"><button class="button right">تغییر رمز عبور</button></a>
</div>



<div class="main">
	<?php $sub = ( isset( $_GET['sub'] ) ) ? strtolower( $_GET['sub'] ) : NULL; ?>
	<?php if( !$sub ): ?>
	
	<div class="content right">
		<h4 class="topic right">
		مدیریت کاربران
		<hr class="square-line red-border" />
		</h4>
		<div class="col right-col center">
			<h5 class="title right gray-text">
			کسانی که در سایت ساز « چل تیکه » ثبت نام می کنند نیاز به مدیریت، رسیدگی و مراقبت دارند.
			به این ترتیب شما به عنوان یک مدیر برای سایت « چل تیکه » از این صفحه می توانید به اعضایی که در روز اخیر و یا ماه اخیر در این سامانه ثبت نام کرده اند نظارت داشته باشید.
			تاریخ ثبت نام، ارتقاء حساب کاربری و همچنین طرح هایی که برای ارتقاء حساب کاربری اشان استفاده کرده اند از طریق این لیست ها مدیریت می شوند.
		</div>
		
		<div class="col left-col center">
			<a href="<?php echo $address; ?>users/show<?php echo date( 'Y-m-d' ); ?>">
				<div class="square center h-red-border">
					<div class="caption red-text"><?php echo $day; ?></div>
					<div class="title shadow4" style="font: bold 20px soroosh;">امروز</div>
				</div>
			</a>
			
			<a href="<?php echo $address; ?>users/show<?php echo date( 'Y-m' ); ?>">
				<div class="square center h-green-border">
					<div class="caption green-text"><?php echo $month; ?></div>
					<div class="title shadow4" style="font: bold 20px soroosh;">این ماه</div>
				</div>
			</a>
			
			<div class="square center h-orange-border">
				<div class="caption orange-text"><?php echo $total; ?></div>
				<div class="title shadow4" style="font: bold 20px soroosh;">از ابتدا</div>
			</div>
		</div>
	</div>
	
	<?php elseif( preg_replace( '/[^a-z]+/', '', strtolower( $_GET['sub'] ) ) === 'show' ): ?>
	
	<div class="content right">
		<div class="topic-box">
			<a href="<?php echo $address; ?>users/"><button class="button icon back"></button></a>
			<h4 class="topic right">کاربران</h4>
			<hr class="square-line orange-border" />
		</div>
		<h5 class="title right gray-text">
		هر کدام از مواردی که در زیر نمایش داده می شوند، یک عضو از سامانه سایت ساز « چل تیکه » است.
		<br>
		با کلیک بر روی هر مورد می توانید اطلاعات کاملی از طرح های مورد استفاده توسط آن کاربر را مشاهده نمایید.
		</h5>
		
		<div class="item bar center">
			<h5 class="username rtl right">نام کاربری</h5>
			<h5 class="name rtl right">نام و نام خانوادگی</h5>
			<h5 class="phone rtl right">شماره تماس</h5>
			<h5 class="email rtl right">پست الکترونیک</h5>
			<h5 class="date rtl left">زمان ثبت نام</h5>
		</div>
		<?php for( $c = 1; $c <= $users['nums']; $c++ ): ?>
			
			<a href="<?php echo $address; ?>users/<?php echo $users[$c]['username']; ?>">
				<div class="item center draft">
					<h5 class="username rtl right"><?php echo $users[$c]['username']; ?></h5>
					<h5 class="name ltr right"><?php echo $users[$c]['firstname']. ' '. $users[$c]['lastname']; ?></h5>
					<h5 class="phone ltr right"><?php echo $users[$c]['phone']; ?></h5>
					<h5 class="email ltr right"><?php echo $users[$c]['email']; ?></h5>
					<h5 class="date ltr left"><?php echo date_format( date_create( $users[$c]['signup_date'] ), 'M d ( H:i:s )' ); ?></h5>
				</div>
			</a>
			
		<?php endfor; ?>
	</div>
	
	<?php else: ?>
	
	<div class="content right">
		<div class="topic-box">
			<a href="<?php echo $address; ?>users/"><button class="button icon back"></button></a>
			<h4 class="topic right">اطلاعات کاربر</h4>
			<hr class="square-line orange-border" />
		</div>
		
		<div class="item bar center">
			<h5 class="username rtl right">نام کاربری</h5>
			<h5 class="name rtl right">نام و نام خانوادگی</h5>
			<h5 class="phone rtl right">شماره تماس</h5>
			<h5 class="email rtl right">پست الکترونیک</h5>
			<h5 class="date rtl left">زمان ثبت نام</h5>
		</div>
		<div class="item center draft">
			<a href="<?php echo $address; ?>preview/<?php echo $user['username']; ?>/" target="_blank">
			<h5 class="username rtl right"><?php echo $user['username']; ?></h5>
			<h5 class="name ltr right"><?php echo $user['firstname']. ' '. $user['lastname']; ?></h5>
			<h5 class="phone ltr right"><?php echo $user['phone']; ?></h5>
			<h5 class="email ltr right"><?php echo $user['email']; ?></h5>
			<h5 class="date ltr left"><?php echo date_format( date_create( $user['signup_date'] ), 'Y M d ( H:i:s )' ); ?></h5>
			</a>
		</div>
		
		<div class="item bar center">
			<h5 class="username rtl right">طرح های مورد استفاده</h5>
		</div>
		
		<?php for( $c = 1; $c <= $user_plans['nums']; $c++ ): ?>
			
			<?php
				if( $user_plans[$c]['expired'] > date( 'Y-m-d' ) ){
					$class = 'valid';
				}else{
					$class = 'expired';
				}
			?>
			
			<div class="item center <?php echo $class; ?>">
				<h5 class="name rtl right"><?php echo $user_plans[$c]['title']; ?></h5>
				<h5 class="host rtl right"><?php echo $user_plans[$c]['host']. ' مگابایت'; ?></h5>
				<h5 class="traffic rtl right"><?php echo $user_plans[$c]['bandwidth']. ' گیگابایت'; ?></h5>
				<h5 class="date ltr left"><?php echo date_format( date_create( $user_plans[$c]['bought'] ), 'Y M d ( H:i:s )' ); ?></h5>
				<h5 class="date ltr left"><?php echo date_format( date_create( $user_plans[$c]['expired'] ), 'Y M d' ); ?></h5>
			</div>
			
		<?php endfor; ?>
	</div>
	
	<?php endif; ?>
</div>

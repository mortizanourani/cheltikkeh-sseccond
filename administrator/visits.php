<?php
	if( !isset( $_GET['sub'] ) ){
		$day = database( 'num_rows', DB_NAME, array(
			'table_name'			=> 'visitors',
			'conditions'			=> 'date >= "'. date( 'Y-m-d' ). '"',
			'group'					=> 'token',
		) );
		
		$month = database( 'num_rows', DB_NAME, array(
			'table_name'			=> 'visitors',
			'conditions'			=> 'date >= "'. date( 'Y-m' ). '"',
			'group'					=> 'token',
		) );
		
		$total = database( 'num_rows', DB_NAME, array(
			'table_name'			=> 'visitors',
			'group'					=> 'token',
		) );
	}else{
		if( preg_replace( '/[^a-z]+/', '', strtolower( $_GET['sub'] ) ) === 'show' ){
			$date = preg_replace( '/[^0-9]+/', '', strtolower( $_GET['sub'] ) );
			if( strlen( $date ) <= 8 ){
				$date_in_format = substr( $date, 0, 4 ). '-'. substr( $date, 4, 2 ). '-'. substr( $date, 6, 2 );
				$conditions = 'date BETWEEN "'. $date_in_format. '" AND "'. date( 'Y-m-d', strtotime( '+1 day', strtotime( $date_in_format ) ) ). '"';
				if( strlen( $date ) < 8 ){
					$date_in_format = substr( $date, 0, 4 ). '-'. substr( $date, 4, 2 ). '-01';
					$conditions = 'date BETWEEN "'. $date_in_format. '" AND "'. date( 'Y-m-d', strtotime( '+1 month', strtotime( $date_in_format ) ) ). '"';
				}
				$visits = database( 'read', DB_NAME, array(
					'table_name'			=> 'visitors',
					'conditions'			=> $conditions,
					'group'					=> 'token',
					'order'					=> 'id DESC',
					'single'				=> false,
				) );
			}
		}else{
			$visits = database( 'read', DB_NAME, array(
				'table_name'			=> 'visitors',
				'conditions'			=> 'token="'. $_GET['sub']. '"',
				'order'					=> 'id DESC',
				'single'				=> false,
			) );
		}
	}
?>
<div class="sidebar right white">
	<?php $address = $_GET['user'] ? '/' : '/administrators/'; ?>
	<a><button class="button right" disabled>بازدید ها</button></a>
	<a href="<?php echo $address; ?>users/"><button class="button right">مدیریت کاربران</button></a>
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
		بازدید ها
		<hr class="square-line red-border" />
		</h4>
		<div class="col right-col center">
			<h5 class="title right gray-text">
			بازدیدکنندگان وبسایت « چل تیکه » مستقل از اینکه به عنوان کاربر وارد سایت شده باشند یا به عنوان یک بازدیدکننده ی غیر عضو،
			در سامانه ی شمارش بازدیدکنندگان وب سایت ثبت می شوند.
			تعداد این افراد در سه بخش تعداد بازدیدهای امروز، تعداد بازدیدهای ماه اخیر
			و تعداد بازدیدهای کلی سایت در لیست مقابل نمایش داده می شوند.
			<br>
			<font class="red-text">
			توجه کنید که در روز آغازین هر ماه، تعداد بازدیدهای روز و ماه برابر خواهند بود.
			</font>
		</div>
		
		<div class="col left-col center">
			<a href="/administrators/visits/show<?php echo date( 'Y-m-d' ); ?>">
				<div class="square center h-red-border">
					<div class="caption red-text"><?php echo $day; ?></div>
					<div class="title shadow4" style="font: bold 20px soroosh;">امروز</div>
				</div>
			</a>
			
			<a href="/administrators/visits/show<?php echo date( 'Y-m' ); ?>">
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
			<a href="/administrators/visits/"><button class="button icon back"></button></a>
			<h4 class="topic right">بازدید ها</h4>
			<hr class="square-line orange-border" />
		</div>
		<h5 class="title right gray-text">
		هر کدام از مواردی که در زیر نمایش داده می شوند، یک بازدیدکننده به شمار می روند.
		با کلیک بر روی هر مورد می توانید مراحل مختلف بازدید سایت توسط آن فرد را مشاهده نمایید.
		</h5>
		
		<div class="item bar center">
			<h5 class="username rtl right">نام کاربری</h5>
			<h5 class="ip rtl right">آی پی بازدیدکننده</h5>
			<h5 class="agent rtl right">نوع مرورگر بازدیدکننده</h5>
			<h5 class="date rtl left">تاریخ و زمان</h5>
		</div>
		<?php for( $c = 1; $c <= $visits['nums']; $c++ ): ?>
			
			<?php
				$visit = database( 'read', DB_NAME, array(
					'table_name'			=> 'visitors',
					'conditions'			=> 'token="'. $visits[$c]['token']. '" AND username IS NOT NULL',
				) );
				if( $visit ) $visits[$c]['username'] = $visit['username'];
			?>
			
			<a href="/administrators/visits/<?php echo $visits[$c]['token']; ?>">
				<div class="item center draft">
					<h5 class="username rtl right"><?php echo $visits[$c]['username']; ?></h5>
					<h5 class="ip ltr right"><?php echo $visits[$c]['ip']; ?></h5>
					<h5 class="agent ltr right"><?php echo $visits[$c]['useragent']; ?></h5>
					<h5 class="date ltr left"><?php echo date_format( date_create( $visits[$c]['date'] ), 'M d ( H:i:s )' ); ?></h5>
				</div>
			</a>
			
		<?php endfor; ?>
	</div>
	
	<?php else: ?>
	
	<div class="content right">
		<div class="topic-box">
			<a href="/administrators/visits/"><button class="button icon back"></button></a>
			<h4 class="topic right">بازدید ها</h4>
			<hr class="square-line orange-border" />
		</div>
		
		<div class="item bar center">
			<h5 class="username rtl right">نام کاربری</h5>
			<h5 class="ip rtl right">آی پی بازدیدکننده</h5>
			<h5 class="agent rtl right">آدرس صفحه ی بازدید شده</h5>
			<h5 class="date rtl left">تاریخ و زمان</h5>
		</div>
		<?php for( $c = 1; $c <= $visits['nums']; $c++ ): ?>
			
			<div class="item center draft">
				<h5 class="username rtl right"><?php echo $visits[$c]['username']; ?></h5>
				<h5 class="ip ltr right"><?php echo $visits[$c]['ip']; ?></h5>
				<h5 class="agent ltr left"><?php echo '/'. $visits[$c]['page']. '/'. $visits[$c]['sub']; ?></h5>
				<h5 class="date ltr left"><?php echo date_format( date_create( $visits[$c]['date'] ), 'M d ( H:i:s )' ); ?></h5>
			</div>
			
		<?php endfor; ?>
	</div>
	
	<?php endif; ?>
</div>

<?php
	if( !isset( $_GET['sub'] ) ){
		$plans = database( 'read', DB_NAME, array(
			'table_name'			=> 'plans',
			'single'				=> false,
		) );
	}else{
		if( preg_replace( '/[^a-z]+/', '', strtolower( $_GET['sub'] ) ) === 'edit' ){
			$plans = database( 'read', DB_NAME, array(
				'table_name'			=> 'plans',
				'conditions'			=> 'id="'. preg_replace( '/[^0-9]+/', '', strtolower( $_GET['sub'] ) ). '"',
			) );
		}
	}
?>
<div class="sidebar right white">
	<?php $address = $_GET['user'] ? '/' : '/administrators/'; ?>
	<a href="<?php echo $address; ?>visits/"><button class="button right">بازدید ها</button></a>
	<a href="<?php echo $address; ?>users/"><button class="button right">مدیریت کاربران</button></a>
	<a><button class="button right" disabled>مدیریت طرح ها</button></a>
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
		مدیریت طرح ها
		<hr class="square-line red-border" />
		</h4>
		<div class="col right-col center">
			<h5 class="title right gray-text">
			تمامی طرح هایی که در سامانه « چل تیکه » برای خریداری و استفاده های کاربران تعریف شده است، در مقابل آورده شده است تا امکان ویرایش اطلاعات آن امکان پذیر گردد.
			با کلیک بر روی هر کدام از آن ها به صفحه ی ویرایش طرح ها وارد می شوید تا بتوانید هر کدام از اطلاعات طرح مورد نظرتان را به روز کنید.
			<br>
			<nav class="center">
				<a href="<?php echo $address; ?>plans/new/"><button class="texture dark-green">ایجاد طرح جدید</button></a>
			</nav>
			<br>
			<font class="blue-text">
			اگر قصد دارید یکی از طرح ها را حذف نمایید، می توانید با ورود به صفحه ی ویرایش آن طرح نسبت به حذف آن اقدام نمایید.
			</font>
			</h5>
		</div>
		
		<div class="col left-col center">
			<?php for( $c = 1; $c <= $plans['nums']; $c++ ): ?>
			
			<?php
				switch( intval( substr( $plans[$c]['title'], 1, 2 ) ) ){
					case( 3 ):
						$color = 'green';
						$caption = '3 ماه';
						break;
					case( 6 ):
						$color = 'orange';
						$caption = '6 ماه';
						break;
					case( 12 ):
						$color = 'blue';
						$caption = '12ماه';
						break;
				}
			?>
			
			<a href="<?php echo $address; ?>plans/edit<?php echo $plans[$c]['id']; ?>">
				<div class="square center h-<?php echo $color; ?>-border">
					<div class="caption <?php echo $color; ?>-text"><?php echo $caption; ?></div>
					<div class="title shadow4"><?php echo $plans[$c]['title']; ?></div>
				</div>
			</a>
			
			<?php endfor; ?>
		</div>
	</div>
	
	<?php elseif( $sub === 'new' ): ?>
	
	<div class="content right">
		<h4 class="topic right">
		ایجاد طرح جدید
		<hr class="square-line blue-border" />
		</h4>
		<div class="col right-col center">
			<h5 class="title right blue-text">
			برای ایجاد طرح جدید در سامانه سایت ساز « چل تیکه » کافی است اطلاعات لازم را در فرم مقابل وارد نموده و کلید « تایید طرح جدید » را کلیک نمایید.
			<br>
			<br>
			برای دیدن لیست طرح های موجود در سامانه سایت ساز « چل تیکه » می توانید روی کلید زیر کلیک کنید.
			<nav class="center">
				<a href="<?php echo $address; ?>plans/"><button class="texture light-red">طرح های موجود در سامانه</button></a>
			</nav>
			<br>
			<font class="red-text">
			جهت ایجاد طرح جدید به نکات زیر توجه نمایید:
			</font>
			<font class="orange-text">
			<br>
			حجم فضای میزبانی به صورت عددی و بر واحد مگابایت وارد شود.
			<br>
			ترافیک ماهیانه به صورت عددی و با واحد گیگابایت وارد شود.
			<br>
			میزان اعتبار هدیه به ریال محاسبه می شود.
			<br>
			تعرفه به صورت عددی و به ریال وارد گردد.
			<br>
			تخفیف طرح به در صد و به صورت عددی وارد شود.
			<br>
			<br>
			</font>
			<font class="gray-text">
			چنانچه اضافه کردن طرح جدید با موفقیت انجام شود، به صورت خودکار به لیست طرح های موجود در سامانه منتقل می شوید.
			</font>
			</h5>
		</div>
		
		
		
		<div class="col left-col right">
			<form class="form center" method="POST" target="">
				<h5 class="right">عنوان طرح</h5>
				<input type="text" class="text black-text h-orange-border ltr" name="title" placeholder="عنوان طرح" required />
				<h5 class="right">اطلاعات فنی طرح</h5>
				<input type="text" class="text black-text h-blue-border ltr" name="host" placeholder="حجم فضای میزبانی" required />
				<input type="text" class="text black-text h-red-border ltr" name="bandwidth" placeholder="میزان ترافیک ماهیانه" required />
				<input type="text" class="text black-text h-green-border ltr" name="credit" placeholder="میزان اعتبار هدیه" required />
				<h5 class="right">تعرفه و تخفیف طرح</h5>
				<input type="text" class="text black-text h-orange-border ltr" name="price" placeholder="تعرفه ی طرح" required />
				<input type="text" class="text black-text h-blue-border ltr" name="off" placeholder="تخفیف طرح" required />
				
				<button class="button texture submit light-orange white-text center" name="submit" value="saveplan">تایید طرح جدید</button>
			</form>
		</div>
	</div>
	
	<?php elseif( preg_replace( '/[^a-z]+/', '', strtolower( $_GET['sub'] ) ) === 'edit' ): ?>
	
	<div class="content right">
		<h4 class="topic right">
		ویرایش طرح موجود
		<hr class="square-line green-border" />
		</h4>
		<div class="col right-col center">
			<h5 class="title right blue-text">
			برای بازگشت به لیست طرح های موجود در سامانه سایت ساز « چل تیکه »، می توانید از کلید زیر استفاده نمایید.
			<br>
			چنانچه بخواهید طرح جدیدی را به لیست طرح های موجود در سامانه « چل تیکه » اضافه نمایید، می توانید مستقیما از کلید « ایجاد طرح جدید » که در زیر قرار دارد، نسبت به این کار اقدام نمایید.
			<nav class="center">
				<a href="<?php echo $address; ?>plans/"><button class="texture light-orange">لیست طرح های موجود</button></a>
				<a href="<?php echo $address; ?>plans/new/"><button class="texture light-blue">ایجاد طرح جدید</button></a>
			</nav>
			<br>
			<font class="red-text">
			هنگام ویرایش اطلاعات مربوط به طرح مورد نظرتان به موارد زیر توجه نمایید:
			</font>
			<font class="orange-text">
			<br>
			حجم فضای میزبانی به صورت عددی و بر واحد مگابایت وارد شود.
			<br>
			ترافیک ماهیانه به صورت عددی و با واحد گیگابایت وارد شود.
			<br>
			میزان اعتبار هدیه به ریال محاسبه می شود.
			<br>
			تعرفه به صورت عددی و به ریال وارد گردد.
			<br>
			تخفیف طرح به در صد و به صورت عددی وارد شود.
			<br>
			<br>
			</font>
			<font class="gray-text">
			چنانچه به روز رسانی طرح مورد نظر با موفقیت انجام شود، به صورت خودکار به لیست طرح های موجود در سامانه منتقل می شوید.
			</font>
			</h5>
		</div>
		
		
		
		<div class="col left-col right">
			<form class="form center" method="POST" target="">
				<input type="text" name="id" value="<?php echo $plans['id']; ?>" hidden />
				<h5 class="right blue-text">عنوان طرح</h5>
				<input type="text" class="text blue-text h-orange-border ltr" name="title" placeholder="عنوان طرح" value="<?php echo $plans['title']; ?>" required />
				<h5 class="right blue-text">اطلاعات فنی طرح</h5>
				<input type="text" class="text blue-text h-blue-border ltr" name="host" placeholder="حجم فضای میزبانی" value="<?php echo $plans['host']; ?>" required />
				<input type="text" class="text blue-text h-red-border ltr" name="bandwidth" placeholder="میزان ترافیک ماهیانه" value="<?php echo $plans['bandwidth']; ?>" required />
				<input type="text" class="text blue-text h-green-border ltr" name="credit" placeholder="میزان اعتبار هدیه" value="<?php echo $plans['credit']; ?>" required />
				<h5 class="right blue-text">تعرفه و تخفیف طرح</h5>
				<input type="text" class="text blue-text h-orange-border ltr" name="price" placeholder="تعرفه ی طرح" value="<?php echo $plans['price']; ?>" required />
				<input type="text" class="text blue-text h-blue-border ltr" name="off" placeholder="تخفیف طرح" value="<?php echo $plans['off']; ?>" required />
				
				<button class="button texture submit light-red white-text center" name="submit" value="deleteplan">حذف طرح مورد نظر</button>
				<button class="button texture submit green white-text center" name="submit" value="updateplan">به روز رسانی طرح مورد نظر</button>
			</form>
		</div>
	</div>
	
	<?php endif; ?>
</div>


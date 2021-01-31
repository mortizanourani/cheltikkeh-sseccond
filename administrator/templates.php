<?php
	if( !isset( $_GET['sub'] ) ){
		$templates = database( 'read', DB_NAME, array(
			'table_name'			=> 'templates',
			'single'				=> false,
		) );
	}else{
		if( preg_replace( '/[^a-z]+/', '', strtolower( $_GET['sub'] ) ) === 'edit' ){
			$templates = database( 'read', DB_NAME, array(
				'table_name'			=> 'templates',
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
	<a><button class="button right" disabled>مدیریت قالب ها</button></a>
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
		مدیریت قالب های آماده
		<hr class="square-line red-border" />
		</h4>
		<div class="col right-col right">
			<h5 class="title right gray-text">
			قالب های آماده ی سامانه سایت ساز « چل تیکه » به جهت تسریع در روند ساخت سایت توسط کاربران طراحی و آماده می شوند.
			<br>
			هر چه این قالب ها بیشتر و متنوع تر باشند، سرعت ساخت وبسایت ها و در نتیجه مطلوبیت سامانه سایت ساز « چل تیکه » بیشتر خواهد بود.
			<br>
			بنابر این تلاش می شود تا تعداد لیست زیر، بیشتر و کیفیت آن ها بهبود بیابند.
			</h5>
		</div>
		
		<div class="col left-col right">
			<h5 class="title right blue-text">
			جهت اضافه کردن قالب آماده جدید از کلید زیر استفاده نمایید.
			<br>
			<nav class="center">
				<a href="<?php echo $address; ?>templates/new/"><button class="texture light-orange">ایجاد ماژول جدید</button></a>
			</nav>
			<font class="red-text">
			کلید حذف هر قالب آماده موجود در لیست زیر در صفحه ی ویرایش آن ماژول است.
			</font>
			</h5>
		</div>
		
		<div class="center">
			<?php for( $c = 1; $c <= $templates['nums']; $c++ ): ?>
			
			<?php
				switch( $c % 4 ){
					case( 0 ):
						$color = 'green';
						break;
					case( 1 ):
						$color = 'orange';
						break;
					case( 2 ):
						$color = 'blue';
						break;
					case( 3 ):
						$color = 'red';
						break;
				}
			?>
			
			<a href="<?php echo $address; ?>templates/edit<?php echo $templates[$c]['id']; ?>">
				<div class="templates square center h-<?php echo $color; ?>-border">
					<nav class="frame">
					<img src="<?php echo 'http://cheltikkeh.com/includes/images/store/templates/'. $templates[$c]['image']; ?>" />
					<div class="title shadow4 white-text"><?php echo $templates[$c]['title']; ?></div>
					</nav>
				</div>
			</a>
			
			<?php endfor; ?>
		</div>
	</div>
	
	<?php elseif( $sub === 'new' ): ?>
	
	<div class="content right">
		<h4 class="topic right">
		ثبت قالب آماده ی جدید
		<hr class="square-line red-border" />
		</h4>
		<div class="col right-col center">
			<h5 class="title right gray-text">
			برای ثبت قالب آماده ی جدید در سامانه ی سایت ساز « چل تیکه » پس از وارد نمودن اطلاعات لازم در فرم مقابل بر روی کلید « ثبت قالب آماده » که در انتهای فرم قرار دارد کلیک نمایید.
			<br>
			برای بازگشت به لیست قالب های آماده ی موجود در سامانه سایت ساز « چل تیکه » می توانید از کلید زیر استفاده نمایید.
			<nav class="center">
				<a href="<?php echo $address; ?>templates/"><button class="texture light-orange">لیست قالب های موجود</button></a>
			</nav>
			<br>
			<font class="blue-text">
			در ثبت قالب آماده ی جدید به موارد زیر دقت نمایید:
			<br>
			نام تصویر قالب آماده، نام و پسوند فایل تصویر، بدون ذکر آدرس می باشد.
			<br>
			نام اسپانسر به فارسی وارد گردد.
			<br>
			تعرفه به صورت عددی و به ریال وارد گردد.
			<br>
			تخفیف قالب به در صد و به صورت عددی وارد شود.
			<br>
			<br>
			</font>
			<font class="black-text">
			چنانچه ثبت قالب آماده ی جدید با موفقیت انجام شود، به صورت خودکار به لیست قالب های موجود در سامانه منتقل می شوید.
			</font>
			</h5>
		</div>
		
		
		
		<div class="col left-col right">
			<form class="form center" method="POST" target="">
				<h5 class="right blue-text">عنوان قالب</h5>
				<input type="text" class="text blue-text h-orange-border ltr" name="title" placeholder="عنوان قالب" required />
				<h5 class="right blue-text">اطلاعات فنی قالب</h5>
				<input type="text" class="text blue-text h-green-border ltr" name="image" placeholder="تصویر قالب" required />
				<textarea rows="10" class="text blue-text h-red-border ltr" name="html" placeholder="HTML Codes" required ></textarea>
				<textarea rows="10" class="text blue-text h-blue-border ltr" name="script" placeholder="Java Scripts"></textarea>
				<h5 class="right blue-text">اسپانسر قالب</h5>
				<input type="text" class="text blue-text h-green-border rtl" name="sponsor" placeholder="اسپانسر قالب" />
				<input type="text" class="text blue-text h-orange-border ltr" name="sponsor_link" placeholder="سایت اسپانسر قالب" />
				<h5 class="right blue-text">تعرفه و تخفیف قالب</h5>
				<input type="text" class="text blue-text h-blue-border ltr" name="price" placeholder="تعرفه ی قالب" required />
				<input type="text" class="text blue-text h-red-border ltr" name="off" placeholder="تخفیف قالب" required />
				
				<button class="button texture submit light-blue white-text center" name="submit" value="savetemplate">ثبت قالب آماده</button>
			</form>
		</div>
	</div>
	
	<?php elseif( preg_replace( '/[^a-z]+/', '', strtolower( $_GET['sub'] ) ) === 'edit' ): ?>
	
	<div class="content right">
		<h4 class="topic right">
		ویرایش قالب های آماده ی موجود
		<hr class="square-line green-border" />
		</h4>
		<div class="col right-col center">
			<h5 class="title right blue-text">
			برای بازگشت به لیست قالب های آماده ی موجود در سامانه سایت ساز « چل تیکه » می توانید از کلید زیر استفاده نمایید.
			<br>
			با استفاده از کلید « ایجاد قالب آماده ی جدید » می توانید به صورت مستقیم از همین صفحه وارد صفحه ی طراحی قالب آماده ی جدید شوید و نسبت به ثبت قالب آماده ی جدید اقدام نمایید.
			<nav class="center">
				<a href="<?php echo $address; ?>templates/"><button class="texture light-blue">لیست قالب های موجود</button></a>
				<a href="<?php echo $address; ?>templates/new/"><button class="texture light-red">ایجاد قالب آماده ی جدید</button></a>
			</nav>
			<br>
			<font class="black-text">
			برای به روز رسانی قالب آماده ی مورد نظر کافیست به موارد زیر دقت نمایید:
			</font>
			<font class="gray-text">
			<br>
			نام تصویر قالب آماده، نام و پسوند فایل تصویر، بدون ذکر آدرس می باشد.
			<br>
			نام اسپانسر به فارسی وارد گردد.
			<br>
			تعرفه به صورت عددی و به ریال وارد گردد.
			<br>
			تخفیف قالب به در صد و به صورت عددی وارد شود.
			<br>
			<br>
			</font>
			<font class="blue-text">
			چنانچه به روز رسانی قالب مورد نظر با موفقیت انجام شود، به صورت خودکار به لیست قالب های موجود در سامانه منتقل می شوید.
			</font>
			</h5>
		</div>
		
		
		
		<div class="col left-col right">
			<form class="form center" method="POST" target="">
				<input type="text" name="id" value="<?php echo $templates['id']; ?>" hidden />
				<h5 class="right blue-text">عنوان قالب</h5>
				<input type="text" class="text blue-text h-orange-border ltr" name="title" placeholder="عنوان قالب" value="<?php echo $templates['title']; ?>" required />
				<h5 class="right blue-text">اطلاعات فنی قالب</h5>
				<input type="text" class="text blue-text h-green-border ltr" name="image" placeholder="تصویر قالب" value="<?php echo $templates['image']; ?>" required />
				<?php
					$templates['html'] = str_replace( '<', '&lt;', base64_decode( $templates['html'] ) );
					$templates['html'] = str_replace( '>', '&gt;', $templates['html'] );
				?>
				<textarea rows="10" class="text blue-text h-red-border ltr" name="html" placeholder="HTML Codes" required ><?php echo $templates['html']; ?></textarea>
				<?php $templates['script'] = base64_decode( $templates['script'] ); ?>
				<textarea rows="10" class="text blue-text h-blue-border ltr" name="script" placeholder="Java Scripts"><?php echo $templates['script']; ?></textarea>
				<h5 class="right blue-text">اسپانسر قالب</h5>
				<input type="text" class="text blue-text h-green-border rtl" name="sponsor" placeholder="اسپانسر قالب" value="<?php echo $templates['sponsor']; ?>" />
				<input type="text" class="text blue-text h-orange-border ltr" name="sponsor_link" placeholder="سایت اسپانسر قالب" value="<?php echo $templates['sponsor_link']; ?>" />
				<h5 class="right blue-text">تعرفه و تخفیف قالب</h5>
				<input type="text" class="text blue-text h-blue-border ltr" name="price" placeholder="تعرفه ی قالب" value="<?php echo $templates['price']; ?>" required />
				<input type="text" class="text blue-text h-red-border ltr" name="off" placeholder="تخفیف قالب" value="<?php echo $templates['off']; ?>" required />
				
				<button class="button texture submit light-red white-text center" name="submit" value="deletetemplate">حذف قالب مورد نظر</button>
				<button class="button texture submit green white-text center" name="submit" value="updatetemplate">به روز رسانی قالب مورد نظر</button>
			</form>
		</div>
	</div>
	
	<?php endif; ?>
</div>


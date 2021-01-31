<?php
	if( !isset( $_GET['sub'] ) ){
		$modules = database( 'read', DB_NAME, array(
			'table_name'			=> 'modules',
			'single'				=> false,
		) );
	}else{
		if( preg_replace( '/[^a-z]+/', '', strtolower( $_GET['sub'] ) ) === 'edit' ){
			$modules = database( 'read', DB_NAME, array(
				'table_name'			=> 'modules',
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
	<a><button class="button right" disabled>مدیریت ماژول ها</button></a>
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
		مدیریت ماژول ها
		<hr class="square-line orange-border" />
		</h4>
		<div class="col right-col right">
			<h5 class="title right gray-text">
			ماژول های موجود در سامانه ی « چل تیکه »، مهمترین ابزاری هستند که در سامانه سایت ساز « چل تیکه » ایفای نقش می کنند.
			بنابر این وجود کوچکترین نقص ، خطا یا اختلالی در هر کدام از ماژول ها باعث اختلال  در طراحی وب سایت های کاربران خواهد شد.
			به منظور جلوگیری از وقوع این نقایص و معایب لیست ماژول های موجود در سامانه « چل تیکه » نمایش داده شده است تا هر کدام از آن ها را به تناسب نیاز ویرایش نمایید.
			</h5>
		</div>
		
		<div class="col left-col right">
			<h5 class="title right blue-text">
			برای ثبت ماژول جدید می توانید با کلیک بر روی کلید زیر وارد بخش اضافه کردن ماژول شوید.
			<br>
			<nav class="center">
				<a href="<?php echo $address; ?>modules/new/"><button class="texture blue">ایجاد ماژول جدید</button></a>
			</nav>
			<font class="red-text">
			کلید حذف هر ماژول در صفحه ی ویرایش آن ماژول است.
			</font>
			</h5>
		</div>
		
		<div class="center">
			<?php for( $c = 1; $c <= $modules['nums']; $c++ ): ?>
			
			<?php
				switch( $modules[$c]['type'] ){
					case( 'header' ):
						$color = 'green';
						break;
					case( 'content' ):
						$color = 'orange';
						break;
					case( 'footer' ):
						$color = 'blue';
						break;
				}
			?>
			
			<a href="<?php echo $address; ?>modules/edit<?php echo $modules[$c]['id']; ?>">
				<div class="modules square center h-<?php echo $color; ?>-border">
					<nav class="frame">
					<img src="<?php echo 'http://cheltikkeh.com/includes/images/store/modules/'. $modules[$c]['image']; ?>" />
					<div class="title shadow4 white-text"><?php echo $modules[$c]['title']; ?></div>
					</nav>
				</div>
			</a>
			
			<?php endfor; ?>
		</div>
	</div>
	
	<?php elseif( $sub === 'new' ): ?>
	
	<div class="content right">
		<h4 class="topic right">
		ایجاد ماژول جدید
		<hr class="square-line blue-border" />
		</h4>
		<div class="col right-col center">
			<h5 class="title right gray-text">
			برای اضافه کردن ماژول جدید به سامانه سایت ساز « چل تیکه »، کافی است اطلاعات لازم را در فرم مقابل وارد نمایید و سپس بر روی کلید « ثبت ماژول جدید » کلیک نمایید.
			<br>
			<br>
			چنانچه می خواهید به لیست ماژول های موجود در سامانه « چل تیکه » باز گردید، کافی است از کلید « لیست ماژول های موجود » استفاده نمایید و به صفحه ی ماژول ها وارد شوید.
			<nav class="center">
				<a href="<?php echo $address; ?>modules/"><button class="texture green">لیست ماژول های موجود</button></a>
			</nav>
			<br>
			<font class="black-text">
			در ثبت ماژول جدید به نکات زیر توجه نمایید:
			</font>
			<font class="blue-text">
			<br>
			نام تصویر ماژول، نام و پسوند فایل تصویر، بدون ذکر آدرس می باشد.
			<br>
			تعرفه به صورت عددی و به ریال وارد گردد.
			<br>
			تخفیف ماژول به در صد و به صورت عددی وارد شود.
			<br>
			<br>
			</font>
			<font class="gray-text">
			چنانچه ثبت ماژول با موفقیت انجام شود، به صورت خودکار به لیست ماژول های موجود در سامانه منتقل خواهید شد.
			</font>
			</h5>
		</div>
		
		
		
		<div class="col left-col right">
			<form class="form center" method="POST" target="">
				<h5 class="right blue-text">عنوان ماژول</h5>
				<input type="text" class="text blue-text h-orange-border ltr" name="title" placeholder="عنوان ماژول" required />
				<h5 class="right blue-text">اطلاعات فنی ماژول</h5>
				<select class="select blue-text h-blue-border rtl" name="type" required >
					<option value="header">بالا صفحه</option>
					<option value="content">محتوا</option>
					<option value="footer">پایین صفحه</option>
				</select>
				<input type="text" class="text blue-text h-red-border ltr" name="image" placeholder="تصویر ماژول" required />
				<textarea rows="10" class="text blue-text h-green-border ltr" name="css" placeholder="CSS Codes"></textarea>
				<textarea rows="10" class="text blue-text h-orange-border ltr" name="html" placeholder="HTML Codes" required ></textarea>
				<textarea rows="10" class="text blue-text h-blue-border ltr" name="script" placeholder="Java Scripts"></textarea>
				<h5 class="right blue-text">تعرفه و تخفیف ماژول</h5>
				<input type="text" class="text blue-text h-red-border ltr" name="price" placeholder="تعرفه ی ماژول" required />
				<input type="text" class="text blue-text h-green-border ltr" name="off" placeholder="تخفیف ماژول" required />
				
				<button class="button texture submit orange white-text center" name="submit" value="savemodule">ثبت ماژول جدید</button>
			</form>
		</div>
	</div>
	
	<?php elseif( preg_replace( '/[^a-z]+/', '', strtolower( $_GET['sub'] ) ) === 'edit' ): ?>
	
	<div class="content right">
		<h4 class="topic right">
		ویرایش ماژول موجود
		<hr class="square-line green-border" />
		</h4>
		<div class="col right-col center">
			<h5 class="title right blue-text">
			چنانچه می خواهید به لیست ماژول های موجود در سامانه سایت ساز « چل تیکه » بازگردید، می توانید از کلید زیر استفاده نمایید.
			<br>
			برای سادگی کار شما، جهت اضافه کردن ماژول جدید، کلید « ایجاد ماژول جدید » در زیر قرار دارد که بتوانید مستقیما به صفحه ی ثبت ماژول دسترسی داشته باشید.
			<nav class="center">
				<a href="<?php echo $address; ?>modules/"><button class="texture light-red">لیست ماژول های موجود</button></a>
				<a href="<?php echo $address; ?>modules/new/"><button class="texture light-orange">ایجاد ماژول جدید</button></a>
			</nav>
			<br>
			<font class="black-text">
			برای به روز رسانی ماژول مورد نظر کافیست به موارد زیر دقت نمایید:
			</font>
			<font class="gray-text">
			<br>
			نام تصویر ماژول، نام و پسوند فایل تصویر، بدون ذکر آدرس می باشد.
			<br>
			تعرفه به صورت عددی و به ریال وارد گردد.
			<br>
			تخفیف ماژول به در صد و به صورت عددی وارد شود.
			<br>
			<br>
			</font>
			<font class="blue-text">
			چنانچه به روز رسانی ماژول با موفقیت انجام شود، به صورت خودکار به لیست ماژول های موجود در سامانه منتقل می شوید.
			</font>
			</h5>
		</div>
		
		
		
		<div class="col left-col right">
			<form class="form center" method="POST" target="">
				<input type="text" name="id" value="<?php echo $modules['id']; ?>" hidden />
				<h5 class="right blue-text">عنوان ماژول</h5>
				<input type="text" class="text blue-text h-orange-border ltr" name="title" placeholder="عنوان ماژول" value="<?php echo $modules['title']; ?>" required />
				<h5 class="right blue-text">اطلاعات فنی ماژول</h5>
				<select class="select blue-text h-blue-border rtl" name="type" required >
					<option value="header"<?php echo ( $modules['type'] === 'header' ) ? ' selected ' : ''; ?>>بالا صفحه</option>
					<option value="content"<?php echo ( $modules['type'] === 'content' ) ? ' selected ' : ''; ?>>محتوا</option>
					<option value="footer"<?php echo ( $modules['type'] === 'footer' ) ? ' selected ' : ''; ?>>پایین صفحه</option>
				</select>
				<input type="text" class="text blue-text h-red-border ltr" name="image" placeholder="تصویر ماژول" value="<?php echo $modules['image']; ?>" required />
				<?php $modules['css'] = base64_decode( $modules['css'] ); ?>
				<textarea rows="10" class="text blue-text h-green-border ltr" name="css" placeholder="CSS Codes"><?php echo $modules['css']; ?></textarea>
				<?php
					$modules['html'] = str_replace( '<', '&lt;', base64_decode( $modules['html'] ) );
					$modules['html'] = str_replace( '>', '&gt;', $modules['html'] );
				?>
				<textarea rows="10" class="text blue-text h-orange-border ltr" name="html" placeholder="HTML Codes" required ><?php echo $modules['html']; ?></textarea>
				<?php $modules['script'] = base64_decode( $modules['script'] ); ?>
				<textarea rows="10" class="text blue-text h-blue-border ltr" name="script" placeholder="Java Scripts"><?php echo $modules['script']; ?></textarea>
				<h5 class="right blue-text">تعرفه و تخفیف ماژول</h5>
				<input type="text" class="text blue-text h-red-border ltr" name="price" placeholder="تعرفه ی ماژول" value="<?php echo $modules['price']; ?>" required />
				<input type="text" class="text blue-text h-green-border ltr" name="off" placeholder="تخفیف ماژول" value="<?php echo $modules['off']; ?>" required />
				
				<button class="button texture submit light-red white-text center" name="submit" value="deletemodule">حذف ماژول مورد نظر</button>
				<button class="button texture submit green white-text center" name="submit" value="updatemodule">به روز رسانی ماژول مورد نظر</button>
			</form>
		</div>
	</div>
	
	<?php endif; ?>
</div>


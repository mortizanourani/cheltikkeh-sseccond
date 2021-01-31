<?php
	if( !isset( $_SESSION ) ) session_start();
	
	switch( $content['operation_answer'] ){
		case( 1 ):
			header( 'location: /designer/' );
			die();
			break;
	}
?>
<header class="cheltikkeh-editor-header">
	<nav class="elements">
		<a href="/designer/"><button class="texture gray">بازگشت</button></a>
		<button class="texture red" id="modules">ماژول ها</button>
		<button class="texture orange" id="templates">قالب های آماده</button>
	</nav>
	<menu class="operation-menu">
		<form class="operation-form" method="POST">
			<input name="id" value="<?php if( isset( $content['id'] ) ){ echo( $content['id'] ); }else{ echo( $page['args']['args_id'] ); } ?>" hidden />
			<textarea id="encoded-html" name="html" hidden >
				<?php if( isset( $content['html'] ) ) echo( $content['html'] ); ?>
			</textarea>
			<textarea id="encoded-cleared-html" name="cleared_html" hidden ></textarea>
			<button class="texture blue" name="submit" value="save" <?php if( !isset( $content['html'] ) ) echo 'disabled'; ?> >ذخیره ی موقت</button>
			<button class="texture green" name="submit" value="publish" <?php if( !isset( $content['html'] ) ) echo 'disabled'; ?> >ثبت نهایی صفحه</button>
		</form>
		<button class="texture gray" id="preview">پیش نمایش</button>
	</menu>
</header>
	
<div class="cheltikkeh-modules-menu">
	<?php if( !isset( $content['modules']['id'] ) && !isset( $content['modules']['nums'] ) ): ?>
		<h3 class="red-text">شما هیچ ماژولی در اختیار ندارید</h3>
		<h3>برای به دست آوردن ماژول هایی که نیاز دارید، به صفحه ی <a href="/store/modules/" class="red-text">« ماژول ها »</a> وارد شوید</h3>
	<?php elseif( isset( $content['modules']['id'] ) ): ?>
		<div class="cheltikkeh-module-item">
			<img src="/includes/images/store/modules/<?php echo $content['modules']['image']; ?>" />
			<hr>
			<input type="text" id="css" value="<?php echo $content['modules']['css']; ?>" hidden />
			<input type="text" id="html" value="<?php echo $content['modules']['html']; ?>" hidden>
		</div>
	<?php elseif( isset( $content['modules']['nums'] ) ): ?>
		<?php for( $c = 1; $c <= $content['modules']['nums']; $c++ ): ?>
			<div class="cheltikkeh-module-item">
				<img src="/includes/images/store/modules/<?php echo $content['modules'][$c]['image']; ?>" />
				<hr>
				<input type="text" id="css" value="<?php echo $content['modules'][$c]['css']; ?>" hidden />
				<input type="text" id="html" value="<?php echo $content['modules'][$c]['html']; ?>" hidden>
			</div>
		<?php endfor; ?>
	<?php endif; ?>
</div>
<div class="cheltikkeh-templates-menu">
	<?php if( !isset( $content['templates']['id'] ) && !isset( $content['templates']['nums'] ) ): ?>
		<h3 class="red-text">شما هیچ قالب آماده ای در اختیار ندارید</h3>
		<h3>برای در اختیار گرفتن قالب های آماده ی مورد نیازتان، به صفحه ی <a href="/store/templates/" class="red-text">« قالب های آماده »</a> وارد شوید</h3>
	<?php elseif( isset( $content['templates']['id'] ) ): ?>
		<div class="cheltikkeh-template-item">
			<img src="/includes/images/store/templates/<?php echo $content['templates']['image']; ?>" />
			<hr>
			<input type="text" id="html" value="<?php echo $content['templates']['html']; ?>" hidden />
		</div>
	<?php elseif( isset( $content['templates']['nums'] ) ): ?>
		<?php for( $c = 1; $c <= $content['templates']['nums']; $c++ ): ?>
			<div class="cheltikkeh-template-item">
				<img src="/includes/images/store/templates/<?php echo $content['templates'][$c]['image']; ?>" />
				<input type="text" id="html" value="<?php echo $content['templates'][$c]['html']; ?>" hidden />
				<hr>
			</div>
		<?php endfor; ?>
	<?php endif; ?>
</div>

<div class="cheltikkeh-settings-menu">
	<?php require_once( dirname( __FILE__ ). '/editor-cheltikkeh-settings-menu.php' ); ?>
</div>

<div class="cheltikkeh-settings-photos">
	<header>
		<h4>آلبوم عکس ها</h4>
		<menu>
			<a href="/controlpanel/photos/" target="_blank"><button>اضافه کردن تصویر</button></a>
			<button id="close">بستن این پنجره</button>
		</menu>
	</header>
	<div class="photos-box">
		<?php if( isset( $content['photos']['nums'] ) ): ?>
			<?php for( $c = $content['photos']['nums']; $c >= 1; $c-- ): ?>
				
				<?php
					switch( $c % 4 ){
						case( 1 ):
							$color = 'red';
							break;
						case( 2 ):
							$color = 'blue';
							break;
						case( 3 ):
							$color = 'orange';
							break;
						case( 0 ):
							$color = 'green';
							break;
					}
				?>
				<div class="photo h-<?php echo $color; ?>-border">
					<div class="frame">
						<?php
							$image = '/users/'. $_SESSION['login_user']. '/includes/images/'. $content['photos'][$c]['image'];
							list( $width, $height ) = getimagesize( ROOT. $image );
							
							$class = "vertical";
							if( $width >= $height ) $class = "horizental";
						?>
						<img class="<?php echo $class; ?>" src="<?php echo $image; ?>" />
					</div>
					<div class="title"><?php echo $content['photos'][$c]['title']; ?></div>
				</div>
				
			<?php endfor; ?>
		
		<?php elseif( isset( $content['photos']['id'] ) ): ?>
			
			<div class="photo h-red-border">
				<div class="frame">
					<?php
						$image = '/users/'. $_SESSION['login_user']. '/includes/images/'. $content['photos']['image'];
						list( $width, $height ) = getimagesize( ROOT. $image );
						
						$class = "vertical";
						if( $width >= $height ) $class = "horizental";
					?>
					<img class="<?php echo $class; ?>" src="<?php echo $image; ?>" />
				</div>
				<div class="title"><?php echo $content['photos']['title']; ?></div>
			</div>
			
		<?php else: ?>
			
			<h4>شما هیچ عکسی در آلبوم خود ندارید. جهت اضافه کردن عکس از دکمه ی « اضافه کردن تصویر » که در بالای صفحه موجود است استفاده نمایید.</h4>
			
		<?php endif; ?>
	</div>
</div>

<div class="cheltikkeh-editor-content">
	<?php if( isset( $content['html'] ) ): ?>
		<?php echo( base64_decode( $content['html'] ) ); ?>
	<?php else: ?>
		<div class="locator dropable">
			<h4>با کشیدن اولین ماژول یا قالب آماده به این قسمت، طراحی صفحه ی خود را آغاز نمایید.</h4>
		</div>
	<?php endif; ?>
</div>

<?php
	if( !isset( $_SESSION ) ) session_start();
	
	switch( $content['operation_answer'] ){
		case( 1 ):
			$_SESSION['post_edited'] = true;
			if( isset( $_GET['token'] ) ){
				if( $_GET['token'] != 'new' ){
					header( 'location: /controlpanel/posts/'. $_GET['token'] );
					die();
				}else{
					unset( $_SESSION['post_edited'] );
				}
			}
			header( 'location: /controlpanel/posts/' );
			die();
			break;
	}
?>
<header class="header">
	<a class="header-logo" href="/" title="چل تیکه"><img src="/includes/images/logo.png"></a>
	<menu class="main-menu">
		<a href="/store/modules/" title="ماژول ها"><button class="button">ماژول ها</button></a>
		<a href="/store/templates/" title="قالب ها"><button class="button">قالب ها</button></a>
		<a href="/cart/" title="سبد خرید"><button class="button">سبد خرید</button></a>
		<form method="POST"><button class="button" name="submit" value="logout">خروج</button></form>
	</menu>
</header>
<content class="body">
	<div class="sidebar right white">
		<a><button class="button right" disabled>مدیریت پست ها</button></a>
		<a href="/controlpanel/photos/"><button class="button right">مدیریت عکس ها</button></a>
		<a href="/controlpanel/pages/"><button class="button right">مدیریت صفحه ها</button></a>
		<a href="/designer/"><button class="button right" style="color: rgba(250, 50, 50, 1);">مدیریت ظاهر صفحه ها</button></a>
		<a href="/controlpanel/messages/"><button class="button right">صندوق پیام ها</button></a>
		<a href="/controlpanel/informations/"><button class="button right">اطلاعات حساب کاربری</button></a>
		<a href="/controlpanel/password/"><button class="button right">تغییر رمز عبور</button></a>
		<a href="/controlpanel/transactions/"><button class="button right">تراکنش ها</button></a>
		<a href="/controlpanel/status/"><button class="button right">وضعیت طرح ها</button></a>
		<a href="/controlpanel/support/"><button class="button right">پشتیبانی</button></a>
	</div>
	
	
	
	<div class="main">
		<div class="posts right">
			<?php if( !isset( $_GET['token'] ) ): ?>

				<h4 class="controlpanel-topic right">
				مدیریت پست ها
				<hr class="square-line blue-border" />
				</h4>
				
				<div class="posts-col right-col">
					<h5 class="controlpanel-title right gray-text">
					هر مطلبی که شما در سایت خود می نویسید به عنوان یک پست در سامانه سایت ساز « چل تیکه » شناخته می شود.
					این پست ها به صورت دسته بندی نشده و یا در دسته های مشخصی، طبقه بندی می شوند.
					<br>
					<br>
					<font class="blue-text">
					شما می توانید برای رسیدن به اهداف خود، دسته های جدیدی را تعریف نمایید.
					به این ترتیب دستیابی به اطلاعات به صورت طبقه بندی شده برای شما امکان پذیر می شود.
					<br>
					<br>
					همچنین در هنگام اضافه کردن هر مطلب یا پست، می توانید مشخص نمایید که آن پست، مربوط به کدام دسته می باشد و باید در کدام دسته طبقه بندی شود.
					<nav class="center">
						<a href="/controlpanel/categories/new"><button class="button texture light-orange">ساخت دسته ی جدید</button></a>
						<a href="/controlpanel/posts/new"><button class="button texture green">نوشتن پست جدید</button></a>
					</nav>
					با کلیک بر روی نام دسته مورد نظرتان که در مقابل نمایش داده می شود، لیست پست های موجود در آن دسته نمایش داده خواهند شد.
					</font>
					</h5>
				</div>
				
				<div class="posts-col left-col">
				
					<?php if( isset( $content['categories']['nums'] ) ): ?>
					
						<?php for( $c = 1; $c <= $content['categories']['nums']; $c++ ): ?>
						
							<div class="category">
								<a href="/controlpanel/categories/<?php echo base64_encode( 'ed'. $content['categories'][$c]['id']. 'it' ); ?>">
								<h5 class="name rtl right"><?php echo $content['categories'][$c]['name']; ?></h5>
								<h5 class="count ltr left"><?php echo $content['categories'][$c]['category_count']; ?></h5>
								</a>
							</div>
							
						<?php endfor; ?>
						
					<?php else: ?>
					
						<div class="category">
							<a href="/controlpanel/categories/<?php echo base64_encode( 'ed'. $content['categories']['id']. 'it' ); ?>">
							<h5 class="name rtl right"><?php echo $content['categories']['name']; ?></h5>
							<h5 class="count ltr left"><?php echo $content['categories']['category_count']; ?></h5>
							</a>
						</div>
						
					<?php endif; ?>
					
				</div>
				
				<div class="topic-box">
					<h4 class="controlpanel-topic right">لیست پست ها</h4>
					<hr class="square-line red-border" />
				</div>
				
				<?php if( isset( $content['nums'] ) ): ?>
				
					<?php for( $c = $content['nums']; $c >= 1; $c-- ): ?>
					
						<div class="post <?php echo $content[$c]['status']; ?>">
							<input type="checkbox" class="checkbox" />
							<a href="<?php echo base64_encode( 'ed'. $content[$c]['id']. 'it' ); ?>">
							<h5 class="title rtl right"><?php echo $content[$c]['title']; ?></h5>
							<h5 class="content rtl right"><?php echo base64_decode( $content[$c]['content'] ); ?></h5>
							<h5 class="date ltr left"><?php echo date_format( date_create( $content[$c]['date'] ), 'M d' ); ?></h5>
							</a>
						</div>
						
					<?php endfor; ?>
				
				<?php elseif( isset( $content['id'] ) ): ?>
				
					<div class="post <?php echo $content['status']; ?>">
						<input type="checkbox" class="checkbox" />
						<a href="<?php echo base64_encode( 'ed'. $content['id']. 'it' ); ?>">
						<h5 class="title rtl right"><?php echo $content['title']; ?></h5>
						<h5 class="content rtl right"><?php echo base64_decode( $content['content'] ); ?></h5>
						<h5 class="date ltr left"><?php echo date_format( date_create( $content['date'] ), 'M d' ); ?></h5>
						</a>
					</div>
				
				<?php else: ?>
				
					<h5 class="controlpanel-title content right red-text">شما هنوز هیچ مطلبی ننوشته اید.</h5>
				
				<?php endif; ?>
				
			<?php else: ?>
				
				<?php if( isset( $content['id'] ) ): ?>
				
					<div class="topic-box">
						<a href="/controlpanel/posts/"><button class="button icon back"></button></a>
						<h4 class="controlpanel-topic right">ویرایش پست</h4>
						<hr class="square-line orange-border" />
					</div>
					
					<form method="POST" class="post-box">
						<input type="text" class="text" name="id" value="<?php echo $content['id']; ?>" hidden />
						<input type="text" class="text" name="current_category" value="<?php echo $content['category']; ?>" hidden />
						<input type="text" class="text blue-text h-blue-border" name="title" value="<?php echo $content['title']; ?>" />
						<select class="select blue-text h-red-border" name="category">
							<?php
								if( isset( $content['categories']['nums'] ) ){
									for( $c = 1; $c <= $content['categories']['nums']; $c++ ){
										echo '<option value="'. $content['categories'][$c]['id']. '"';
										if( $content['categories'][$c]['id'] === $content['category'] ) echo ' selected';
										echo '>'. $content['categories'][$c]['name']. '</option>';
									}
								}else{
									echo '<option value="'. $content['categories']['id']. '">'. $content['categories']['name']. '</option>';
								}
							?>
						</select>
						<textarea rows="10" class="editor blue-text rtl right" name="content"><?php echo base64_decode( $content['content'] ); ?></textarea>
						<input type="checkbox" class="checkbox" id="status" name="status" <?php if( $content['status'] === 'visible' ) echo 'checked'; ?> />
						<label for="status"><h5 class="checkbox-label">این مطلب نمایش داده شود.</h5></label>
						<input type="checkbox" class="checkbox" id="commentable" name="commentable" <?php if( $content['commentable'] === 'true' ) echo 'checked'; ?> />
						<label for="commentable"><h5 class="checkbox-label">امکان اظهار نظر داشته باشد.</h5></label>
						<nav class="left">
							<?php if( isset( $_SESSION['post_edited'] ) ): ?>
								<h5 class="green-text left">به روز رسانی با موفقیت انجام شد.</h5>
								<?php unset( $_SESSION['post_edited'] ); ?>
							<?php endif; ?>
							<button class="button texture light-red" name="submit" value="delete">حذف مطلب</button>
							<button class="button texture green" name="submit" value="update">به روز رسانی</button>
						</nav>
					</form>
				
				<?php else: ?>
				
					<div class="topic-box">
						<a href="/controlpanel/posts/"><button class="button icon back"></button></a>
						<h4 class="controlpanel-topic right">پست جدید</h4>
						<hr class="square-line orange-border" />
					</div>
					
					<form method="POST" class="post-box">
						<input type="text" class="text blue-text h-blue-border" name="title" placeholder="عنوان پست" />
						<select class="select blue-text h-red-border" name="category">
							<?php
								if( isset( $content['categories']['nums'] ) ){
									for( $c = 1; $c <= $content['categories']['nums']; $c++ ){
										echo '<option value="'. $content['categories'][$c]['id']. '">'. $content['categories'][$c]['name']. '</option>';
									}
								}else{
									echo '<option value="'. $content['categories']['id']. '">'. $content['categories']['name']. '</option>';
								}
							?>
						</select>
						<textarea rows="10" class="editor blue-text rtl right" name="content"></textarea>
						<input type="checkbox" class="checkbox" id="status" name="status" />
						<label for="status"><h5 class="checkbox-label">این مطلب نمایش داده شود.</h5></label>
						<input type="checkbox" class="checkbox" id="commentable" name="commentable" />
						<label for="commentable"><h5 class="checkbox-label">امکان اظهار نظر داشته باشد.</h5></label>
						<nav class="left">
							<button class="button texture green" name="submit" value="save" >ثبت پست</button>
						</nav>
					</form>
				
				<?php endif; ?>
				
			<?php endif;?>
		</div>
	</div>
</content>

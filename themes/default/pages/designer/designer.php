<header class="header designer">
	<a class="header-logo" href="/" title="چل تیکه"><img src="/includes/images/logo.png"></a>
	<menu class="main-menu">
		<a href="/controlpanel/posts/" title="مدیریت حساب کاربری"><button class="button bold">حساب کاربری</button></a>
		<a href="/store/modules/" title="ماژول ها"><button class="button">ماژول ها</button></a>
		<a href="/store/templates/" title="قالب ها"><button class="button">قالب ها</button></a>
		<form method="POST"><button class="button" name="submit" value="logout">خروج</button></form>
	</menu>
</header>
<content class="body">
	<div class="main designer">
		<h3 class="designer-topic blue-text right">
		طراحی قالب صفحات
		<hr class="square-line" />
		</h3>
		<h5 class="designer-title gray-text">
		تمامی صفحه هایی که شما برای سایت خود در نظر می گیرید، به صورت جداگانه قابل طراحی گرافیکی هستند.
		به این معنی که این امکان برای شما فراهم خواهد بود که هر صفحه را به صورت مجزا، به حالت ثابت ( Static ) و یا پویا ( Dynamic ) طراحی نمایید.
		بدیهی است که این استقلال در طراحی ظاهر صفحه ها، تنوع بیشتری در اختیار شما قرار می دهد و این امکان را برای شما فراهم می آورد تا به اهداف خود دست یابید.
		<br>
		<br>
		<font class="blue-text">
		تمامی صفحه های سایت شما در زیر نمایش داده شده اند.
		همان گونه که از لیست زیر مشخص است، هر کدام از صفحه ها غیر از امکان ویرایش، قابل بازبینی نیز می باشند.
		</font>
		</h5>
		
		<nav class="pages">
		<?php if( isset( $content['nums'] ) ): ?>
		
			<?php for( $c = 1; $c <= $content['nums']; $c++ ): ?>
			
				<?php
					switch( $c % 4 ){
						case( 1 ):
							$color = 'green';
							break;
						case( 2 ):
							$color = 'red';
							break;
						case( 3 ):
							$color = 'blue';
							break;
						case( 0 ):
							$color = 'orange';
							break;
					}
				?>
				
				<div class="page">
					<div class="square-box">
						<div class="square h-<?php echo $color; ?>-border">
						<a href="<?php echo base64_encode( 'ed'. $content[$c]['id']. 'it' ); ?>"><button class="button icon edit <?php echo $color; ?>"></button></a>
						<a href="http://preview.cheltikkeh.com<?php echo $content[$c]['link']; ?>" target="_blank"><button class="button icon preview <?php echo $color; ?>"></button></a>
						<h5 class="page-name <?php echo $color; ?>-text"><?php echo $content[$c]['name']; ?></h5>
						</div>
					</div>
					
					<p class="page-text ltr">
						<?php echo $content[$c]['link']; ?>
					</p>
					<hr class="square-line <?php echo $color; ?>" />
				</div>
				
			<?php endfor; ?>
			
		<?php else: ?>
		
			<div class="page">
				<div class="square-box">
					<div class="square h-green-border">
					<a href="<?php echo base64_encode( 'ed'. $content['id']. 'it' ); ?>"><button class="button icon edit green"></button></a>
					<a href="<?php echo base64_encode( 'sh'. $content['id']. 'ow' ); ?>" target="_blank"><button class="button icon preview green"></button></a>
					<h5 class="page-name green-text"><?php echo $content['name']; ?></h5>
					</div>
				</div>
				
				<p class="page-text ltr">
					<?php echo $content['link']; ?>
				</p>
				<hr class="square-line green	" />
			</div>
			
		<?php endif; ?>
		</nav>
	</div>
</content>

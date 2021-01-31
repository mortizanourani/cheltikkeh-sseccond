<?php
	if( !isset( $_SESSION ) ) session_start();
	
	if( isset( $_SESSION['login_user'] ) ) header( 'location: /controlpanel/posts/' );
	
	switch( $content['operation_answer'] ){
		case( -1 ):
			$_SESSION['login_fail'] = true;
			header( 'location: /login/' );
			die();
			break;
			
		case( 1 ):
			unset( $_SESSION['login_fail'] );
			header( 'location: /controlpanel/posts/' );
			die();
			break;
	}
?>
<header>
	<a class="header-logo" href="/" title="چل تیکه"><img src="/includes/images/logo.png"></a>
	<menu class="main-menu">
		<a href="/terms/" title="قوانین و مقررات"><button class="button">قوانین</button></a>
		<a href="/store/plans/" title="طرح ها"><button class="button">طرح ها</button></a>
		<a href="/store/templates/" title="قالب های آماده"><button class="button">قالب ها</button></a>
		<a href="/about/" title="درباره ما"><button class="button">درباره ما</button></a>
		<a href="http://blog.cheltikkeh.com" title="وبلاگ"><button class="button">وبلاگ</button></a>
	</menu>
</header>
<content class="body">
	<div class="background login-header"></div>



	<div class="main">
		<div class="full-row shadow3">
			<div class="login white">
			<form method="POST" target="">
				<input type="text" class="text h-blue-border black-text ltr" name="username" placeholder="شناسه کاربری" required />
				<br>
				<input type="password" class="text password black-text h-green-border ltr" name="password" placeholder="رمز عبور" required />
				<?php if( isset( $_SESSION['login_fail'] ) ): ?>
					<h5 class="fail-text" style="font: 15px soroosh; color: rgba(220, 75, 75, 1);">نام کاربری یا رمز عبور اشتباه است</h5>
					<?php unset( $_SESSION['login_fail'] ); ?>
				<?php else: ?>
					<br><br>
				<?php endif; ?>
				<button class="button texture submit light-red white-text" name="submit" value="login">ورود</button>
			</form>
			<a href="/forget/"><button class="button texture default-outline btnforget">رمز عبور خود را فراموش کرده اید؟</button></a>
			</div>
		</div>
	</div>
</content>

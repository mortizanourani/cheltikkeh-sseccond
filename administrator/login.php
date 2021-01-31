<div style="margin-top: 100px;">
	<div class="content center">
		<div class="col center">
			<h4 class="topic center">
			ورود به مدیریت سامانه سایت ساز « چل تیکه »
			</h4>
			<form class="form center" method="POST">
				<h4 class="topic center blue-text">مدیران سطح یک</h4>
				<input type="text" class="text blue-text h-orange-border ltr" name="username" placeholder="نام کاربری" required />
				<input type="password" class="text blue-text h-red-border ltr" name="password" placeholder="رمزعبور" required />
				<?php if( !isset( $_SESSION ) ) session_start(); ?>
				<?php if( isset( $_SESSION['login_fail'] ) ): ?>
					<h5 class="center red-text">نام کاربری یا رمزعبور اشتباه است</h5>
				<?php unset( $_SESSION['login_fail'] ); ?>
				<?php endif; ?>
				<button class="button texture submit green white-text center" name="submit" value="login">ورود به سامانه</button>
			</form>
		</div>
	</div>
</div>


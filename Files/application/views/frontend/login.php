<?php if(get_settings('recaptcha_status')): ?>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php endif; ?>
<div class="container margin_60">
	<div class="row justify-content-center">
		<div class="col-xl-6 col-lg-6 col-md-8">
			<div class="box_account">
				<h3 class="client"><?php echo get_phrase('already_registered'); ?></h3>
				<form class="" action="<?php echo site_url('login/validate_login'); ?>" method="post">
					<div class="form_container">
						<div class="divider"><span><?php echo get_phrase('login_credentials'); ?></span></div>
						<div class="form-group">
							<input type="email" class="form-control" name="email" id="email" placeholder="Email*">
						</div>
						<div class="form-group">
							<input type="password" class="form-control" name="password" id="password" value="" placeholder="Password*">
						</div>
						<div class="clearfix add_bottom_15">
							<div class="float-right"><a id="forgot-pass" href="<?php echo site_url('home/forgot_password'); ?>"> <small><?php echo get_phrase('lost_password'); ?>?</small> </a></div>
						</div>

						<?php if(get_settings('recaptcha_status')): ?>
							<div class="form-group">
								<div class="g-recaptcha" data-sitekey="<?php echo get_settings('recaptcha_sitekey'); ?>"></div>
							</div>
						<?php endif; ?>

						<div class="row">
							<div class="col-md-12 mb-2">
								<input type="submit" value="<?php echo get_phrase("log_in"); ?>" class="btn_1 w-100">
							</div>
							<div class="col-md-12">
								<a id="sign_up" class="btn_1 full-width outline wishlist icon-login" href="<?php echo site_url('home/sign_up'); ?>"><?php echo get_phrase("sign_up"); ?></a>
							</div>
						</div>
                        <hr class="my-4">

                        <a href="<?php echo site_url('socialLogin/loginGoogle'); ?>" class="btn btn-lg btn-block btn-primary" style="background-color: #dd4b39;font-size: 14px"><i class="fab fa-google mx-2"></i>  Sign in with Google</a>
                        <a href="<?php echo site_url('socialLogin/loginFacebook'); ?>" class="btn btn-lg btn-block btn-primary mb-2" style="background-color: #3b5998;font-size: 14px"><i class="fab fa-facebook-f mx-2"></i>  Sign in with Facebook</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
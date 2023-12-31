<?php if(get_settings('recaptcha_status')): ?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php endif; ?>
<div class="container margin_60">
  <div class="row justify-content-center">
    <div class="col-xl-6 col-lg-6 col-md-8">
      <div class="box_account">
        <h3 class="new_client"><?php echo get_phrase('new_user'); ?></h3> <small class="float-right pt-2">* <?php echo get_phrase('required_fields'); ?></small>
        <form class="" action="<?php echo site_url('login/register_user') ?>" method="post">
          <div class="form_container">
            <div class="form-group">
              <input type="email" class="form-control" name="email" id="email" placeholder="<?php echo get_phrase('email'); ?>*" required>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name="password" id="password" value="" placeholder="<?php echo get_phrase('password'); ?>*" required>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <input type="text" class="form-control" name="name" placeholder="<?php echo get_phrase('name'); ?> *" required>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <input type="text" class="form-control" name="address" placeholder="<?php echo get_phrase('address'); ?> *" required>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <input type="number" class="form-control" name="phone" placeholder="<?php echo get_phrase('phone'); ?> *" required>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-xl-7">
                <div class="form-group">
                  <label class="container_check">
                    <small>
                      <?php echo get_phrase('accept'); ?> <a href="<?php echo site_url('home/terms_and_conditions'); ?>"><?php echo get_phrase('terms_and_condition'); ?></a>
                      <input type="checkbox" required>
                      <span class="checkmark"></span>
                    </small>
                  </label>
                </div>
              </div>
              
            </div>

            <?php if(get_settings('recaptcha_status')): ?>
              <div class="form-group">
                <div class="g-recaptcha" data-sitekey="<?php echo get_settings('recaptcha_sitekey'); ?>"></div>
              </div>
            <?php endif; ?>
            
            <div class="row mt-1">
              <div class="col-md-12 mb-2">
                <input type="submit" value="<?php echo get_phrase('sign_up'); ?>" class="btn_1 w-100">
              </div>
              <div class="col-md-12">
                
                <a id="login" class="btn_1 full-width outline wishlist icon-login" href="<?php echo site_url('home/login'); ?>">Login</a>
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

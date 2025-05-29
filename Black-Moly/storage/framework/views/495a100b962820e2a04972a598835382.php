<div class="impl_header_wrapper">
    <div class="impl_logo">
        <a href="<?php echo e(route('home')); ?>"><img src="<?php echo e(asset('assets/images/logo.png')); ?>" alt="Logo" class="img-fluid"></a>
    </div>
    <div class="impl_top_header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="impl_top_info">
                        <ul class="impl_header_icons">
                            <!-- Search icon: always visible -->
                            <li class="impl_search"><span><i class="fa fa-search" aria-hidden="true"></i></span></li>

                            <?php if(auth()->guard()->check()): ?>
                                <!-- Show when user is logged in -->
                                <li><a href="<?php echo e(route('compare.index')); ?>"><i class="fa fa-exchange" aria-hidden="true"></i></a></li>
                                <!-- Optionally, show username -->
                                <li>
                                    <a href="<?php echo e(route('profile.index')); ?>">
                                        <i class="fa fa-user" aria-hidden="true"></i> <?php echo e(Auth::user()->name); ?>

                                    </a>
                                </li>

                                <li>
                                    <a href="<?php echo e(route('logout')); ?>"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                                    </a>
                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                        <?php echo csrf_field(); ?>
                                    </form>
                                </li>
                            <?php endif; ?>

                            <?php if(auth()->guard()->guest()): ?>
                                <!-- Show only for guests -->
                                <li><a href="#signin" data-toggle="modal"><i class="fa fa-sign-in" aria-hidden="true"></i></a></li>
                            <?php endif; ?>
                        </ul>
                        <div class="impl_search_overlay">
                            <div class="impl_search_area">
                                <div class="srch_inner">
                                    <form action="#">
                                        <input type="text" placeholder="Search here... ">
                                        <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                    </form>
                                    <div class="srch_close_btn">
                                        <span class="srch_close_btn_icon"><i class="fa fa-times" aria-hidden="true"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--sign-in form-->
    <div class="modal" id="signin">
        <div class="impl_signin">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <form action="<?php echo e(route('login')); ?>" method="POST" class="impl_sign_form">
                <?php echo csrf_field(); ?>
                <h1>Sign In</h1>

                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <?php echo e($errors->first()); ?>

                    </div>
                <?php endif; ?>

                <div class="form-group">
                    <input type="email" name="email" placeholder="Email" class="form-control" value="<?php echo e(old('email')); ?>" required>
                    <span class="form_icon">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                </span>
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" class="form-control" required>
                    <span class="form_icon">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                </span>
                </div>
                <div class="forget_password">
                    <div class="remember_checkbox">
                        <label>Keep me signed in
                            <input type="checkbox" name="remember">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <a href="#">Forgot Password?</a>
                </div>

                <button type="submit" class="impl_btn">Submit</button>

                <p>Don't Have An Account? <a class="impl_modal" href="#signup" data-toggle="modal">Sign Up</a></p>
            </form>

            <div class="impl_sign_img">
                <h2>Welcome To Auto Molly</h2>
                <p>A Perfect Zone To Sell And Purchase Cars</p>
                <div class="impl_sign_bottom">
                    <h3>It’s Not Just A Car</h3>
                    <h3>It’s Someone’s Dream</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="signup">
        <div class="impl_signin">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <div class="impl_sign_form">
                <h1>Sign up</h1>
                <form method="POST" action="<?php echo e(route('register')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Username" class="form-control" required>
                        <span class="form_icon">
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </span>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email" class="form-control" required>
                        <span class="form_icon">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </span>
                    </div>
                    <div class="form-group">
                        <input type="password" name="new_password" placeholder="Password" class="form-control" required>
                        <span class="form_icon">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </span>
                    </div>
                    <div class="form-group">
                        <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control" required>
                        <span class="form_icon">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </span>
                    </div>
                    <div class="form-group">
                        <input type="text" name="telephone" placeholder="Telephone" class="form-control" required>
                        <span class="form_icon">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                    </span>
                    </div>
                    <div class="form-group">
                        <input type="text" name="address" placeholder="Address" class="form-control" required>
                        <span class="form_icon">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                    </span>
                    </div>
                    <button type="submit" class="impl_btn">Sign Up</button>
                </form>
                <p>Dont Have An Account? <a href="#signup" data-toggle="modal" class="impl_modal">Sign Up</a></p>
            </div>
            <div class="impl_sign_img">
                <h2>Welcome To Auto Molly</h2>
                <p>A Perfect Zone To Sell And Purchase Cars</p>
                <div class="impl_sign_bottom">
                    <h3>It’s Not Just A Car </h3>
                    <h3>It’s Someone’s Dream</h3>
                </div>
            </div>
        </div>
    </div>
    <!--menu start-->
    <div class="impl_menu_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <button class="impl_menu_btn">
                        <i class="fa fa-car" aria-hidden="true"></i>
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </button>
                    <div class="impl_menu_inner">
                        <div class="impl_logo_responsive">
                            <a href="index.html"><img src="images/logo1.png" alt="Logo" class="img-fluid"></a>
                        </div>
                        <?php if(auth()->check()): ?>
                            <a href="<?php echo e(route('vehicle.sell')); ?>" class="impl_btn">Sell your car</a>
                        <?php endif; ?>
                        <div class="impl_menu">
                            <nav>
                                <div class="menu_cross">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </div>
                                <ul>
                                    <li><a href="<?php echo e(route('home')); ?>" class="active">Home</a></li>
                                    <li><a href="<?php echo e(route('about')); ?>">About Us</a></li>
                                    <li><a href="<?php echo e(route('customer.vehicles.index')); ?>">Vehicle</a></li>
                                    <li><a href="<?php echo e(route('scanner')); ?>">Scanner AI</a></li>
                                    <li><a href="<?php echo e(route('prediction')); ?>">Price AI</a></li>
                                    <li><a href="<?php echo e(route('leasing')); ?>">Leasing</a> </li>
                                    <li><a href="<?php echo e(route('service')); ?>">Service</a></li>
                                    <li><a href="<?php echo e(route('contact')); ?>">Contact</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php /**PATH D:\Auto-Moly Vehicle Selling Website\auto-molly-web\resources\views/customer/components/header.blade.php ENDPATH**/ ?>
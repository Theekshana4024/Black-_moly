<?php $__env->startSection('content'); ?>
    <!-- Breadcrumb Start -->
    <div class="impl_bread_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1>About Auto Molly</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Company</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- About Section Start -->
    <div class="impl_about_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="impl_heading text-center">
                        <h1>Who We Are</h1>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="impl_about_data">
                        <h2>Welcome to Auto Molly</h2>
                        <p>
                            Auto Molly is a cutting-edge platform that transforms the way people buy, sell, and manage vehicles using AI-powered tools.
                            With our intelligent scanner, automated vehicle scoring system, and secure transaction process, we ensure transparency,
                            accuracy, and peace of mind in every automotive decision. Our goal is to make the automotive journey smarter, safer, and more seamless.
                        </p>
                        <p>
                            Whether you're scanning a car’s performance, analyzing market value, or closing a deal, Auto Molly is your trusted digital co-pilot.
                        </p>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="impl_progress_wrapper">
                        <div class="barWrapper">
                            <span class="progressText">Customers</span>
                            <div class="progress">
                                <div class="progress-bar" style="width: 70%;">
                                    <div class="progress-value">5410+</div>
                                </div>
                            </div>
                        </div>
                        <div class="barWrapper">
                            <span class="progressText">AI Scans Completed</span>
                            <div class="progress">
                                <div class="progress-bar" style="width: 85%;">
                                    <div class="progress-value">8612+</div>
                                </div>
                            </div>
                        </div>
                        <div class="barWrapper">
                            <span class="progressText">Secure Transactions</span>
                            <div class="progress">
                                <div class="progress-bar" style="width: 90%;">
                                    <div class="progress-value">9782+</div>
                                </div>
                            </div>
                        </div>
                        <div class="barWrapper">
                            <span class="progressText">Verified Vehicles</span>
                            <div class="progress">
                                <div class="progress-bar" style="width: 95%;">
                                    <div class="progress-value">6450+</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <?php echo $__env->make('customer.components.testimonial', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('customer.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Auto-Moly Vehicle Selling Website\auto-molly-web\resources\views/customer/pages/about.blade.php ENDPATH**/ ?>
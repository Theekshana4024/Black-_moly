<?php $__env->startSection('content'); ?>
    <div class="impl_bread_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1><?php echo e($vehicle->title); ?></h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo e(route('customer.vehicles.index')); ?>">Vehicles</a></li>
                        <li class="breadcrumb-item active"><?php echo e($vehicle->title); ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!------ Purchase Car Start ------>
    <div class="impl_buy_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="impl_buycar_wrapper">
                        <div class="impl_buycar_color" id="color_car">
                            <div class="slider slider-for1 enlarged-image">
                                <?php $__currentLoopData = $vehicle->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div>
                                        <img src="<?php echo e(asset('storage/' . $image->image_path)); ?>" alt="<?php echo e($vehicle->title); ?>" class="img-fluid">
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php if($vehicle->images->isEmpty()): ?>
                                    <div>
                                        <img src="<?php echo e(asset('images/placeholder-car.jpg')); ?>" alt="<?php echo e($vehicle->title); ?>" class="img-fluid">
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="impl_buycar_data">
                        <h1><?php echo e($vehicle->model->brand->name); ?>, <?php echo e($vehicle->model->name); ?></h1>
                        <h1>Rs <?php echo e(number_format($vehicle->price)); ?></h1>
                        <div class="car_emi_wrapper">
                            <?php
                                $emiEstimate = round($vehicle->price / 36);
                            ?>
                            <span>EMI Starts at Rs <?php echo e(number_format($emiEstimate)); ?> /- *</span>
                            <a href="#"><i class="fa fa-info-circle" aria-hidden="true"></i> Get EMI Assistance</a>
                        </div>
                        <p><?php echo e(Str::limit($vehicle->description, 250)); ?></p>
                        <div class="impl_old_buy_btn">
                            <?php if(auth()->guard()->check()): ?>
                                <a href="<?php echo e(route('checkout', $vehicle->id)); ?>" class="impl_btn">Buy now</a>
                            <?php else: ?>
                                <p class="text-danger">Please log in to continue</p>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!------ Car Specifications Start ------>
    <div class="impl_spesi_wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="impl_car_spesi_list">
                        <div class="impl_heading">
                            <h1>Car Specifications</h1>
                        </div>
                        <ul>
                            <li>
                                <h3>Year</h3>
                                <div class="progress">
                                    <div class="progress-bar" style="width:<?php echo e(min(($vehicle->year - 2000) * 5, 100)); ?>%"></div>
                                </div>
                            </li>
                            <li>
                                <h3>Mileage</h3>
                                <div class="progress">
                                    <?php
                                        $mileagePercentage = min(($vehicle->mileage / 150000) * 100, 100);
                                        $inverseMileage = 100 - $mileagePercentage; // Lower mileage is better
                                    ?>
                                    <div class="progress-bar" style="width:<?php echo e($inverseMileage); ?>%"></div>
                                </div>
                            </li>
                            <li>
                                <h3>Fuel Type</h3>
                                <div class="progress">
                                    <?php
                                        $fuelEfficiency = match($vehicle->fuel_type) {
                                            'electric' => 90,
                                            'hybrid' => 75,
                                            'gas' => 60,
                                            'diesel' => 50,
                                            default => 60
                                        };
                                    ?>
                                    <div class="progress-bar" style="width:<?php echo e($fuelEfficiency); ?>%"></div>
                                </div>
                            </li>
                            <li>
                                <h3>Transmission</h3>
                                <div class="progress">
                                    <?php
                                        $transScore = match($vehicle->transmission) {
                                            'automatic' => 80,
                                            'manual' => 70,
                                            'semi-automatic' => 75,
                                            'cvt' => 85,
                                            default => 70
                                        };
                                    ?>
                                    <div class="progress-bar" style="width:<?php echo e($transScore); ?>%"></div>
                                </div>
                            </li>
                            <li>
                                <h3>Condition</h3>
                                <div class="progress">
                                    <?php
                                        $conditionScore = match($vehicle->condition) {
                                            'new' => 100,
                                            'like new' => 90,
                                            'excellent' => 80,
                                            'good' => 70,
                                            'fair' => 50,
                                            default => 70
                                        };
                                    ?>
                                    <div class="progress-bar" style="width:<?php echo e($conditionScore); ?>%"></div>
                                </div>
                            </li>
                            <?php if($vehicle->history): ?>
                                <li>
                                    <h3>Ownership</h3>
                                    <div class="progress">
                                        <?php
                                            $ownershipScore = match($vehicle->history->ownership_count) {
                                                1 => 90,
                                                2 => 70,
                                                3 => 50,
                                                default => 30
                                            };
                                        ?>
                                        <div class="progress-bar" style="width:<?php echo e($ownershipScore); ?>%"></div>
                                    </div>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>

                <!-- Add trusted score section to the right -->
                <div class="col-lg-6 col-md-12">
                    <div class="impl_trusted_score">
                        <div class="impl_heading">
                            <h1>Trusted Score</h1>
                        </div>

                        <?php
                            // Calculate overall trusted score based on car specifications
                            $yearScore = min(($vehicle->year - 2000) * 0.5, 10) * 0.2;
                            $mileageScore = (10 - min(($vehicle->mileage / 15000), 10)) * 0.2;

                            $fuelTypeScore = match($vehicle->fuel_type) {
                                'electric' => 9.0,
                                'hybrid' => 7.5,
                                'gas' => 6.0,
                                'diesel' => 5.0,
                                default => 6.0
                            } * 0.15;

                            $transmissionScore = match($vehicle->transmission) {
                                'automatic' => 8.0,
                                'manual' => 7.0,
                                'semi-automatic' => 7.5,
                                'cvt' => 8.5,
                                default => 7.0
                            } * 0.15;

                            $conditionScore = match($vehicle->condition) {
                                'new' => 10.0,
                                'like new' => 9.0,
                                'excellent' => 8.0,
                                'good' => 7.0,
                                'fair' => 5.0,
                                default => 7.0
                            } * 0.3;

                            $ownershipScore = 0;
                            if($vehicle->history) {
                                $ownershipScore = match($vehicle->history->ownership_count) {
                                    1 => 9.0,
                                    2 => 7.0,
                                    3 => 5.0,
                                    default => 3.0
                                } * 0.1;
                            }

                            // Calculate final score
                            $trustedScore = $yearScore + $mileageScore + $fuelTypeScore + $transmissionScore + $conditionScore + $ownershipScore;
                            $trustedScore = round($trustedScore, 1);

                            // Determine rating text based on score
                            $ratingText = match(true) {
                                $trustedScore >= 9.0 => 'Exceptional',
                                $trustedScore >= 8.0 => 'Excellent',
                                $trustedScore >= 7.0 => 'Very Good',
                                $trustedScore >= 6.0 => 'Good',
                                $trustedScore >= 5.0 => 'Average',
                                default => 'Fair'
                            };

                            // Calculate percentage for circular progress
                            $scorePercentage = ($trustedScore / 10) * 100;
                        ?>

                        <div class="trusted_score_container">
                            <div class="score_circle_wrapper">
                                <div class="score_circle">
                                    <div class="score_circle_inner" style="--score-percentage: <?php echo e($scorePercentage); ?>%">
                                        <span class="score_value"><?php echo e($trustedScore); ?></span>
                                        <span class="score_max">/10</span>
                                    </div>
                                </div>
                                <h3 class="rating_text"><?php echo e($ratingText); ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!------ Car description wrapper Start ------>
    <div class="impl_descrip_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="impl_heading">
                        <h1>description</h1>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <div class="impl_descrip_box">
                        <h2>Car Brand & Model</h2>
                        <p><?php echo e($vehicle->model->brand->name); ?></p>
                        <p><?php echo e($vehicle->model->name); ?></p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <div class="impl_descrip_box">
                        <h2>FUEL ECONOMY</h2>
                        <p>Fuel Type: <?php echo e(ucfirst($vehicle->fuel_type)); ?></p>
                        <?php if($vehicle->fuel_type !== 'electric'): ?>
                            <p>Estimated MPG: 20-25 city/highway</p>
                        <?php else: ?>
                            <p>Electric Range: 250-300 miles</p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <div class="impl_descrip_box">
                        <h2>ENGINE TYPE</h2>
                        <p><?php echo e(ucfirst($vehicle->fuel_type)); ?> Engine</p>
                        <p><?php echo e(ucfirst($vehicle->transmission)); ?> Transmission</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <div class="impl_descrip_box">
                        <h2>TRANSMISSION</h2>
                        <p><?php echo e(ucfirst($vehicle->transmission)); ?></p>
                        <?php if($vehicle->transmission == 'automatic'): ?>
                            <p>With Manual Shifting Mode</p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <div class="impl_descrip_box">
                        <h2>CONDITION</h2>
                        <p><?php echo e(ucfirst($vehicle->condition)); ?></p>
                        <p>Mileage: <?php echo e(number_format($vehicle->mileage)); ?> miles</p>
                        <?php if($vehicle->history): ?>
                            <p>Ownership: <?php echo e($vehicle->history->ownership_count); ?> owner(s)</p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <div class="impl_descrip_box">
                        <h2>VEHICLE TYPE</h2>
                        <p><?php echo e($vehicle->model->category->name ?? 'Vehicle'); ?></p>
                        <p>Year: <?php echo e($vehicle->year); ?></p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <div class="impl_descrip_box">
                        <h2>LOCATION</h2>
                        <p><?php echo e($vehicle->location); ?></p>
                        <p>Available for viewing</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <div class="impl_descrip_box">
                        <h2>HISTORY</h2>
                        <?php if($vehicle->history): ?>
                            <?php
                                $history = json_decode($vehicle->history, true);
                                $services = $history['services'] ?? [];
                            ?>
                            <p>Accidents: <?php echo e($vehicle->history->accidents ?? 'None reported'); ?></p>
                            <p>Service Records: <?php echo e(count($services)); ?></p>
                            <p>Flood Damage: <?php echo e($vehicle->history->has_flood_damage ? 'Yes' : 'No'); ?></p>
                            <p>Salvage Title: <?php echo e($vehicle->history->has_salvage_title ? 'Yes' : 'No'); ?></p>
                        <?php else: ?>
                            <p>Vehicle history not available</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!------ Related Cars wrapper Start ------>
    <?php if($relatedVehicles->count() > 0): ?>
        <div class="impl_related_wrapper mb-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="impl_heading">
                            <h1>related vehicles</h1>
                        </div>
                    </div>
                    <?php $__currentLoopData = $relatedVehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relatedVehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="impl_fea_car_box">
                                <div class="impl_fea_car_img">
                                    <?php if($relatedVehicle->images->where('is_primary', true)->first()): ?>
                                        <img src="<?php echo e(asset('storage/' . $relatedVehicle->images->where('is_primary', true)->first()->image_path)); ?>" alt="<?php echo e($relatedVehicle->title); ?>" class="img-fluid impl_frst_car_img" />
                                        <img src="<?php echo e(asset('storage/' . $relatedVehicle->images->where('is_primary', true)->first()->image_path)); ?>" alt="<?php echo e($relatedVehicle->title); ?>" class="img-fluid impl_hover_car_img" />
                                    <?php else: ?>
                                        <img src="<?php echo e(asset('images/placeholder-car.jpg')); ?>" alt="<?php echo e($relatedVehicle->title); ?>" class="img-fluid impl_frst_car_img" />
                                        <img src="<?php echo e(asset('images/placeholder-car.jpg')); ?>" alt="<?php echo e($relatedVehicle->title); ?>" class="img-fluid impl_hover_car_img" />
                                    <?php endif; ?>
                                    <span class="impl_img_tag" title="compare">
                            </span>
                                </div>
                                <div class="impl_fea_car_data">
                                    <h2><a href="<?php echo e(route('customer.vehicles.show', $relatedVehicle->slug)); ?>"><?php echo e($relatedVehicle->title); ?></a></h2>
                                    <ul>
                                        <li><span class="impl_fea_title">model</span>
                                            <span class="impl_fea_name"><?php echo e($relatedVehicle->model->name); ?></span></li>
                                        <li><span class="impl_fea_title">Vehicle Status</span>
                                            <span class="impl_fea_name"><?php echo e(ucfirst($relatedVehicle->condition)); ?></span></li>
                                        <li><span class="impl_fea_title">Brand</span>
                                            <span class="impl_fea_name"><?php echo e($relatedVehicle->model->brand->name); ?></span></li>
                                    </ul>
                                    <div class="impl_fea_btn">
                                        <button class="impl_btn">
                                            <span class="impl_doller">Rs <?php echo e(number_format($relatedVehicle->price)); ?></span>
                                            <span class="impl_bnw">Buy now</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <style>
        /* Existing styles */
        .enlarged-image {
            width: 120%; /* Makes image 20% larger than its container */
            max-width: none; /* Removes any max-width restrictions */
            transform: scale(1.2); /* Alternative approach to enlarge by 20% */
            margin: 0 auto; /* Centers the enlarged image */
            object-fit: contain; /* Maintains aspect ratio */
            display: block; /* Ensures proper block formatting */
            transition: all 0.3s ease; /* Adds smooth transition when size changes */
        }

        /* New styles for trusted score */
        .impl_trusted_score {
            padding: 30px;

            border-radius: 10px;
            height: 100%;
        }

        .trusted_score_container {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .score_circle_wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 30px;
        }

        .score_circle {
            position: relative;
            width: 150px;
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }

        .score_circle_inner {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: conic-gradient(
                #007bff 0% var(--score-percentage),
                #e6e6e6 var(--score-percentage) 100%
            );
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .score_circle_inner::before {
            content: '';
            position: absolute;
            width: 130px;
            height: 130px;
            border-radius: 50%;
        }

        .score_value {
            font-size: 42px;
            font-weight: bold;
            color: black;
            position: relative;
            z-index: 2;
            line-height: 1;
        }

        .score_max {
            font-size: 18px;
            color: #666;
            position: relative;
            z-index: 2;
        }

        .rating_text {
            font-size: 24px;
            font-weight: bold;
            color: white;
            margin-top: 10px;
        }


    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('customer.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Auto-Moly Vehicle Selling Website\auto-molly-web\resources\views/customer/pages/vehicles/show.blade.php ENDPATH**/ ?>
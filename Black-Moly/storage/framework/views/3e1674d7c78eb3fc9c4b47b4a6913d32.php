<?php $__env->startSection('content'); ?>
    <div class="impl_compare_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="impl_heading">
                        <h1>Compare Vehicles</h1>
                    </div>
                </div>

                <!-- First Vehicle Selection -->
                <div class="col-lg-6 col-md-6">
                    <div class="impl_cmpr_box">
                        <h2 class="impl_cmpr_title">Select Vehicle 1</h2>
                        <?php if(isset($vehicle1)): ?>
                            <div class="compare_img">
                                <img src="<?php echo e($vehicle1->images->where('is_primary', true)->first()->image_path ?? 'http://via.placeholder.com/200x180'); ?>" alt="<?php echo e($vehicle1->title); ?>" class="img-fluid" />
                                <a href="<?php echo e(route('compare.reset', ['position' => 1])); ?>" class="cmpr_rmv_icon"><i class="fa fa-times" aria-hidden="true"></i></a>
                            </div>
                            <h3><?php echo e($vehicle1->title); ?></h3>
                        <?php else: ?>
                            <div class="compare_select_box custom_select">
                                <select id="vehicle1-select" name="vehicle1">
                                    <option data-display="Select Vehicle">Select Vehicle</option>
                                    <?php $__currentLoopData = $availableVehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($vehicle->id); ?>"><?php echo e($vehicle->title); ?> (<?php echo e($vehicle->year); ?>)</option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Second Vehicle Selection -->
                <div class="col-lg-6 col-md-6">
                    <div class="impl_cmpr_box">
                        <h2 class="impl_cmpr_title">Select Vehicle 2</h2>
                        <?php if(isset($vehicle2)): ?>
                            <div class="compare_img">
                                <img src="<?php echo e($vehicle2->images->where('is_primary', true)->first()->image_path ?? 'http://via.placeholder.com/200x180'); ?>" alt="<?php echo e($vehicle2->title); ?>" class="img-fluid" />
                                <a href="<?php echo e(route('compare.reset', ['position' => 2])); ?>" class="cmpr_rmv_icon"><i class="fa fa-times" aria-hidden="true"></i></a>
                            </div>
                            <h3><?php echo e($vehicle2->title); ?></h3>
                        <?php else: ?>
                            <div class="compare_select_box custom_select">
                                <select id="vehicle2-select" name="vehicle2">
                                    <option data-display="Select Vehicle">Select Vehicle</option>
                                    <?php $__currentLoopData = $availableVehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($vehicle->id); ?>"><?php echo e($vehicle->title); ?> (<?php echo e($vehicle->year); ?>)</option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12">
                    <div class="compare_btn">
                        <button id="compare-btn" class="impl_btn">Compare</button>
                        <a href="<?php echo e(route('compare.reset')); ?>" class="impl_btn">Reset All</a>
                    </div>
                </div>

                <?php if(isset($vehicle1) && isset($vehicle2)): ?>
                    <div class="col-lg-12 col-md-12">
                        <div class="compare_table_wrapper">
                            <div class="compare_list_option">
                                <label class="compare_check_label">
                                    Hide Common Features
                                    <input type="checkbox" id="hide-common" name="check">
                                    <span class="label-text"></span>
                                </label>
                                <label class="compare_check_label">
                                    Highlight Differences
                                    <input type="checkbox" id="highlight-diff" name="check">
                                    <span class="label-text"></span>
                                </label>
                            </div>
                            <div class="compare_table">
                                <table class="table table-bordered table-responsive">
                                    <thead>
                                    <tr>
                                        <th>Specifications</th>
                                        <th><?php echo e($vehicle1->title); ?></th>
                                        <th><?php echo e($vehicle2->title); ?></th>
                                    </tr>
                                    </thead>
                                    <tr class="bg_color">
                                        <td>Price</td>
                                        <td><?php echo e(number_format($vehicle1->price, 2)); ?></td>
                                        <td><?php echo e(number_format($vehicle2->price, 2)); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Year</td>
                                        <td><?php echo e($vehicle1->year); ?></td>
                                        <td><?php echo e($vehicle2->year); ?></td>
                                    </tr>
                                    <tr class="bg_color">
                                        <td>Mileage</td>
                                        <td><?php echo e(number_format($vehicle1->mileage, 2)); ?> km</td>
                                        <td><?php echo e(number_format($vehicle2->mileage, 2)); ?> km</td>
                                    </tr>
                                    <tr>
                                        <td>Fuel Type</td>
                                        <td><?php echo e(ucfirst($vehicle1->fuel_type)); ?></td>
                                        <td><?php echo e(ucfirst($vehicle2->fuel_type)); ?></td>
                                    </tr>
                                    <tr class="bg_color">
                                        <td>Transmission</td>
                                        <td><?php echo e(ucfirst($vehicle1->transmission)); ?></td>
                                        <td><?php echo e(ucfirst($vehicle2->transmission)); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Condition</td>
                                        <td><?php echo e(ucfirst($vehicle1->condition)); ?></td>
                                        <td><?php echo e(ucfirst($vehicle2->condition)); ?></td>
                                    </tr>
                                    <tr class="bg_color">
                                        <td>Location</td>
                                        <td><?php echo e($vehicle1->location); ?></td>
                                        <td><?php echo e($vehicle2->location); ?></td>
                                    </tr>

                                    <?php if(isset($vehicle1->vehicleHistory) && isset($vehicle2->vehicleHistory)): ?>
                                        <tr>
                                            <td colspan="3" class="section-header">Vehicle History</td>
                                        </tr>
                                        <tr class="bg_color">
                                            <td>Previous Accidents</td>
                                            <td><?php echo e($vehicle1->vehicleHistory->accidents); ?></td>
                                            <td><?php echo e($vehicle2->vehicleHistory->accidents); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Ownership Count</td>
                                            <td><?php echo e($vehicle1->vehicleHistory->ownership_count); ?></td>
                                            <td><?php echo e($vehicle2->vehicleHistory->ownership_count); ?></td>
                                        </tr>
                                        <tr class="bg_color">
                                            <td>Actual Mileage</td>
                                            <td><?php echo e($vehicle1->vehicleHistory->actual_mileage ?? 'N/A'); ?></td>
                                            <td><?php echo e($vehicle2->vehicleHistory->actual_mileage ?? 'N/A'); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Flood Damage</td>
                                            <td><?php echo $vehicle1->vehicleHistory->has_flood_damage ? '<i class="fa fa-check" aria-hidden="true"></i>' : '<i class="fa fa-times" aria-hidden="true"></i>'; ?></td>
                                            <td><?php echo $vehicle2->vehicleHistory->has_flood_damage ? '<i class="fa fa-check" aria-hidden="true"></i>' : '<i class="fa fa-times" aria-hidden="true"></i>'; ?></td>
                                        </tr>
                                        <tr class="bg_color">
                                            <td>Salvage Title</td>
                                            <td><?php echo $vehicle1->vehicleHistory->has_salvage_title ? '<i class="fa fa-check" aria-hidden="true"></i>' : '<i class="fa fa-times" aria-hidden="true"></i>'; ?></td>
                                            <td><?php echo $vehicle2->vehicleHistory->has_salvage_title ? '<i class="fa fa-check" aria-hidden="true"></i>' : '<i class="fa fa-times" aria-hidden="true"></i>'; ?></td>
                                        </tr>
                                    <?php endif; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- JavaScript for handling the comparison functionality -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle compare button click
            document.getElementById('compare-btn').addEventListener('click', function() {
                let vehicle1Id = document.getElementById('vehicle1-select')?.value;
                let vehicle2Id = document.getElementById('vehicle2-select')?.value;

                if (vehicle1Id && vehicle2Id) {
                    window.location.href = `/compare/vehicles/${vehicle1Id}/${vehicle2Id}`;
                } else {
                    alert('Please select two vehicles to compare');
                }
            });

            // Handle highlight differences checkbox
            document.getElementById('highlight-diff')?.addEventListener('change', function() {
                const rows = document.querySelectorAll('.compare_table table tr:not(:first-child)');

                rows.forEach(row => {
                    const cells = row.querySelectorAll('td:not(:first-child)');
                    if (cells.length >= 2) {
                        const areEqual = cells[0].textContent.trim() === cells[1].textContent.trim();

                        if (!areEqual && this.checked) {
                            row.classList.add('highlight-diff');
                        } else {
                            row.classList.remove('highlight-diff');
                        }
                    }
                });
            });

            // Handle hide common features checkbox
            document.getElementById('hide-common')?.addEventListener('change', function() {
                const rows = document.querySelectorAll('.compare_table table tr:not(:first-child):not(.section-header)');

                rows.forEach(row => {
                    const cells = row.querySelectorAll('td:not(:first-child)');
                    if (cells.length >= 2) {
                        const areEqual = cells[0].textContent.trim() === cells[1].textContent.trim();

                        if (areEqual && this.checked) {
                            row.style.display = 'none';
                        } else {
                            row.style.display = '';
                        }
                    }
                });
            });
        });
    </script>

    <style>
        .highlight-diff {
            background-color: #fff3cd !important;
        }

        .section-header {
            background-color: #343a40;
            color: white;
            font-weight: bold;
            text-align: center;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('customer.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Auto-Moly Vehicle Selling Website\auto-molly-web\resources\views/customer/pages/vehicles/compare.blade.php ENDPATH**/ ?>
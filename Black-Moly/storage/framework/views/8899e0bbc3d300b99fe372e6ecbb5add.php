<?php $__env->startSection('content'); ?>
    <!------ Breadcrumbs Start ------>
    <div class="impl_bread_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1>Edit Your Vehicle</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo e(route('profile.index', ['tab' => 'vehicles'])); ?>">My Vehicles</a></li>
                        <li class="breadcrumb-item active">Edit Vehicle</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!------ Edit Vehicle wrapper Start ------>
    <div class="impl_sell_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="impl_heading">
                        <h1>Edit Your Vehicle Listing</h1>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <?php if(session('error')): ?>
                        <div class="alert alert-danger">
                            <?php echo e(session('error')); ?>

                        </div>
                    <?php endif; ?>

                    <form id="impl_sform" action="<?php echo e(route('vehicle.update', $vehicle->id)); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="impl_steps_wrapper">
                            <h3><span class="step_number">1</span></h3>
                            <section>
                                <div class="impl_step">
                                    <h2 class="step-title">Car Details</h2>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <input id="step_year" type="text" name="name" class="form-control required" placeholder="TITLE*" value="<?php echo e($vehicle->title); ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <select id="model_id" name="model_id" class="form-control required">
                                                    <option value="">SELECT MODEL*</option>
                                                    <?php $__currentLoopData = $carModels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $carModel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($carModel->id); ?>" <?php echo e($vehicle->model_id == $carModel->id ? 'selected' : ''); ?>><?php echo e($carModel->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <input id="step_year" type="text" name="year" class="form-control required number" placeholder="YEAR*" value="<?php echo e($vehicle->year); ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <input id="step_meter" type="text" name="mileage" class="form-control required number" placeholder="KILOMETERS DRIVEN*" value="<?php echo e($vehicle->mileage); ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <select id="condition" name="condition" class="form-control required">
                                                    <option value="">CONDITION*</option>
                                                    <option value="new" <?php echo e($vehicle->condition == 'new' ? 'selected' : ''); ?>>New</option>
                                                    <option value="used" <?php echo e($vehicle->condition == 'used' ? 'selected' : ''); ?>>Used</option>
                                                    <option value="pre-owned" <?php echo e($vehicle->condition == 'pre-owned' ? 'selected' : ''); ?>>Pre-Owned</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <select id="transmission" name="transmission" class="form-control required">
                                                    <option value="">TRANSMISSION*</option>
                                                    <option value="auto" <?php echo e($vehicle->transmission == 'auto' ? 'selected' : ''); ?>>Automatic</option>
                                                    <option value="manual" <?php echo e($vehicle->transmission == 'manual' ? 'selected' : ''); ?>>Manual</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <select id="fuel_type" name="fuel_type" class="form-control required">
                                                    <option value="">FUEL TYPE*</option>
                                                    <option value="diesel" <?php echo e($vehicle->fuel_type == 'diesel' ? 'selected' : ''); ?>>Diesel</option>
                                                    <option value="petrol" <?php echo e($vehicle->fuel_type == 'petrol' ? 'selected' : ''); ?>>Petrol</option>
                                                    <option value="electric" <?php echo e($vehicle->fuel_type == 'electric' ? 'selected' : ''); ?>>Electric</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <input id="step_price" type="text" name="price" class="form-control required number" placeholder="PRICE*" value="<?php echo e($vehicle->price); ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <textarea id="description" name="description" class="form-control" placeholder="VEHICLE DESCRIPTION" rows="4"><?php echo e($vehicle->description); ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <textarea id="location" name="location" class="form-control required" placeholder="LOCATION*" rows="2"><?php echo e($vehicle->location); ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <!-- Step 2: Vehicle History -->
                            <h3><span class="step_number">2</span></h3>
                            <section>
                                <div class="impl_step">
                                    <h2 class="step-title">Vehicle History</h2>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <input id="accidents" type="number" name="accidents" class="form-control" placeholder="NUMBER OF ACCIDENTS" min="0" value="<?php echo e($vehicleHistory->accidents ?? 0); ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <input id="ownership_count" type="number" name="ownership_count" class="form-control" placeholder="NUMBER OF PREVIOUS OWNERS" min="0" value="<?php echo e($vehicleHistory->ownership_count ?? 1); ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <select id="has_flood_damage" name="has_flood_damage" class="form-control">
                                                    <option value="">FLOOD DAMAGE?</option>
                                                    <option value="0" <?php echo e(isset($vehicleHistory->has_flood_damage) && $vehicleHistory->has_flood_damage == 0 ? 'selected' : ''); ?>>No</option>
                                                    <option value="1" <?php echo e(isset($vehicleHistory->has_flood_damage) && $vehicleHistory->has_flood_damage == 1 ? 'selected' : ''); ?>>Yes</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <select id="has_salvage_title" name="has_salvage_title" class="form-control">
                                                    <option value="">SALVAGE TITLE?</option>
                                                    <option value="0" <?php echo e(isset($vehicleHistory->has_salvage_title) && $vehicleHistory->has_salvage_title == 0 ? 'selected' : ''); ?>>No</option>
                                                    <option value="1" <?php echo e(isset($vehicleHistory->has_salvage_title) && $vehicleHistory->has_salvage_title == 1 ? 'selected' : ''); ?>>Yes</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <!-- Step 3: Service Records -->
                            <h3><span class="step_number">3</span></h3>
                            <section>
                                <div class="impl_step">
                                    <h2 class="step-title">VEHICLE Service Records</h2>
                                    <div class="row">
                                        <?php
                                            $serviceRecords = isset($vehicleHistory->service_records) ? json_decode($vehicleHistory->service_records, true) : [];
                                        ?>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="battery_check">Battery Check:</label>
                                                <input id="battery_check" type="date" name="services[battery_check]" class="form-control" value="<?php echo e($serviceRecords['battery_check'] ?? ''); ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="tire_rotation">Tire Rotation:</label>
                                                <input id="tire_rotation" type="date" name="services[tire_rotation]" class="form-control" value="<?php echo e($serviceRecords['tire_rotation'] ?? ''); ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="last_service">Last Service Date:</label>
                                                <input id="last_service" type="date" name="last_service" class="form-control" value="<?php echo e($serviceRecords['last_service'] ?? ''); ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="next_service_due">Next Service Due:</label>
                                                <input id="next_service_due" type="date" name="next_service_due" class="form-control" value="<?php echo e($serviceRecords['next_service_due'] ?? ''); ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <textarea id="history_notes" name="history_notes" class="form-control" placeholder="ADDITIONAL HISTORY NOTES" rows="3"><?php echo e($vehicleHistory->notes ?? ''); ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <!-- Step 4: Car Images -->
                            <h3><span class="step_number">4</span></h3>
                            <section>
                                <div class="impl_step">
                                    <h2 class="step-title">VEHICLE Images</h2>
                                    <div class="row">
                                        <!-- Current Images Display -->
                                        <div class="col-lg-12 col-md-12 mb-4">
                                            <h4>Current Images</h4>
                                            <div class="current-images" style="display: flex; flex-wrap: wrap; gap: 15px; margin-bottom: 20px;">
                                                <?php $__currentLoopData = $vehicle->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="image-container" style="position: relative; width: 150px;">
                                                        <img src="<?php echo e(asset('storage/' . $image->image_path)); ?>" alt="Vehicle Image" class="img-thumbnail" style="width: 100%; height: auto;">
                                                        <div class="image-actions" style="margin-top: 5px; display: flex; justify-content: space-between;">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="primary_image_existing" value="<?php echo e($image->id); ?>" <?php echo e($image->is_primary ? 'checked' : ''); ?>>
                                                                <label class="form-check-label">Primary</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="delete_images[]" value="<?php echo e($image->id); ?>">
                                                                <label class="form-check-label">Delete</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>

                                        <!-- Upload New Images -->
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label for="carImages" class="btn btn-primary btn-lg btn-block">
                                                    <i class="fa fa-upload"></i> Upload New Images
                                                </label>
                                                <input type="file" id="carImages" name="car_images[]" accept="image/*" multiple style="display: none;">
                                                <small class="form-text text-muted">Upload additional images for your vehicle</small>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <div id="preview" class="image-preview-container" style="margin-top: 20px; display: flex; flex-wrap: wrap; gap: 10px;"></div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label>Select Primary Image (for new uploads):</label>
                                                <select id="primary_image_new" name="primary_image_new" class="form-control">
                                                    <option value="">Select primary image after uploading</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group text-center">
                                                <button type="submit" class="btn btn-success btn-lg">Update Listing</button>
                                                <a href="<?php echo e(route('profile.index', ['tab' => 'vehicles'])); ?>" class="btn btn-secondary btn-lg">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // JavaScript to handle dynamic interactions
        document.addEventListener('DOMContentLoaded', function() {
            const imageInput = document.getElementById('carImages');
            const previewContainer = document.getElementById('preview');
            const primaryImageSelect = document.getElementById('primary_image_new');

            imageInput.addEventListener('change', function() {
                // Clear previous previews
                previewContainer.innerHTML = '';
                primaryImageSelect.innerHTML = '<option value="">Select primary image</option>';

                if (this.files) {
                    // Process the new files
                    const maxFiles = 10;
                    const filesToProcess = this.files.length > maxFiles ? maxFiles : this.files.length;

                    for (let i = 0; i < filesToProcess; i++) {
                        const file = this.files[i];

                        // Create image preview
                        const imageContainer = document.createElement('div');
                        imageContainer.className = 'image-preview';
                        imageContainer.style.width = '150px';
                        imageContainer.style.position = 'relative';

                        const img = document.createElement('img');
                        img.src = URL.createObjectURL(file);
                        img.style.width = '100%';
                        img.style.height = 'auto';
                        img.style.borderRadius = '4px';
                        imageContainer.appendChild(img);

                        // Remove button
                        const removeBtn = document.createElement('button');
                        removeBtn.type = 'button';
                        removeBtn.className = 'btn btn-danger btn-sm';
                        removeBtn.style.position = 'absolute';
                        removeBtn.style.top = '5px';
                        removeBtn.style.right = '5px';
                        removeBtn.innerHTML = '&times;';
                        removeBtn.dataset.index = i;
                        removeBtn.addEventListener('click', function() {
                            imageContainer.remove();
                            // Would need to update the file input here
                        });
                        imageContainer.appendChild(removeBtn);

                        previewContainer.appendChild(imageContainer);

                        // Add to primary image dropdown
                        const option = document.createElement('option');
                        option.value = i;
                        option.textContent = `New Image ${i+1}`;
                        primaryImageSelect.appendChild(option);
                    }
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('customer.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Auto-Moly Vehicle Selling Website\auto-molly-web\resources\views/customer/pages/vehicles/edit.blade.php ENDPATH**/ ?>
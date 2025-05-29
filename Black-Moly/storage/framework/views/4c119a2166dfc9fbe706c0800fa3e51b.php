<?php $__env->startSection('content'); ?>
    <!------ Breadcrumbs Start ------>
    <div class="impl_bread_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1><?php echo e(isset($condition) ? ucfirst($condition) . ' Vehicles' : 'Vehicles'); ?></h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
                        <li class="breadcrumb-item active"><?php echo e(isset($condition) ? ucfirst($condition) . ' Vehicles' : 'Vehicles'); ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!------ Purchase new section Start ------>
    <div class="impl_purchase_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="impl_sorting_text custom_select">
                        <span class="impl_show"> Showing <?php echo e($vehicles->firstItem()); ?> - <?php echo e($vehicles->lastItem()); ?> of <?php echo e($totalVehicles); ?> Results</span>
                        <div class="impl_select_wrapper">
                            <span>sort by</span>
                            <select onchange="location = this.value;">
                                <option value="<?php echo e(request()->fullUrlWithQuery(['sort' => 'newest'])); ?>" <?php echo e(request('sort') == 'newest' ? 'selected' : ''); ?>>Newest</option>
                                <option value="<?php echo e(request()->fullUrlWithQuery(['sort' => 'oldest'])); ?>" <?php echo e(request('sort') == 'oldest' ? 'selected' : ''); ?>>Oldest</option>
                                <option value="<?php echo e(request()->fullUrlWithQuery(['sort' => 'price_high'])); ?>" <?php echo e(request('sort') == 'price_high' ? 'selected' : ''); ?>>Price High to Low</option>
                                <option value="<?php echo e(request()->fullUrlWithQuery(['sort' => 'price_low'])); ?>" <?php echo e(request('sort') == 'price_low' ? 'selected' : ''); ?>>Price Low to High</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="impl_purchase_inner">
                        <div class="row">
                            <div class="col-lg-3 col-md-4">
                                <div class="impl_sidebar">
                                    <div class="impl_product_search widget woocommerce">
                                        <form action="<?php echo e(route('customer.vehicles.search')); ?>" method="GET">
                                            <div class="impl_footer_subs">
                                                <input type="text" name="query" class="form-control" placeholder="Search..." value="<?php echo e(request('query')); ?>">
                                                <button type="submit" class="foo_subs_btn"><i class="fa fa-search" aria-hidden="true"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                    <!--Brands-->
                                    <div class="impl_product_brand widget woocommerce">
                                        <h2 class="widget-title">brands</h2>
                                        <form id="brand-filter-form" action="<?php echo e(route('customer.vehicles.index')); ?>" method="GET">
                                            <input type="hidden" name="sort" value="<?php echo e(request('sort')); ?>">
                                            <ul>
                                                <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li>
                                                        <label class="brnds_check_label">
                                                            <?php echo e($brand->name); ?>

                                                            <input type="checkbox" name="brand[]" value="<?php echo e($brand->id); ?>"
                                                                   <?php echo e(in_array($brand->id, (array)request('brand')) ? 'checked' : ''); ?>

                                                                   onchange="document.getElementById('brand-filter-form').submit()">
                                                            <span class="label-text"></span>
                                                        </label>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </form>
                                    </div>
                                    <!--Price Range-->
                                    <div class="impl_product_price widget woocommerce">
                                        <h2 class="widget-title">price range</h2>
                                        <div class="price_range">
                                            <input type="text" id="range_24" name="ionRangeSlider" value=""
                                                   data-min="<?php echo e($minPrice); ?>"
                                                   data-max="<?php echo e($maxPrice); ?>"
                                                   data-from="<?php echo e(request('price_min') ?? $minPrice); ?>"
                                                   data-to="<?php echo e(request('price_max') ?? $maxPrice); ?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-8">
                                <div class="row">
                                    <?php $__empty_1 = true; $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <div class="col-lg-4 col-md-6 mb-4">
                                            <div class="impl_fea_car_box">
                                                <div class="impl_fea_car_img">
                                                    <?php if($vehicle->images->where('is_primary', true)->first()): ?>
                                                        <img src="<?php echo e(asset('storage/' . $vehicle->images->where('is_primary', true)->first()->image_path)); ?>" alt="<?php echo e($vehicle->title); ?>" class="img-fluid impl_frst_car_img" />
                                                        <img src="<?php echo e(asset('storage/' . $vehicle->images->where('is_primary', true)->first()->image_path)); ?>" alt="<?php echo e($vehicle->title); ?>" class="img-fluid impl_hover_car_img" />
                                                    <?php else: ?>
                                                        <img src="<?php echo e(asset('images/placeholder-car.jpg')); ?>" alt="<?php echo e($vehicle->title); ?>" class="img-fluid impl_frst_car_img" />
                                                        <img src="<?php echo e(asset('images/placeholder-car.jpg')); ?>" alt="<?php echo e($vehicle->title); ?>" class="img-fluid impl_hover_car_img" />
                                                    <?php endif; ?>
                                                </div>
                                                <div class="impl_fea_car_data">
                                                    <h2><a href="<?php echo e(route('customer.vehicles.show', $vehicle->slug)); ?>"><?php echo e($vehicle->title); ?></a></h2>
                                                    <ul>
                                                        <li><span class="impl_fea_title">model</span>
                                                            <span class="impl_fea_name"><?php echo e($vehicle->model->name); ?></span></li>
                                                        <li><span class="impl_fea_title">Vehicle Status</span>
                                                            <span class="impl_fea_name"><?php echo e(ucfirst($vehicle->condition)); ?></span></li>
                                                        <li><span class="impl_fea_title">Brand</span>
                                                            <span class="impl_fea_name"><?php echo e($vehicle->model->brand->name); ?></span></li>
                                                    </ul>
                                                    <div class="impl_fea_btn">
                                                        <button class="impl_btn">
                                                            <span class="impl_doller">Rs <?php echo e(number_format($vehicle->price)); ?></span>
                                                            <span class="impl_bnw">buy now</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <div class="col-12">
                                            <div class="alert alert-info">No vehicles found matching your criteria.</div>
                                        </div>
                                    <?php endif; ?>

                                    <!--pagination start-->
                                    <div class="col-lg-12 col-md-12">
                                        <div class="impl_pagination_wrapper">
                                            <?php echo e($vehicles->links()); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        // Price range slider initialization
        $(document).ready(function() {
            $("#range_24").ionRangeSlider({
                type: "double",
                min: $("#range_24").data('min'),
                max: $("#range_24").data('max'),
                from: $("#range_24").data('from'),
                to: $("#range_24").data('to'),
                prefix: "$",
                grid: true,
                onFinish: function(data) {
                    window.location.href = "<?php echo e(request()->url()); ?>?price_min=" + data.from + "&price_max=" + data.to +
                        "&sort=<?php echo e(request('sort')); ?>" +
                        "<?php echo e(request('brand') ? '&brand[]=' . implode('&brand[]=', (array)request('brand')) : ''); ?>" +
                        "<?php echo e(request('category') ? '&category=' . request('category') : ''); ?>";
                }
            });
        });

        // Add category filter
        function addCategoryFilter(categoryId) {
            document.getElementById('category-filter').value = categoryId;
            document.getElementById('category-filter-form').submit();
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('customer.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Auto-Moly Vehicle Selling Website\auto-molly-web\resources\views/customer/pages/vehicles/index.blade.php ENDPATH**/ ?>
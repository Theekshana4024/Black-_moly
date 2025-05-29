@extends('customer.layouts.app')
@section('content')
    <!------ Breadcrumbs Start ------>
    <div class="impl_bread_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1>sell your car</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">sell your car</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!------ Sell wrapper  Start ------>
    <div class="impl_sell_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="impl_heading">
                        <h1>Sell your car in just 5 easy steps</h1>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <form id="impl_sform" action="{{route('vehicle.sell')}}" method="POST" enctype="multipart/form-data">
                        <!-- CSRF Token for Laravel -->
                        @method('POST')
                        @csrf
                        <div class="impl_steps_wrapper">
                            <h3><span class="step_number">1</span></h3>
                            <section>
                                <div class="impl_step">
                                    <h2 class="step-title">Car Details</h2>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <input id="step_year" type="text" name="name" class="form-control required number" placeholder="TITLE*">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <select id="model_id" name="model_id" class="form-control required">
                                                    <option value="">SELECT MODEL*</option>
                                                    @foreach ($carModels as $carModel)
                                                        <option value="{{ $carModel->id }}">{{ $carModel->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <input id="step_year" type="text" name="year" class="form-control required number" placeholder="YEAR*">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <input id="step_meter" type="text" name="mileage" class="form-control required number" placeholder="KILOMETERS DRIVEN*">
                                            </div>
                                        </div>
                                        <!-- Replace color with condition -->
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <select id="condition" name="condition" class="form-control required">
                                                    <option value="">CONDITION*</option>
                                                    <option value="new">New</option>
                                                    <option value="used">Used</option>
                                                    <option value="pre-owned">Pre-Owned</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- Transmission -->
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <select id="transmission" name="transmission" class="form-control required">
                                                    <option value="">TRANSMISSION*</option>
                                                    <option value="auto">Automatic</option>
                                                    <option value="manual">Manual</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- Fuel Type -->
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <select id="fuel_type" name="fuel_type" class="form-control required">
                                                    <option value="">FUEL TYPE*</option>
                                                    <option value="diesel">Diesel</option>
                                                    <option value="petrol">Petrol</option>
                                                    <option value="electric">Electric</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- Price -->
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <input id="step_price" type="text" name="price" class="form-control required number" placeholder="PRICE*">
                                            </div>
                                        </div>
                                        <!-- Description & Location -->
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <textarea id="description" name="description" class="form-control" placeholder="VEHICLE DESCRIPTION" rows="4"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <textarea id="location" name="location" class="form-control required" placeholder="LOCATION*" rows="2"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!-- Step 4: Vehicle History -->
                            <h3><span class="step_number">2</span></h3>
                            <section>
                                <div class="impl_step">
                                    <h2 class="step-title">Vehicle History</h2>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <input id="accidents" type="number" name="accidents" class="form-control" placeholder="NUMBER OF ACCIDENTS" min="0">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <input id="ownership_count" type="number" name="ownership_count" class="form-control" placeholder="NUMBER OF PREVIOUS OWNERS" min="0">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <select id="has_flood_damage" name="has_flood_damage" class="form-control">
                                                    <option value="">FLOOD DAMAGE?</option>
                                                    <option value="0">No</option>
                                                    <option value="1">Yes</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <select id="has_salvage_title" name="has_salvage_title" class="form-control">
                                                    <option value="">SALVAGE TITLE?</option>
                                                    <option value="0">No</option>
                                                    <option value="1">Yes</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- Updated Service Records Section -->
                                    </div>
                                </div>
                            </section>

                            <h3><span class="step_number">3</span></h3>
                            <section>
                                <div class="impl_step">
                                    <h2 class="step-title">VEHICLE Sevice Records</h2>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="battery_check">Battery Check:</label>
                                                <input id="battery_check" type="date" name="services[battery_check]" class="form-control" value="2023-09-10">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="tire_rotation">Tire Rotation:</label>
                                                <input id="tire_rotation" type="date" name="services[tire_rotation]" class="form-control" value="2023-08-01">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="last_service">Last Service Date:</label>
                                                <input id="last_service" type="date" name="last_service" class="form-control" value="2023-09-10">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="next_service_due">Next Service Due:</label>
                                                <input id="next_service_due" type="date" name="next_service_due" class="form-control" value="2024-09-10">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <textarea id="history_notes" name="history_notes" class="form-control" placeholder="ADDITIONAL HISTORY NOTES" rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <!-- Step 5: Car Images -->
                            <h3><span class="step_number">4</span></h3>
                            <section>
                                <div class="impl_step">
                                    <h2 class="step-title">VEHICLE Images</h2>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label for="carImages" class="btn btn-primary btn-lg btn-block">
                                                    <i class="fa fa-upload"></i> Upload Car Images
                                                </label>
                                                <input type="file" id="carImages" name="car_images[]" accept="image/*" multiple style="display: none;">
                                                <small class="form-text text-muted">Upload multiple images of your vehicle (max 10 images)</small>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <div id="preview" class="image-preview-container" style="margin-top: 20px; display: flex; flex-wrap: wrap; gap: 10px;"></div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label>Select Primary Image:</label>
                                                <select id="primary_image" name="primary_image" class="form-control">
                                                    <option value="">Select primary image after uploading</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group text-center">
                                                <button type="submit" class="btn btn-success btn-lg">Submit Listing</button>
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
            const primaryImageSelect = document.getElementById('primary_image');

            imageInput.addEventListener('change', function() {
                // Clear previous previews
                previewContainer.innerHTML = '';
                primaryImageSelect.innerHTML = '<option value="">Select primary image</option>';

                if (this.files) {
                    // Limit to 10 images
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
                        option.textContent = `Image ${i+1}`;
                        primaryImageSelect.appendChild(option);
                    }
                }
            });
        });
    </script>
@endsection

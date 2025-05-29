<?php $__env->startSection('content'); ?>
    <div class="impl_bread_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1>Car Diagnostic System</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Car Diagnostic</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="impl_sell_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="impl_heading">
                        <h1>Get Car Problems & Solutions</h1>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12">
                    <div class="diagnostic_form_section">
                        <div class="impl_step">
                            <h2 class="step-title">Car Details</h2>
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <input id="car_model" type="text" name="car_model" class="form-control required" placeholder="CAR MODEL (e.g. Toyota Corolla)">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <input id="manufacture_year" type="number" name="manufacture_year" class="form-control required number" placeholder="MANUFACTURE YEAR (e.g. 2015)">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 text-center">
                                    <button id="diagnoseBtn" class="impl_btn">Diagnose Car</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Results Section (Initially Hidden) -->
                    <div id="diagnostic_results" class="diagnostic_results" style="display: none;">
                        <div class="impl_step">
                            <h2 class="step-title">Diagnostic Results</h2>

                            <!-- Vehicle Information -->
                            <div class="vehicle_info_section">
                                <h3>Vehicle Information</h3>
                                <div class="vehicle_info_card">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="info_item">
                                                <span class="info_label">Car Model:</span>
                                                <span id="result_car_model" class="info_value">Toyota Corolla</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="info_item">
                                                <span class="info_label">Manufacture Year:</span>
                                                <span id="result_year" class="info_value">2015</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="info_item">
                                                <span class="info_label">Vehicle Age:</span>
                                                <span id="result_age" class="info_value">10 Years</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="info_item">
                                                <span class="info_label">Fuel Economy:</span>
                                                <span id="result_fuel" class="info_value">8.5 L/100km</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-3">
                                            <div class="info_item">
                                                <span class="info_label">Ground Clearance:</span>
                                                <span id="result_clearance" class="info_value">18.3 cm</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Performance Gauge Section -->
                            <div class="performance_metrics">
                                <h3>Vehicle Performance Metrics</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="gauge_container">
                                            <h4>Fuel Efficiency</h4>
                                            <div class="gauge" id="fuel_gauge">
                                                <div class="gauge-body">
                                                    <div class="gauge-fill" id="fuel_gauge_fill"></div>
                                                    <div class="gauge-cover" id="fuel_gauge_text"></div>
                                                </div>
                                                <div class="gauge-labels">
                                                    <span>Excellent</span>
                                                    <span>Poor</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="gauge_container">
                                            <h4>Ground Clearance</h4>
                                            <div class="gauge" id="clearance_gauge">
                                                <div class="gauge-body">
                                                    <div class="gauge-fill" id="clearance_gauge_fill"></div>
                                                    <div class="gauge-cover" id="clearance_gauge_text"></div>
                                                </div>
                                                <div class="gauge-labels">
                                                    <span>Low</span>
                                                    <span>High</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Most Likely Problem & Solution -->
                            <div class="diagnosis_summary">
                                <h3>Primary Diagnosis</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="diagnosis_card problem_card">
                                            <h4>Most Likely Problem</h4>
                                            <p id="most_likely_problem">Cloudy headlights</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="diagnosis_card solution_card">
                                            <h4>Recommended Solution</h4>
                                            <p id="most_likely_solution">Headlight restoration</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Potential Problems & Solutions -->
                            <div class="detailed_diagnosis">
                                <h3>Detailed Diagnosis</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="impl_fea_car_data">
                                            <h4>Potential Problems</h4>
                                            <ul id="potential_problems_list" class="diagnosis_list">
                                                <!-- Will be populated dynamically -->
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="impl_fea_car_data">
                                            <h4>Potential Solutions</h4>
                                            <ul id="potential_solutions_list" class="diagnosis_list">
                                                <!-- Will be populated dynamically -->
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Service Recommendations -->
                            <div class="service_recommendations mt-4">
                                <h3>Maintenance Recommendations</h3>
                                <div class="recommendations_container" id="maintenance_recommendations">
                                    <!-- Will be populated dynamically based on vehicle age and model -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom CSS -->
    <style>
        .diagnostic_form_section {
            padding: 30px;
            border-radius: 5px;
            margin-bottom: 40px;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
        }

        .diagnostic_results {
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            margin-top: 40px;
            background-color: #2c3e50;
            color: #fff;
        }

        .vehicle_info_card {
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 30px;
            background-color: rgba(255,255,255,0.1);
        }

        .info_item {
            margin-bottom: 10px;
        }

        .info_label {
            font-weight: bold;
            color: #fff;
        }

        .info_value {
            font-weight: 600;
            color: #fff;
            margin-left: 10px;
        }

        .diagnosis_card {
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 30px;
            min-height: 150px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .diagnosis_card h4 {
            margin-bottom: 15px;
            font-weight: 600;
        }

        .diagnosis_card p {
            font-size: 18px;
            font-weight: 500;
        }

        .problem_card {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }

        .solution_card {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }

        .diagnosis_list {
            list-style: none;
            padding: 0;
            background-color: rgba(255,255,255,0.1);
            border-radius: 5px;
        }

        .diagnosis_list li {
            padding: 12px 15px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            display: flex;
            justify-content: space-between;
            color: #fff;
        }

        .diagnosis_list li:last-child {
            border-bottom: none;
        }

        .diagnosis_list li .problem,
        .diagnosis_list li .solution {
            font-weight: 500;
        }

        .diagnosis_list li .probability {
            background-color: #007bff;
            color: white;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .impl_btn {
            background-color: #2c3e50;
            color: #fff;
            border: none;
            padding: 12px 30px;
            font-size: 16px;
            border-radius: 30px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 600;
            margin-top: 20px;
        }

        .impl_btn:hover {
            background-color: #1a252f;
        }

        .vehicle_info_section h3,
        .detailed_diagnosis h3,
        .performance_metrics h3,
        .service_recommendations h3 {
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid rgba(255,255,255,0.2);
            color: #fff;
        }

        .detailed_diagnosis h4 {
            color: #fff;
            margin-bottom: 15px;
        }

        /* Performance Gauge Styles */
        .performance_metrics {
            margin-bottom: 30px;
        }

        .gauge_container {
            text-align: center;
            padding: 20px;
            background-color: rgba(255,255,255,0.1);
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .gauge_container h4 {
            color: #fff;
            margin-bottom: 15px;
        }

        .gauge {
            width: 100%;
            max-width: 250px;
            margin: 0 auto;
        }

        .gauge-body {
            width: 100%;
            height: 0;
            padding-bottom: 50%;
            background: #444;
            position: relative;
            border-top-left-radius: 100% 200%;
            border-top-right-radius: 100% 200%;
            overflow: hidden;
        }

        .gauge-fill {
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, #00ff00, #ff0000);
            transform-origin: center top;
            transform: rotate(0.5turn);
            transition: transform 0.5s ease-out;
        }

        .gauge-cover {
            width: 75%;
            height: 150%;
            background: #2c3e50;
            border-radius: 50%;
            position: absolute;
            top: 25%;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding-bottom: 25%;
            box-sizing: border-box;
            color: #fff;
            font-weight: bold;
            font-size: 1.5em;
        }

        .gauge-labels {
            display: flex;
            justify-content: space-between;
            padding: 5px 10px;
            color: #fff;
            font-size: 0.8em;
        }

        /* Recommendations Styles */
        .recommendations_container {
            background-color: rgba(255,255,255,0.1);
            border-radius: 5px;
            padding: 15px;
        }

        .recommendation_item {
            padding: 10px 15px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
        }

        .recommendation_item:last-child {
            border-bottom: none;
        }

        .recommendation_icon {
            margin-right: 15px;
            font-size: 20px;
            color: #ffc107;
        }

        .recommendation_text {
            flex-grow: 1;
        }

        .recommendation_priority {
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            background-color: #dc3545;
            color: white;
        }

        .priority-high {
            background-color: #dc3545;
        }

        .priority-medium {
            background-color: #ffc107;
            color: #212529;
        }

        .priority-low {
            background-color: #28a745;
        }
    </style>

    <!-- JavaScript for API Integration -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const diagnoseBtn = document.getElementById('diagnoseBtn');

            diagnoseBtn.addEventListener('click', function() {
                const carModel = document.getElementById('car_model').value.trim();
                const manufactureYear = document.getElementById('manufacture_year').value.trim();

                // Basic validation
                if (!carModel || !manufactureYear) {
                    alert('Please enter both car model and manufacture year');
                    return;
                }

                // Show loading state
                diagnoseBtn.textContent = 'Processing...';
                diagnoseBtn.disabled = true;

                // Prepare data for API
                const data = {
                    car_model: carModel,
                    manufacture_year: parseInt(manufactureYear)
                };

                // Call API
                fetch('http://localhost:5000/predict', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Display results
                        displayResults(data);

                        // Reset button state
                        diagnoseBtn.textContent = 'Diagnose Car';
                        diagnoseBtn.disabled = false;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error fetching diagnostic data. Please try again.');

                        // Reset button state
                        diagnoseBtn.textContent = 'Diagnose Car';
                        diagnoseBtn.disabled = false;
                    });
            });

            function displayResults(data) {
                // Show results section
                document.getElementById('diagnostic_results').style.display = 'block';

                // Populate vehicle info
                document.getElementById('result_car_model').textContent = data.vehicle_info.car_model;
                document.getElementById('result_year').textContent = data.vehicle_info.manufacture_year;
                document.getElementById('result_age').textContent = data.vehicle_info.vehicle_age + ' Years';

                // Format and display fuel consumption (L/100km)
                const fuelConsumption = data.fuel_consumption ? data.fuel_consumption.toFixed(1) : 'N/A';
                document.getElementById('result_fuel').textContent = fuelConsumption + ' L/100km';

                // Format and display ground clearance (convert mm to cm)
                const groundClearance = data.ground_clearance ? (data.ground_clearance / 10).toFixed(1) : 'N/A';
                document.getElementById('result_clearance').textContent = groundClearance + ' cm';

                // Populate most likely problem and solution
                document.getElementById('most_likely_problem').textContent = data.most_likely_problem.trim();
                document.getElementById('most_likely_solution').textContent = data.most_likely_solution.trim();

                // Populate potential problems list
                const problemsList = document.getElementById('potential_problems_list');
                problemsList.innerHTML = '';
                data.potential_problems.forEach(problem => {
                    const li = document.createElement('li');
                    li.innerHTML = `
                        <span class="problem">${problem.problem.trim()}</span>
                        <span class="probability">${Math.round(problem.probability)}%</span>
                    `;
                    problemsList.appendChild(li);
                });

                // Populate potential solutions list
                const solutionsList = document.getElementById('potential_solutions_list');
                solutionsList.innerHTML = '';
                data.potential_solutions.forEach(solution => {
                    const li = document.createElement('li');
                    li.innerHTML = `
                        <span class="solution">${solution.solution.trim()}</span>
                        <span class="probability">${Math.round(solution.probability)}%</span>
                    `;
                    solutionsList.appendChild(li);
                });

                // Update gauges
                updateGauges(data);

                // Generate maintenance recommendations based on vehicle age
                generateMaintenanceRecommendations(data.vehicle_info.vehicle_age, data.vehicle_info.car_model);

                // Scroll to results
                document.getElementById('diagnostic_results').scrollIntoView({
                    behavior: 'smooth'
                });
            }

            function updateGauges(data) {
                // Update fuel efficiency gauge (scale: 5-25 L/100km, lower is better)
                const fuelConsumption = data.fuel_consumption || 0;
                const fuelEfficiencyPercent = Math.max(0, Math.min(100, (fuelConsumption - 5) / 20 * 100));
                const fuelGaugeFill = document.getElementById('fuel_gauge_fill');
                const fuelGaugeText = document.getElementById('fuel_gauge_text');

                fuelGaugeFill.style.transform = `rotate(${0.5 - (fuelEfficiencyPercent / 200)}turn)`;
                fuelGaugeText.textContent = fuelConsumption.toFixed(1);

                // Update ground clearance gauge (scale: 100-250mm, higher could be better for off-road)
                const groundClearance = data.ground_clearance || 0;
                const clearancePercent = Math.max(0, Math.min(100, (groundClearance - 100) / 150 * 100));
                const clearanceGaugeFill = document.getElementById('clearance_gauge_fill');
                const clearanceGaugeText = document.getElementById('clearance_gauge_text');

                clearanceGaugeFill.style.transform = `rotate(${0.5 - (clearancePercent / 200)}turn)`;
                clearanceGaugeText.textContent = (groundClearance / 10).toFixed(1);
            }

            function generateMaintenanceRecommendations(vehicleAge, carModel) {
                const recommendationsContainer = document.getElementById('maintenance_recommendations');
                recommendationsContainer.innerHTML = '';

                // Standard recommendations based on vehicle age
                const recommendations = [];

                if (vehicleAge >= 0) {
                    recommendations.push({
                        text: 'Regular oil and filter changes every 5,000-7,500 miles',
                        priority: 'high'
                    });
                }

                if (vehicleAge >= 2) {
                    recommendations.push({
                        text: 'Inspect brake pads and rotors',
                        priority: 'medium'
                    });
                    recommendations.push({
                        text: 'Check all fluid levels and top up as needed',
                        priority: 'medium'
                    });
                }

                if (vehicleAge >= 3) {
                    recommendations.push({
                        text: 'Replace air filter',
                        priority: 'medium'
                    });
                }

                if (vehicleAge >= 5) {
                    recommendations.push({
                        text: 'Consider transmission fluid change',
                        priority: 'high'
                    });
                    recommendations.push({
                        text: 'Inspect suspension components',
                        priority: 'medium'
                    });
                }

                if (vehicleAge >= 7) {
                    recommendations.push({
                        text: 'Check timing belt/chain condition',
                        priority: 'high'
                    });
                }

                if (vehicleAge >= 10) {
                    recommendations.push({
                        text: 'Major tune-up recommended',
                        priority: 'high'
                    });
                    recommendations.push({
                        text: 'Replace all rubber hoses and belts',
                        priority: 'medium'
                    });
                }

                // If no recommendations (new car), add basic maintenance
                if (recommendations.length === 0) {
                    recommendations.push({
                        text: 'Follow manufacturer\'s break-in procedure for new vehicles',
                        priority: 'medium'
                    });
                    recommendations.push({
                        text: 'First service check-up at 1,000 miles',
                        priority: 'medium'
                    });
                }

                // Add recommendations to container
                recommendations.forEach(rec => {
                    const item = document.createElement('div');
                    item.className = 'recommendation_item';
                    item.innerHTML = `
                        <div class="recommendation_icon">
                            <i class="fa fa-wrench"></i>
                        </div>
                        <div class="recommendation_text">
                            ${rec.text}
                        </div>
                        <div class="recommendation_priority priority-${rec.priority}">
                            ${rec.priority.toUpperCase()}
                        </div>
                    `;
                    recommendationsContainer.appendChild(item);
                });
            }
        });
    </script>

    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<?php $__env->stopSection(); ?>

<?php echo $__env->make('customer.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Auto-Moly Vehicle Selling Website\auto-molly-web\resources\views/customer/pages/scanner.blade.php ENDPATH**/ ?>
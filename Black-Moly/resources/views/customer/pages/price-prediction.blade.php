@extends('customer.layouts.app')
@section('content')
    <div class="impl_bread_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1>Car Price Prediction System</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Car Price Prediction</li>
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
                        <h1>Get Your Car Value Prediction</h1>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12">
                    <div class="prediction_form_section">
                        <div class="impl_step">
                            <h2 class="step-title">Vehicle Details</h2>
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <input id="manufacturer" type="text" name="manufacturer" class="form-control required" placeholder="MANUFACTURER (e.g. Toyota)">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <input id="model" type="text" name="model" class="form-control required" placeholder="MODEL (e.g. Camry)">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <input id="year" type="number" name="year" class="form-control required number" placeholder="YEAR (e.g. 2018)">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <select id="condition" name="condition" class="form-control required">
                                            <option value="" disabled selected>CONDITION</option>
                                            <option value="excellent">Excellent</option>
                                            <option value="good">Good</option>
                                            <option value="fair">Fair</option>
                                            <option value="poor">Poor</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <select id="cylinders" name="cylinders" class="form-control required">
                                            <option value="" disabled selected>CYLINDERS</option>
                                            <option value="4 cylinders">4 cylinders</option>
                                            <option value="6 cylinders">6 cylinders</option>
                                            <option value="8 cylinders">8 cylinders</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <select id="fuel" name="fuel" class="form-control required">
                                            <option value="" disabled selected>FUEL TYPE</option>
                                            <option value="gas">Gas</option>
                                            <option value="diesel">Diesel</option>
                                            <option value="hybrid">Hybrid</option>
                                            <option value="electric">Electric</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <input id="odometer" type="number" name="odometer" class="form-control required number" placeholder="ODOMETER (miles)">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <select id="title_status" name="title_status" class="form-control required">
                                            <option value="" disabled selected>TITLE STATUS</option>
                                            <option value="clean">Clean</option>
                                            <option value="salvage">Salvage</option>
                                            <option value="rebuilt">Rebuilt</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <select id="transmission" name="transmission" class="form-control required">
                                            <option value="" disabled selected>TRANSMISSION</option>
                                            <option value="automatic">Automatic</option>
                                            <option value="manual">Manual</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <select id="drive" name="drive" class="form-control required">
                                            <option value="" disabled selected>DRIVE</option>
                                            <option value="fwd">FWD</option>
                                            <option value="rwd">RWD</option>
                                            <option value="4wd">4WD</option>
                                            <option value="awd">AWD</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <select id="type" name="type" class="form-control required">
                                            <option value="" disabled selected>VEHICLE TYPE</option>
                                            <option value="sedan">Sedan</option>
                                            <option value="suv">SUV</option>
                                            <option value="truck">Truck</option>
                                            <option value="coupe">Coupe</option>
                                            <option value="wagon">Wagon</option>
                                            <option value="van">Van</option>
                                            <option value="hatchback">Hatchback</option>
                                            <option value="convertible">Convertible</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <select id="paint_color" name="paint_color" class="form-control required">
                                            <option value="" disabled selected>PAINT COLOR</option>
                                            <option value="black">Black</option>
                                            <option value="white">White</option>
                                            <option value="silver">Silver</option>
                                            <option value="gray">Gray</option>
                                            <option value="blue">Blue</option>
                                            <option value="red">Red</option>
                                            <option value="green">Green</option>
                                            <option value="yellow">Yellow</option>
                                            <option value="brown">Brown</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 text-center">
                                    <button id="predictBtn" class="impl_btn">Predict Price</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Results Section (Initially Hidden) -->
                    <div id="prediction_results" class="prediction_results" style="display: none;">
                        <div class="impl_step">
                            <h2 class="step-title">Price Prediction Results</h2>

                            <!-- Vehicle Information -->
                            <div class="vehicle_info_section">
                                <h3>Vehicle Information</h3>
                                <div class="vehicle_info_card">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="info_item">
                                                <span class="info_label">Make & Model:</span>
                                                <span id="result_make_model" class="info_value">Toyota Camry</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="info_item">
                                                <span class="info_label">Year:</span>
                                                <span id="result_year" class="info_value">2018</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="info_item">
                                                <span class="info_label">Condition:</span>
                                                <span id="result_condition" class="info_value">Good</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="info_item">
                                                <span class="info_label">Mileage:</span>
                                                <span id="result_odometer" class="info_value">50,000 mi</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-3">
                                            <div class="info_item">
                                                <span class="info_label">Vehicle Age:</span>
                                                <span id="result_age" class="info_value">7 years</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="info_item">
                                                <span class="info_label">Transmission:</span>
                                                <span id="result_transmission" class="info_value">Automatic</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="info_item">
                                                <span class="info_label">Drive Type:</span>
                                                <span id="result_drive" class="info_value">FWD</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="info_item">
                                                <span class="info_label">Body Type:</span>
                                                <span id="result_type" class="info_value">Sedan</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Price Prediction -->
                            <div class="prediction_summary">
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="prediction_card price_card">
                                            <h4>Predicted Price</h4>
                                            <div class="price_value">
                                                <span id="predicted_price">$14,670</span>
                                                <span id="confidence_level" class="confidence medium">Medium Confidence</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="prediction_card range_card">
                                            <h4>Price Range</h4>
                                            <div class="price_range">
                                                <span id="price_range_low">$12,470</span>
                                                <span class="range-divider">to</span>
                                                <span id="price_range_high">$16,870</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="metrics_card">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="metric_item">
                                                        <h5>Price Per Mile</h5>
                                                        <span id="price_per_mile">$0.29</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="metric_item">
                                                        <h5>Vehicle Depreciation</h5>
                                                        <span id="depreciation">~35% from MSRP</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Market Comparison (Optional section for future enhancement) -->
                            <div class="market_comparison mt-4">
                                <h3>Market Position</h3>
                                <div class="market_position_chart">
                                    <!-- In a real implementation, this would be a chart showing where the price falls in the market -->
                                    <div class="progress">
                                        <div id="market_position" class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="position_labels">
                                        <span class="position_label">Below Market</span>
                                        <span class="position_label">Average</span>
                                        <span class="position_label">Above Market</span>
                                    </div>
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
        .prediction_form_section {
            padding: 30px;
            border-radius: 5px;
            margin-bottom: 40px;
        }

        .prediction_results {
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            margin-top: 40px;
        }

        .vehicle_info_card {
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 30px;
            background-color: #2c3e50;
        }

        .info_item {
            margin-bottom: 10px;
        }

        .info_label {
            font-weight: bold;
            color: white;
        }

        .info_value {
            font-weight: 600;
            color: white;
            margin-left: 10px;
        }

        .prediction_card {
            padding: 25px;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 20px;
            min-height: 150px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .prediction_card h4 {
            margin-bottom: 15px;
            font-weight: 600;
        }

        .price_card {
            background-color: #3498db;
            color: white;
        }

        .range_card {
            background-color: #2ecc71;
            color: white;
        }

        .price_value {
            font-size: 36px;
            font-weight: 700;
        }

        .price_range {
            font-size: 24px;
            font-weight: 600;
        }

        .range-divider {
            margin: 0 15px;
            opacity: 0.7;
        }

        .confidence {
            display: block;
            font-size: 14px;
            padding: 5px 10px;
            border-radius: 20px;
            margin-top: 10px;
            font-weight: 600;
            background-color: rgba(255, 255, 255, 0.2);
            display: inline-block;
        }

        .confidence.high {
            background-color: #27ae60;
        }

        .confidence.medium {
            background-color: #f39c12;
        }

        .confidence.low {
            background-color: #e74c3c;
        }

        .metrics_card {
            background-color: #f8f9fa;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .metric_item {
            text-align: center;
            padding: 10px;
        }

        .metric_item h5 {
            margin-bottom: 10px;
            color: #555;
            font-size: 16px;
        }

        .metric_item span {
            font-size: 22px;
            font-weight: 600;
            color: #2c3e50;
        }

        .market_comparison {
            background-color: #f8f9fa;
            border-radius: 5px;
            padding: 20px;
            margin-top: 30px;
        }

        .market_position_chart {
            margin-top: 20px;
        }

        .progress {
            height: 20px;
            border-radius: 10px;
            background-color: #e9ecef;
            margin-bottom: 10px;
        }

        .progress-bar {
            background-color: #3498db;
            border-radius: 10px;
        }

        .position_labels {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            color: #555;
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
        .market_comparison h3 {
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #eee;
        }

        select.form-control {
            height: 50px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .price_value, .price_range {
                font-size: 24px;
            }
            .metric_item span {
                font-size: 18px;
            }
        }
    </style>

    <!-- JavaScript for API Integration -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const predictBtn = document.getElementById('predictBtn');

            predictBtn.addEventListener('click', function() {
                // Get all form values
                const manufacturer = document.getElementById('manufacturer').value.trim();
                const model = document.getElementById('model').value.trim();
                const year = document.getElementById('year').value.trim();
                const condition = document.getElementById('condition').value;
                const cylinders = document.getElementById('cylinders').value;
                const fuel = document.getElementById('fuel').value;
                const odometer = document.getElementById('odometer').value.trim();
                const title_status = document.getElementById('title_status').value;
                const transmission = document.getElementById('transmission').value;
                const drive = document.getElementById('drive').value;
                const type = document.getElementById('type').value;
                const paint_color = document.getElementById('paint_color').value;

                // Basic validation
                if (!manufacturer || !model || !year || !condition || !cylinders ||
                    !fuel || !odometer || !title_status || !transmission ||
                    !drive || !type || !paint_color) {
                    alert('Please fill in all fields');
                    return;
                }

                // Show loading state
                predictBtn.textContent = 'Processing...';
                predictBtn.disabled = true;

                // Prepare data for API
                const data = {
                    year: parseInt(year),
                    manufacturer: manufacturer,
                    model: model,
                    condition: condition,
                    cylinders: cylinders,
                    fuel: fuel,
                    odometer: parseInt(odometer),
                    title_status: title_status,
                    transmission: transmission,
                    drive: drive,
                    type: type,
                    paint_color: paint_color
                };

                // Call API
                fetch('http://localhost:5000/price', {
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
                        predictBtn.textContent = 'Predict Price';
                        predictBtn.disabled = false;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error fetching price prediction data. Please try again.');

                        // Reset button state
                        predictBtn.textContent = 'Predict Price';
                        predictBtn.disabled = false;
                    });
            });

            function formatNumber(number) {
                return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            function displayResults(data) {
                // Show results section
                document.getElementById('prediction_results').style.display = 'block';

                // Define USD to LKR conversion rate (example rate - update with current rate)
                const usdToLkrRate = 315.50; // Example rate: 1 USD = 315.50 LKR

                // Convert USD prices to LKR
                const predictedPriceLKR = data.predicted_price * usdToLkrRate;
                const priceRangeLowLKR = data.price_range_low * usdToLkrRate;
                const priceRangeHighLKR = data.price_range_high * usdToLkrRate;
                const pricePerKmLKR = data.price_per_mile * usdToLkrRate / 1.60934; // Convert miles to km

                // Populate vehicle info
                document.getElementById('result_make_model').textContent = `${data.vehicle_info.manufacturer} ${data.vehicle_info.model}`;
                document.getElementById('result_year').textContent = data.vehicle_info.year;
                document.getElementById('result_condition').textContent = data.vehicle_info.condition.charAt(0).toUpperCase() + data.vehicle_info.condition.slice(1);
                document.getElementById('result_odometer').textContent = `${formatNumber(data.vehicle_info.odometer)} km`;  // Changed to km for Sri Lanka
                document.getElementById('result_age').textContent = `${data.vehicle_info.car_age} years`;
                document.getElementById('result_transmission').textContent = data.vehicle_info.transmission.charAt(0).toUpperCase() + data.vehicle_info.transmission.slice(1);
                document.getElementById('result_drive').textContent = data.vehicle_info.drive.toUpperCase();
                document.getElementById('result_type').textContent = data.vehicle_info.type.charAt(0).toUpperCase() + data.vehicle_info.type.slice(1);

                // Populate price prediction with LKR (Sri Lankan Rupees)
                document.getElementById('predicted_price').textContent = 'LKR ' + formatNumber(Math.round(predictedPriceLKR));
                document.getElementById('price_range_low').textContent = 'LKR ' + formatNumber(Math.round(priceRangeLowLKR));
                document.getElementById('price_range_high').textContent = 'LKR ' + formatNumber(Math.round(priceRangeHighLKR));
                document.getElementById('price_per_mile').textContent = 'LKR ' + pricePerKmLKR.toFixed(2) + '/km';  // Changed to km

                // Set confidence level class
                const confidenceElement = document.getElementById('confidence_level');
                confidenceElement.textContent = data.confidence.charAt(0).toUpperCase() + data.confidence.slice(1) + ' Confidence';
                confidenceElement.className = 'confidence ' + data.confidence.toLowerCase();

                // Calculate depreciation (example calculation - you may want to adjust this)
                const currentYear = new Date().getFullYear();
                const carAge = currentYear - data.vehicle_info.year;
                const estimatedDepreciation = Math.min(carAge * 5 + 15, 80); // Simple formula: 15% first year + 5% per year, max 80%
                document.getElementById('depreciation').textContent = `~${estimatedDepreciation}% from MSRP`;

                // Set market position (example implementation)
                const marketPosition = data.confidence === 'high' ? 65 : (data.confidence === 'medium' ? 50 : 35);
                document.getElementById('market_position').style.width = `${marketPosition}%`;
                document.getElementById('market_position').setAttribute('aria-valuenow', marketPosition);

                // Scroll to results
                document.getElementById('prediction_results').scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    </script>
@endsection

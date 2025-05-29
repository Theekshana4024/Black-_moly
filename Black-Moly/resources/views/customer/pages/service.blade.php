@extends('customer.layouts.app')
@section('content')
    <!------ Breadcrumbs Start ------>
    <div class="impl_bread_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1>Our Services</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Services</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!------ Services Section Start ------>
    <div class="impl_provide_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="impl_heading text-center">
                        <h1>What Auto Molly Provides</h1>
                        <p>AI-Powered Solutions for Smarter Vehicle Deals</p>
                    </div>
                </div>

                <!-- AI-Based Scanner -->
                <div class="col-lg-4 col-md-6">
                    <div class="impl_facility_wrapper text-center">
                        <img src="{{asset('images/services/ai-scanner.jpg')}}" alt="AI Scanner" class="img-fluid" />
                        <div class="impl_ser_hover_ovrly">
                            <div class="impl_ser_text">
                                <h3>AI-Based Vehicle Scanner</h3>
                                <p>Scan your vehicle using AI to detect issues and estimate performance automatically.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Vehicle Scoring -->
                <div class="col-lg-4 col-md-6">
                    <div class="impl_facility_wrapper text-center">
                        <img src="{{asset('images/services/vehicle-score.jpg')}}" alt="Vehicle Score" class="img-fluid" />
                        <div class="impl_ser_hover_ovrly">
                            <div class="impl_ser_text">
                                <h3>Vehicle Score</h3>
                                <p>Get a trusted score based on your car’s condition, service records, and specs.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Vehicle Price Prediction -->
                <div class="col-lg-4 col-md-6">
                    <div class="impl_facility_wrapper text-center">
                        <img src="{{asset('images/services/price-prediction.jpg')}}" alt="Price Prediction AI" class="img-fluid" />
                        <div class="impl_ser_hover_ovrly">
                            <div class="impl_ser_text">
                                <h3>AI-Powered Price Prediction</h3>
                                <p>Our advanced AI model predicts your vehicle’s market price using real-time data from condition, mileage, service history, and market trends.</p>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Secure Transactions -->
                <div class="col-12">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6">
                            <div class="impl_facility_wrapper text-center">
                                <img src="{{asset('images/services/secure-payment.jpg')}}" alt="Secure Transaction" class="img-fluid" />
                                <div class="impl_ser_hover_ovrly">
                                    <div class="impl_ser_text">
                                        <h3>Secure Transaction</h3>
                                        <p>Buy or sell your vehicle with full confidence using our secure transaction system.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="impl_facility_wrapper text-center">
                                <img src="{{ asset('images/services/leasing-calculator.jpg') }}" alt="Leasing Calculator" class="img-fluid" />
                                <div class="impl_ser_hover_ovrly">
                                    <div class="impl_ser_text">
                                        <h3>Leasing Calculator</h3>
                                        <p>Estimate your monthly leasing payments based on vehicle price, down payment, term length, and interest rate.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

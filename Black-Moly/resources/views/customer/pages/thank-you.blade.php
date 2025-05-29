@extends('customer.layouts.app')
@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        <h3 class="mb-0">Payment Successful</h3>
                    </div>
                    <div class="card-body text-center">
                        <div class="mb-4">
                            <div class="success-animation">
                                <i class="fas fa-check-circle fa-5x text-success mb-4"></i>
                            </div>
                            <h2 style="color: black">Thank You for Your Purchase!</h2>
                            <p class="lead" style="color: black">Your payment for {{ $vehicle->title }} has been processed successfully.</p>
                            <div class="my-4 p-3 bg-light rounded">
                                <div class="row">
                                    <div class="col-md-6 text-md-right text-center">
                                        <p style="color: black"><strong>Order Reference:</strong></p>
                                    </div>
                                    <div class="col-md-6 text-md-left text-center">
                                        <p style="color: black">{{ $payment->reference_id ?? 'ORD-'.time() }}</p>
                                    </div>
                                    <div class="col-md-6 text-md-right text-center">
                                        <p style="color: black"><strong>Amount Paid:</strong></p>
                                    </div>
                                    <div class="col-md-6 text-md-left text-center">
                                        <p style="color: black">${{ number_format($vehicle->price, 2) }}</p>
                                    </div>
                                    <div class="col-md-6 text-md-right text-center">
                                        <p style="color: black"><strong>Date:</strong></p>
                                    </div>
                                    <div class="col-md-6 text-md-left text-center">
                                        <p style="color: black">{{ date('F j, Y') }}</p>
                                    </div>
                                </div>
                            </div>
                            <p style="color: black">A confirmation has been sent to your email address.</p>
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('home') }}" class="btn btn-primary me-2">
                                <i class="fas fa-tachometer-alt me-1"></i> Go to Home
                            </a>
                            <a href="{{ route('profile.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-list me-1"></i> View Orders
                            </a>
                        </div>

                        <div class="mt-5">
                            <h4 style="color: black">What Happens Next?</h4>
                            <ul class="list-unstyled text-start">
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Our team will contact you shortly to arrange vehicle delivery or pickup</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i> You can track your order status from your dashboard</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i> For any questions, please contact our support team</li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <p class="mb-0">Need assistance? <a href="#">Contact our support team</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .success-animation {
            margin: 20px 0;
        }
        .success-animation i {
            animation: scale-up 0.5s ease-in-out;
        }
        @keyframes scale-up {
            0% {
                transform: scale(0);
                opacity: 0;
            }
            60% {
                transform: scale(1.2);
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>
@endsection

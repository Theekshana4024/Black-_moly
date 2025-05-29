<?php $__env->startSection('content'); ?>
    <script src="https://js.stripe.com/v3/"></script>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Checkout</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <h4 style="color: black"><?php echo e($vehicle->title); ?></h4>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted" style="color: black">Vehicle Price</span>
                                <span class="font-weight-bold" style="color: black">Rs <?php echo e(number_format($vehicle->price, 2)); ?></span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="h5" style="color: black">Total</span>
                                <span class="h5" style="color: black">Rs <?php echo e(number_format($vehicle->price, 2)); ?></span>
                            </div>
                        </div>

                        <form action="<?php echo e(route('payment.process', $vehicle->id)); ?>" method="POST" id="payment-form">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="stripeToken" id="stripeToken">

                            <div class="form-group">
                                <label for="card-element" style="color: black" class="form-label">Credit or debit card</label>
                                <div id="card-element" class="form-control p-3">
                                    <!-- Stripe Element will be inserted here -->
                                </div>
                                <div id="card-errors" class="text-danger mt-2" role="alert"></div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary btn-lg w-100" id="submit-button">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <i class="fas fa-lock mr-2"></i>
                                        <span>Pay Rs <?php echo e(number_format($vehicle->price, 2)); ?></span>
                                        <div id="spinner" class="spinner-border spinner-border-sm ml-2 d-none" role="status"></div>
                                    </div>
                                </button>
                            </div>

                            <div class="text-center mt-3">
                                <small class="text-muted">Your payment is processed securely by Stripe. We do not store your card details.</small>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Initialize Stripe
        const stripe = Stripe("<?php echo e(env('STRIPE_KEY')); ?>");
        const elements = stripe.elements();

        // Custom styling for the card Element
        const style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        // Create an instance of the card Element
        const cardElement = elements.create('card', {style: style});

        // Add an instance of the card Element into the `card-element` div
        cardElement.mount('#card-element');

        // Handle real-time validation errors from the card Element
        cardElement.on('change', function(event) {
            const displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission
        const form = document.getElementById('payment-form');
        const submitButton = document.getElementById('submit-button');
        const spinner = document.getElementById('spinner');

        form.addEventListener('submit', async function(event) {
            event.preventDefault();

            // Disable the submit button to prevent repeated clicks
            submitButton.disabled = true;
            spinner.classList.remove('d-none');

            try {
                const { paymentMethod, error } = await stripe.createPaymentMethod('card', cardElement);

                if (error) {
                    // Show error to customer
                    const errorElement = document.getElementById('card-errors');
                    errorElement.textContent = error.message;
                    submitButton.disabled = false;
                    spinner.classList.add('d-none');
                } else {
                    // Get token for the card
                    const tokenResult = await stripe.createToken(cardElement);

                    if (tokenResult.error) {
                        // Show error to customer
                        const errorElement = document.getElementById('card-errors');
                        errorElement.textContent = tokenResult.error.message;
                        submitButton.disabled = false;
                        spinner.classList.add('d-none');
                    } else {
                        // Set the token and submit the form
                        document.getElementById('stripeToken').value = tokenResult.token.id;
                        form.submit();
                    }
                }
            } catch (err) {
                console.error(err);
                const errorElement = document.getElementById('card-errors');
                errorElement.textContent = "An unexpected error occurred. Please try again.";
                submitButton.disabled = false;
                spinner.classList.add('d-none');
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('customer.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Auto-Moly Vehicle Selling Website\auto-molly-web\resources\views/customer/pages/checkout.blade.php ENDPATH**/ ?>
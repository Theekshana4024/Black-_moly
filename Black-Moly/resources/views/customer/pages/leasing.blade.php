@extends('customer.layouts.app')
@section('content')
    <!------ Breadcrumbs Start ------>
    <div class="impl_bread_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1>Leasing Calculator</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Leasing Calculator</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!------ Calculator wrapper Start ------>
    <div class="impl_sell_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="impl_steps_wrapper impl_calculator_wrapper">
                        <div class="impl_step">
                            <h2 class="step-title">Leasing Calculator</h2>
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="vehicle_price">Vehicle Price (Rs)</label>
                                        <input id="vehicle_price" type="text" name="vehicle_price" class="form-control required number" placeholder="Enter vehicle price">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label for="down_payment">Down Payment (Rs)</label>
                                        <input id="down_payment" type="text" name="down_payment" class="form-control required number" placeholder="Down payment amount">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label for="lease_term">Lease Term</label>
                                        <select id="lease_term" name="lease_term" class="form-control required">
                                            <option value="">Select Lease Term</option>
                                            <option value="24">24 months</option>
                                            <option value="36">36 months</option>
                                            <option value="48">48 months</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label for="interest_rate">Interest Rate (%)</label>
                                        <select id="interest_rate" name="interest_rate" class="form-control required">
                                            <option value="">Select Interest Rate</option>
                                            <option value="10.00">10.00%</option>
                                            <option value="11.50">11.50%</option>
                                            <option value="12.75">12.75%</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label for="leasing_company">Leasing Company</label>
                                        <select id="leasing_company" name="leasing_company" class="form-control required">
                                            <option value="">Select Company</option>
                                            <option value="lb">LB Finance</option>
                                            <option value="cdb">CDB</option>
                                            <option value="lolc">LOLC Finance</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <button id="calculate_btn" type="button" class="btn btn-primary btn-lg btn-block">Calculate Payment</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Results Section -->
                    <div class="impl_steps_wrapper impl_results_wrapper" style="margin-top: 20px; display: none;" id="results_section">
                        <div class="impl_step">
                            <h2 class="step-title">Lease Payment Details</h2>
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="payment_info_box">
                                        <h3>Monthly Payment</h3>
                                        <h2 id="monthly_payment">Rs 0.00</h2>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="payment_info_box">
                                        <h3>Total Lease Amount</h3>
                                        <h2 id="total_payment">Rs 0.00</h2>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <table class="table table-striped">
                                        <tbody>
                                        <tr>
                                            <td>Vehicle Price</td>
                                            <td id="summary_vehicle_price">Rs 0.00</td>
                                        </tr>
                                        <tr>
                                            <td>Down Payment</td>
                                            <td id="summary_down_payment">Rs 0.00</td>
                                        </tr>
                                        <tr>
                                            <td>Loan Amount</td>
                                            <td id="summary_loan_amount">Rs 0.00</td>
                                        </tr>
                                        <tr>
                                            <td>Interest Rate</td>
                                            <td id="summary_interest_rate">0.00%</td>
                                        </tr>
                                        <tr>
                                            <td>Lease Term</td>
                                            <td id="summary_lease_term">0 months</td>
                                        </tr>
                                        <tr>
                                            <td>Total Interest</td>
                                            <td id="summary_total_interest">Rs 0.00</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Leasing Agents Section -->
                <div class="col-lg-4 col-md-12">
                    <div class="impl_steps_wrapper impl_agents_wrapper">
                        <div class="impl_step">
                            <h2 class="step-title">Leasing Agents</h2>
                            <div id="leasing_agents">
                                <div class="leasing_agent_box" data-company="lb">
                                    <h3>LB Finance</h3>
                                    <div class="agent_details">
                                        <p><strong>Agent:</strong> <span class="agent_name">Samantha Perera</span></p>
                                        <p><strong>Terms:</strong> <span class="lease_terms">24, 36, 48 months</span></p>
                                        <p><strong>Interest:</strong> <span class="interest_rate">11.50%</span></p>
                                        <p><strong>Contact:</strong> <span class="contact_number">+94 77 123 4567</span></p>
                                        <button class="btn btn-sm btn-info contact_agent_btn">Contact Agent</button>
                                    </div>
                                </div>

                                <div class="leasing_agent_box" data-company="cdb" style="margin-top: 20px;">
                                    <h3>CDB</h3>
                                    <div class="agent_details">
                                        <p><strong>Agent:</strong> <span class="agent_name">Nimal Fernando</span></p>
                                        <p><strong>Terms:</strong> <span class="lease_terms">24, 36, 48 months</span></p>
                                        <p><strong>Interest:</strong> <span class="interest_rate">12.75%</span></p>
                                        <p><strong>Contact:</strong> <span class="contact_number">+94 76 234 5678</span></p>
                                        <button class="btn btn-sm btn-info contact_agent_btn">Contact Agent</button>
                                    </div>
                                </div>

                                <div class="leasing_agent_box" data-company="lolc" style="margin-top: 20px;">
                                    <h3>LOLC Finance</h3>
                                    <div class="agent_details">
                                        <p><strong>Agent:</strong> <span class="agent_name">Kumari Silva</span></p>
                                        <p><strong>Terms:</strong> <span class="lease_terms">24, 36, 48 months</span></p>
                                        <p><strong>Interest:</strong> <span class="interest_rate">10.00%</span></p>
                                        <p><strong>Contact:</strong> <span class="contact_number">+94 71 345 6789</span></p>
                                        <button class="btn btn-sm btn-info contact_agent_btn">Contact Agent</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Agent Modal -->
    <div class="modal fade" id="contactAgentModal" tabindex="-1" role="dialog" aria-labelledby="contactAgentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content dark-modal">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactAgentModalLabel">Contact Leasing Agent</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-light">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="agent_contact_info">
                        <p><strong class="text-light">Name:</strong> <span id="modal_agent_name" class="text-light"></span></p>
                        <p><strong class="text-light">Company:</strong> <span id="modal_company_name" class="text-light"></span></p>
                        <p><strong class="text-light">Contact:</strong> <span id="modal_contact_number" class="text-light"></span></p>
                    </div>
                    <form id="agent_contact_form">
                        <div class="form-group">
                            <label for="customer_name" class="text-light">Your Name</label>
                            <input type="text" class="form-control dark-input" id="customer_name" required>
                        </div>
                        <div class="form-group">
                            <label for="customer_phone" class="text-light">Your Phone Number</label>
                            <input type="tel" class="form-control dark-input" id="customer_phone" required>
                        </div>
                        <div class="form-group">
                            <label for="customer_message" class="text-light">Message</label>
                            <textarea class="form-control dark-input" id="customer_message" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info" id="submit_contact_form">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Leasing calculation
            const calculateBtn = document.getElementById('calculate_btn');
            const resultsSection = document.getElementById('results_section');

            // Formatting function for currency
            function formatCurrency(amount) {
                return 'Rs ' + parseFloat(amount).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
            }

            calculateBtn.addEventListener('click', function() {
                // Get input values
                const vehiclePrice = parseFloat(document.getElementById('vehicle_price').value) || 0;
                const downPayment = parseFloat(document.getElementById('down_payment').value) || 0;
                const leaseTerm = parseInt(document.getElementById('lease_term').value) || 0;
                const interestRate = parseFloat(document.getElementById('interest_rate').value) || 0;
                const company = document.getElementById('leasing_company').value;

                // Calculate loan amount
                const loanAmount = vehiclePrice - downPayment;

                // Calculate monthly interest rate
                const monthlyInterestRate = interestRate / 100 / 12;

                // Calculate monthly payment using loan formula
                const monthlyPayment = loanAmount * monthlyInterestRate * Math.pow(1 + monthlyInterestRate, leaseTerm) /
                    (Math.pow(1 + monthlyInterestRate, leaseTerm) - 1);

                // Calculate total payment
                const totalPayment = monthlyPayment * leaseTerm;

                // Calculate total interest
                const totalInterest = totalPayment - loanAmount;

                // Update results
                document.getElementById('monthly_payment').textContent = formatCurrency(monthlyPayment);
                document.getElementById('total_payment').textContent = formatCurrency(totalPayment);
                document.getElementById('summary_vehicle_price').textContent = formatCurrency(vehiclePrice);
                document.getElementById('summary_down_payment').textContent = formatCurrency(downPayment);
                document.getElementById('summary_loan_amount').textContent = formatCurrency(loanAmount);
                document.getElementById('summary_interest_rate').textContent = interestRate + '%';
                document.getElementById('summary_lease_term').textContent = leaseTerm + ' months';
                document.getElementById('summary_total_interest').textContent = formatCurrency(totalInterest);

                // Show results section
                resultsSection.style.display = 'block';

                // Highlight selected leasing company
                const agentBoxes = document.querySelectorAll('.leasing_agent_box');
                agentBoxes.forEach(box => {
                    if (box.dataset.company === company) {
                        box.style.border = '2px solid #00e0ff';
                        box.style.boxShadow = '0 0 10px rgba(0, 224, 255, 0.5)';
                    } else {
                        box.style.border = '1px solid #444';
                        box.style.boxShadow = 'none';
                    }
                });
            });

            // Contact agent functionality
            const contactBtns = document.querySelectorAll('.contact_agent_btn');

            contactBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const agentBox = this.closest('.leasing_agent_box');
                    const agentName = agentBox.querySelector('.agent_name').textContent;
                    const companyName = agentBox.querySelector('h3').textContent;
                    const contactNumber = agentBox.querySelector('.contact_number').textContent;

                    // Update modal content
                    document.getElementById('modal_agent_name').textContent = agentName;
                    document.getElementById('modal_company_name').textContent = companyName;
                    document.getElementById('modal_contact_number').textContent = contactNumber;

                    // Show modal
                    $('#contactAgentModal').modal('show');
                });
            });

            // Form submission
            document.getElementById('submit_contact_form').addEventListener('click', function() {
                const form = document.getElementById('agent_contact_form');
                if (form.checkValidity()) {
                    // Here you would typically send the form data to a server
                    alert('Your message has been sent to the agent. They will contact you shortly.');
                    $('#contactAgentModal').modal('hide');
                    form.reset();
                } else {
                    form.reportValidity();
                }
            });
        });
    </script>

    <style>
        .payment_info_box h2 {
            font-size: 24px;
            font-weight: bold;
            color: #00e0ff;
            margin-top: 10px;
        }

        .payment_info_box h3 {
            font-size: 16px;
            color: #fff;
        }

        .payment_info_box {
            background-color: #222;
            border: 1px solid #444;
            padding: 15px;
            text-align: center;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .leasing_agent_box {
            padding: 15px;
            border: 1px solid #444;
            border-radius: 5px;
            background-color: rgba(40, 40, 40, 0.7);
            transition: all 0.3s ease;
        }

        .leasing_agent_box:hover {
            border-color: #00e0ff;
            box-shadow: 0 0 10px rgba(0, 224, 255, 0.3);
        }

        .leasing_agent_box h3 {
            padding-bottom: 10px;
            border-bottom: 1px solid #444;
            margin-bottom: 10px;
            color: #00e0ff;
        }

        .agent_details p {
            margin-bottom: 8px;
            color: #ccc;
        }

        .agent_details strong {
            color: #fff;
        }

        .contact_agent_btn {
            margin-top: 10px;
            background-color: #00e0ff;
            border-color: #00e0ff;
            color: #222;
        }

        .contact_agent_btn:hover {
            background-color: #00b3cc;
            border-color: #00b3cc;
            color: #fff;
        }

        .impl_calculator_wrapper {
            margin-bottom: 20px;
        }

        #calculate_btn {
            background-color: #00e0ff;
            border-color: #00e0ff;
            color: #222;
        }

        #calculate_btn:hover {
            background-color: #00b3cc;
            border-color: #00b3cc;
            color: #fff;
        }

        .impl_results_wrapper {
            border: 2px solid #00e0ff;
            border-radius: 5px;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(40, 40, 40, 0.5);
        }

        .table {
            color: #ccc;
        }

        .table td {
            border-top: 1px solid #444;
        }

        .impl_step {
            background-color: transparent;
        }

        .step-title {
            color: #00e0ff;
        }

        /* Form controls styling for dark theme */
        .form-control {
            background-color: #333;
            border: 1px solid #555;
            color: #fff;
        }

        .form-control:focus {
            background-color: #444;
            border-color: #00e0ff;
            box-shadow: 0 0 0 0.2rem rgba(0, 224, 255, 0.25);
            color: #fff;
        }

        label {
            color: #ccc;
        }

        .dark-modal {
            background-color: #222;
            color: #ccc;
            border: 1px solid #444;
        }

        .dark-modal .modal-header {
            border-bottom: 1px solid #444;
            background-color: #333;
        }

        .dark-modal .modal-footer {
            border-top: 1px solid #444;
            background-color: #333;
        }

        .dark-input {
            background-color: #333;
            border: 1px solid #555;
            color: #fff;
        }

        .dark-input:focus {
            background-color: #444;
            border-color: #00e0ff;
            box-shadow: 0 0 0 0.2rem rgba(0, 224, 255, 0.25);
            color: #fff;
        }

        #submit_contact_form {
            background-color: #00e0ff;
            border-color: #00e0ff;
            color: #222;
        }

        #submit_contact_form:hover {
            background-color: #00b3cc;
            border-color: #00b3cc;
            color: #fff;
        }
    </style>
@endsection

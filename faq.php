<?php
include "connect.php";
include "Includes/templates/header.php";
include "Includes/templates/navbar.php";
?>

<style>
/* Bronze Theme Overrides */
.nav-tabs .nav-link {
    color: #9d8a79 !important;
}
.nav-tabs .nav-link.active {
    background-color: #9d8a79 !important;
    color: #fff !important;
    border-color: #9d8a79 #9d8a79 #fff !important;
}
.btn-link {
    color: #9d8a79 !important;
    font-weight: bold;
    text-decoration: none;
}
.btn-link:hover {
    color: #7c6b5d !important;
}
code {
    color: #9d8a79 !important;
}
.bg-light {
    background-color: #111 !important;
    border: 1px solid #9d8a79;
    color: #eee;
}
.bg-light h3,
.bg-light p,
.bg-light strong {
    color: #9d8a79;
}
.bg-light i {
    color: #9d8a79 !important;
}
</style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center mb-0">Frequently Asked Questions (FAQ)</h1>
                    <p class="text-center text-muted mt-2">Everything you need to know about booking with Fresh Fade Co.</p>
                </div>
                <div class="card-body">
                    
                    <!-- Navigation Tabs -->
                    <ul class="nav nav-tabs mb-4" id="faqTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="navigation-tab" data-toggle="tab" data-target="#navigation" type="button" role="tab" aria-controls="navigation" aria-selected="true">
                                <i class="fas fa-compass"></i> Navigation
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="booking-tab" data-toggle="tab" data-target="#booking" type="button" role="tab" aria-controls="booking" aria-selected="false">
                                <i class="fas fa-calendar-plus"></i> Making Bookings
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="editing-tab" data-toggle="tab" data-target="#editing" type="button" role="tab" aria-controls="editing" aria-selected="false">
                                <i class="fas fa-edit"></i> Editing Bookings
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="cancellation-tab" data-toggle="tab" data-target="#cancellation" type="button" role="tab" aria-controls="cancellation" aria-selected="false">
                                <i class="fas fa-times-circle"></i> Cancellations
                            </button>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content" id="faqTabContent">
                        
                        <!-- Navigation Tab -->
                        <div class="tab-pane fade show active" id="navigation" role="tabpanel" aria-labelledby="navigation-tab">
                            <div class="accordion" id="navigationAccordion">
                                
                                <div class="card">
                                    <div class="card-header" id="nav1">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#nav1Content" aria-expanded="true" aria-controls="nav1Content">
                                                How do I access the barbershop website?
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="nav1Content" class="collapse show" aria-labelledby="nav1" data-parent="#navigationAccordion">
                                        <div class="card-body">
                                            Open your web browser and go to: <code>https://freshfadeco.ct.ws/barbershop/</code>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" id="nav2">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#nav2Content" aria-expanded="false" aria-controls="nav2Content">
                                                What sections are available on the website?
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="nav2Content" class="collapse" aria-labelledby="nav2" data-parent="#navigationAccordion">
                                        <div class="card-body">
                                            The website has several main sections:
                                            <ul>
                                                <li><strong>Home:</strong> Landing page with services overview</li>
                                                <li><strong>About:</strong> Information about Fresh Fade Co.</li>
                                                <li><strong>Services:</strong> Available barbershop services</li>
                                                <li><strong>Booking:</strong> Appointment booking form</li>
                                                <li><strong>Contact:</strong> Contact information and form</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" id="nav3">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#nav3Content" aria-expanded="false" aria-controls="nav3Content">
                                                How do I navigate between sections?
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="nav3Content" class="collapse" aria-labelledby="nav3" data-parent="#navigationAccordion">
                                        <div class="card-body">
                                            You can navigate using:
                                            <ul>
                                                <li><strong>Navigation Menu:</strong> Click on menu items at the top of the page</li>
                                                <li><strong>Scroll:</strong> Scroll down to view different sections</li>
                                                <li><strong>Quick Links:</strong> Use the "Make an appointment" button to jump to booking</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" id="nav4">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#nav4Content" aria-expanded="false" aria-controls="nav4Content">
                                                Is the website mobile-friendly?
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="nav4Content" class="collapse" aria-labelledby="nav4" data-parent="#navigationAccordion">
                                        <div class="card-body">
                                            Yes! The website is fully responsive and works perfectly on:
                                            <ul>
                                                <li>Desktop computers</li>
                                                <li>Tablets</li>
                                                <li>Mobile phones</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Booking Tab -->
                        <div class="tab-pane fade" id="booking" role="tabpanel" aria-labelledby="booking-tab">
                            <div class="accordion" id="bookingAccordion">
                                
                                <div class="card">
                                    <div class="card-header" id="book1">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#book1Content" aria-expanded="true" aria-controls="book1Content">
                                                How do I start the booking process?
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="book1Content" class="collapse show" aria-labelledby="book1" data-parent="#bookingAccordion">
                                        <div class="card-body">
                                            There are two ways:
                                            <ol>
                                                <li>Click the <strong>"Make an appointment"</strong> button on the homepage</li>
                                                <li>Scroll down to the booking section at the bottom of the page</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" id="book2">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#book2Content" aria-expanded="false" aria-controls="book2Content">
                                                What information do I need to provide?
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="book2Content" class="collapse" aria-labelledby="book2" data-parent="#bookingAccordion">
                                        <div class="card-body">
                                            You'll need to fill in:
                                            <br><br>
                                            <strong>Personal Details:</strong>
                                            <ul>
                                                <li>First Name (required)</li>
                                                <li>Last Name (required)</li>
                                                <li>Phone Number (required)</li>
                                                <li>Email Address (required)</li>
                                            </ul>
                                            <strong>Appointment Details:</strong>
                                            <ul>
                                                <li>Select Services (haircut, beard trim, shave, etc.)</li>
                                                <li>Choose Your Preferred Barber</li>
                                                <li>Pick Date and Time</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" id="book3">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#book3Content" aria-expanded="false" aria-controls="book3Content">
                                                How do I select services?
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="book3Content" class="collapse" aria-labelledby="book3" data-parent="#bookingAccordion">
                                        <div class="card-body">
                                            <ol>
                                                <li>Click on the service dropdown menu</li>
                                                <li>Choose from available options:
                                                    <ul>
                                                        <li>Haircut Styles</li>
                                                        <li>Beard Trimming</li>
                                                        <li>Smooth Shave</li>
                                                        <li>Face Masking</li>
                                                    </ul>
                                                </li>
                                                <li>You can select multiple services</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" id="book4">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#book4Content" aria-expanded="false" aria-controls="book4Content">
                                                Will I get a confirmation?
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="book4Content" class="collapse" aria-labelledby="book4" data-parent="#bookingAccordion">
                                        <div class="card-body">
                                            Yes! You'll receive an email confirmation with:
                                            <ul>
                                                <li>Your appointment details</li>
                                                <li>Date and time</li>
                                                <li>Selected services</li>
                                                <li>Barber information</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Editing Tab -->
                        <div class="tab-pane fade" id="editing" role="tabpanel" aria-labelledby="editing-tab">
                            <div class="accordion" id="editingAccordion">
                                
                                <div class="card">
                                    <div class="card-header" id="edit1">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#edit1Content" aria-expanded="true" aria-controls="edit1Content">
                                                Can I change my appointment after booking?
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="edit1Content" class="collapse show" aria-labelledby="edit1" data-parent="#editingAccordion">
                                        <div class="card-body">
                                            Yes, you can edit your booking through the admin panel or by contacting the barbershop directly.
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" id="edit2">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#edit2Content" aria-expanded="false" aria-controls="edit2Content">
                                                How do I edit my booking online?
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="edit2Content" class="collapse" aria-labelledby="edit2" data-parent="#editingAccordion">
                                        <div class="card-body">
                                            <ol>
                                                <li>Go to: <code>https://freshfadeco.ct.ws/barbershop/editbooking.php</code></li>
                                                <li>Enter your email address</li>
                                                <li>View your current booking</li>
                                                <li>Make changes to:
                                                    <ul>
                                                        <li>Date and time</li>
                                                        <li>Selected services</li>
                                                        <li>Barber preference</li>
                                                    </ul>
                                                </li>
                                                <li>Click <strong>"Update Booking"</strong></li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" id="edit3">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#edit3Content" aria-expanded="false" aria-controls="edit3Content">
                                                What can I change in my booking?
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="edit3Content" class="collapse" aria-labelledby="edit3" data-parent="#editingAccordion">
                                        <div class="card-body">
                                            You can modify:
                                            <ul>
                                                <li>Appointment date</li>
                                                <li>Appointment time</li>
                                                <li>Selected services</li>
                                                <li>Preferred barber</li>
                                                <li>Contact information</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" id="edit4">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#edit4Content" aria-expanded="false" aria-controls="edit4Content">
                                                Will I get a new confirmation after editing?
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="edit4Content" class="collapse" aria-labelledby="edit4" data-parent="#editingAccordion">
                                        <div class="card-body">
                                            Yes, you'll receive an updated confirmation email with your new appointment details.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Cancellation Tab -->
                        <div class="tab-pane fade" id="cancellation" role="tabpanel" aria-labelledby="cancellation-tab">
                            <div class="accordion" id="cancellationAccordion">
                                
                                <div class="card">
                                    <div class="card-header" id="cancel1">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#cancel1Content" aria-expanded="true" aria-controls="cancel1Content">
                                                How do I cancel my appointment?
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="cancel1Content" class="collapse show" aria-labelledby="cancel1" data-parent="#cancellationAccordion">
                                        <div class="card-body">
                                            You have several options:
                                            <br><br>
                                            <strong>Option 1: Online Cancellation</strong>
                                            <ol>
                                                <li>Go to: <code>https://freshfadeco.ct.ws/barbershop/editbooking.php</code></li>
                                                <li>Enter your email address</li>
                                                <li>View your booking</li>
                                                <li>Click <strong>"Cancel Booking"</strong></li>
                                                <li>Provide a reason for cancellation</li>
                                            </ol>
                                            <strong>Option 2: Contact the Barbershop</strong>
                                            <ul>
                                                <li><strong>Phone:</strong> +27 (011) 058 4889</li>
                                                <li><strong>Email:</strong> Freshfade@gmail.com</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" id="cancel2">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#cancel2Content" aria-expanded="false" aria-controls="cancel2Content">
                                                How far in advance do I need to cancel?
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="cancel2Content" class="collapse" aria-labelledby="cancel2" data-parent="#cancellationAccordion">
                                        <div class="card-body">
                                            Please cancel at least 24 hours before your appointment time to avoid any cancellation fees.
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" id="cancel3">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#cancel3Content" aria-expanded="false" aria-controls="cancel3Content">
                                                What happens when I cancel?
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="cancel3Content" class="collapse" aria-labelledby="cancel3" data-parent="#cancellationAccordion">
                                        <div class="card-body">
                                            <ol>
                                                <li>Your appointment will be removed from the schedule</li>
                                                <li>The time slot becomes available for other customers</li>
                                                <li>You'll receive a cancellation confirmation email</li>
                                                <li>The barbershop will be notified of the cancellation</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" id="cancel4">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#cancel4Content" aria-expanded="false" aria-controls="cancel4Content">
                                                Can I reschedule instead of canceling?
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="cancel4Content" class="collapse" aria-labelledby="cancel4" data-parent="#cancellationAccordion">
                                        <div class="card-body">
                                            Yes! It's often better to reschedule than cancel:
                                            <ol>
                                                <li>Go to the edit booking page</li>
                                                <li>Change the date and time</li>
                                                <li>Keep your original booking details</li>
                                                <li>This is faster than canceling and rebooking</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="mt-5 p-4 bg-light rounded">
                        <h3 class="text-center mb-3">Need More Help?</h3>
                        <p class="text-center mb-3">If you can't find the answer to your question here, please contact us:</p>
                        <div class="row text-center">
                            <div class="col-md-4">
                                <i class="fas fa-envelope fa-2x text-primary mb-2"></i>
                                <p><strong>Email:</strong><br>Freshfade@gmail.com</p>
                            </div>
                            <div class="col-md-4">
                                <i class="fas fa-phone fa-2x text-primary mb-2"></i>
                                <p><strong>Phone:</strong><br>+27 (011) 058 4889</p>
                            </div>
                            <div class="col-md-4">
                                <i class="fas fa-map-marker-alt fa-2x text-primary mb-2"></i>
                                <p><strong>Address:</strong><br>198 West 21th Street, Suite 721<br>Noordvyk, Midrand 1687</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap tabs
    $('#faqTabs a').on('click', function (e) {
        e.preventDefault();
        $(this).tab('show');
    });
    
    // Initialize Bootstrap accordion
    $('.collapse').on('show.bs.collapse', function () {
        $(this).addClass('show');
    });
    
    $('.collapse').on('hide.bs.collapse', function () {
        $(this).removeClass('show');
    });
});
</script>

<?php include "Includes/templates/footer.php"; ?>

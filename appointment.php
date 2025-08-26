<!-- PHP INCLUDES -->

<?php
include "connect.php";
include "Includes/functions/functions.php";
include "Includes/templates/header.php";
include "Includes/templates/navbar.php";

// PHPMailer SMTP setup
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function getMailer() {
    $mail = new PHPMailer(true);
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->Username = "mikniks.hotsauce@gmail.com";
    $mail->Password = "ditdbdmtfaibipke";
    $mail->isHtml(true);
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true,
        )
    );
    return $mail;
}

?>

<link rel="stylesheet" href="Design/css/appointment-page-style.css">

<section class="booking_section">
    <div class="container">

        <?php
        if(isset($_POST['submit_book_appointment_form']) && $_SERVER['REQUEST_METHOD'] === 'POST') {

            // Selected SERVICES
            $selected_services = $_POST['selected_services'];

            // Selected EMPLOYEE
            $selected_employee = $_POST['selected_employee'];

            // Selected DATE+TIME
            $selected_date_time = explode(' ', $_POST['desired_date_time']);
            $date_selected = $selected_date_time[0];
            $start_time = $date_selected." ".$selected_date_time[1];
            $end_time = $date_selected." ".$selected_date_time[2];

            // Client Details
            $client_first_name = test_input($_POST['client_first_name']);
            $client_last_name = test_input($_POST['client_last_name']);
            $client_phone_number = test_input($_POST['client_phone_number']);
            $client_email = test_input($_POST['client_email']);
            $existing_customer = isset($_POST['existing_customer']) ? true : false;

            $con->beginTransaction();

            try {

                if($existing_customer) {
                    // Only email is required - validate email is provided
                    if(empty($client_email)){
                        throw new Exception("Please provide your email address.");
                    }
                    
                    $stmtCheckClient = $con->prepare("SELECT * FROM clients WHERE client_email = ?");
                    $stmtCheckClient->execute([$client_email]);
                    $client_result = $stmtCheckClient->fetch();
                    $client_count = $stmtCheckClient->rowCount();

                    if($client_count > 0){
                        $client_id = $client_result["client_id"];
                        $client_first_name = $client_result["first_name"];
                        $client_last_name = $client_result["last_name"];
                        $client_phone_number = $client_result["phone_number"];
                    } else {
                        throw new Exception("Email not found in our system. Please uncheck 'existing customer' and fill in all your details.");
                    }
                } else {
                    // New customer: all fields required
                    if(empty($client_first_name) || empty($client_last_name) || empty($client_phone_number) || empty($client_email)){
                        throw new Exception("Please fill in all your details.");
                    }

                    // Check if client exists
                    $stmtCheckClient = $con->prepare("SELECT * FROM clients WHERE client_email = ?");
                    $stmtCheckClient->execute([$client_email]);
                    $client_result = $stmtCheckClient->fetch();
                    $client_count = $stmtCheckClient->rowCount();

                    if($client_count > 0){
                        $client_id = $client_result["client_id"];
                    } else {
                        // Insert new client
                        $stmtClient = $con->prepare("INSERT INTO clients(first_name,last_name,phone_number,client_email) VALUES (?,?,?,?)");
                        $stmtClient->execute([$client_first_name,$client_last_name,$client_phone_number,$client_email]);
                        $client_id = $con->lastInsertId();
                    }
                }

                // Insert appointment
                $stmt_appointment = $con->prepare("INSERT INTO appointments(date_created, client_id, employee_id, start_time, end_time_expected) VALUES(?, ?, ?, ?, ?)");
                $stmt_appointment->execute(array(Date("Y-m-d H:i"), $client_id, $selected_employee, $start_time, $end_time));

                // Insert selected services
                $appointment_id = $con->lastInsertId();
                foreach($selected_services as $service){
                    $stmt = $con->prepare("INSERT INTO services_booked(appointment_id, service_id) VALUES(?, ?)");
                    $stmt->execute(array($appointment_id, $service));
                }

                $con->commit();

                echo "<div class='alert alert-success'>Great! Your appointment has been created successfully.</div>";

                // SEND EMAIL
                try {
                    $mail = getMailer();
                    $mail->setFrom('mikniks.hotsauce@gmail.com', 'Fresh Fade Co');
                    $mail->addAddress($client_email, $client_first_name.' '.$client_last_name);
                    $mail->Subject = "Appointment Confirmation";
                    
                    // Build service list
                    $service_names = [];
                    $stmt = $con->prepare("SELECT service_name FROM services WHERE service_id IN (".implode(',', array_map('intval', $selected_services)).")");
                    $stmt->execute();
                    $service_rows = $stmt->fetchAll();
                    foreach($service_rows as $s){
                        $service_names[] = $s['service_name'];
                    }
                    $service_list = implode(', ', $service_names);

                    // Get employee name
                    $stmt_employee = $con->prepare("SELECT first_name, last_name FROM employees WHERE employee_id = ?");
                    $stmt_employee->execute([$selected_employee]);
                    $employee_result = $stmt_employee->fetch();
                    $employee_name = $employee_result ? $employee_result['first_name'] . ' ' . $employee_result['last_name'] : 'Staff Member';

                    $mail->Body = "
                        <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
                            <h2 style='color: #333;'>Appointment Confirmation</h2>
                            <p>Hello $client_first_name $client_last_name,</p>
                            <p>Your appointment has been booked successfully. Here are your booking details:</p>
                            
                            <div style='background: #f9f9f9; padding: 20px; border-radius: 5px; margin: 20px 0;'>
                                <h3 style='color: #666; margin-top: 0;'>Appointment Details</h3>
                                <p><strong>Services:</strong> $service_list</p>
                                <p><strong>Date/Time:</strong> $start_time to $end_time</p>
                                <p><strong>Stylist:</strong> $employee_name</p>
                            </div>
                            
                            <p>Please arrive 5 minutes before your appointment time.</p>
                            <p><strong>Need to make changes?</strong> You can edit your booking by visiting: <a href='https://freshfadeco.ct.ws/barbershop/editbooking.php' style='color: #9e8a78; text-decoration: underline;'>Edit My Booking</a></p>
                            
                            <p>Thank you for choosing Fresh Fade Co!</p>
                            
                            <hr style='margin: 30px 0; border: none; border-top: 1px solid #eee;'>
                            <p style='color: #999; font-size: 12px;'>This is an automated email. Please do not reply.</p>
                        </div>
                    ";

                    $mail->send();
                } catch (Exception $e) {
                    echo "<div class='alert alert-warning'>Appointment created but email could not be sent.</div>";
                }

            } catch(Exception $e) {
                $con->rollBack();
                echo "<div class='alert alert-danger'>".$e->getMessage()."</div>";
            }
        }
        ?>

        <!-- RESERVATION FORM -->
        <form method="post" id="appointment_form" action="appointment.php">
            <!-- SELECT SERVICE -->
            <div class="select_services_div tab_reservation" id="services_tab">
                <div class="alert alert-danger" role="alert" style="display: none">Please, select at least one service!</div>
                <div class="text_header"><span>1. Choice of services</span></div>
                <div class="items_tab">
                    <?php
                    $stmt = $con->prepare("Select * from services");
                    $stmt->execute();
                    $rows = $stmt->fetchAll();
                    foreach($rows as $row){
                        echo "<div class='itemListElement'>";
                        echo "<div class='item_details'>";
                        echo "<div>".$row['service_name']."</div>";
                        echo "<div class='item_select_part'>";
                        echo "<span class='service_duration_field'>".$row['service_duration']." min</span>";
                        echo "<div class='service_price_field'><span style='font-weight: bold;'>R ".number_format($row['service_price'], 2)."</span></div>";
                        ?>
                        <div class="select_item_bttn">
                            <div class="btn-group-toggle" data-toggle="buttons">
                                <label class="service_label item_label btn btn-secondary">
                                    <input type="checkbox" name="selected_services[]" value="<?php echo $row['service_id'] ?>" autocomplete="off">Select
                                </label>
                            </div>
                        </div>
                        <?php
                        echo "</div></div></div>";
                    }
                    ?>
                </div>
            </div>

            <!-- SELECT EMPLOYEE -->
            <div class="select_employee_div tab_reservation" id="employees_tab">
                <div class="alert alert-danger" role="alert" style="display: none">Please, select your employee!</div>
                <div class="text_header"><span>2. Choice of employee</span></div>
                <div class="btn-group-toggle" data-toggle="buttons">
                    <div class="items_tab">
                        <?php
                        $stmt = $con->prepare("Select * from employees");
                        $stmt->execute();
                        $rows = $stmt->fetchAll();
                        foreach($rows as $row){
                            echo "<div class='itemListElement'>";
                            echo "<div class='item_details'>";
                            echo "<div>".$row['first_name']." ".$row['last_name']."</div>";
                            echo "<div class='item_select_part'>";
                            ?>
                            <div class="select_item_bttn">
                                <label class="item_label btn btn-secondary active">
                                    <input type="radio" class="radio_employee_select" name="selected_employee" value="<?php echo $row['employee_id'] ?>">Select
                                </label>
                            </div>
                            <?php
                            echo "</div></div></div>";
                        }
                        ?>
                    </div>
                </div>
            </div>

            <!-- SELECT DATE TIME -->
            <div class="select_date_time_div tab_reservation" id="calendar_tab">
                <div class="alert alert-danger" role="alert" style="display: none">Please, select time!</div>
                <div class="text_header"><span>3. Choice of Date and Time</span></div>
                <div class="calendar_tab" style="overflow-x: auto;overflow-y: visible;" id="calendar_tab_in">
                    <div id="calendar_loading">
                        <img src="Design/images/ajax_loader_gif.gif" style="display: block;margin-left: auto;margin-right: auto;">
                    </div>
                </div>
            </div>

            <!-- CLIENT DETAILS -->
            <div class="client_details_div tab_reservation" id="client_tab">
                <div class="text_header"><span>4. Client Details</span></div>
                <div>
                    <div class="form-group">
                        <input type="checkbox" id="existing_customer" name="existing_customer">
                        <label for="existing_customer">I am an existing customer</label>
                    </div>

                    <div class="form-group colum-row row">
                        <div class="col-sm-6" id="first_name_field">
                            <input type="text" name="client_first_name" id="client_first_name" class="form-control" placeholder="First Name">
                            <span class="error-message" style="display: none; color: #dc3545; font-size: 12px;">First name is required</span>
                        </div>
                        <div class="col-sm-6" id="last_name_field">
                            <input type="text" name="client_last_name" id="client_last_name" class="form-control" placeholder="Last Name">
                            <span class="error-message" style="display: none; color: #dc3545; font-size: 12px;">Last name is required</span>
                        </div>
                        <div class="col-sm-6">
                            <input type="email" name="client_email" id="client_email" class="form-control" placeholder="E-mail" required>
                            <span class="error-message" style="display: none; color: #dc3545; font-size: 12px;">Valid email is required</span>
                        </div>
                        <div class="col-sm-6" id="phone_field">
                            <input type="text" name="client_phone_number" id="client_phone_number" class="form-control" placeholder="Phone number">
                            <span class="error-message" style="display: none; color: #dc3545; font-size: 12px;">Valid phone number is required</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- NEXT AND PREVIOUS BUTTONS -->
            <div style="overflow:auto;padding: 30px 0px;">
                <div style="float:right;">
                    <input type="hidden" name="submit_book_appointment_form" value="1">
                    <button type="button" id="prevBtn" class="next_prev_buttons" style="background-color: #bbbbbb;" onclick="nextPrev(-1)">Previous</button>
                    <button type="button" id="nextBtn" class="next_prev_buttons" onclick="nextPrev(1)">Next</button>
                </div>
            </div>

            <!-- Circles -->
            <div style="text-align:center;margin-top:40px;">
                <span class="step"></span>
                <span class="step"></span>
                <span class="step"></span>
                <span class="step"></span>
            </div>

        </form>
    </div>
</section>

<!-- JS to hide/show fields if existing customer is checked -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    function toggleClientFields() {
        if($('#existing_customer').is(':checked')){
            $('#first_name_field, #last_name_field, #phone_field').hide();
            // Remove required attribute from hidden fields
            $('#client_first_name, #client_last_name, #client_phone_number').removeAttr('required');
        } else {
            $('#first_name_field, #last_name_field, #phone_field').show();
            // Add required attribute back to visible fields
            $('#client_first_name, #client_last_name, #client_phone_number').attr('required', 'required');
        }
    }

    toggleClientFields();
    $('#existing_customer').change(function(){
        toggleClientFields();
        // Clear fields when toggling
        if($(this).is(':checked')){
            $('#client_first_name, #client_last_name, #client_phone_number').val('');
        }
    });

    // Check if email exists when existing customer checkbox is checked
    $('#client_email').on('blur', function(){
        if($('#existing_customer').is(':checked')){
            var email = $(this).val().trim();
            if(email !== ''){
                console.log('Checking email:', email); // Debug log
                $.ajax({
                    url: 'check_email.php',
                    type: 'POST',
                    data: { email: email },
                    success: function(response){
                        console.log('Raw response:', response); // Debug log
                        try {
                            // Try to parse JSON if it's a string
                            var data = typeof response === 'string' ? JSON.parse(response) : response;
                            console.log('Parsed response:', data); // Debug log
                            
                            if(data.found){
                                $('#client_first_name').val(data.first_name);
                                $('#client_last_name').val(data.last_name);
                                $('#client_phone_number').val(data.phone_number);
                                console.log('Email found, fields populated');
                            } else {
                                console.log('Email not found');
                                alert('Email not found in our system. Please uncheck "existing customer" and fill in your details.');
                                $('#client_first_name, #client_last_name, #client_phone_number').val('');
                            }
                        } catch(e) {
                            console.log('JSON Parse Error:', e);
                            console.log('Response was:', response);
                            alert('Error processing response. Please try again.');
                        }
                    },
                    error: function(xhr, status, error){
                        console.log('AJAX Error Details:');
                        console.log('Status:', status);
                        console.log('Error:', error);
                        console.log('Response Text:', xhr.responseText);
                        console.log('Status Code:', xhr.status);
                        alert('Error checking email. Please try again.');
                    }
                });
            }
        }
    });
});
</script>

<?php include "Includes/templates/footer.php"; ?>
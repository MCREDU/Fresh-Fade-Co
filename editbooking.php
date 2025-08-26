<?php
include "connect.php";
include "Includes/functions/functions.php";
include "Includes/templates/header.php";
include "Includes/templates/navbar.php";

// Include your SMTP setup
$mail = require 'smtp.php';

// Helper function to fetch employee full name
function getEmployeeName($employee_id, $con) {
    $stmt = $con->prepare("SELECT first_name, last_name FROM employees WHERE employee_id = ?");
    $stmt->execute([$employee_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        return $row['first_name'] . " " . $row['last_name'];
    }
    return "Unknown Employee";
}

// Helper function to get service names
function getServiceNames($service_ids, $con) {
    if (empty($service_ids)) return [];
    
    $placeholders = str_repeat('?,', count($service_ids) - 1) . '?';
    $stmt = $con->prepare("SELECT service_name FROM services WHERE service_id IN ($placeholders)");
    $stmt->execute($service_ids);
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

// Helper function to check if time slot is available
function isTimeSlotAvailable($employee_id, $start_time, $end_time, $exclude_appointment_id, $con) {
    $stmt = $con->prepare("
        SELECT COUNT(*) FROM appointments 
        WHERE employee_id = ? 
        AND appointment_id != ? 
        AND canceled = 0
        AND (
            (start_time <= ? AND end_time_expected > ?) OR
            (start_time < ? AND end_time_expected >= ?) OR
            (start_time >= ? AND end_time_expected <= ?)
        )
    ");
    $stmt->execute([$employee_id, $exclude_appointment_id, $start_time, $start_time, $end_time, $end_time, $start_time, $end_time]);
    return $stmt->fetchColumn() == 0;
}

$appointment_found = false;
$client_email = '';
$appointment_id = null;
$selected_services = [];
$selected_employee = '';
$start_time = '';
$end_time = '';
$client_first_name = '';
$client_last_name = '';
$client_phone_number = '';
$error_message = '';
$success_message = '';

if(isset($_POST['find_appointment'])){
    $client_email = test_input($_POST['client_email']);
    
    if (!empty($client_email)) {
        $stmt = $con->prepare("
            SELECT a.*, c.client_id, c.first_name, c.last_name, c.phone_number
            FROM appointments a
            JOIN clients c ON a.client_id = c.client_id
            WHERE c.client_email = ? AND a.canceled = 0
            ORDER BY a.start_time DESC
        ");
        $stmt->execute([$client_email]);
        $appointment_data = $stmt->fetch();

        if($appointment_data){
            $appointment_found = true;
            $appointment_id = $appointment_data['appointment_id'];
            $client_first_name = $appointment_data['first_name'];
            $client_last_name = $appointment_data['last_name'];
            $client_phone_number = $appointment_data['phone_number'];
            $selected_employee = $appointment_data['employee_id'];
            $start_time = $appointment_data['start_time'];
            $end_time = $appointment_data['end_time_expected'];

            // Get current services
            $stmt2 = $con->prepare("SELECT service_id FROM services_booked WHERE appointment_id = ?");
            $stmt2->execute([$appointment_id]);
            $selected_services = $stmt2->fetchAll(PDO::FETCH_COLUMN);
        } else {
            $error_message = "No active booking found for this email address.";
        }
    } else {
        $error_message = "Please enter your email address.";
    }
}

if(isset($_POST['cancel_appointment'])){
    // Debug: Log that cancel appointment was triggered
    error_log("Cancel appointment form submitted");
    
    $appointment_id = isset($_POST['appointment_id']) ? intval($_POST['appointment_id']) : null;
    $client_email_post = isset($_POST['client_email']) ? test_input($_POST['client_email']) : '';
    $cancellation_reason = isset($_POST['cancellation_reason']) ? test_input($_POST['cancellation_reason']) : '';
    
    // Debug: Log the values
    error_log("Appointment ID: " . $appointment_id);
    error_log("Client Email: " . $client_email_post);
    error_log("Cancellation Reason: " . $cancellation_reason);

    // Get latest appointment + client details to validate and use for email
    if ($appointment_id) {
        $stmt = $con->prepare("SELECT a.*, c.client_id, c.first_name, c.last_name, c.phone_number, c.client_email FROM appointments a JOIN clients c ON a.client_id = c.client_id WHERE a.appointment_id = ?");
        $stmt->execute([$appointment_id]);
        $appointment_data = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        $appointment_data = false;
    }

    if(!$appointment_data){
        $error_message = "Appointment not found.";
    } elseif (!empty($client_email_post) && strcasecmp($appointment_data['client_email'], $client_email_post) !== 0) {
        $error_message = "Email address does not match this booking.";
    } else {
        try {
            $con->beginTransaction();

            // Cancel the appointment
            $stmt = $con->prepare("UPDATE appointments SET canceled = 1, cancellation_reason = ? WHERE appointment_id = ?");
            $result = $stmt->execute([$cancellation_reason, $appointment_id]);
            
            // Debug: Log the database update result
            error_log("Database update result: " . ($result ? "SUCCESS" : "FAILED"));
            error_log("Rows affected: " . $stmt->rowCount());

            $con->commit();
            $success_message = "Your booking has been cancelled successfully! You will receive a cancellation confirmation email shortly.";

            // Send cancellation email
            try {
                $employee_name = getEmployeeName($appointment_data['employee_id'], $con);
                $formatted_date = date('l, F j, Y', strtotime($appointment_data['start_time']));
                $formatted_start_time = date('g:i A', strtotime($appointment_data['start_time']));
                
                $mail->setFrom('mikniks.hotsauce@gmail.com', 'Fresh Fade Co.');
                $mail->addAddress($appointment_data['client_email'], $appointment_data['first_name'].' '.$appointment_data['last_name']);
                $mail->Subject = "Appointment Cancelled - Fresh Fade Co.";
                $mail->Body = "
                    <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
                        <h2 style='color: #333;'>Appointment Cancelled</h2>
                        <p>Dear ".$appointment_data['first_name'].",</p>
                        <p>Your appointment has been cancelled successfully. Here are the details of the cancelled appointment:</p>
                        
                        <div style='background: #f9f9f9; padding: 20px; border-radius: 5px; margin: 20px 0;'>
                            <h3 style='color: #666; margin-top: 0;'>Cancelled Appointment Details</h3>
                            <p><strong>Date:</strong> $formatted_date</p>
                            <p><strong>Time:</strong> $formatted_start_time</p>
                            <p><strong>Barber:</strong> $employee_name</p>
                            " . (!empty($cancellation_reason) ? "<p><strong>Cancellation Reason:</strong> $cancellation_reason</p>" : "") . "
                        </div>
                        
                        <p>If you'd like to book a new appointment, please visit our website.</p>
                        
                        <p>Thank you for choosing Fresh Fade Co.!</p>
                        
                        <hr style='margin: 30px 0; border: none; border-top: 1px solid #eee;'>
                        <p style='color: #999; font-size: 12px;'>This is an automated email. Please do not reply.</p>
                    </div>
                ";
                $mail->isHTML(true);
                $mail->send();
            } catch(Exception $e) {
                // Email failed but appointment was cancelled
                $error_message = "Appointment cancelled but email confirmation failed: " . $e->getMessage();
            }

            // Reset state so the form hides and messages show
            $appointment_found = false;
            $client_email = '';
        } catch(Exception $e) {
            $con->rollBack();
            $error_message = "Error cancelling appointment: " . $e->getMessage();
        }
    }
}

if(isset($_POST['update_appointment'])){
    // Fetch the appointment_id and client email from the form to validate and proceed
    $appointment_id = isset($_POST['appointment_id']) ? intval($_POST['appointment_id']) : null;
    $client_email_post = isset($_POST['client_email']) ? test_input($_POST['client_email']) : '';

    // Get latest appointment + client details to validate and use for email
    if ($appointment_id) {
        $stmt = $con->prepare("SELECT a.*, c.client_id, c.first_name, c.last_name, c.phone_number, c.client_email FROM appointments a JOIN clients c ON a.client_id = c.client_id WHERE a.appointment_id = ?");
        $stmt->execute([$appointment_id]);
        $appointment_data = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        $appointment_data = false;
    }

    if(!$appointment_data){
        $error_message = "Appointment not found.";
    } elseif (!empty($client_email_post) && strcasecmp($appointment_data['client_email'], $client_email_post) !== 0) {
        $error_message = "Email address does not match this booking.";
    } else {
        // Seed variables for email/template reuse
        $client_first_name = $appointment_data['first_name'];
        $client_last_name = $appointment_data['last_name'];
        $client_phone_number = $appointment_data['phone_number'];
        $client_email = $appointment_data['client_email'];

        $selected_services_post = isset($_POST['selected_services']) ? (array)$_POST['selected_services'] : [];
        $selected_employee_post = isset($_POST['selected_employee']) ? intval($_POST['selected_employee']) : null;
        $selected_date = isset($_POST['selected_date']) ? $_POST['selected_date'] : '';
        $selected_time = isset($_POST['selected_time']) ? $_POST['selected_time'] : '';
        
        // Validate inputs
        if (empty($selected_services_post)) {
            $error_message = "Please select at least one service.";
        } elseif (empty($selected_employee_post)) {
            $error_message = "Please select an employee.";
        } elseif (empty($selected_date) || empty($selected_time)) {
            $error_message = "Please select both date and time.";
        } else {
            // Calculate start and end times
            $start_time_post = $selected_date . " " . $selected_time;

            // Calculate end time based on total service duration
            $stmt = $con->prepare("SELECT COALESCE(SUM(service_duration),0) as total_duration FROM services WHERE service_id IN (" . str_repeat('?,', count($selected_services_post) - 1) . "?)");
            $stmt->execute($selected_services_post);
            $total_duration = intval($stmt->fetchColumn());

            if ($total_duration <= 0) {
                $error_message = "Selected services have no duration configured.";
            } else {
                $end_time_post = date('Y-m-d H:i:s', strtotime($start_time_post) + ($total_duration * 60));

                // Check if time slot is available
                if (!isTimeSlotAvailable($selected_employee_post, $start_time_post, $end_time_post, $appointment_id, $con)) {
                    $error_message = "The selected time slot is not available. Please choose a different time.";
                } else {
                    try {
                        $con->beginTransaction();

                        // Update appointment
                        $stmt = $con->prepare("UPDATE appointments SET employee_id=?, start_time=?, end_time_expected=? WHERE appointment_id=?");
                        $stmt->execute([$selected_employee_post, $start_time_post, $end_time_post, $appointment_id]);

                        // Update services
                        $stmt = $con->prepare("DELETE FROM services_booked WHERE appointment_id=?");
                        $stmt->execute([$appointment_id]);

                        foreach($selected_services_post as $service){
                            $stmt = $con->prepare("INSERT INTO services_booked(appointment_id, service_id) VALUES(?, ?)");
                            $stmt->execute([$appointment_id, $service]);
                        }

                        $con->commit();
                        $success_message = "Your booking has been updated successfully! You will receive an email confirmation shortly.";

                        // Send email confirmation
                        try {
                            $employee_name = getEmployeeName($selected_employee_post, $con);
                            $service_names = getServiceNames($selected_services_post, $con);
                            $formatted_date = date('l, F j, Y', strtotime($start_time_post));
                            $formatted_start_time = date('g:i A', strtotime($start_time_post));
                            $formatted_end_time = date('g:i A', strtotime($end_time_post));
                            
                            $mail->setFrom('mikniks.hotsauce@gmail.com', 'Fresh Fade Co.');
                            $mail->addAddress($client_email, $client_first_name.' '.$client_last_name);
                            $mail->Subject = "Booking Updated Successfully - Fresh Fade Co.";
                            $mail->Body = "
                                <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
                                    <h2 style='color: #333;'>Booking Updated Successfully!</h2>
                                    <p>Dear $client_first_name,</p>
                                    <p>Your booking has been updated successfully. Here are the new details:</p>
                                    
                                    <div style='background: #f9f9f9; padding: 20px; border-radius: 5px; margin: 20px 0;'>
                                        <h3 style='color: #666; margin-top: 0;'>Appointment Details</h3>
                                        <p><strong>Date:</strong> $formatted_date</p>
                                        <p><strong>Time:</strong> $formatted_start_time - $formatted_end_time</p>
                                        <p><strong>Barber:</strong> $employee_name</p>
                                        <p><strong>Services:</strong> " . implode(', ', $service_names) . "</p>
                                    </div>
                                    
                                    <p>Please arrive 5 minutes before your appointment time.</p>
                                    <p><strong>Need to make more changes?</strong> You can edit your booking by visiting: <a href='https://freshfadeco.ct.ws/barbershop/editbooking.php' style='color: #9e8a78; text-decoration: underline;'>Edit My Booking</a></p>
                                    
                                    <p>Thank you for choosing Fresh Fade Co.!</p>
                                    
                                    <hr style='margin: 30px 0; border: none; border-top: 1px solid #eee;'>
                                    <p style='color: #999; font-size: 12px;'>This is an automated email. Please do not reply.</p>
                                </div>
                            ";
                            $mail->isHTML(true);
                            $mail->send();
                        } catch(Exception $e) {
                            // Email failed but booking was updated
                            $error_message = "Booking updated but email confirmation failed: " . $e->getMessage();
                        }

                        // Reset state so the form hides and messages show
                        $appointment_found = false;
                        $client_email = '';
                    } catch(Exception $e) {
                        $con->rollBack();
                        $error_message = "Error updating booking: " . $e->getMessage();
                    }
                }
            }
        }
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center mb-0">Edit Your Booking</h2>
                    <!-- Debug: Test database connection -->
                    <?php if(isset($_GET['test_db'])): ?>
                        <div class="alert alert-info">
                            <strong>Database Test:</strong><br>
                            Connection: <?php echo $con ? 'OK' : 'FAILED'; ?><br>
                            <?php 
                            if($con) {
                                $test_stmt = $con->prepare("SELECT COUNT(*) FROM appointments WHERE canceled = 0");
                                $test_stmt->execute();
                                echo "Active appointments: " . $test_stmt->fetchColumn();
                            }
                            ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    
                    <?php if($error_message): ?>
                        <div class='alert alert-danger'><?php echo $error_message; ?></div>
                    <?php endif; ?>
                    
                    <?php if($success_message): ?>
                        <div class='alert alert-success'><?php echo $success_message; ?></div>
                    <?php endif; ?>
                    
                    <!-- Debug: Show POST data -->
                    <?php if(isset($_GET['debug']) && !empty($_POST)): ?>
                        <div class='alert alert-warning'>
                            <strong>Debug - POST Data:</strong><br>
                            <pre><?php print_r($_POST); ?></pre>
                        </div>
                    <?php endif; ?>

                    <?php if(!$appointment_found): ?>
                        <form method="post" action="">
                            <div class="form-group mb-3">
                                <label for="client_email" class="form-label"><strong>Enter your email to find your booking:</strong></label>
                                <input type="email" name="client_email" id="client_email" class="form-control form-control-lg" 
                                       value="<?php echo htmlspecialchars($client_email); ?>" required 
                                       placeholder="Enter your email address">
                            </div>
                            <div class="d-grid">
                                <button type="submit" name="find_appointment" class="btn btn-primary btn-lg">
                                    <i class="fas fa-search"></i> Find My Booking
                                </button>
                            </div>
                    <?php endif; ?>

                    <?php if($appointment_found): ?>
                        <form method="post" action="">
                            <input type="hidden" name="appointment_id" value="<?php echo (int)$appointment_id; ?>">
                            <input type="hidden" name="client_email" value="<?php echo htmlspecialchars($client_email); ?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="mb-3">Client Details</h4>
                                    <div class="mb-3">
                                        <label class="form-label">First Name</label>
                                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($client_first_name); ?>" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Last Name</label>
                                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($client_last_name); ?>" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Phone Number</label>
                                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($client_phone_number); ?>" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" value="<?php echo htmlspecialchars($client_email); ?>" readonly>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <h4 class="mb-3">Select Employee</h4>
                                    <div class="mb-3">
                                        <?php
                                        $stmt = $con->prepare("SELECT * FROM employees ORDER BY first_name, last_name");
                                        $stmt->execute();
                                        $employees = $stmt->fetchAll();
                                        foreach($employees as $emp){
                                            $checked = ($selected_employee == $emp['employee_id']) ? 'checked' : '';
                                            echo "<div class='form-check'>";
                                            echo "<input class='form-check-input' type='radio' name='selected_employee' id='emp_".$emp['employee_id']."' value='".$emp['employee_id']."' $checked required>";
                                            echo "<label class='form-check-label' for='emp_".$emp['employee_id']."'>";
                                            echo htmlspecialchars($emp['first_name'] . " " . $emp['last_name']);
                                            echo "</label>";
                                            echo "</div>";
                                        }
                                        ?>
                                    </div>

                                    <h4 class="mb-3">Select Services</h4>
                                    <div class="mb-3">
                                        <?php
                                        $stmt = $con->prepare("SELECT * FROM services ORDER BY service_name");
                                        $stmt->execute();
                                        $services = $stmt->fetchAll();
                                        foreach($services as $srv){
                                            $checked = in_array($srv['service_id'], $selected_services) ? 'checked' : '';
                                            echo "<div class='form-check'>";
                                            echo "<input class='form-check-input' type='checkbox' name='selected_services[]' id='service_".$srv['service_id']."' value='".$srv['service_id']."' $checked>";
                                            echo "<label class='form-check-label' for='service_".$srv['service_id']."'>";
                                            echo htmlspecialchars($srv['service_name']) . " - R " . number_format($srv['service_price'], 2);
                                            echo "</label>";
                                            echo "</div>";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-12">
                                    <h4 class="mb-3">Select Date & Time</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="selected_date" class="form-label">Date</label>
                                            <input type="date" name="selected_date" id="selected_date" class="form-control" 
                                                   value="<?php echo date('Y-m-d', strtotime($start_time)); ?>" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="selected_time" class="form-label">Time</label>
                                            <select name="selected_time" id="selected_time" class="form-control" required>
                                                <?php
                                                // Generate time slots from 9 AM to 6 PM
                                                $start_hour = 9;
                                                $end_hour = 18;
                                                for ($hour = $start_hour; $hour < $end_hour; $hour++) {
                                                    for ($minute = 0; $minute < 60; $minute += 30) {
                                                        $time = sprintf('%02d:%02d:00', $hour, $minute);
                                                        $selected = ($time == date('H:i:s', strtotime($start_time))) ? 'selected' : '';
                                                        echo "<option value='$time' $selected>" . date('g:i A', strtotime($time)) . "</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button type="button" class="btn btn-danger mr-2" data-toggle="modal" data-target="#cancelModal">
                                            <i class="fas fa-times"></i> Cancel Booking
                                        </button>
                                        <a href="editbooking.php" class="btn btn-secondary me-md-2">Reset</a>
                                        <button type="submit" name="update_appointment" class="btn btn-success">
                                            <i class="fas fa-save"></i> Update Booking
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- Cancel Booking Modal -->
                        <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="cancelModalLabel">Cancel Appointment</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" action="">
                                        <div class="modal-body">
                                            <input type="hidden" name="appointment_id" value="<?php echo (int)$appointment_id; ?>">
                                            <input type="hidden" name="client_email" value="<?php echo htmlspecialchars($client_email); ?>">
                                            
                                            <p>Are you sure you want to cancel your appointment?</p>
                                            <p><strong>Date:</strong> <?php echo date('l, F j, Y', strtotime($start_time)); ?></p>
                                            <p><strong>Time:</strong> <?php echo date('g:i A', strtotime($start_time)); ?></p>
                                            
                                            <div class="mb-3">
                                                <label for="cancellation_reason" class="form-label">Reason for cancellation (optional):</label>
                                                <textarea class="form-control" id="cancellation_reason" name="cancellation_reason" rows="3" placeholder="Please let us know why you're cancelling..."></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Keep Appointment</button>
                                            <button type="submit" name="cancel_appointment" class="btn btn-danger">
                                                <i class="fas fa-times"></i> Yes, Cancel Appointment
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add validation for services
    const serviceCheckboxes = document.querySelectorAll('input[name="selected_services[]"]');
    const updateButton = document.querySelector('button[name="update_appointment"]');
    
    if (updateButton) {
        updateButton.addEventListener('click', function(e) {
            const checkedServices = document.querySelectorAll('input[name="selected_services[]"]:checked');
            if (checkedServices.length === 0) {
                e.preventDefault();
                alert('Please select at least one service.');
                return false;
            }
        });
    }
    
    // Add validation for date (can't select past dates)
    const dateInput = document.getElementById('selected_date');
    if (dateInput) {
        const today = new Date().toISOString().split('T')[0];
        dateInput.setAttribute('min', today);
    }
    
    // Debug modal functionality
    const cancelButton = document.querySelector('button[data-toggle="modal"]');
    if (cancelButton) {
        console.log('Cancel button found');
        cancelButton.addEventListener('click', function() {
            console.log('Cancel button clicked');
        });
    } else {
        console.log('Cancel button not found');
    }
    
    // Check if Bootstrap modal is available (Bootstrap 4)
    if (typeof $ !== 'undefined' && $.fn.modal) {
        console.log('Bootstrap 4 is loaded');
        $('#cancelModal').on('show.bs.modal', function () {
            console.log('Modal is about to show');
        });
        
        // Debug form submission
        $('#cancelModal form').on('submit', function(e) {
            console.log('Cancel form submitted');
            console.log('Form data:', $(this).serialize());
        });
    } else {
        console.log('Bootstrap 4 not loaded');
    }
});
</script>

<?php include "Includes/templates/footer.php"; ?>

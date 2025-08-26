<?php
    
    //PHP INCLUDES

	include "connect.php";

	if(isset($_POST['selected_employee']) && isset($_POST['selected_services']))
	{

		?>

        <!-- CALENDAR STYLE -->
        
        <style type="text/css">
            
            .calendar_tab
            {
                background: white;
                margin-top: 5px;
                width: 100%;
                position: relative;
                box-shadow: rgba(60, 66, 87, 0.04) 0px 0px 5px 0px, rgba(0, 0, 0, 0.04) 0px 0px 10px 0px;
                overflow: hidden;
                border-radius: 4px;
            }

            .appointment_day
            {
                width: 15%;
                text-align: center;
                display: flex;
                color: rgb(151, 151, 151);
                font-weight: 700;
                -webkit-box-align: center;
                align-items: center;
                -webkit-box-pack: center;
                justify-content: center;
                font-size: 14px;
                line-height: 1.5;
            }

            .appointments_days
            {
                border-top-left-radius: 4px;
                border-top-right-radius: 4px;
                display: flex;
                height: 60px;
                position: relative;
                -webkit-box-pack: justify;
                justify-content: space-between;
                padding: 10px;
                border-bottom: 1px solid rgb(229, 229, 229);
            }

            .available_booking_hours
            {
                display: flex;
                -webkit-box-pack: justify;
                justify-content: space-between;
                flex-wrap: wrap;
                gap: 8px;
                padding: 16px;
                border-radius: 4px;
            }

            .available_booking_hour
            {
                display: inline-block;
                margin: 6px 4px;
                padding: 8px 12px;
                border: 1px solid #e0e0e0;
                border-radius: 999px;
                background: #ffffff;
                font-size: 14px;
                line-height: 1.2;
                cursor: pointer;
                transition: all .15s ease;
            }

            .available_booking_hour:hover
            {
                background: #f5f7ff;
                border-color: #cfd8ff;
            }

            input[type="radio"] 
            {
                display: none;
            }

            input[type="radio"]:checked + label 
            {
                background: #0d6efd;
                color: #fff;
                border-color: #0d6efd;
                box-shadow: 0 2px 6px rgba(13,110,253,.3);
            }

            .available_booking_hours_colum
            {
                width: 15%;
                text-align: center;
            }

        </style>

        <!-- END CALENDAR STYLE -->

        <!-- START CALENDAR SLOT -->

        <div class="calendar_slots" style="min-width: 600px;">

            <!-- NEXT 10 DAYS -->

            <div class="appointments_days">
                <?php
                    
                    $appointment_date = date('Y-m-d');

                    for($i = 0; $i < 10; $i++)
                    {
                        $appointment_date = date('Y-m-d', strtotime($appointment_date . ' +1 day'));
                        echo "<div class = 'appointment_day'>";
                            echo date('D', strtotime($appointment_date));
                            echo "<br>";
                            echo date('d', strtotime($appointment_date))." ".date('M', strtotime($appointment_date));
                        echo "</div>";
                    } 
                ?>
            </div>

            <!-- DAY HOURS -->

            <div class = 'available_booking_hours'>
                <?php

                    //SELECTED SERVICES
		            $desired_services = $_POST['selected_services'];
		            
                    //SELECTED EMPLOYEE
		            $selected_employee = $_POST['selected_employee'];

        			//Services Duration - End time expected
		            $sum_duration = 0;
		            
                    foreach($desired_services as $service)
		            {
		                
		                $stmtServices = $con->prepare("select service_duration from services where service_id = ?");
		                $stmtServices->execute(array($service));
		                $rowS =  $stmtServices->fetch();
		                $sum_duration += $rowS['service_duration'];
		                
		            }
            
            
		            $sum_duration = date('H:i',mktime(0,$sum_duration));
		            $secs = strtotime($sum_duration)-strtotime("00:00:00");


                    $open_time = date('H:i',mktime(9,0,0));

                    $close_time = date('H:i',mktime(22,0,0));

                    $start = $open_time;

                    $secs = strtotime($sum_duration)-strtotime("00:00:00");
                    $result = date("H:i:s",strtotime($start)+$secs);


                    $appointment_date = date('Y-m-d');

                    for($i = 0; $i < 10; $i++)
                    {
                        echo "<div class='available_booking_hours_colum'>";

                            $appointment_date = date('Y-m-d', strtotime($appointment_date . ' +1 day'));
                            $start = $open_time;
                            $secs = strtotime($sum_duration)-strtotime("00:00:00");
                            $result = date("H:i:s",strtotime($start)+$secs);

                            $day_id = date('w',strtotime($appointment_date));
                            
                            while($start >= $open_time && $result <= $close_time)
                            {
                                // Check If the employee is available

                                $stmt_emp = $con->prepare("\n                                    Select employee_id\n                                    from employees_schedule\n                                    where employee_id = ?\n                                    and day_id = ?\n                                    and ? between from_hour and to_hour\n                                    and ? between from_hour and to_hour\n                                       \n                                ");
                                $stmt_emp->execute(array($selected_employee,$day_id,$start, $result));
                                $emp = $stmt_emp->fetchAll();

                                //If employee is available

                                if($stmt_emp->rowCount() != 0)
                                {

                                    //Check If there are no intersecting appointments with the current one
                                    $stmt = $con->prepare("\n                                        SELECT 1\n                                        FROM appointments a\n                                        WHERE a.employee_id = ?\n                                          AND a.canceled = 0\n                                          AND a.start_time < ?\n                                          AND a.end_time_expected > ?\n                                        LIMIT 1\n                                    ");

                                    $slot_start_ts = $appointment_date." ".$start;
                                    $slot_end_ts = $appointment_date." ".$result;
                                    $stmt->execute(array($selected_employee,$slot_end_ts,$slot_start_ts));
                                    $rows = $stmt->fetchAll();
                        
                                    if($stmt->rowCount() != 0)
                                    {
                                        //Show blank cell
                                    }
                                    else
                                    {
                                        ?>
                                            <input type="radio" id="<?php echo $appointment_date." ".$start; ?>" name="desired_date_time" value="<?php echo $appointment_date." ".$start." ".$result; ?>">
                                            <label class="available_booking_hour" for="<?php echo $appointment_date." ".$start; ?>"><?php echo date('g:i A', strtotime($start)); ?></label>
                                        <?php
                                    }
                                }
                                else
                                {
                                    //Show Blank cell
                                }
                                

                                $start = strtotime("+15 minutes", strtotime($start));
                                $start =  date('H:i', $start);

                                $secs = strtotime($sum_duration)-strtotime("00:00:00");
                                $result = date("H:i",strtotime($start)+$secs);
                            }

                        echo "</div>";
                    }
                ?>
            </div>
        </div>
	<?php
	}
    else
    {
        header('location: index.php');
        exit();
    }
?>
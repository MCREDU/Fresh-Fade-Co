<?php
include "connect.php";

// Test database connection
try {
    $stmt = $con->prepare("SELECT COUNT(*) as count FROM clients");
    $stmt->execute();
    $result = $stmt->fetch();
    echo "Database connection successful! Found " . $result['count'] . " clients.<br>";
    
    // Test email check
    $test_email = "driss.jabiri@gmail.com";
    $stmt = $con->prepare("SELECT * FROM clients WHERE client_email = ?");
    $stmt->execute([$test_email]);
    $client = $stmt->fetch();
    
    if($client) {
        echo "Test email found: " . $client['first_name'] . " " . $client['last_name'] . "<br>";
    } else {
        echo "Test email not found<br>";
    }
    
} catch(Exception $e) {
    echo "Database error: " . $e->getMessage();
}
?>

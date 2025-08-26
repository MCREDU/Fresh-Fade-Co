<?php
include "connect.php";

header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = trim($_POST['email']);
    
    if(empty($email)) {
        echo json_encode(['found' => false, 'error' => 'Email is required']);
        exit;
    }
    
    try {
        $stmt = $con->prepare("SELECT * FROM clients WHERE client_email = ?");
        $stmt->execute([$email]);
        $client = $stmt->fetch();
        
        if($client) {
            echo json_encode([
                'found' => true,
                'first_name' => $client['first_name'],
                'last_name' => $client['last_name'],
                'phone_number' => $client['phone_number']
            ]);
        } else {
            echo json_encode(['found' => false]);
        }
    } catch(Exception $e) {
        echo json_encode(['found' => false, 'error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['found' => false, 'error' => 'Invalid request']);
}
?>
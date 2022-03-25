<?php

session_start();
$exist = false;
$_SESSION['logged_in'] = false; // setting by default to false
require '_conn.php'; // importing connection object

$logs = [];
$phone = mysqli_real_escape_string($link, $_POST['phone_number']);
$email = mysqli_real_escape_string($link, $_POST['email']);

$pass = $_POST['password'];
$cpass = $_POST['c_password'];

if ($pass != $cpass) {
    $logs = [
        'status' => 'error',
        'massage' => 'Password do not matches',
    ];
} else {
    // moving towards checking data if password mathces;

    $enc_pass = password_hash($cpass, PASSWORD_BCRYPT);
    $key = bin2hex(openssl_random_pseudo_bytes(16));
    $query = "INSERT INTO user_data (mo_no , email, pass ,pass_key ) VALUES ( '$phone', '$email' , '$enc_pass' , '$key')";

    $execute = mysqli_query($link, $query);

    echo(mysqli_error($link ));
    
    if ($execute) {
        $_SESSION['logged_in'] = true;
        $_SESSION['user_id'] = $phone;

        $logs = [
            'status' => 'success',
            'massage' =>
                'Your account has been created , redirecting to home....',
        ];
    } else {
        $logs = [
            'status' => 'error',
            'massage' => 'Phone number already exists',
        ];
    }
}

echo json_encode($logs);

?>

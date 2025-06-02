<?php

require 'config/function.php';

if (isset($_POST['loginBtn'])) {
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);

    if ($email != '' && $password != '') {
        $query = "SELECT * FROM admins WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($conn, $query);
        if ($result) {
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                $hashedPassword = $row['password'];

                if (!password_verify($password, $hashedPassword)) {
                    redirect('login.php', 'Invalid password, please try again');
                }
                if ($row['is_ban'] == 1) {
                    redirect('login.php', 'Your account has been banned');
                }

                $_SESSION['loggedIn'] = true;
                $_SESSION['loggedInUser'] = [
                    'user_id' => $row['id'],
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'phone' => $row['phone']
                ];

                // Make sure this path is correct for your project structure
                redirect('admin/index.php', 'Login successful, welcome');
            } else {
                redirect('login.php', 'Invalid email, please try again');
            }
        } else {
            redirect('login.php', 'Something went wrong, please try again');
        }
    } else {
        redirect('login.php', 'Please fill in all fields');
    }
}
?>
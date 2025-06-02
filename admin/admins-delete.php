<?php
require '../config/function.php';

$paraResultId = checkParamId('id');
if (is_numeric($paraResultId)) {
    $adminId = validate($paraResultId);

    $admin = getById('admins', $adminId);
    if ($admin['status'] == 200) {
        $adminDeleteRes = delete('admins', $adminId);
        if ($adminDeleteRes) {
            redirect('/pos-system-in-php/admin/admins.php', 'Admin deleted successfully');
        } else {
            redirect('/pos-system-in-php/admin/admins.php', 'Something went wrong, please try again');
        }
    } else {
        redirect('/pos-system-in-php/admin/admins.php', $admin['message']);
    }
} else {
    redirect('/pos-system-in-php/admin/admins.php', 'Something went wrong, please try again');
}
?>
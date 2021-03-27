<?php
require_once('../../../wp-load.php');
require_once('admin-email-template.php');

header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");

$answers = json_decode(stripslashes_deep($_POST['answers']));
$sanitized_answers = [];
$user_id = get_current_user_id();
$user_info = get_userdata($user_id);
$user_name = $user_info->first_name . ' ' . $user_info->last_name;
$user_email = $user_info->user_email;

foreach ($answers[0] as $question => $answer) {
    $sanitized_answers[$question] = sanitize_text_field($answer);
}

//Saving the user data to the DB
$test_status_option_name = 'test_status' . $user_id;
$test_answers_option_name = 'test_answers' . $user_id;

update_option($test_status_option_name, 'completed');
update_option($test_answers_option_name, $sanitized_answers);


$admin_email_address = 'ashanudayanga@gmail.com, sisileranga@gmail.com';
$subject = $user_name . ' (' . $user_email . ') Has submitted their answers';
$message_admin_body = admin_email($user_name, $user_email);

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <interview@interview.insider-b2b.com>' . "\r\n";
//$headers .= 'BCc: ashanudayanga@gmail.com' . "\r\n";
//$headers .= 'BCc: sisileranga@gmail.com' . "\r\n";

$mail_sent_admin = wp_mail($admin_email_address, $subject, $message_admin_body, $headers);

$sanitized_answers['userName'] = $user_name;
$sanitized_answers['userEmail'] = $user_email;

if ($mail_sent_admin) {
    echo json_encode($sanitized_answers);
}


<?php

$config = require __DIR__.'/config.php';

$validation = validate();
if(!$validation['status']) {
    echo json_encode($validation['errors']);
} else if(send($config['mail-to'], $config['mail-from'], $validation['data'])) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to place an order']);
}

function validate()
{
    $data = [
        'text' => '',
        'email' => '',
    ];

    $formObject = 'Contact';

    if(isset($_POST[$formObject])) {
        foreach ($_POST[$formObject] as $key => $value) {
            if(key_exists($key, $data)) {
                $data[$key] = htmlspecialchars(trim($value));
            }
        }
    }

    $errors = [];
    foreach ($data as $key => $value) {
       if(empty($value)) {
           $errors[$key] = 'error';
       }
    }

    if(count($errors) > 0) {
        return ['status' => false, 'errors' => $errors];
    }

    return ['status' => true, 'data' => $data];

}

function send($mailTo, $mailFrom, $data)
{
    $subject = 'Ginget Studio Contact';
    $subject1 = "=?utf-8?b?". base64_encode($subject) ."?=";

    $message ="\n\nText: {$data['text']}\n\nEmail:  {$data['email']}\n\n";

    $header = "Content-Type: text/plain; charset=utf-8\n";
    $header .= "From: Ginget Studio <$mailFrom>\n\n";
    $mail = mail($mailTo, $subject1, iconv ('utf-8', 'windows-1251', $message), iconv ('utf-8', 'windows-1251', $header));

    if($mail) {
        return true;
    }
    return false;
}

?>

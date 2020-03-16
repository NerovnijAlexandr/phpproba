<?php

require_once('Database.php');
require_once("request_class.php");

$requestClass = new Request();

if( $requestClass->isPost() )
{
    $db = new Database();
    $db->table_name = 'feedback';

    $formData = new FormData();

    $requestClass->required('name');
    $requestClass->required('email');
    $requestClass->isEmail('email');
    $requestClass->required('message');
    $requestClass->min('message', 10);
    $requestClass->max('message', 200);

    $errors = $requestClass->getErrors();
    echo json_encode($errors);

    if(!isset($errors) || count($errors) == 0) {
        $db->insert([
            'name' => $formData->getField('name'),
            'email' => $formData->getField('email'),
            'message' => $formData->getField('message'),
        ]);
    }
}

?>

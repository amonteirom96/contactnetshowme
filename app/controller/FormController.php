<?php
include '../model/Connection.php';
$jsonReturn = [];

$jsonReturn["status"] = true;
$jsonReturn["message"] = "Recebemos sua mensagem, logo menos entraremos em contato com você.";



$validate = validateForm($_POST, $_FILES);
if ($validate) {
} else {
    $jsonReturn["status"] = false;
}



function validateForm($form = [], $file)
{
    $inputRequired = [
        "name",
        "email",
        "phone",
        "message",
        "clientIp",
        "file",
    ];

    foreach ($inputRequired as $nameInput) {
        if ($nameInput == "file") {
            if (empty($file)) {
                $jsonReturn["message"] = "Campo de arquivo é obrigatório";
                return false;
            }
        } else {
            if (in_array($nameInput, $form)) {
                if (empty($form[$nameInput])) {
                    $jsonReturn["message"] = "Campo de {$form[$nameInput]} é obrigatório";
                    return false;
                }

                $_POST[$nameInput] = checkIfTrustedText($_POST[$nameInput]);
            }

        }
    }
    return true;
}

function checkIfTrustedText($text)
{
    return preg_replace('/[^[:alpha:]_]/', '',$text);
}

echo json_encode($jsonReturn);

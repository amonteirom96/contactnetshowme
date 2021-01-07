<?php
include '../model/Connection.php';
/**
 * validation 1: Only save files with extesion: pdf, doc, docx, odt ou txt
 */
$jsonReturn = [];

$jsonReturn["status"] = true;
$jsonReturn["message"] = "Recebemos sua mensagem, logo menos entraremos em contato com você.";

try {
    validateForm();

    $sqlCreate = createSqlSave();
    $stmt = $pdo->prepare($sqlCreate);
    $stmt->bindValue(':name', $_POST["name"]);
    $create = $stmt->execute();

    function saveLocalFile()
    {
    }

    function validateForm()
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
                if (empty($_FILES))
                    throw new Exception("Campo de arquivo é obrigatório");

                saveLocalFile();
            } else {
                if (in_array($nameInput, $_POST)) {
                    if (empty($_POST[$nameInput])) {
                        throw new Exception("Campo de {$_POST[$nameInput]} é obrigatório");
                    }

                    $_POST[$nameInput] = checkIfTrustedText($_POST[$nameInput]);
                }
            }
        }
    }

    function createSqlSave()
    {
    }

    function checkIfTrustedText($text)
    {
        return preg_replace('/[^[:alpha:]_]/', '', $text);
    }
} catch (\Exception $e) {
    $jsonReturn["status"] = false;
    $jsonReturn["message"] = $e->getMessage();
}

echo json_encode($jsonReturn);
die;

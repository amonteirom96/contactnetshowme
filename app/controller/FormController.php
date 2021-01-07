<?php
include '../model/Connection.php';
/**
 * validation 1: Only save files with extesion: pdf, doc, docx, odt ou txt
 */
$jsonReturn = [];

$jsonReturn["status"] = true;
$jsonReturn["message"] = "Recebemos sua mensagem, logo menos entraremos em contato com você.";

try {
    function saveLocalFile()
    {
        $mimeTypesFiles = [
            "application/pdf",
            "application/msword",
            "application/vnd.oasis.opendocument.text",
            "text/plain",
        ];

        if(!in_array($_FILES["file"]["type"], $mimeTypesFiles))
            throw new Exception("Tipo de arquivo não permitido");

        $extesionFile = new SplFileInfo($_FILES['file']['name']);
        $newNameFile = uniqid(). "." .$extesionFile->getExtension(); 
        $locationSaveFile = $_SERVER['DOCUMENT_ROOT']."/contactnetshowme/tmp/files/";
        $saveFileLocal = @move_uploaded_file($_FILES['file']['tmp_name'], $locationSaveFile.$newNameFile);

        if(!$saveFileLocal)
            throw new Exception("Falha ao salvar arquivo local");

        $_POST["file"] = $newNameFile;
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
        return "INSERT INTO contacts (
            name,
            email,
            telephone,
            message,
            file,
            ip_client,
            created)
            VALUES (
                :name,
                :email,
                :telephone,
                :message,
                :file,
                :clientIp,
                now()
            )";
    }

    function checkIfTrustedText($text)
    {
        return preg_replace('/[^[:alpha:]_]/', '', $text);
    }

    function sendMailForClient()
    {

    }

    validateForm();
    
    $sqlCreate = createSqlSave();
    $stmt = $pdo->prepare($sqlCreate);
    $stmt->bindValue(':name', $_POST["name"]);
    $stmt->bindValue(':email', $_POST["email"]);
    $stmt->bindValue(':telephone', $_POST["phone"]);
    $stmt->bindValue(':file', $_POST["file"]);
    $stmt->bindValue(':clientIp', $_POST["clientIp"]);
    $stmt->bindValue(':message', $_POST["message"]);
    $create = $stmt->execute();

    if(!$create)
        throw new Exception("Falha ao salvar o contato");

    sendMailForClient();
} catch (\Exception $e) {
    $jsonReturn["status"] = false;
    $jsonReturn["message"] = $e->getMessage();
}

echo json_encode($jsonReturn);
die;

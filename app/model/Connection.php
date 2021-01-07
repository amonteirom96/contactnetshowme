<?php
try {
    require_once('../../vendor/autoload.php');
    $paramsDatabase = parse_ini_file('../../database.ini');
    $paramsEmail = parse_ini_file('../../email.ini');

    if ($paramsDatabase === false)
        throw new \Exception("Error reading database configuration file");

    if ($paramsDatabase === false)
        throw new \Exception("Error reading database configuration file");
    // connect to the postgresql database
    $conStr = sprintf(
        "pgsql:host=%s;port=%d;dbname=%s;user=%s;password=%s",
        $paramsDatabase['host'],
        $paramsDatabase['port'],
        $paramsDatabase['database'],
        $paramsDatabase['user'],
        $paramsDatabase['password']
    );

    $pdo = new \PDO($conStr);

    $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

    require_once('../../vendor/phpmailer/phpmailer/src/PHPMailer.php');

    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->IsSMTP();

    $mail->Port = $paramsEmail["port"];
    $mail->Host = $paramsEmail["host"];
    $mail->IsHTML(true);
    $mail->Mailer = $paramsEmail["mailer"];
    $mail->SMTPSecure = $paramsEmail["smtp"];

    $mail->SMTPAuth = true;
    $mail->Username = $paramsEmail["username"];
    $mail->Password = $paramsEmail["password"];
    $mail->From = $paramsEmail["from"];
    $mail->FromName = $paramsEmail["formName"];
    $mail->addAddress($paramsEmail["mailSend"]);

} catch (\Exception $e) {
    echo $e->getMessage();
}

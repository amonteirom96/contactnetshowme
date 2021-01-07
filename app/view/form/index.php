<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Contato Netshowme</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <div class="container-contact100">
        <div class="wrap-contact100">
            <form class="contact100-form validate-form" id="form-contact" onsubmit="return false">
                <span class="contact100-form-title">
                    Contato Netshowme
                </span>

                <div class="wrap-input100 validate-input bg1" data-validate="Por favor, preencha seu nome">
                    <span class="label-input100">NOMEC COMPLETO *</span>
                    <input class="input100" type="text" name="name" value="" placeholder="Digite seu nome completo">
                </div>

                <div class="wrap-input100 validate-input bg1 rs1-wrap-input100" data-validate="Preencha seu email (e@a.x)">
                    <span class="label-input100">E-mail *</span>
                    <input class="input100" type="text" name="email" value="" placeholder="Preencha seu email ">
                </div>

                <div class="wrap-input100 bg1 rs1-wrap-input100">
                    <span class="label-input100">TELEFONE</span>
                    <input class="input100" type="text" name="phone" placeholder="Preencha seu número">
                </div>

                <div class="wrap-input100 validate-input bg0 rs1-alert-validate" data-validate="Precisamos de um arquivo">
                    <span class="label-input100">ARQUIVO</span>
                    <input type="file" class="input100" accept="application/pdf, application/msword, application/vnd.oasis.opendocument.text, text/plain" name="" id="file-contact">
                </div>
                <div class="wrap-input100 validate-input bg0 rs1-alert-validate" data-validate="Por favor, nos diga algo.">
                    <span class="label-input100">Mensagem</span>
                    <textarea class="input100" name="message" placeholder="Agora me conta tudo que você tem pra falar..."></textarea>
                </div>

                <div class="container-contact100-form-btn">
                    <button class="contact100-form-btn" onclick="">
                        <span>
                            Submit
                            <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
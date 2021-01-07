class FormController extends Util {
    constructor() {
        super();
        this.maxFileSize = 500000;
        this.clientIp = null;
    }

    async sendForm() {
        const self = this;
        try {
            var file = document.getElementById(`file-contact`).files[0];
            var validation = await self.validationFile(file);

            if (validation) {
                var form = new FormData(document.getElementById(`form-contact`));

                form.append(`clientIp`, self.clientIp);
                form.append(`file`, file);

                $.ajax({
                    url: `app/controller/FormController.php`,
                    dataType: `json`,
                    type: `post`,
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form
                }).done(function (response) {
                    alert(response.message)

                    if (response.status)
                        $(':input').val('');
                });
            }

        } catch (error) {
            alert(`Ultrapassou o tamanho permitido. Só é pertimido arquivos até ${self.maxFileSize / 1000}Kbps`);
        }
    }

    validationFile(file = null) {
        const self = this;
        return new Promise((resolve, reject) => {
            if (file.size > self.maxFileSize)
                reject(false);
            else {
                $.ajax({
                    url: `https://api.ipify.org/?format=json`,
                    type: `get`,
                    dataType: `json`
                }).done(function (response) {
                    self.clientIp = response.ip;
                    resolve(true);
                })
            }

        });
    }
}
const AppFormController = new FormController();
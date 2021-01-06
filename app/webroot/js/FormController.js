class FormController extends Util {
    constructor() {
        super();
    }

    async sendForm() {
        try {
            const self = this;
            var file = document.getElementById(`file-contact`).files[0];
            var validation = await self.validationFile(file);

            validation.then((resolve) => {
                var form = new FormData(document.getElementById(`form-contact`));
                alert('oi');

                // $.ajax({
                //     url: ``,
                //     dataType: `json`,
                //     type: `post`,
                //     cache: false,
                //     contentType: false,
                //     processData: false
                // });
            });

            validation.catch((reject) => {
                alert(reject);
            });
        } catch (error) {
            console.log(error);
        }
    }

    validationFile(file = null) {
        var maxFileSize = 500000;
        return new Promise((resolve, reject) => {
            if (file.size > maxFileSize)
                reject(`Ultrapassou o tamanho permitido. Só é pertimido arquivos até ${maxFileSize / 1000}Kbps`);
            else
                resolve();

        });
    }
}
const AppFormController = new FormController();
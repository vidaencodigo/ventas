/**
 * 
 * Created by Emmanuel Lucio Urbina 2023
 */

class MyAlert {
    parent = ".c_alert"
    text = "New Alert"
    btn_text = "Click"
    type_a = "success"
    success_image = `
        
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                    <circle class="path circle" fill="none" stroke="#73AF55" stroke-width="6" stroke-miterlimit="10"
                        cx="65.1" cy="65.1" r="62.1" />
                    <polyline class="path check" fill="none" stroke="#73AF55" stroke-width="6" stroke-linecap="round"
                        stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 " />
                </svg>`
    error_image = `
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                <circle class="path circle" fill="none" stroke="#D06079" stroke-width="6" stroke-miterlimit="10"
                    cx="65.1" cy="65.1" r="62.1" />
                <line class="path line" fill="none" stroke="#D06079" stroke-width="6" stroke-linecap="round"
                    stroke-miterlimit="10" x1="34.4" y1="37.9" x2="95.8" y2="92.3" />
                <line class="path line" fill="none" stroke="#D06079" stroke-width="6" stroke-linecap="round"
                    stroke-miterlimit="10" x1="95.8" y1="38" x2="34.4" y2="92.2" />
            </svg>
            `


    create__alert() {


        const content__alert = document.createElement("section");
        const alert = document.createElement("article");
        const alert__image = document.createElement("div");
        const alert__content = document.createElement("div");
        const alert__button = document.createElement("div");
        const button__alert = document.createElement("button");
        const text_ = document.createElement("h5");
        /*adding clases*/
        content__alert.classList.add("alert--container");
        alert.classList.add("ale--alert");
        alert__image.classList.add("image");
        alert__content.classList.add("alert--content");
        alert__button.classList.add("alert--buttons");
        button__alert.classList.add("button--alert");

        text_.innerHTML = this.text;
        button__alert.innerHTML = this.btn_text;
        if (this.type_a == "success") alert__image.innerHTML = this.success_image;
        if (this.type_a == "error") alert__image.innerHTML = this.error_image;
        alert__button.appendChild(button__alert);
        alert__content.appendChild(text_);

        alert.appendChild(alert__image);
        alert.appendChild(alert__content);
        alert.appendChild(alert__button);

        content__alert.appendChild(alert);

        document.querySelector(this.parent).appendChild(content__alert);



        button__alert.addEventListener("click", () => {
            this.destroy__alert()
        })



    }

    destroy__alert() {
        const lastChild = document.querySelector('.alert--container');
        document.querySelector(this.parent).removeChild(lastChild);
        return true
    }


}
class CardProduct extends HTMLElement {
    constructor() {
        super();
    }
    connectedCallback() {
        const shadow = this.attachShadow({
            mode: 'open'
        });
        const style = document.createElement('style');
        style.textContent = `
        .card {
            background-color:#fff;
            border-radius:8px;
            padding:10px 15px; 
            display:flex;
            flex-direction:row;
            gap:10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
          
        }
        .product--image{
            width:100%;
            height:80px;
            border-radius:8px;
        }
        .button {
            text-decoration:none;
            cursor: pointer;
            outline: none;
            border: none;
            font-family: 'Montserrat', sans-serif;
            padding: 10px 20px;
            background-color: #5468ff;
            color: #fff;
            font-weight: 600;
            border-radius: 5px;
        }
        
        .button:hover {
            background-color: #6459dd;
        }
        
        .button:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(115, 103, 240, 0.5);
        }
        
        .button:active {
            background-color: #483cd7;
        }
        .body--card {
            display:flex;
            flex-direction:column;
            gap:5px;
        }
        `
        const card = document.createElement("div");
        card.setAttribute("class", "card");
        const header = document.createElement("div");
        const image = document.createElement("img");
        image.setAttribute("class", "product--image");
        image.src = this.getAttribute('data-image');
        const body_card = document.createElement("div");
        body_card.setAttribute("class", "body--card");
        const footer_card = document.createElement("div");
        const name = document.createElement("p");
        const buttonAction = document.createElement("a");
        buttonAction.setAttribute("class", "button");
        buttonAction.textContent = "Editar";
        let idd = this.getAttribute('data-id');
        buttonAction.href = "index.php?controller=product&action=get_form_new&id=" + idd;

        name.textContent = this.getAttribute('data-name');
        header.appendChild(image);
        footer_card.appendChild(buttonAction);
        card.appendChild(header);
        body_card.appendChild(name);
        body_card.appendChild(footer_card);
        card.appendChild(body_card);

        shadow.appendChild(style);
        shadow.appendChild(card);
    }
}
customElements.define('card-component', CardProduct);



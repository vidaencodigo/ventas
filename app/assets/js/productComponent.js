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
        `
        const card = document.createElement("div");
        card.setAttribute("class", "card");
        const header = document.createElement("div");
        const image = document.createElement("img");
        image.setAttribute("class", "product--image");
        image.src = this.getAttribute('data-image');
        const body_card = document.createElement("div");
        const name = document.createElement("p");
        name.textContent = this.getAttribute('data-name');
        header.appendChild(image);
        card.appendChild(header);
        body_card.appendChild(name);
        card.appendChild(body_card);

        shadow.appendChild(style);
        shadow.appendChild(card);
    }
}
customElements.define('card-component', CardProduct);
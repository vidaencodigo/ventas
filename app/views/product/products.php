<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producto</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/3d68344ae4.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="app/assets/css/styles.css">
    <link rel="stylesheet" href="app/assets/css/alert.css">
    <style>
        /** end custom file input */
        .form {
            display: flex;
            flex-direction: column;
            gap: 8px;
            width: 100%;
        }

        .container--content {
            padding: 20px 18px;
            border-radius: 15px;
            background-color: #fff;
            display: flex;
            flex-direction: column;
            gap: 16px;
            width: 100%;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        }

        .container {
            height: 100vh;
            background-color: #F4F8FB;
            width: 80%;
            padding: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;

            gap: 16px;

        }

        .grilla {
            display: grid;

            grid-template-columns: repeat(3, 1fr);
            gap: 5px;
        }

        /** */
        .lds-ellipsis {
            display: inline-block;
            position: relative;
            width: 80px;
            height: 80px;
        }

        .lds-ellipsis div {
            position: absolute;
            top: 33px;
            width: 13px;
            height: 13px;
            border-radius: 50%;
            background: #483cd7;
            animation-timing-function: cubic-bezier(0, 1, 1, 0);
        }

        .lds-ellipsis div:nth-child(1) {
            left: 8px;
            animation: lds-ellipsis1 0.6s infinite;
        }

        .lds-ellipsis div:nth-child(2) {
            left: 8px;
            animation: lds-ellipsis2 0.6s infinite;
        }

        .lds-ellipsis div:nth-child(3) {
            left: 32px;
            animation: lds-ellipsis2 0.6s infinite;
        }

        .lds-ellipsis div:nth-child(4) {
            left: 56px;
            animation: lds-ellipsis3 0.6s infinite;
        }

        @keyframes lds-ellipsis1 {
            0% {
                transform: scale(0);
            }

            100% {
                transform: scale(1);
            }
        }

        @keyframes lds-ellipsis3 {
            0% {
                transform: scale(1);
            }

            100% {
                transform: scale(0);
            }
        }

        @keyframes lds-ellipsis2 {
            0% {
                transform: translate(0, 0);
            }

            100% {
                transform: translate(24px, 0);
            }
        }
    </style>
</head>

<body>
    <nav class="nav">
        <div class="nav--container">
            <div class="brand">
                Ventas
            </div>
        </div>
    </nav>
    <main class="main c_alert">
        <aside class="menu--lateral">
            <ul class="nav--lateral">
                <li>
                    <a href="#" class="link">
                        <i class="fa-solid fa-store"></i>
                        Ventas
                    </a>
                </li>
                <li class="active">
                    <a href="index.php?controller=product&action=get_view_products" class="link">
                        <i class="fa-solid fa-file"></i>
                        Productos
                    </a>
                </li>
            </ul>
        </aside>

        <section class="container">
            <div class="container--content">
                <h3>
                    Productos
                </h3>
                <div class="categorias">
                    <div class="btn-categorias">
                        <button class="button" onclick="get_all_category()">Todo</button>
                        <?php foreach ($categorias as $categoria) : ?>
                            <button class="button" onclick="get_by_category(<?= $categoria->id ?>)"><?= $categoria->nombre ?></button>
                        <?php endforeach; ?>
                    </div>

                </div>
                <div class="grilla">

                </div>

            </div>

        </section>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="app/assets/js/alert.js"></script>

    <script>
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
        customElements.define('card-product', CardProduct);




        get_all_category();

        async function get_all_category() {
            const grilla = document.querySelector(".grilla");
            grilla.innerHTML = `<div></div><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>`;

            try {
                const res = await axios.get("index.php?controller=product&action=get_all_products");
                grilla.innerHTML = "";
                res.data.forEach(element => {
                    const c = document.createElement("card-product");
                    c.setAttribute("data-name", `${element.nombre} - $ ${element.precio_unitario}`);
                    c.setAttribute("data-image", "data:image/png;base64," + element.imagen);
                    grilla.appendChild(c);
                });
            } catch (error) {
                console.log(error);
            }


        }

        async function get_by_category(category) {
            const grilla = document.querySelector(".grilla");
            grilla.innerHTML = `<div></div><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>`;

            try {
                const res = await axios.get("index.php?controller=product&action=get_all_products&categoria=" + category);

                grilla.innerHTML = "";
                res.data.forEach(element => {
                    const c = document.createElement("card-product");
                    c.setAttribute("data-name", `${element.nombre} - $ ${element.precio_unitario}`);
                    c.setAttribute("data-image", "data:image/png;base64," + element.imagen);
                    grilla.appendChild(c);
                });
            } catch (error) {
                console.log(error);
            }


        }
    </script>

</body>

</html>
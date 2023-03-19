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

       
        .btn-categorias {
            display: flex;
            gap: 5px;
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
    <script src="app/assets/js/productComponent.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded",()=>{
            get_all_category();
        })

        async function get_all_category() {
            /**
             * Renderiza todos los productos
             */
            const grilla = document.querySelector(".grilla");
            grilla.innerHTML = `<div></div><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>`;
            console.log("loading");
            try {
                const res = await axios.get("index.php?controller=product&action=get_all_products");
                grilla.innerHTML = "";
                res.data.forEach(element => {
                    const c = document.createElement("card-component");
                    c.setAttribute("data-name", `${element.nombre} - $ ${element.precio_unitario}`);
                    c.setAttribute("data-image", "data:image/png;base64," + element.imagen);
                    grilla.appendChild(c);
                });
                console.log(res.data);
            } catch (error) {
                console.log(error);
            }


        }

        async function get_by_category(category) {
            /**
             * Renderiza productos por @categoria
             */
            const grilla = document.querySelector(".grilla");
            grilla.innerHTML = `<div></div><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>`;
            console.log("loading");
            try {
                const res = await axios.get("index.php?controller=product&action=get_all_products&categoria=" + category);

                grilla.innerHTML = "";
                res.data.forEach(element => {
                    const c = document.createElement("card-component");
                    c.setAttribute("data-name", `${element.nombre} - $ ${element.precio_unitario}`);
                    c.setAttribute("data-image", "data:image/png;base64," + element.imagen);
                    grilla.appendChild(c);
                });
                console.log(res.data);
            } catch (error) {
                console.log(error);
            }


        }
    </script>

</body>

</html>
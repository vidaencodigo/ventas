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
        .formulario--content {
            padding: 20px 18px;
            border-radius: 15px;
            background-color: #fff;
            display: flex;
            flex-direction: column;
            gap: 16px;
            width: 60%;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        }
        .formulario {
            height: 100vh;
            background-color: #F4F8FB;
            width: 80%;
            padding: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            
            gap: 16px;

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
                    <a href="index.php?controller=product&action=get_form_new" class="link">
                        <i class="fa-solid fa-file"></i>
                        Productos
                    </a>
                </li>
            </ul>
        </aside>

        <section class="formulario">
            <div class="formulario--content">
                <h3>
                    Registra nuevo producto
                </h3>
                <form id="new_product" class="form">
                    <input type="hidden" id="token" value="<?php echo $_SESSION['token'] ?>">
                    <div class="input--group">
                        <label for="codigo">Código</label>
                        <div class="icon--input">
                            <span>
                                <i class="fa-solid fa-barcode"></i>
                            </span>
                            <input type="text" name="codigo" id="codigo" placeholder="Escribe el código..." required>
                        </div>
                    </div>

                    <div class="input--group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="input--form" name="nombre" id="nombre" required>
                    </div>

                    <div class="input--group">
                        <label for="descripcion">Descripción</label>
                        <input type="text" class="input--form" name="descripcion" id="descripcion">
                    </div>

                    <div class="input--group">
                        <label for="precio_u">Precio unitario</label>
                        <div class="icon--input">
                            <span>
                                <i class="fa-solid fa-dollar-sign"></i>
                            </span>
                            <input type="number" step="any" name="precio_u" id="precio_u" value="0">
                        </div>
                    </div>

                    <div class="input--group">
                        <label for="precio_p">Precio proveedor</label>
                        <div class="icon--input">
                            <span>
                                <i class="fa-solid fa-dollar-sign"></i>
                            </span>
                            <input type="number" step="any" name="precio_p" id="precio_p" value="0">
                        </div>
                    </div>
                    <div class="input--group">
                        <label for="categories">Categoría</label>
                        <select name="categoria" id="categoria" class="input--form">
                            <?php foreach ($categorias as $categoria) : ?>
                                <option value="<?= $categoria->id ?>"><?= $categoria->nombre ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="input--group--file">
                        <label for="imagen" class="file--custom">
                            <i class="fa-solid fa-upload"></i>
                            <span class="file--text">
                                Elije el archivo...
                            </span>
                        </label>
                        <input type="file" class="file--form" name="imagen" id="imagen" accept=".jpg, .jpeg, .png">
                    </div>
                    <div class="buttons">

                        <button type="button" class="button success" id="save"> <i class="fa-solid fa-paper-plane"></i> Guardar</button>
                    </div>
                </form>
            </div>

        </section>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="app/assets/js/alert.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const btn_save = document.querySelector("#save");
            read_file();
            btn_save.addEventListener("click", () => {
                valida_guarda();
            });
        })

        function valida_guarda() {
            // evento boton guardar
            if (!valida()) {
                // crea alerta  si la validacion falla
                const alerta = new MyAlert();
                alerta.text = "Completa los campos requerids (nombre, código)";
                alerta.type_a = "error";
                alerta.btn_text = "Cerrar"
                alerta.create__alert();
            } else {
                const alerta = new MyAlert();
                alerta.text = "Guardado";
                alerta.type_a = "success";
                alerta.btn_text = "Cerrar"
                alerta.create__alert();
                save();
            }
        }

        function read_file() {
            // lectura de archivos en input file
            let archivo = document.querySelector('.file--form');
            let file_text = document.querySelector('.file--text');
            archivo.addEventListener("change", function() {
                total = this.files.length;
                name = this.files[0].name;
                file_text.innerHTML = name;
            });

        }
        const save = async () => {
            // envio de datos por fetch
            let data = get_data();
            let url = "index.php?controller=product&action=post_save_product";
            try {
                let resp = await axios.post(url, data)
                console.log(response.data)
                document.querySelector("#new_product").reset();
                document.querySelector('.file--text').innerHTML = "Elije imagen...";
            } catch (error) {
                console.log("Mensaje error " + error)
                document.querySelector("#new_product").reset();
                document.querySelector('.file--text').innerHTML = "Elije imagen...";
            }
        }

        function get_data() {
            // creacion de formData
            let codigo = document.querySelector("#codigo");
            let nombre = document.querySelector("#nombre");
            let descripcion = document.querySelector("#descripcion");
            let precio_u = document.querySelector("#precio_u");
            let precio_p = document.querySelector("#precio_p");
            let imagen = document.querySelector("#imagen");
            let token = document.querySelector("#token");
            let categoria = document.querySelector("#categoria");
            let data = new FormData();
            data.append("codigo", codigo.value);
            data.append("nombre", nombre.value);
            data.append("descripcion", descripcion.value);
            data.append("precio_u", precio_u.value);
            data.append("precio_p", precio_p.value);
            data.append("imagen", imagen.files[0]);
            data.append("token", token.value);
            data.append("categoria", categoria.value);
            return data;
        }

        function valida() {
            // validacion sencilla por required
            let codigo = document.querySelector("#codigo");
            let nombre = document.querySelector("#nombre");
            if (!codigo.checkValidity() || !nombre.checkValidity()) {
                return false;
            } else {
                return true;
            }

        }
    </script>
</body>

</html>
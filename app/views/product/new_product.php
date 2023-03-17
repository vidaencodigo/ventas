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
    <link rel="stylesheet" href="app/assets/css/alert.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Montserrat', sans-serif;
        }

        :root {
            --purple-1: #712cf9;
        }

        body {
            font-weight: 500;
        }


        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
            padding: 1em;
        }

        .form {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        /**
        inputs */
        .input--group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .input--form {
            padding: 10px 15px;
            border-radius: 5px;
            border: solid 1px var(--purple-1);
            font-weight: 700;
        }


        .success {
            width: 100%;
        }

        .button {
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

        /** file input custom */
        .file--form {
            display: none;
        }

        .file--custom {
            cursor: pointer;
            color: var(--purple-1);

            border: solid 2px var(--purple-1);
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 15px;
            width: 100%;
            background-color: white;
            padding: 10px 15px;
            font-size: 20px;
            font-weight: bolder;
        }

        .file--custom i {
            font-size: 22px;
        }

        .file--text {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /** end custom file input */

        .formulario {
            padding: 10px;
            min-width: 40%;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
    </style>
</head>

<body>
    <div class="container c_alert">
        <section class="formulario">
            <h3>
                Registra nuevo producto
            </h3>
            <form id="new_product" class="form">
                <input type="hidden" id="token" value="<?php echo $_SESSION['token'] ?>">
                <div class="input--group">
                    <label for="codigo">Código</label>
                    <input type="text" class="input--form" name="codigo" id="codigo" required>
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
                    <input type="number" step="any" class="input--form" name="precio_u" id="precio_u" value="0">
                </div>

                <div class="input--group">
                    <label for="precio_p">Precio proveedor</label>
                    <input type="number" step="any" class="input--form" name="precio_p" id="precio_p" value="0">
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
        </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="app/assets/js/alert.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // lectura de archivos en input file
            let archivo = document.querySelector('.file--form');
            let file_text = document.querySelector('.file--text');
            archivo.addEventListener("change", function() {
                total = this.files.length;
                name = this.files[0].name;
                file_text.innerHTML = name;
            });

            document.querySelector("#save").addEventListener("click", () => {
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
            });
        })

        const save = async () => {
            // envio de datos por fetch
            let data = get_data();
            let url = "index.php?controller=product&action=post_save_product";
            try {
                let resp = await axios.post(url, data)
                console.log(response.data)
                document.querySelector("#new_product").reset();
            } catch (error) {
                console.log("Mensaje error " + error)
                document.querySelector("#new_product").reset();
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
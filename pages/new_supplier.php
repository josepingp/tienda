<section class="container-admin-form ">
<h2 id="container-admin-form-title">Registrar Nuevo Suministrador</h2>
        <form action="" class="admin_form" class="" enctype="multipart/form-data" method="POST">
            <section id="product-form-data">
                <h3 class="admin-form-t-s-d">Datos del Suministrador</h3>
                <label class="product-label" for="input_name">Nombre</label>
                <input class="product-input" type="text" name="product_name" id="input_name"
                    pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" required>

                    <label for="input-description">Descripción</label>
                    <textarea name="description" id="input-description" class="product-input textarea"></textarea>
                    <input type="submit" name="btn" class="btn-admin-form" value="registrar">
            </section>

            <section class="admin-form-photo">
                <h3 class="product-form-t-s">Logo</h3>
                <div id="photo-s-1-supp">
                    <div class="supp-photo-input">
                        <label>Logo del suministrador</label><br>
                        <div class="">
                            <input class="file-input" type="file" name="product_photo" accept=".jpg, .png, .jpeg">
                        </div>
                        <div class="product-photo-form">
                            <img src="./assets/img/productos/bandodiseño2-3.webp" alt="">
                        </div>
                    </div>
            </section>
        </form>
</section>
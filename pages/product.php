<section class="container-admin-form">
        <h2 id="container-admin-form-title">Registrar Nuevo producto</h2>
        <div class="form-rest"></div>
        <form action="" class="admin_form" class="" enctype="multipart/form-data" method="POST">
            <h3 class="admin-form-t-s-d">Datos de Producto</h3>
            <section id="product-form-data">
                <label class="product-label" for="input_code">Codigo</label>
                <input class="product-input" pattern="[a-zA-Z0-9/.-]{7,100}" type="text" name="product_code"
                    id="input_code" required>

                <label class="product-label" for="input_name">Nombre</label>
                <input class="product-input" type="text" name="name" id="input_name"
                    pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" required>

                <label class="product-label" for="input_price">Precio</label>
                <input type="text" class="product-input" pattern="[0-9.]{1,5}" name="price" id="input_price">

                <label class="product-label" for="input_stock">Unidades disponibles</label>
                <input type="text" class="product-input" pattern="[0-9]{1,5}" name="stock" id="input_stock">

                <label class="product-label" for="input_category">Categoria</label>
                <select name="category_id" id="input_category" class="select-product">
                    <option value="">selecciona una categoria</option>
                    <?php foreach($categories as $category): ?>
                    <option value="<?=$category['id'];?>"><?=$category['category_name'];?></option>
                <?php endforeach?>
                </select>

                <label for="input-supplier" class="product-label">Suministrador</label>
                <select name="supplier_id" id="input-supplier" class="select-product">
                    <option value="">Selecciona un suministrador</option>
                    <?php foreach($suppliers as $supplier): ?>
                    <option value="<?=$supplier['id'];?>"><?=$supplier['supplier_name'];?></option>
                    <?php endforeach?>
                </select>

                <label for="input-description">Descripción</label>
                <textarea name="description" id="input-description" class="product-input textarea"></textarea>

                <label for="input-outstanding">
                    Marcar si es un producto destacado
                    <input type="checkbox" name="is_outstanding" id="input-outstanding" class="product-input checkbox">
                </label>
                <input type="submit" name="btn" class="btn-admin-form" value="registrar">
            </section>


            <h3 class="product-form-t-s">Fotos de Producto</h3>
            <section class="admin-form-photo">
                <div id="photo-s-1">
                    <div class="product-photo-input">
                        <label>Foto o imagen del producto 1</label><br>
                        <div class="">
                            <input class="file-input" type="file" name="product_photo1" accept=".jpg, .png, .jpeg">
                        </div>
                    </div>
                    <div class="product-photo-form">
                        <img src="./assets/img/productos/bandodiseño2-3.webp" alt="">
                        <label for="main-photo1" class="admin-s-r">
                            <input type="radio" name="is_main" value="product_photo1" id="main-photo1">
                            Selecciona la foto principal
                        </label>
                    </div>
                    <label>Foto o imagen del producto 2</label><br>
                    <div class="admin-photo-input-file">
                        <input class="file-input" type="file" name="product_photo2" accept=".jpg, .png, .jpeg">
                    </div>
                    <div class="product-photo-form">
                        <img src="./assets/img/productos/bandodiseño2-3.webp" alt="">
                        <label for="main-photo2" class="admin-s-r">
                            <input type="radio" name="is_main" value="product_photo2" id="main-photo2">
                            Selecciona la foto principal
                        </label>
                    </div>
                </div>
                <div id="photo-s-2">
                    <div>
                        <label>Foto o imagen del producto 3</label><br>
                        <div class="">
                            <input class="file-input" type="file" name="product_photo3" accept=".jpg, .png, .jpeg">
                        </div>
                    </div>
                    <div class="product-photo-form">
                        <img src="./assets/img/productos/bandodiseño2-3.webp" alt="">
                        <label for="main-photo3" class="admin-s-r">
                            <input type="radio" name="is_main" value="product_photo3" id="main-photo3">
                            Selecciona la foto principal
                        </label>
                    </div>
                    <label>Foto o imagen del producto 4</label><br>
                    <div class="admin-photo-input-file">
                        <input class="file-input" type="file" name="product_photo4" accept=".jpg, .png, .jpeg">
                    </div>
                    <div class="product-photo-form">
                        <img src="./assets/img/productos/bandodiseño2-3.webp" alt="">
                        <label for="main-photo4" class="admin-s-r">
                            <input type="radio" name="is_main" value="product_photo4" id="main-photo4">
                            Selecciona la foto principal
                        </label>
                    </div>
                </div>
            </section>

        </form>
    </section>
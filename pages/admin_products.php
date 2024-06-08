
    <main class="container-admin-form">

        <h2 id="container-admin-form-title">Administrar Productos</h2>

        <section class="admin-controls-container">
            <article class="admin-search-container">
                <form action="" class="admin-search-form">
                    <label for="catgory-list" class="select-s-c">
                        <select name="category_id" id="category-list" class="admin-select-s">
                            <option value="">Seleccionar categoría</option>
                            <option value="">categoria</option>
                            <option value="">categoria</option>
                            <option value="">categoria</option>
                            <option value="">categoria</option>
                            <option value="">categoria</option>
                            <option value="">categoria</option>
                        </select>
                    </label>
                        <input type="text" name="product_search" class="input_name_search"
                        pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" required
                        placeholder="Introduzca nombre o código del producto">
                        <input type="submit" name="search" value="Buscar" class="admin-search-btn">
                </form>

            </article>
            <article class="admin-btns-container">
                <a href="">Añadir Producto</a>
                <a href="">Añadir Categoria</a>
                <a href="">Añadir Distribuidor</a>
            </article>
        </section>

        <section class="admin-list-container">
            <table class="admin-table">
                <thead class="admin-table-th">
                    <tr class="admin-table-th-tr">
                        <th class="admin-table-tdh">#</th>
                        <th class="admin-table-tdh">Foto Principal</th>
                        <th class="admin-table-tdh">Código</th>
                        <th class="admin-table-tdh">Nombre</th>
                        <th class="admin-table-tdh">Precio</th>
                        <th class="admin-table-tdh">Disponibles</th>
                        <th class="admin-table-tdh">Categoría</th>
                        <th class="admin-table-tdh">Distribuidor</th>
                        <th class="admin-table-tdh">Destacado</th>
                        <th class="admin-table-tdh">Editar</th>
                        <th class="admin-table-tdh">Eliminar</th>
                    </tr>
                </thead>
            </table>
        </section>
    </main>


<main class="container-admin-form">

    <h2 id="container-admin-form-title">Administrar Productos</h2>

    <section class="admin-controls-container">
        <article class="admin-search-container">
                <label for="catgory-list" class="select-s-c">
                    <select name="category_id" id="category-list" class="admin-select-s">
                        <option value="">Seleccionar categoría</option>
                        <?php
                        foreach ($categories as $category)
                            echo '<option value="' . $category['category_name'] . '">' . $category['category_name'] . '</option>';
                        ?>
                    </select>
                </label>
                <input type="text" name="search" class="input_name_search" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}"
                    required placeholder="Introduzca nombre o código del producto" id="search-input">
        </article>
        <article class="admin-btns-container">
            <a href="/proyecto/admin_products/new_product/">Añadir Producto</a>
            <a href="/proyecto/admin_products/new_category/">Añadir Categoria</a>
            <a href="/proyecto/admin_products/new_supplier/">Añadir Distribuidor</a>
        </article>
    </section>

    <section class="admin-list-container">
        <table class="admin-table">
            <thead class="admin-table-th">
                <tr class="admin-table-th-tr">
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
            <tbody class="admin-table-tb">
            </tbody>
        </table>
    </section>
</main>
<script>

    document.addEventListener('DOMContentLoaded', () => {
        const products = <?php echo json_encode($products, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
        const tbody = document.querySelector('.admin-table-tb');
        const search = document.querySelector('.input_name_search');
        const select = document.querySelector('#category-list');

        class List {
            constructor(products) {
                this.products = products
            }

            showProducts(table) {
                table.innerHTML = '';

                table.appendChild(this.createTable())
            };

            filterProducts() {
                let filter_name = search.value;
                let filter_category = select.value;
                let filteredProducts = this.products;

                if (filter_category != '') {
                    filteredProducts = filteredProducts.filter(element =>
                        element.category_name.toLowerCase().includes(filter_category.toLowerCase()));
                        console.log('hola');
                }
                if (filter_name != '') {
                    filteredProducts = filteredProducts.filter(element => 
                element.name.toLowerCase().includes(filter_name.toLowerCase()) || 
                element.product_code.toLowerCase().includes(filter_name.toLowerCase()));
                }

                return filteredProducts;
            }

            createTable() {
                let tb = document.createDocumentFragment();
                let data = this.filterProducts()
                data.forEach(element => {
                    let tr = document.createElement('tr');
                    for (let column in element) {
                        if (column != 'id') {
                            let td = document.createElement('td');
                            td.innerHTML = element[column];
                            tr.appendChild(td);
                        }
                    };
                    let edit = document.createElement('td');
                    let del = document.createElement('td');
                    edit.innerHTML = `<a href="/proyecto/admin_users/product/${element.id}">editar</a>`
                    del.innerHTML = `<a href="/proyecto/admin_users/product/${element.id}">borrar</a>`
                    tr.appendChild(edit);
                    tr.appendChild(del);
                    tb.appendChild(tr);
                })
                return tb;
            }
        }
        const list = new List(products);

        list.showProducts(tbody)

        search.addEventListener('change', () => {
            list.showProducts(tbody);
        })
        select.addEventListener('change', () => {
            list.showProducts(tbody);
        })
    })

</script>
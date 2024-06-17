<?php if (!isset($products))echo 'No hay ningun pproducto en la cesta'; ?>
<main id="cart">
        <h1 class="tittle">
            Carrito
        </h1>
        <table class="cart-list">
            <thead>
                <tr>
                    <th>C. de producto</th>
                    <th>Nombre del producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                if (isset($products)) {
                    foreach($products as $product) {
                        echo '<tr>
                        <td>'.$product['product_code'].'</td>
                        <td>'.$product['name'].'</td>
                        <td>1</td>
                        <td>'.$product['price'].'</td>
                        <td><img src="./assets/img/delete_24dp_FILL0_wght400_GRAD0_opsz24.svg" alt=""></td>
                        </tr>';
                    $total += (int) $product['price'];
                }
            }
                ?>
                <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><strong>Total: </strong></td>
                        <td><strong><?=$total?> €</strong></td>
                    </tr>
            </tbody>
        </table>
        <div class="cart-btns">
            <a href="" class="cart-btn">Continuar comprando</a>
            <a href="" class="cart-btn">Pasar a caja</a>
        </div>
    </main>
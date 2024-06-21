
<main id="checkout">
    <h1 class="tittle">Formulario de pago</h1>
    <section>
        <form action="" method="post" class="checkout-form">
            <fieldset id="checkout-u-d">
                <legend>Datos de facturacion</legend>

                <?php
                if (isset($user)) {
                    ?>
                    <p id="name"><?= $user->getFullName() ?></p>
                    <p id="email"><?= $_SESSION['email'] ?></p>
                    <?php
                } else {
                    ?>
                    <label for="nam">
                        <p>Nombre</p>
                        <input type="text" id="nam" name="name" pattern="[a-zA-Z ]{4,20}" required>
                    </label>

                    <label for="l-name1">
                        <p>Apellido 1</p>
                        <input type="text" id="l-name1" name="last_name1" pattern="[a-zA-Z ]{4,20}" required>
                    </label>

                    <label for="l-name2">
                        <p>Apellido 2</p>
                        <input type="text" id="l-name2" name="last_name2" pattern="[a-zA-Z ]{4,20}" required>
                    </label>

                    <label for="mail">
                        <p>Email</p>
                        <input type="email" id="mail" name="email" required>
                    </label>

                    <label for="birthdate">
                        <p>F.Nacimiento</p>
                        <input type="date" id="birthdate" name="birth_date" required>
                    </label>
                    <?php
                }
                if (isset($user) && $user->getPhone() != '') {
                    ?>
                    <p id="phone">Teléfono: 658780643</p>
                    <?php
                } else {
                    ?>
                    <!-- si no hay telefono button si no telefono e input type hidden -->
                    <label for="phone-number">
                        <p>Teléfono</p>
                        <input type="text" id="phone-number" name="phone" required>
                    </label>
                    <?php
                }
                ?>
            </fieldset>

            <?php
            if (isset($directions) && $directions != null) {

                ?>
                <select name="shipping_address_id" id="address">
                    <option value="">Elija una direccion de entrega</option>
                    <?php
                    foreach ($directions as $direction) {
                        echo '<option value="' . $direction['id'] . '">' . $direction['street'] . ' ' . $direction['number'] . '</option>';
                    }
                    ?>
                </select>
                <?php
            } else {
                ?>
                <!-- Si no hay direccion inputs -->
                <fieldset class="shipping_address">
                    <legend>Dirección de entrega</legend>
                    <label for="u-street">
                        <p>Calle</p>
                        <input type="text" name="street" id="u-street" required>
                    </label>
                    <div id="apartment-data">
                        <label for="u-number">
                            <p>Número</p>
                            <input type="text" name="shipping-number" id="u-number" required>
                        </label>

                        <label for="u-floor">
                            <p>Piso</p>
                            <input type="text" name="floor" id="u-floor" maxlength="3" required pattern="[0-9]{1,3}">
                        </label>

                        <label for="u-apartment">
                            <p>Letra</p>
                            <input type="text" name="apartment" id="u-apartment" required>
                        </label>
                    </div>

                    <label for="u-region">
                        <p>Provincia</p>
                        <input type="text" name="region" id="u-region" required>
                    </label>

                    <label for="u-city">
                        <p> Ciudad</p>
                        <input type="text" name="city" id="u-city" required>
                    </label>
                    <?php
                    if (isset($user)) {
                        echo '<div class="btns-container check">
                    <label for="dir-check"> Añadir direccion dirección como principal</label>
                            <input type="checkbox" class="direction-check" id="dir-check" name="main">
                        </div>';
                    }
                    echo '</fieldset>';
            }
            ?>

                <div id="pay-data">
                    <p id="total-price">Total del pedido: <?= $total ?>€</p>

                    <select name="payment_method" id="method">
                        <option value="">Elija un método de pago</option>
                        <?php foreach ($paymentMethods as $method): ?>
                            <option value="<?= $method['id'] ?>"><?= $method['method_name'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="btns-container">
                    <button class="back">Atras</button>
                    <button type="submit">Pagar</button>
                </div>
                
            </form>
    </section>
</main>

<script>
    const backBtn = document.querySelector('.back');

    backBtn.addEventListener('click', function() {
        window.history.back();
    })
</script>
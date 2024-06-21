<main id="product-detail">
    <section id="principal-image">
            <?php foreach ($photos as $photo) {
                if ($photo['is_main'] == 1){
                    echo'<img src="./repo/product/'.$photo['url'].'" alt="">';
                }
            }
            ?>
    </section>
    <section id="detail-imgs-aside">
    <?php foreach ($photos as $photo) {
                if ($photo['is_main'] == 0){
                    echo '<div class="aside-img-detail">
                            <img src="./repo/product/'.$photo['url'].'" alt="">
                        </div>';
                        }
            }
            ?>
    </section>
    <section id="product-details">
        <h2 id="detail-tittle"><?=$product['name']?></h2>
        <p id="detail-price"><?=$product['price']?>€</p>
        <p id="detail-description"><?=$product['description']?></p>
    </section>
    <button class="add-to-cart-btn p-l-c-btn" product_id="<?= $product['id']?>">Añadir al carrito</button>
</main>
<script>
    let button = document.querySelector('.add-to-cart-btn');
    button.addEventListener('click', function() {
                let productId = button.getAttribute('product_id');
                let cartCounter = document.querySelector('.cart-counter');

                let request = new XMLHttpRequest();
                request.open('POST', '/proyecto/products/detail/:id', true);
                request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                request.send('product_id=' + encodeURIComponent(productId));

                
                if (parseInt(cartCounter.innerHTML) > 0) {
                    cartCounter.innerHTML = parseInt(cartCounter.innerHTML) +1;
                } else {
                    cartCounter.innerHTML = 1;
                }

                
            });
        
</script>
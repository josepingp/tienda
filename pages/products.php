<main class="p-c">
    <section class="menu-products-c">
        <div class="menu-products">
            <button class="m-p-btn"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                    width="30px" fill="#3a1d0d">
                    <path
                        d="M120-240v-80h520v80H120Zm664-40L584-480l200-200 56 56-144 144 144 144-56 56ZM120-440v-80h400v80H120Zm0-200v-80h520v80H120Z" />
                </svg></button>
            <ul>
                <a href="/proyecto/products/1" class="m-p-link">
                    <li>Moda</li>
                </a>
                <a href="/proyecto/products/5" class="m-p-link">
                    <li>Accesorios</li>
                </a>
                <a href="/proyecto/products/3" class="m-p-link">
                    <li>Esterillas</li>
                </a>
                <a href="/proyecto/products/4" class="m-p-link">
                    <li>Mantas</li>
                </a>
                <a href="/proyecto/products/2" class="m-p-link">
                    <li>Zafus</li>
                </a>
                <a href="/proyecto/products/6" class="m-p-link">
                    <li>Meditación</li>
                </a>
            </ul>
        </div>
    </section>
    <h2 class="tittle-p-l"> <?= isset($category) ? $category : 'Productos'; ?></h2>
    <?php if (isset($products))
        echo '<section class="products-c-l">';
    foreach ($products as $product) {
        echo '<div class="p-l-card">
        <div class="p-l-c-imgs">';
        foreach ($product[0]['photos'] as $photo) {
            echo '<div class="p-l-c-img">
            <img src="./repo/product/' . $photo . '" alt="" width="500">
            </div>';
        }
        echo '</div>
        <div class="p-l-c-img-main">
        <img src="./repo/product/' . $product[0]['main_photo'] . '" alt="" width="300">
        </div>
        <a href="/proyecto/products/detail/'. $product[0]['id'] .'">
        <div class="p-l-c-data">
        <div class="p-l-c-d-name">
        <p>' . $product[0]['name'] . '</p>
        </div>
        <div class="p-l-c-d-price">
        <p>' . $product[0]['price'] . '</p>
        <p>€</p>
        </a>
        </div>
                    <button class="p-l-c-btn" product_id="'. $product[0]['id'] .'">Añadir al carrito</button>
                </div>
            </div>';
    }
    ?>
    </section>
</main>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const menuBtn = document.querySelector('.m-p-btn');
        const menu = document.querySelector('.menu-products-c');
        
        window.addEventListener('resize', handleResize);
        
        menuBtn.addEventListener('click', function () {
            menu.classList.toggle('active-p');
        })
        
        document.querySelectorAll('.p-l-c-btn').forEach(button => {
            button.addEventListener('click', function() {
                let productId = button.getAttribute('product_id');
                let cartCounter = document.querySelector('.cart-counter');

                let request = new XMLHttpRequest();
                request.open('POST', '/proyecto/products/:id', true);
                request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                request.send('product_id=' + encodeURIComponent(productId));

                
                if (parseInt(cartCounter.innerHTML) > 0) {
                    cartCounter.innerHTML = parseInt(cartCounter.innerHTML) +1;
                } else {
                    cartCounter.innerHTML = 1;
                }

                
            })         
        });
        
        
        
        
        
    function handleResize() {
        const windowWidth = window.innerWidth;
        if (windowWidth > 780) menu.classList.remove('active-p');
    }
    
    
    handleResize();
})
</script>
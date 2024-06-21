
<script> 
<?php
    require_once "./js/swiper-bundle.min.js";

    require_once "./js/ajax.js";
?>

//HEADER
    let iconMenu = document.querySelector('.menu-icon');
    let dropdowns = document.querySelectorAll('.dropdown-toggle');
    const loginContainer = document.querySelector('#login-container');
    const closeModal = document.querySelector('.close-modal');
    const headerLogin = document.querySelector('.icon-login-container');

    const swiper = new Swiper('.swiper', {
        loop: true,
        grabCursor: true,
        spaceBetween: 5,

        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            dynamicBullets: true,
        },

        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

        breakpoints: {
            500: {
                slidesPerView: 1,
            },
            750: {
                slidesPerView: 2,
            },
            1150: {
                slidesPerView: 3,
            },
            1450: {
                slidesPerView: 4,
            },

        }
    });


    closeModal.addEventListener('click', () => {
        loginContainer.classList.add('hidden');
    })

    headerLogin.addEventListener('click', () => {
        loginContainer.classList.toggle('hidden');
    })

    iconMenu.addEventListener('click', (e) => {
        e.preventDefault();
        iconMenu.classList.toggle('active');
    })

    dropdowns.forEach(dropdown => {
        dropdown.addEventListener('click', (e) => {
            e.preventDefault();
            dropdown.classList.toggle('active');
        })
    })

</script>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Tienda de artículos relacionados con la practica del yoga, el pilates y la meditacion">
    <meta name="keywords"
        content="yoga, pilates, salud, welthness, deporte, espiritual, mujer, aviles, gijon, oviedo, asturias">
    <meta name="author" content="Jose Luis García Pelayo">
    <title>Yogini Nana</title>
    <link rel="shortcut icon" href="./assets/img/favicon.ico" type="image/x-icon">
    <base href="/proyecto/">
    <link rel="stylesheet" href="./css/swiper-bundle.min.css">
    <link rel="stylesheet" href="./css/style2.css">
</head>

<body>
    <header>
        <section id="m-header">
            <nav id="m-nav">
                <a class="brand" href="/proyecto/">
                    <div class="nav-brand">
                        <img src="./assets/img/logo-sin-fondo.png" class="" alt="logo" width="50">
                        <p>YOGUINI NANA</p>
                    </div>
                </a>
                <div class="icon-menu-container">
                    <div href="#" class="icon-menu-responsive-link">
                        <svg class="menu-icon" id="menu-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"
                            class="menu-icon-svg">
                            <g fill="none" fill-rule="evenodd" stroke="#979797">
                                <path d="M13,26.5 L88,26.5" />
                                <path d="M13,50.5 L88,50.5" />
                                <path d="M13,50.5 L88,50.5" />
                                <path d="M13,74.5 L88,74.5" />
                            </g>
                        </svg>
                        <section id="nav-m-links">
                            <?php if (isset($user)) { ?>
                                <div id="user-login-container">

                                    <a href="/proyecto/my_account">
                                        <img id="m-user-login-img" src="<?php if (isset($user)) {
                                            if ($user->getPhoto() != '') {
                                                echo './repo/user/' . $user->getPhoto();
                                            } else {
                                                echo './assets/img/sinlog.png';
                                            }
                                        } else {
                                            echo './assets/img/sinlog.png';

                                        } ?>" alt="">
                                    </a>
                                </div>
                            <?php } ?>
                            <ul class="nav-m-items">
                                <li class="nav-m-item">
                                    <a href="/proyecto/" class="nav-m-link">Home</a>
                                </li>
                                <li class="nav-m-item-dropdown">
                                    <a href="/proyecto/products" class="nav-m-link dropdown-toggle">
                                        Productos
                                        <svg class="dropdown-arrow-down" xmlns="http://www.w3.org/2000/svg" width="20"
                                            height="20" viewBox="0 0 24 24">
                                            <path
                                                d="m9.55 12l7.35 7.35q.375.375.363.875t-.388.875t-.875.375t-.875-.375l-7.7-7.675q-.3-.3-.45-.675t-.15-.75t.15-.75t.45-.675l7.7-7.7q.375-.375.888-.363t.887.388t.375.875t-.375.875z" />
                                        </svg>
                                        <svg class="dropdown-arrow-up" xmlns="http://www.w3.org/2000/svg" width="20"
                                            height="20" viewBox="0 0 24 24">
                                            <path
                                                d="m9.55 12l7.35 7.35q.375.375.363.875t-.388.875t-.875.375t-.875-.375l-7.7-7.675q-.3-.3-.45-.675t-.15-.75t.15-.75t.45-.675l7.7-7.7q.375-.375.888-.363t.887.388t.375.875t-.375.875z" />
                                        </svg>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="/proyecto/products/1" class="dropdown-m-item">Moda</a></li>
                                        <li><a href="/proyecto/products/5" class="dropdown-m-item">Accesorios</a></li>
                                        <li><a href="/proyecto/products/3" class="dropdown-m-item">Esterillas</a></li>
                                        <li><a href="/proyecto/products/4" class="dropdown-m-item">Mantas</a></li>
                                        <li><a href="/proyecto/products/2" class="dropdown-m-item">Zafus</a></li>
                                        <li><a href="/proyecto/products/6" class="dropdown-m-item">Meditación</a></li>
                                    </ul>
                                </li>
                                <li class="nav-m-item">
                                    <a href="/proyecto/blog" class="nav-m-link">Blog</a>
                                </li>
                                <li class="nav-m-item">
                                    <a href="/proyecto/contact" class="nav-m-link">Contacto</a>
                                </li>
                                <?php if (!isset($user)) { ?>
                                    <li class="nav-m-item-dropdown">
                                        <a href="" class="nav-m-link dropdown-toggle">
                                            Sesion
                                            <svg class="dropdown-arrow-down" xmlns="http://www.w3.org/2000/svg" width="20"
                                                height="20" viewBox="0 0 24 24">
                                                <path
                                                    d="m9.55 12l7.35 7.35q.375.375.363.875t-.388.875t-.875.375t-.875-.375l-7.7-7.675q-.3-.3-.45-.675t-.15-.75t.15-.75t.45-.675l7.7-7.7q.375-.375.888-.363t.887.388t.375.875t-.375.875z" />
                                            </svg>
                                            <svg class="dropdown-arrow-up" xmlns="http://www.w3.org/2000/svg" width="20"
                                                height="20" viewBox="0 0 24 24">
                                                <path
                                                    d="m9.55 12l7.35 7.35q.375.375.363.875t-.388.875t-.875.375t-.875-.375l-7.7-7.675q-.3-.3-.45-.675t-.15-.75t.15-.75t.45-.675l7.7-7.7q.375-.375.888-.363t.887.388t.375.875t-.375.875z" />
                                            </svg>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <form action="/proyecto/" method="POST" class="login-form">
                                                    <label for="email" class="login-label">Email</label>
                                                    <input type="email" class="login-input" id="email" name="email"
                                                        required>
                                                    <label for="password" class="login-label">Contraseña</label>
                                                    <input type="password" class="login-input" id="password" name="pass"
                                                        pattern="[a-zA-Z0-9$@.-]{7,100}" required>
                                                    <div id="login-btns">
                                                        <input type="submit" class="login-button" value="Inicia sesion">
                                                        <a class="create-account" href="/proyecto/register/">Registrarse</a>
                                                    </div>
                                                </form>
                                            </li>
                                        </ul>
                                    </li>
                                <?php } ?>
                                <li class="nav-m-item">
                                    <a href="/proyecto/cart" class="nav-m-link">Carrito</a>
                                </li>
                                <?php
                                if ((isset($user) && $_SESSION['rol'] == 1) or (isset($user) && $_SESSION['rol'] == 4)) {
                                    ?>
                                    <li class="nav-m-item-dropdown">
                                        <a href="" class="nav-m-link dropdown-toggle">
                                            Administracion
                                            <svg class="dropdown-arrow-down" xmlns="http://www.w3.org/2000/svg" width="20"
                                                height="20" viewBox="0 0 24 24">
                                                <path
                                                    d="m9.55 12l7.35 7.35q.375.375.363.875t-.388.875t-.875.375t-.875-.375l-7.7-7.675q-.3-.3-.45-.675t-.15-.75t.15-.75t.45-.675l7.7-7.7q.375-.375.888-.363t.887.388t.375.875t-.375.875z" />
                                            </svg>
                                            <svg class="dropdown-arrow-up" xmlns="http://www.w3.org/2000/svg" width="20"
                                                height="20" viewBox="0 0 24 24">
                                                <path
                                                    d="m9.55 12l7.35 7.35q.375.375.363.875t-.388.875t-.875.375t-.875-.375l-7.7-7.675q-.3-.3-.45-.675t-.15-.75t.15-.75t.45-.675l7.7-7.7q.375-.375.888-.363t.887.388t.375.875t-.375.875z" />
                                            </svg>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="/proyecto/admin_users" class="dropdown-m-item">Usuarios</a></li>
                                            <li><a href="" class="dropdown-m-item">Productos</a></li>
                                        </ul>
                                    </li>
                                <?php } ?>
                                <li class="nav-m-item-dropdown social-media">
                                    <section class="social-media-icons">
                                        <div>
                                            <svg class="instagram-icon" height="30px" width="30px" version="1.1"
                                                id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 551.034 551.034"
                                                xml:space="preserve">
                                                <g id="XMLID_13_">

                                                    <linearGradient id="XMLID_2_" gradientUnits="userSpaceOnUse"
                                                        x1="275.517" y1="4.5714" x2="275.517" y2="549.7202"
                                                        gradientTransform="matrix(1 0 0 -1 0 554)">
                                                        <stop offset="0" style="stop-color:#E09B3D" />
                                                        <stop offset="0.3" style="stop-color:#C74C4D" />
                                                        <stop offset="0.6" style="stop-color:#C21975" />
                                                        <stop offset="1" style="stop-color:#7024C4" />
                                                    </linearGradient>
                                                    <path id="XMLID_17_" style="fill:url(#XMLID_2_);" d="M386.878,0H164.156C73.64,0,0,73.64,0,164.156v222.722
        c0,90.516,73.64,164.156,164.156,164.156h222.722c90.516,0,164.156-73.64,164.156-164.156V164.156
        C551.033,73.64,477.393,0,386.878,0z M495.6,386.878c0,60.045-48.677,108.722-108.722,108.722H164.156
        c-60.045,0-108.722-48.677-108.722-108.722V164.156c0-60.046,48.677-108.722,108.722-108.722h222.722
        c60.045,0,108.722,48.676,108.722,108.722L495.6,386.878L495.6,386.878z" />

                                                    <linearGradient id="XMLID_3_" gradientUnits="userSpaceOnUse"
                                                        x1="275.517" y1="4.5714" x2="275.517" y2="549.7202"
                                                        gradientTransform="matrix(1 0 0 -1 0 554)">
                                                        <stop offset="0" style="stop-color:#E09B3D" />
                                                        <stop offset="0.3" style="stop-color:#C74C4D" />
                                                        <stop offset="0.6" style="stop-color:#C21975" />
                                                        <stop offset="1" style="stop-color:#7024C4" />
                                                    </linearGradient>
                                                    <path id="XMLID_81_" style="fill:url(#XMLID_3_);" d="M275.517,133C196.933,133,133,196.933,133,275.516
        s63.933,142.517,142.517,142.517S418.034,354.1,418.034,275.516S354.101,133,275.517,133z M275.517,362.6
        c-48.095,0-87.083-38.988-87.083-87.083s38.989-87.083,87.083-87.083c48.095,0,87.083,38.988,87.083,87.083
        C362.6,323.611,323.611,362.6,275.517,362.6z" />

                                                    <linearGradient id="XMLID_4_" gradientUnits="userSpaceOnUse"
                                                        x1="418.306" y1="4.5714" x2="418.306" y2="549.7202"
                                                        gradientTransform="matrix(1 0 0 -1 0 554)">
                                                        <stop offset="0" style="stop-color:#E09B3D" />
                                                        <stop offset="0.3" style="stop-color:#C74C4D" />
                                                        <stop offset="0.6" style="stop-color:#C21975" />
                                                        <stop offset="1" style="stop-color:#7024C4" />
                                                    </linearGradient>
                                                    <circle id="XMLID_83_" style="fill:url(#XMLID_4_);" cx="418.306"
                                                        cy="134.072" r="34.149" />
                                                </g>
                                            </svg>
                                        </div>
                                        <div class="youtube-div">
                                            <svg class="youtube-icon" height="30px" width="50px" version="1.1"
                                                id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 461.001 461.001"
                                                xml:space="preserve">
                                                <g>
                                                    <path style="fill:#fe0000;"
                                                        d="M365.257,67.393H95.744C42.866,67.393,0,110.259,0,163.137v134.728
                                        c0,52.878,42.866,95.744,95.744,95.744h269.513c52.878,0,95.744-42.866,95.744-95.744V163.137
                                        C461.001,110.259,418.135,67.393,365.257,67.393z M300.506,237.056l-126.06,60.123c-3.359,1.602-7.239-0.847-7.239-4.568V168.607
                                        c0-3.774,3.982-6.22,7.348-4.514l126.06,63.881C304.363,229.873,304.298,235.248,300.506,237.056z" />
                                                </g>
                                            </svg>
                                        </div>
                                        <div>
                                            <svg height="30px" width="30px" version="1.1" id="Layer_1"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 408.788 408.788"
                                                xml:space="preserve">
                                                <path style="fill:#0866ff;" d="M353.701,0H55.087C24.665,0,0.002,24.662,0.002,55.085v298.616c0,30.423,24.662,55.085,55.085,55.085
    h147.275l0.251-146.078h-37.951c-4.932,0-8.935-3.988-8.954-8.92l-0.182-47.087c-0.019-4.959,3.996-8.989,8.955-8.989h37.882
    v-45.498c0-52.8,32.247-81.55,79.348-81.55h38.65c4.945,0,8.955,4.009,8.955,8.955v39.704c0,4.944-4.007,8.952-8.95,8.955
    l-23.719,0.011c-25.615,0-30.575,12.172-30.575,30.035v39.389h56.285c5.363,0,9.524,4.683,8.892,10.009l-5.581,47.087
    c-0.534,4.506-4.355,7.901-8.892,7.901h-50.453l-0.251,146.078h87.631c30.422,0,55.084-24.662,55.084-55.084V55.085
    C408.786,24.662,384.124,0,353.701,0z" />
                                            </svg>
                                        </div>
                                    </section>
                                    <p>Síguenos en nuestras redes sociales</p>
                                </li>
                            </ul>
                        </section>
                    </div>
            </nav>
        </section>

        <section id="d-header">
            <nav class="d-navbar">
                <a class="brand" href="/proyecto/">
                    <div class="nav-brand">
                        <img src="./assets/img/logo-sin-fondo.png" class="" alt="logo" width="50">
                        <p>YOGUINI NANA</p>
                    </div>
                </a>
                <section id="d-nav-principal-section">
                    <ul class="d-navbar-links">
                        <li class="d-navbar-link"><a href="/proyecto/">Home</a></li>
                        <li class="d-navbar-link drop">
                            <a class="nav-d-link dropdown-toggle" href="/proyecto/products">
                                Productos
                                <svg class="d-dropdown-arrow-down" xmlns="http://www.w3.org/2000/svg" width="20"
                                    height="20" viewBox="0 0 24 24">
                                    <path
                                        d="m9.55 12l7.35 7.35q.375.375.363.875t-.388.875t-.875.375t-.875-.375l-7.7-7.675q-.3-.3-.45-.675t-.15-.75t.15-.75t.45-.675l7.7-7.7q.375-.375.888-.363t.887.388t.375.875t-.375.875z" />
                                </svg>
                                <svg class="d-dropdown-arrow-up" xmlns="http://www.w3.org/2000/svg" width="20"
                                    height="20" viewBox="0 0 24 24">
                                    <path
                                        d="m9.55 12l7.35 7.35q.375.375.363.875t-.388.875t-.875.375t-.875-.375l-7.7-7.675q-.3-.3-.45-.675t-.15-.75t.15-.75t.45-.675l7.7-7.7q.375-.375.888-.363t.887.388t.375.875t-.375.875z" />
                                </svg>
                            </a>
                            <ul class="d dropdown-menu">
                                <li><a href="/proyecto/products/1" class="dropdown-d-item">Moda</a></li>
                                <li><a href="/proyecto/products/5" class="dropdown-d-item">Accesorios</a></li>
                                <li><a href="/proyecto/products/3" class="dropdown-d-item">Esterillas</a></li>
                                <li><a href="/proyecto/products/4" class="dropdown-d-item">Mantas</a></li>
                                <li><a href="/proyecto/products/2" class="dropdown-d-item">Zafus</a></li>
                                <li><a href="/proyecto/products/6" class="dropdown-d-item">Meditación</a></li>
                            </ul>
                        </li>
                        <li class="d-navbar-link"><a href="/proyecto/blog">Blog</a></li>
                        <li class="d-navbar-link"><a href="/proyecto/contact">Contacto</a></li>
                        <?php
                        if ((isset($user) && $_SESSION['rol'] == 1) or (isset($user) && $_SESSION['rol'] == 4)) {
                            ?>
                            <li class="d-navbar-link drop">
                                <a class="nav-d-link dropdown-toggle">
                                    Admin
                                    <svg class="d-dropdown-arrow-down" xmlns="http://www.w3.org/2000/svg" width="20"
                                        height="20" viewBox="0 0 24 24">
                                        <path
                                            d="m9.55 12l7.35 7.35q.375.375.363.875t-.388.875t-.875.375t-.875-.375l-7.7-7.675q-.3-.3-.45-.675t-.15-.75t.15-.75t.45-.675l7.7-7.7q.375-.375.888-.363t.887.388t.375.875t-.375.875z" />
                                    </svg>
                                    <svg class="d-dropdown-arrow-up" xmlns="http://www.w3.org/2000/svg" width="20"
                                        height="20" viewBox="0 0 24 24">
                                        <path
                                            d="m9.55 12l7.35 7.35q.375.375.363.875t-.388.875t-.875.375t-.875-.375l-7.7-7.675q-.3-.3-.45-.675t-.15-.75t.15-.75t.45-.675l7.7-7.7q.375-.375.888-.363t.887.388t.375.875t-.375.875z" />
                                    </svg>
                                </a>
                                <ul class="d dropdown-menu">
                                    <li><a href="/proyecto/admin_users" class="dropdown-d-item">Usuarios</a></li>
                                    <li><a href="/proyecto/admin_products" class="dropdown-d-item">Productos</a></li>
                                </ul>
                            </li>
                        <?php } ?>
                    </ul>
                </section>
            </nav>
            <nav class="d-navbar2">
                <section class="d-navbar2-container">
                    <article>
                        <a href="/proyecto/cart" class="cart-link"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon-shopping-cart">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M17 17h-11v-14h-2" />
                                <path d="M6 5l14 1l-1 7h-13" />
                            </svg></a>
                    </article>
                    <article class="icon-login-container">
                        <a class="login-link"><?php echo (isset($user)) ? $user->takeInitials() : 'login'; ?> <img src="<?php if (isset($user)) {
                                    if ($user->getPhoto() != '') {
                                        echo './repo/user/' . $user->getPhoto();
                                    } else {
                                        echo './assets/img/sinlog.png';
                                    }
                                } else {
                                    echo './assets/img/sinlog.png';

                                } ?>" alt="" class=" default-log-img"></a>
                    </article>
                </section>
            </nav>
            <section id="login-container" class="hidden">
                <button class="close-modal">X</button>
                <?php if (isset($user)) { ?>
                    <img id="user-login-img" src="<?php if (isset($user)) {
                        if ($user->getPhoto() != '') {
                            echo './repo/user/' . $user->getPhoto();
                        } else {
                            echo './assets/img/sinlog.png';
                        }
                    } else {
                        echo './assets/img/sinlog.png';

                    } ?>" alt="">
                    <p id="user-hi">Bienvenido <?= $_SESSION['name']; ?></p>
                    <a href="/proyecto/my_account" id="admin-account-btn">Administrar mi cuenta</a>
                    <form action="/proyecto/" class="login-form" method="POST">
                        <input id="close-session-btn" type="submit" value="Cerrar sesion" name="session_close">
                    </form>
                <?php } else { ?>
                    <form action="/proyecto/" class="login-form" method="POST">
                        <label for="email" class="login-label">Email</label>
                        <input type="email" class="login-input" name="email" id="email" required>
                        <label for="password" class="login-label">Contraseña</label>
                        <input type="password" class="login-input" id="password" pattern="[a-zA-Z0-9$@.-]{7,100}"
                            name="pass" required>
                        <div id="login-btns">
                            <input type="submit" class="login-button" value="Inicia sesion">
                            <a class="create-account" href="/proyecto/register/">Registrarse</a>
                        </div>
                    </form>
                <?php } ?>
            </section>
        </section>
    </header>
    <?php ?>
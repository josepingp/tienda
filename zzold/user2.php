<?php
var_dump($user);
$photo = $user->getPhoto();
echo $photo;
?>

<div class="container mb-5">
    <h1 class="title">Usuario</h1>
    <h2 class="subtitle">Modificar perfil</h2>
    <?php require_once "./inc/back_button.php"; ?>
</div>

<div class="d-flex justify-content-center aling-content-center w-100" ><?php if(isset($msg)) echo $msg;  ?></div>

<form action="" method="POST" class="container row-gap-3 ajax_form">
    <input type="hidden" name="id" value="<?= $user->getId();?> ">
<?php
    if ($photo != '') {
    echo "<img src='../../repo/user/$photo' alt=''>";
    }
    echo $user->getPhoto();
    ?>
    <div class="row px-3 mb-2">
        <div class="col">
            <label for="input_name">Nombre</label>
            <input type="text" name="name" id="input_name" value="<?= $user->getName(); ?>" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" class="form-control"
                aria-label="First name" required>
        </div>
        <div class="col">
            <label for="lname1">Primer apellido</label>
            <input type="text" name="last_name1" id="lname1" value="<?= $user->getLastName1(); ?>" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" class="form-control"
                aria-label="Last name" required>
        </div>
        <div class="col">
            <label for="lname2">Segundo apellido</label>
            <input type="text" name="last_name2" id="lname2" value="<?= $user->getLastName2(); ?>" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" class="form-control"
                aria-label="Last name">
        </div>

    </div>
    <div class="row px-3 mb-2">
        <div class="col">
            <label for="input-email">Email</label>
            <input type="email" name="email" id="input-email" value="<?= $user->getEmail(); ?>" aria-label="email" required class="form-control">
        </div>
        <div class="col-sm">
            <label for="input-date">Fecha de nacimiento</label>
            <input type="date" name="birth_date" id="input-date" value="<?= $user->getBirthDate(); ?>" aria-label="birth_date" required class="form-control">
        </div>
        <div class="col-sm">
            <label for="input-phone">Telefono</label>
            <input type="text" name="phone" id="input-phone" value="<?= $user->getPhone(); ?>" aria-label="birth_date" pattern="(\+34|0034|34)?[ -]*(6|7)[ -]*([0-9][ -]*){8}" class="form-control">
        </div>
    </div>
    <div class="row px-3 mb-2">
        <div class="col">
                <label for="inputPassword4">Nueva contraseña</label>
                <input type="text" name="new_pass" id="inputPassword4" class="form-control"
                    pattern="[a-zA-Z0-9$@.-]{7,100}" value="Rellenar solo si quiere cambiar la contraseña" maxlength="100" >
        </div>
        <div class="col">
            <label for="inputPassword4">Contraseña</label>
            <input type="password" name="pass1" id="inputPassword4" class="form-control"
            pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required>
        </div>
        <div class="col">
            <label for="inputPassword3">Repetir contraseña</label>
            <input type="password" name="pass2" id="inputPassword3" class="form-control"
                pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary w-25">Actualizar</button>
    </div>

</form>

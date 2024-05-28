<div class="container mb-5">
    <h1 class="title">Usuarios</h1>
    <h2 class="subtitle">Nuevo Usuario</h2>
    <?php require_once "./inc/back_button.php"; ?>
</div>

<div class="d-flex justify-content-center aling-content-center w-100" ><?php if(isset($msg)) echo $msg;  ?></div>


<form action="" method="POST" class="container row-gap-3 ajax_form">
    <div class="row px-3 mb-2">
        <div class="col">
            <label for="input_name">Nombre</label>
            <input type="text" name="name" id="input_name" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" class="form-control"
                aria-label="First name" required>
        </div>
        <div class="col">
            <label for="lname1">Primer apellido</label>
            <input type="text" name="last_name1" id="lname1" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" class="form-control"
                aria-label="Last name" required>
        </div>
        <div class="col">
            <label for="lname2">Segundo apellido</label>
            <input type="text" name="last_name2" id="lname2" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" class="form-control"
                aria-label="Last name">
        </div>
    </div>
    <div class="row px-3 mb-2">
        <div class="col">
            <label for="input-email">Email</label>
            <input type="email" name="email" id="input-email" aria-label="email" required class="form-control">
        </div>
        <div class="col-sm">
            <label for="input-date">Fecha de nacimiento</label>
            <input type="date" name="birth_date" id="input-date" aria-label="birth_date" required class="form-control">
        </div>
        <div class="col-sm">
            <label for="input-rol">Rol</label>
            <select name="role_id" id="input-rol" class="form-control">
                <option value="">elige un rol</option>
                <?php foreach ($roles as $role): ?>
                    <option value="<?= $role->getId(); ?>"><?= $role->getRoleName(); ?></option>
                <?php endforeach; ?>

            </select>
        </div>
    </div>
    <div class="row px-3 mb-2">
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
        <button type="submit" class="btn btn-primary w-25">Registrar</button>
    </div>

</form>
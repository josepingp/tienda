<div class="container text-center mt-4">


    <nav class="navbar bg-body-tertiary w-100">

        <form class="container-fluid" role="search">
        <div class="d-flex justify-content-center aling-content-center w-100" ><?php if(isset($msg)) echo $msg;  ?></div>
            <div class="d-flex w-100">
            

                <input class="form-control me-2 flex-grow-1" type="search" placeholder="Buscar Usuario"
                    aria-label="Search">
                <span>
                    <button class="btn btn-outline-success " type="submit">Buscar</button>
                </span>
            </div>
        
                <a class="btn btn-primary flex-grow-1 m-2" href="/proyecto/admin_users/new_user" role="button">Nuevo Usuario</a>
        </form>

    </nav>


    <table class="table table-hover table-striped ">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre completo</th>
                <th scope="col">Email</th>
                <th scope="col">F.nacimiento</th>
                <th scope="col">F.Registro</th>
                <th scope="col">Rol</th>
                <th scope="col">Pedidos</th>
                <th scope="col">Editar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $counter = 1;
            foreach ($users as $user):

                ?>

                <tr>
                    <th scope="row"><?= $counter ?></th>
                        <td><?= $user->getFullName()?></td>
                        <td><?= $user->getEmail() ?></td>
                        <td><?= $user->getBirthDate() ?></td>
                        <td><?= $user->getDateRegistered() ?></td>
                        <td><?= match ((int) $user->getRol()) {
                            1 => 'Admin',
                            2 => 'Customer',
                            3 => 'Guest',
                            4 => 'Manager',
                        }
                            ?></td>
                        <td>
                        <button type="button" class="btn btn-outline-primary btn-sm" style="--bs-btn-padding-y: .15rem;">
                            Pedidos
                        </button>
                        </td>
                        <td> <a href="/proyecto/admin_users/user/<?= $user->getId()?>" class=""><img src="./assets/img/pencil-square.svg" alt=""></a> </td>
                </tr>
                <?php
                $counter = $counter + 1;
            endforeach;
            ?>
        </tbody>
    </table>
</div>



<!-- ?php
foreach ($users as $user) {

    print_r($user);echo "<br>";
} -->
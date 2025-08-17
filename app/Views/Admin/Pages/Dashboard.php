<?=
$this->extend( 'Admin/Layouts/main' );

$this->section( 'content' );

?>

    <!-- Title -->
    <h1 class="modal-title text-center my-lg-2"><?= isset( $title ) ? esc( $title ) : "";?></h1>
    <!-- Title End -->

    <div class="container">
        <?php
        if ( session()->get( 'firstname' ) && session()->get( 'lastname' ) && session( 'email' ) && session( 'role' ) ):
            $firstname  =   session()->get( 'firstname' );
            $lastname   =   session()->get( 'lastname' );
            $email      =   session()->get( 'email' );
            $role       =   session()->get( 'role' );
        endif;

        switch ($role) {
            case 1:
                $role   =   'Admin';
                break;
            case 2:
                $role   =   'Guest';
                break;
            case 3:
                $role   =   'Pro';
                break;
        }

        ?>

        <h5 class="bg-info-subtle">Hello, <?= $firstname . " " . $lastname . " seu role is: " . $role;   ?></h5>


        <?php
        if ( $role  === 'Guest' ):

            echo "Vc só é um guest";

        else:
            ?>




            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                    <th scope="col">Actions</th>

                </tr>
                </thead>
                <tbody>
                <?php if( isset( $users ))
                    foreach ( $users as $user ):
                        ?>
                        <tr>
                            <th scope="row"><?= $user->id; ?></th>
                            <td><?= $user->firstname; ?></td>
                            <td><?= $user->lastname; ?></td>
                            <td><?= $user->email; ?></td>
                            <td><?= $user->created_at; ?></td>
                            <td><?= $user->updated_at; ?></td>
                            <td>
                                <a href="<?= site_url( '/edituser/'.$user->id.'' )?>" class="btn btn-sm btn-primary fa fa-edit d-inline">Edit</a>
                                <a href="<?= site_url( '/delete/'.$user->id.'' )?>" class="btn btn-sm btn-danger fa fa-trash d-inline">Delete</a>
                            </td>

                        </tr>
                    <?php
                    endforeach;
                ?>
                </tbody>
            </table>



        <?php
        endif;
        ?>


    </div>



<?php
$this->endSection();
<?=
$this->extend( 'Admin/Layouts/main' );

$this->section( 'content' );

/**
 * @author MiSCapu
 * @since 15.01.2024
 * Validations
 */
if ( isset( $validation ) ){
    $validation =   \Config\Services::validation();

    if ( $validation->hasError( 'firstnameFrm' ) )
    {
        $errorfirstnameFrm  =   $validation->getError( 'firstnameFrm' );
    }

    if ( $validation->hasError( 'lastnameFrm' ) )
    {
        $errorlastnameFrm  =   $validation->getError( 'lastnameFrm' );
    }

    if ( $validation->hasError( 'emailFrm' ) )
    {
        $erroremailFrm  =   $validation->getError( 'emailFrm' );
    }

    if ( $validation->hasError( 'pwdFrm' ) )
    {
        $errorpwdFrm  =   $validation->getError( 'pwdFrm' );
    }

    if ( $validation->hasError( 'cfpwdFrm' ) )
    {
        $errorcfpwdFrm  =   $validation->getError( 'cfpwdFrm' );
    }
}

/**
 * @author MiSCapu
 * @since 22.01.2024
 * Add data user for update MySQL
 */
if ( isset( $user ) )
{
    $firstName  =   $user->firstname;
    $lastname   =   $user->lastname;
    $email      =   $user->email;
}

?>

    <!-- Title -->
    <h1 class="modal-title text-center my-lg-2"><?= isset( $title ) ? esc( $title ) : "";?></h1>
    <!-- Title End -->

    <div class="container">
        <div class="row">
            <div class="col">

            </div>
            <div class="col">
                <form method="post">
                    <div class="mb-3">
                        <label for="firstnameFrm" class="form-label">First Name</label>
                        <input type="text" name="firstnameFrm" class="form-control" id="firstnameFrm" value="<?= isset( $firstName ) ? esc( $firstName ) : set_value( "firstnameFrm" );?>">
                        <?= isset( $errorfirstnameFrm ) ? "<div class='alert alert-danger' role='alert'>".$errorfirstnameFrm."</div>" : ""; ?>
                    </div>

                    <div class="mb-3">
                        <label for="lastnameFrm" class="form-label">Last Name</label>
                        <input type="text" name="lastnameFrm" class="form-control" id="lastnameFrm" value="<?= isset($lastname) ? esc($lastname) : set_value( "lastnameFrm" );?>">
                        <?= isset( $errorlastnameFrm ) ? "<div class='alert alert-danger' role='alert'>".$errorlastnameFrm."</div>" : ""; ?>
                    </div>


                    <div class="mb-3">
                        <label for="emailFrm" class="form-label">Email address</label>
                        <input type="email" name="emailFrm" class="form-control" id="emailFrm" value="<?= isset($email) ? esc($email) : set_value( "emailFrm" );?>">
                        <?= isset( $erroremailFrm ) ? "<div class='alert alert-danger' role='alert'>".$erroremailFrm."</div>" : ""; ?>
                    </div>
                    <div class="mb-3">
                            <label for="pwdFrm" class="form-label">Password</label>
                            <input type="password" name="pwdFrm" class="form-control" id="pwdFrm">
                            <?= isset( $errorpwdFrm ) ? "<div class='alert alert-danger' role='alert'>".$errorpwdFrm."</div>" : ""; ?>
                    </div>

                    <div class="mb-3">
                            <label for="cfpwdFrm" class="form-label">Confirm Password</label>
                            <input type="password" name="cfpwdFrm" class="form-control" id="cfpwdFrm">
                            <?= isset( $errorcfpwdFrm ) ? "<div class='alert alert-danger' role='alert'>".$errorcfpwdFrm."</div>" : ""; ?>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="col">

            </div>
        </div>
    </div>




<?php
$this->endSection();
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

    if ( $validation->hasError( 'emailFrm' ) )
    {
        $erroremailFrm  =   $validation->getError( 'emailFrm' );
    }

    if ( $validation->hasError( 'pwdFrm' ) )
    {
        $errorpwdFrm  =   $validation->getError( 'pwdFrm' );
    }
}

?>

    <!-- Title -->
    <h1 class="modal-title text-center my-lg-2"><?= isset( $title ) ? esc( $title ) : "";?></h1>
    <!-- Title End -->

<?php
if (session()->get( 'success' )): ?>
    <div class='alert alert-success' role='alert'>
        <?= session()->get( 'success' );?>
    </div>
<?php
else:
    echo "";
endif;
?>



    <div class="container">
        <div class="row">
            <div class="col">

            </div>
            <div class="col">
                <form method="post">
                    <div class="mb-3">
                        <label for="emailFrm" class="form-label">Email address</label>
                        <input type="email" name="emailFrm" class="form-control" id="emailFrm" value="<?= set_value( "emailFrm" );?>">
                        <?= isset( $erroremailFrm ) ? "<div class='alert alert-danger' role='alert'>".$erroremailFrm."</div>" : ""; ?>
                    </div>
                    <div class="mb-3">
                        <label for="pwdFrm" class="form-label">Password</label>
                        <input type="password" name="pwdFrm" class="form-control" id="pwdFrm">
                        <?= isset( $errorpwdFrm ) ? "<div class='alert alert-danger' role='alert'>".$errorpwdFrm."</div>" : ""; ?>
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
<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Dashboard extends BaseController
{
    public $userModel;

    public function __construct()
    {
        $this->userModel    =   new UserModel();
    }

    public function index()
    {
        $users  =   $this->userModel->asObject()->findAll();

        $data   =   [
            'title' =>  'Dashboard',
            'users' =>  $users
        ];

        $renderT    =   \Config\Services::renderer();
        return $renderT->setData( $data )->render( 'Admin/Pages/Dashboard' );
    }

    /**
     * @param $id
     * @return string
     */
    public function edit( $id )
    {
        helper( [ 'form' ] );

        $user =   $this->userModel->asObject()->find( $id );

        $data   =   [
            'title'     =>  'Edit User',
            'user'    =>  $user
        ];

        if ( $this->request->getMethod() == 'post' ){
            $userData   =   [
                'firstname'     =>  $this->request->getVar( 'firstnameFrm' ),
                'lastname'      =>  $this->request->getVar( 'lastnameFrm' ),
                'email'         =>  $this->request->getVar( 'emailFrm' )
            ];

            $this->userModel->update( $id, $userData );

            return redirect()->to( '/' );
        }

        $renderT    =   \Config\Services::renderer();

        return $renderT->setData( $data )->render( 'Admin/Pages/Form' );
    }


    public function delete( $id )
    {
        $this->userModel->where( 'id', $id );
        $this->userModel->delete();
        return redirect()->to( '/' );
    }
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    /**
     * @var userModel
     * @since 17.08.2025
     * @author MiSCapu
     */
    private $userModel;

    /**
     * UserController constructor.
     * @since 17.08.2025
     * @author MiSCapu
     */
    public function __construct()
    {
        $userModel  =   new UserModel();
    }


    /**
     * @return \CodeIgniter\HTTP\RedirectResponse|string
     * @since 17.08.2025
     * @author MiSCapu
     */
    public function index()
    {
        helper(['form']);

        $data   =   [
            'title' =>  'Login'
        ];

        if ( $this->request->getMethod() == "POST")
        {
            $rules  =   [
                'emailFrm'  =>  'required|min_length[3]|max_length[50]|valid_email',
                'pwdFrm'    =>  'required|min_length[3]|max_length[255]|validateUser[emailFrm,pwdFrm]'
            ];

            $messages   =   [
                'emailFrm'  =>  [
                    'required'      =>  'Please, enter your email',
                    'min_length'    =>  'Please, enter an email with low characters',
                    'max_length'    =>  'Please, enter an email with more characters',
                    'valid_email'   =>  'Please, enter valid email'
                ],

                'pwdFrm'  =>  [
                    'required'      =>  'Please, enter your password',
                    'min_length'    =>  'Please, enter an password with low characters',
                    'max_length'    =>  'Please, enter an password with more characters',
                    'validateUser'  =>  'User or password wrong'
                ],
            ];

            if ( !$this->validate( $rules, $messages ) )
            {
                $data['validation'] =   $this->validator;
            }else
                {
                    $user   =   $this->userModel->where( 'email', $this->request->getPost('emailFrm') )->first();
                    $this->setUserSession($user);
                    return redirect()->to('dashboard');
                }
        }

        $renderT    =   \Config\Services::renderer();

        return $renderT->setData( $data )->render( 'Admin/Pages/Login' );

    }


    private function setUserSession($user)
    {
        $data   =   [
            'id'    =>  $user['id'],
            'firstname'     =>  $user['firstname'],
            'lastname'      =>  $user['lastname'],
            'email'         =>  $user['email'],
            'role'          =>  $user['role'],
            'isLoggedIn'    =>  true
        ];

        session()->set( $data );
        return true;
    }


    /**
     * @return \CodeIgniter\HTTP\RedirectResponse|string
     * @throws \ReflectionException
     * @since 17.08.2025
     * @author MiSCapu
     */
    public function registerUSer()
    {
        helper(['form']);

        $data   =   [
            'title'     =>  'Register User'
        ];

        if ( $this->request->getMethod() == 'POST' )
        {
            $rules  =   [
                'firstnameFrm'      =>  'required|min_length[3]|max_length[50]',
                'lastnameFrm'       =>  'required|min_length[3]|max_length[80]',
                'emailFrm'          =>  'required|min_length[3],max_length[80]|valid_email|is_unique[users.email]',
                'pwdFrm'            =>  'required|min_length[3]|max_length[255]',
                'cfpwdFrm'          =>  'matches[pwdFrm]'
            ];

            $messages   =   [
                'firstnameFrm'      =>  [
                    'required'      =>  'Please, insert your first name',
                    'min_length'    =>  'Please, min length is 3',
                    'max_length'    =>  'Please, max length is 50',
                ],

                'lastnameFrm'      =>  [
                    'required'      =>  'Please, insert your last name',
                    'min_length'    =>  'Please, min length is 3',
                    'max_length'    =>  'Please, max length is 80',
                ],

                'emailFrm'      =>  [
                    'required'      =>  'Please, insert your email',
                    'min_length'    =>  'Please, min length is 3',
                    'max_length'    =>  'Please, max length is 50',
                    'valid_email'   =>  'Please, insert an email valid',
                    'is_unique'     =>  'Please, email is already!'
                ],

                'pwdFrm'      =>  [
                    'required'      =>  'Please, insert your password',
                    'min_length'    =>  'Please, min length is 3',
                    'max_length'    =>  'Please, max length is 255',
                ],

                'cfpwdFrm'      =>  [
                    'matches'      =>  'Please, password dont matches!',
                ],
            ];

            if ( !$this->validate( $rules, $messages ) )
            {
                $data['validation'] =   $this->validator;
            }else
                {
                    $newData    =       [
                        'firstname'         =>  $this->request->getVar('firstnameFrm'),
                        'lastnameFrm'       =>  $this->request->getVar('lastnameFrm'),
                        'email'             =>  $this->request->getVar('email'),
                        'pwdFrm'            =>  $this->request->getVar('pwdFrm'),
                    ];

                    $this->userModel->save($newData);
                    $session    =   session();
                    $session->setFlashdata('success', 'Successful Registration');

                    return redirect()->to('/');
                }
        }

        $renderT    =   \Config\Services::renderer();
        return $renderT->setData($data)->render( 'Admin/Pages/Form' );
    }


    /**
     * @return \CodeIgniter\HTTP\RedirectResponse
     * @since 17.08.2025
     * @author MiSCapu
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }

}

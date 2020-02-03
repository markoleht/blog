<?php


class Users extends Controller
{

    /**
     * Users constructor.
     */
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function register(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
//      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); // to do
            $data = array(
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => $_POST['password'],
                'confirm_password' => $_POST['confirm_password'],
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            );
            if(empty($data['name'])){
                $data['name_err'] = 'Please enter the name';
            }

            if(empty($data['email'])){
                $data['email_err'] = 'Please enter the email';
            } else if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                $data['email_err'] = 'Please enter the valid email';
            }

            else if($this->userModel->findUserByEmail($data['email'])){
                $data ['email_err'] = 'email is already taken';
            }

            if(empty($data['password'])){
                $data['password_err'] = 'Please enter the password';
            } else if(strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must consist at least from 6 characters';
            }

            if(empty($data['confirm_password'])){
                $data['confirm_password_err'] = 'Please enter the confirm password';
            } else if(strlen($data['confirm_password']) < 6) {
                $data['confirm_password_err'] = 'Password must consist at least from 6 characters';
            } else if($data['password'] !== $data['confirm_password']){
                $data['confirm_password_err'] = 'Passwords do not match';
            }

            if(empty($data['name_err']) and empty($data['email_err']) and empty($data['password_err']) and empty($data['confirm_password_err'])){
                echo 'ok';
            }
            if(empty($data['name_err']) and empty($data['email_err']) and empty($data['password_err']) and empty($data['confirm_password_err'])){
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                if($this->userModel->register($data)){
                    header('Location: '.URLROOT.'/'.'users/login');
                } else {
                    die('Something went wrong');
                }
            }
        } else {
            $data = array(
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            );
        }

        $this->view('users/register', $data);
    }
}




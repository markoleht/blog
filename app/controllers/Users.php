
<?php


class Users extends Controller
{

    /**
     * Users constructor.
     */
    public function __construct()
    {
        $usersModel = $this->model('User');
    }

    public function register(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = $array(
                'name'=> trim($_POST['name']),
            'email'=>trim($_POST['email']),
            'password' =>trim($_POST['password']),
            'confirm_password'=>trim($_POST['confirm_password']),
            'name_err' =>'',
            'email_err' =>'',
            'password_err' =>'',
            'password_confirm_err' =>''
            );

        } else {
            $this->view('users/register');
        }
    }
}
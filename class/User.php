<?php
/**
 * Created by PhpStorm.
 * User: jpb
 * Date: 15/02/19
 * Time: 13:44
 */




class User
{
    private $_db = null;

    public function __construct($instance) {

        $this->_db = $instance;

    }

    public function Auth($login,$password){

        $req = $this->_db->prepare('SELECT * FROM User WHERE Pseudo = ?');
        $req->execute([$login]);
        $user = $req->fetch();
        if (!empty($user)){
            try {
                // on compare le password en base avec le post
                if (password_verify($password,$user->password)){
                    return  "match !";
                    $_SESSION['auth'] = $user;
                }else{
                    return "not match !";
                }
            }catch (\Exception $e) {

            }
        }

        return "not match !";

    }



}
<?php

include('class.password.php');

class User extends Password {

    private $db;

    function __construct($db) {
        parent::__construct();

        $this->_db = $db;
    }

//check if user is logged in
    public function is_logged_in() {
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            return true;
        }
    }

//get hashed password from database
    private function get_user_hash($username) {

        try {

            $stmt = $this->_db->prepare('SELECT password FROM blog_members WHERE username = :username');
            $stmt->execute(array('username' => $username));

            $row = $stmt->fetch();
            return $row['password'];
        } catch (PDOException $e) {
            echo '<p class="error">' . $e->getMessage() . '</p>';
        }
    }

//expects username & password; session is set if matches
    public function login($username, $password) {

        $hashed = $this->get_user_hash($username);

        if ($this->password_verify($password, $hashed) == 1) {

            $_SESSION['loggedin'] = true;
            return true;
        }
    }

    public function logout() {
        session_destroy();
    }

}

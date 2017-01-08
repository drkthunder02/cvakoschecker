<?php
    $session = new Custom\Sessions\sessions();

/*
 * file name : login.class.php
 * class name : login
 * pupose: for login module, database connectibity, query execution and fetch data from database
 * author : saeed ahmed
 * contact email: saeed.sas@gmail.com
 * website: http://saeed05.wordpress.com
 * License : GPL http://www.gnu.org/licenses/gpl.html
 */

class Login{

    private $connect;
    private $result_to;
    private $data;
    
    public $dbresponse;

    public $response;


    public function __construct($dbhost = 'localhost', $dbuser = 'koschecker', $dbpass = 'password', $dbname = 'koschecker'){

        $this->connect = new \Simplon\Mysql\Mysql(
            $dbhost,
            $dbuser,
            $dbpass,
            $dbname
        );

    }


    public function  __destruct() {
        $this->connect->close();
    }


    public function login_user($username, $password, $head = 'securearea.php') {
        
        $username = mysql_real_escape_string($username);
        $password = mysql_real_escape_string($password);
        $session = new Custom\Sessions\sessions();

        $password = md5($password);
        
        $result = $this->connect->fetchColumnMany('SELECT username, password FROM users WHERE username= :user AND password= :pass LIMIT 1', array('user' => $username, 'pass' => $password));
        $this->data = $result;

        if(!$this->data){
            return 'Please enter correct username and password';
        }else{
            $_SESSION['username'] = $this->data['username'];
            $_SESSION['permission'] = 'yes';
            $location = 'location: ' . $head;
            header($location);
        }

    }

    public function logout(){
        session_destroy();
        return 'you are now logged out';

    }

    public function session_check() {
                echo $_SESSION['username'];
		if($_SESSION['permission'] != 'yes') {
                    return 'you have no permission to see this page';                   
                }else{
                    return 'you are now logged in';
                }
    }
    
    public function authenticated() {
        if($_SESSION['permission'] === 'yes') {
            return true;
        } else {
            return false;
        }
    }
}

?>

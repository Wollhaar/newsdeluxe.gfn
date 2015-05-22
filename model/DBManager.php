<?

class DBManager {

    private $connection;
    
    public function __construct() {
        $this->init();
        
    }

    private function init() {
        $dsn = 'mysql:host=localhost;dbname=newsdeluxe_login';
        $username = 'root';
        $passwd = '';
        $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );
        
        try {
            $this->connection = new PDO($dsn, $username, $passwd, $options);
        } catch (Exception $ex) {
            if(DEBUG_MODE){
                echo '<pre>';
                print_r($ex->getMessage());
                echo '</pre>';
            }
            
            die('Kein Zugriff auf Datenbank möglich!');
        }
    }
    
    public function getConnection() {
        return $this->connection;
    }

}

<?php 
class Database
{
  /* uses passed object from config.php */
    protected $conn = null;
    
    public function __construct($db)
    {
        $this->conn = new mysqli($db->host, $db->username, $db->password, $db->database);
        $this->conn->set_charset('utf8');
    }
}



/* $conn = mysqli_connect('localhost', 'root', '', 'scandi');
if (!$conn) {
  die("database connection failed.");
} else {
  //echo "connected";
} */
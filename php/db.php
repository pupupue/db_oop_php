<?php 
class Database
{
    protected $conn = null;
    protected $error = 'Testi pašlaik nav pieejami';

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
<?php 
class Database
{
  /* uses passed constants from config.php */
  public $conn = null;
  
  public function __construct()
  {
    $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $this->conn->set_charset('utf8');
    if ($this->conn->connect_errno) {
      die("db connection failed".$this->conn->connect_errno);
    }
  }

  public function query($sql)
  {
    $result = $this->conn->query($sql);
    $this->confirm_query($result);
    return $result;
  }

  private function confirm_query($result)
  {
    if(!$result){
        die("Query failed".$this->conn->error);
    }
  }
// escaping string
  public function escape_string($string)
  {
    $esc_string = $this->conn->real_escape_string($string);
    return $esc_string;
  }
// get the last created id 
  public function getCreatedId()
  {
      return mysqli_insert_id($this->conn);
  }

}

$db = new Database();

/* $conn = mysqli_connect('localhost', 'root', '', 'scandi');
if (!$conn) {
  die("database connection failed.");
} else {
  //echo "connected";
} */
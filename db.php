<?php
class Database {

public $db_host = "localhost";
public $db_name = "test";
public $db_user = "root";
public $db_pw = "";
public $connection = '';
public function connect() {
//the @ sign will remove any warnings from mysqli!
$this->connection = @mysqli_connect($this->db_host,$this->db_user,$this->db_pw,$this->db_name);

}
public function read($table, $fields='*', $join='',$where='',$orderby='') {
$this->connect();
$fields = is_array($fields) ? implode(", ", $fields) : $fields;
$join = is_array($join) ? implode(" ", $join) : $join;
$sql = "SELECT ".$fields." FROM ".$table." ".$join." ".$where." ".$orderby." ;";
 //echo $sql; //only for testing
$result = $this->connection->query($sql);
$return = $result->fetch_all(MYSQLI_ASSOC);
mysqli_close($this->connection);
return $return;
}

public function update($table,$set,$condition) {
$this->connect();
$sql = '';
$where= '';
foreach ($set as $key => $value) {
// $sql = first_name = 'serri', last_name = ghiath
if($sql != ''){
  $sql .=", ";
 }
$sql .= $key . "='".$value."' ";
}
foreach ($condition as $key => $value) {
if($where != ''){
  $where .=" AND ";
 }
 $where .= $key . "='" . $value . "'";
 }
$sql = "UPDATE ".$table." SET ".$sql." WHERE ".$where.";";
$this->connection->query($sql);
mysqli_close($this->connection);
}
public function insert($table, $fields, $values) {
$this->connect();
$fields = is_array($fields) ? implode(", ", $fields) : $fields;
//$values = implode("','", $values);
$sql = '';
if (is_array($values)){
foreach ($values as $value) {
if ($sql !=''){
$sql .=", ";
}
$sql .= "'".mysqli_real_escape_string($this->connection,$value)."'";
}
} else {
$sql = $values;
}

$sql = "INSERT INTO ".$table." (".$fields.") VALUES (".$sql.");";
$res = $this->connection->query($sql);
mysqli_close($this->connection);
}
public function delete($table,$condition) {
$this->connect();
$sql='';
foreach ($condition as $key => $value) {
if($sql != ''){
  $sql .=" AND ";
 }
 $sql .= $key . "='" . $value . "'";
 }
$sql="DELETE FROM ".$table." WHERE ".$sql;
$result = $this->connection->query($sql);
mysqli_close($this->connection);
}
}
$obj = new Database ();
 ?>
<?php
class ConnectDb{
    public function Connect($sql){
    $dbms='mysql';
    $dbname='wts';
    $user='root';
    $password="12345678";
    $host="8.136.232.136";
    $dsn="$dbms:host=$host;dbname=$dbname";
    $pdo=new PDO($dsn,$user,$password);
    $pdo->exec("SET NAMES 'utf8';"); 
    $result=$pdo->prepare($sql);
    $result->execute();
    return $result;
      }
	}
?>
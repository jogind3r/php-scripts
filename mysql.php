<?php
class Db {
///////////////////////////////////class vars////////////////////////////////////////////
  public  static $connection;
  private $config= array('username'=>"root",'password'=>"123",'dbname'=>"mydb");
  public  $x=0;
/////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////member func////////////////////////////////////////
  public function connect() {
    if(!isset(self::$connection)){
      self::$connection = new mysqli('localhost',$this->config['username'],$this->config['password'],$this->config['dbname']);
    }
    if(self::$connection === false) {
      print 'connection error';
      return false;
    }
    return self::$connection;
  }


  public function query($query) {  return  $this -> connect()-> query($query);    }
///////////////////////////////////////////////////////////////////////////////////////////////
  public function select($n,$query) {
    $r=array();
    $result = $this -> query($query);
    if(!$result){return 0;}

    if (in_array("1match",$n)) {
      if(is_object($result)){(($result -> num_rows)=="1")? $r['1match']=1:$r['1match']=0;}
    }


    if(in_array("num",$n)){
      if(is_object($result))$r['num']=$result -> num_rows;
    }

    if(in_array("lastid",$n)){
      $r['lastid']=$this->connect() -> insert_id;
    }

    if(in_array("rows",$n)){
      while ($row = $result -> fetch_assoc()) {
        $rows[] = $row;
      }
      $r['rows']=$rows;
    }

    if(in_array("row",$n)){
      $r['row']= $result -> fetch_assoc();
    }

    return $r;
  }
/////////////////////////////////////////////////////////////////////////////////////////////////

  public function error() {
    $connection = $this -> connect();
    return $connection -> error;
  }
///////////////////////////////////////////////////////////////////////////////////////////////
  public function serror() {
    $connection = $this -> connect();
    if(!$connection){
      return 0;
    }
    else{
      return 1;
    }
  }
///////////////////////////////////////////////////////////////////////////////////////////////

  public function quote($value) {
    return "'" . $this -> connect() -> real_escape_string($value) . "'";
  }
///////////////////////////////////////////////////////////////////////////////////////////////
}
////////////////////////////////////////end of class///////////////////////////////////////////

// $qry="INSERT INTO `users` (`user_id`, `username`, `email`, `password`) VALUES (NULL, 'cat', 'cat@cathsstdtgthouse.com', 'cacat');";
// $qry="select * from `users` ";
// $db = new Db();
// $res = $db -> select(['num','lastid','rows'],$qry);

// print_r($res);
// if(!$res){print $db->error();}
?>

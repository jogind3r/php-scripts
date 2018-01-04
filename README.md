# php-mysql helper script - mysql.php
A simple php-mysql script that makes it easy to work with database and provides simple functions to work with.
Just include it, update the config credentials and you are good to go
```sh
$qry="INSERT INTO `users` (`user_id`, `username`, `email`, `password`) VALUES (NULL, 'cat', 'cat@cathsstdtgthouse.com', 'cacat');";
//or
$qry="select * from `users` ";
$db = new Db();
$res = $db -> select(['num','lastid','rows'],$qry);
print_r($res);
if(!$res){print $db->error();}
```
License
----

MIT

 

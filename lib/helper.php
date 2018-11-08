<?php

/**
 * conecta_db
 * @param string $host,$user,$pass,$db
 * @return int Connection
 */

   function connect_db($host,$user,$passwd,$db){
       return mysqli_connect($host,$user,$passwd,$db);
   }

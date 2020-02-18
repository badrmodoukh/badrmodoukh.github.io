<?php
/*BTI320B
Badr Modoukh
Tuesday Oct. 14 2014

Student Declaration

I/we declare that the attached assignment is my/our own work in accordance with Seneca Academic Policy. No part of this assignment has been copied manually or electronically from any other source (including web sites) or distributed to other students.

Name Badr Modoukh

Student ID 062112123
*/
//include function library 
include('a1.lib');
$val_n = "n";
$val_y = "y";
//store id sent into variable
$rec_id = $_GET['id'];  
//connect to mysql 
$link = connect_to_sql();
//if deleted value is y change value to n
if ($_GET['deleted'] == "y")
{
   //sql query to update deleted value
   $sql_query = 'UPDATE inventory
                 SET deleted = "' . $val_n . '"
	         WHERE id = "' . $rec_id . '"';
   //run sql query
   $result = mysqli_query($link, $sql_query) or die('query failed'. mysqli_error($link));	 
   //redirect to view.php and terminate
   header("Location: view.php");
   exit();
}
//if deleted value is n change value to y
if ($_GET['deleted'] == "n")
{
   //sql query to update deleted value
   $sql_query = 'UPDATE inventory 
	     	 SET deleted = "' . $val_y . '" 
	         WHERE id = "' . $rec_id . '"';
   //run sql query
   $result = mysqli_query($link, $sql_query) or die('query failed'. mysqli_error($link));
   //redirect to view.php and terminate
   header("Location: view.php");
   exit();
}
?>

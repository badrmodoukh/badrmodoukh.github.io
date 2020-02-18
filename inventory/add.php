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
$onbackorder = "n"; //if onbackorder is not checked display n
$itemNameErr = "";
$descriptionErr = "";
$supplierCodeErr = "";
$costErr = "";
$sellingpriceErr = "";
$numberonhandErr = "";
$reorderpointErr = "";
$errMess = true;

if($_POST) 
{
   //validate item name
   if ($_POST['itemName'] == "")
   {
      $itemNameErr = "Error - you must enter an Item Name";
      $errMess = false;
   }
   else
   {
      //remove leading and trailing blanks
      $_POST['itemName'] = trim($_POST['itemName']);
      if (!preg_match('/^[a-zA-Z0-9 ]+[ :;\-,\'a-zA-Z0-9]*$/', $_POST['itemName']))
      {
         $itemNameErr = "Must be upper/lower case letters or digits and may contain (:;-,')";
	 $errMess = false;
      }
   }
   //validate description	
   if ($_POST['description'] == "")
   {
      $descriptionErr = "Error - you must enter a Description";
      $errMess = false;
   }
   else
   {
      $_POST['description'] = trim($_POST['description']);
      if (!preg_match('/^[a-zA-Z0-9 ]+[ .,\-\'a-zA-Z0-9]*$/m', $_POST['description']))
      {
         $descriptionErr = "Must be upper/lower case letters or digits and may contain (.,'-)";
	 $errMess = false;
      }
   }
   //validate suppliercode
   if ($_POST['supplierCode'] == "")
   {
      $supplierCodeErr = "Error - you must enter a Supplier Code";
      $errMess = false;
   }
   else
   {
      $_POST['supplierCode'] = trim($_POST['supplierCode']);
      if (!preg_match('/^[A-Z]{3}[0-9]{3,}$/', $_POST['supplierCode']))
      {
         $supplierCodeErr = "Supplier code must begin with three upper-case letters followed by 3 or more digits";
	 $errMess = false;
      }
   }
   //validate cost
   if ($_POST['cost'] == "")
   {
      $costErr = "Error - you must enter the cost";
      $errMess = false;
   }
   else
   {
      $_POST['cost'] = trim($_POST['cost']);
      if (!preg_match('/^[0-9]+\.[0-9]{2}$/', $_POST['cost']))
      {
         $costErr = "Cost should be in dollar amounts, with one or more digits, followed by a decimal point, followed by exactly two digits";
	 $errMess = false;
      }
   }
   //validate selling price
   if ($_POST['sellingprice'] == "")
   {
      $sellingpriceErr = "Error - you must enter the Selling Price";
      $errMess = false;
   }
   else
   {
      $_POST['sellingprice'] = trim($_POST['sellingprice']);
      if (!preg_match('/^[0-9]+\.[0-9]{2}$/', $_POST['sellingprice']))
      {
         $sellingpriceErr = "Selling price should be in dollar amounts, with one or more digits, followed by a decimal point, followed by exactly two digits";
	 $errMess = false;
      }
   }
   //validate number on hand
   if ($_POST['numberonhand'] == "")
   {
      $numberonhandErr = "Error - you must enter Number on Hand";
      $errMess = false;
   }
   else
   {
      $_POST['numberonhand'] = trim($_POST['numberonhand']);
      if (!preg_match('/^[0-9]+$/', $_POST['numberonhand']))
      {
         $numberonhandErr = "Number on hand should be one or more digits";
	 $errMess = false;
      }
   }
   //validate reorder point
   if ($_POST['reorderpoint'] == "")
   {
      $reorderpointErr = "Error - you must enter Reorder Point";
      $errMess = false;
   }		
   else
   {
      $_POST['reorderpoint'] = trim($_POST['reorderpoint']);
      if (!preg_match('/^[0-9]+$/', $_POST['reorderpoint']))
      {
         $reorderpointErr = "Reorder Point should be one or more digits";
	 $errMess = false;
      }
   }
   //check if on back order is checked
   if (isset($_POST['onbackorder']))
   {	
      $onbackorder = $_POST["onbackorder"];
      //if back order is not n than assign y
      if ($onbackorder != 'n')
      {
         $onbackorder = 'y';
      }
   }
}
//if valid connect to database and insert values into table 
if ($_POST && $errMess)
{
   //connect to mysql
   $link = connect_to_sql();
   //insert values into table
   $sql_query = 'INSERT INTO inventory set itemName="' . $_POST['itemName'] . '", description="' . $_POST['description'] . '",  supplierCode="' . $_POST['supplierCode'] . '",  cost="' . $_POST['cost'] . '",  price="' . $_POST['sellingprice'] . '",  onHand="' . $_POST['numberonhand'] . '",  reorderPoint="' . $_POST['reorderpoint'] . '",  backOrder="' . $onbackorder . '"';
   //run sql query
   $result = mysqli_query($link, $sql_query) or die('query failed'. mysqli_error($link));
   //close mysql link
   mysqli_close($link);
   //redirect to view.php and terminate
   header("Location: view.php");
   exit();	
} 
//else redisplay form with error message
?> 
<html>
   <head>
      <title>Add Record</title>
      <?php 
         //call function from library to link style and display header
         style(); 
         header_text(); 
      ?>
   </head>
   <body>
      <!--call function from library to display menu-->
      <?php menu(); ?>
      <p>All fields mandatory except "On Back Order"</p>
      <form method="post" action="">
      <table>		
         <tr>
            <td align="right">Item name:</td>
	    <td class="formErr"><input type="text" name="itemName" value="<?php if (isset($_POST['itemName'])) echo $_POST['itemName']; ?>"><?php echo $itemNameErr; ?></td>
         </tr>		
         <tr>
            <td align="right">Description:</td>
	    <td class="formErr"><textarea name="description"><?php if (isset($_POST['description'])) echo $_POST['description']; ?></textarea><?php echo $descriptionErr; ?></td>
         </tr>
         <tr>
            <td align="right">Supplier Code:</td>
	    <td class="formErr"><input type="text" name="supplierCode" value="<?php if (isset($_POST['supplierCode'])) echo $_POST['supplierCode']; ?>"><?php echo $supplierCodeErr; ?></td>
         </tr>
         <tr>
            <td align="right">Cost:</td>
	    <td class="formErr"><input type="text" name="cost" value="<?php if (isset($_POST['cost'])) echo $_POST['cost']; ?>"><?php echo $costErr; ?></td>
         </tr>
         <tr>
            <td align="right">Selling price:</td>
	    <td class="formErr"><input type="text" name="sellingprice" value="<?php if (isset($_POST['sellingprice'])) echo $_POST['sellingprice']; ?>"><?php echo $sellingpriceErr; ?></td>
         </tr>
         <tr>
            <td align="right">Number on hand:</td>
	    <td class="formErr"><input type="text" name="numberonhand" value="<?php if (isset($_POST['numberonhand'])) echo $_POST['numberonhand']; ?>"><?php echo $numberonhandErr; ?></td>
         </tr>
         <tr>
            <td align="right">Reorder Point:</td>
	    <td class="formErr"><input type="text" name="reorderpoint" value="<?php if (isset($_POST['reorderpoint'])) echo $_POST['reorderpoint']; ?>"><?php echo $reorderpointErr; ?></td>
         </tr>
         <tr>
            <td align="right">On Back Order:</td>
	    <td><input type="checkbox" name="onbackorder"<?php if (isset($_POST['onbackorder'])) echo "CHECKED"; ?>></td>
         </tr>
         <tr>
            <td align="right"><input type="submit" value="Submit"></td>
         </tr>
      </table>
      <!--call function from library to display footer-->	
      <?php footer_text(); ?>
      </form>
   </body>
</html>
		


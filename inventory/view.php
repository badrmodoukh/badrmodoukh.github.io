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
?>
<html>
   <head>
   <title>View Database</title>
   <?php //call function from library
      style();
      header_text(); 
   ?>
   </head>
   <body>
   <?php
      //connect to mysql 
      $link = connect_to_sql();
      //get all records from database
      $sql_query = "SELECT * from inventory";
      //run the sql query
      $result = mysqli_query($link, $sql_query) or die('query failed'. mysqli_error($link));
   ?>
   <?php menu(); ?>
      <br/>
      <table class="view">
         <tr>
            <th>ID</th>
            <th>Item Name</th>
            <th class="desc">Description</th>
            <th>Supplier</th>
            <th>Cost</th>
            <th>Price</th>
            <th class="noh">Number On Hand</th>
            <th class="noh">Reorder Level</th> 
            <th class="noh">On Back Order?</th>
            <th>Delete/Restore</th>
         </tr>
         <?php
            //iterate through result printing each record
            while($row = mysqli_fetch_assoc($result))
            {
         ?>
         <tr>
            <td><?php print $row['id']; ?></td>
            <td><?php print $row['itemName']; ?></td>
            <td><?php print $row['description']; ?></td>
            <td><?php print $row['supplierCode']; ?></td>
            <td><?php print $row['cost']; ?></td>
            <td><?php print $row['price']; ?></td>
            <td><?php print $row['onHand']; ?></td>
            <td><?php print $row['reorderPoint']; ?></td>
            <td><?php print $row['backOrder']; ?></td>
            <td><a href="delete.php?id=<?php echo $row['id']; ?>&deleted=<?php echo $row['deleted']; ?>"><?php if ($row['deleted'] == "n") print "Delete"; else print "Restore"; ?></a></td>
         </tr>
         <?php
            } 
         ?>
      </table>
      <?php footer_text(); ?>
   </body>
</html>


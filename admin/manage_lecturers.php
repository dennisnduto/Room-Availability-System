<?php

include 'db.php';


if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_query = mysqli_query($conn, "DELETE FROM `employee` WHERE id = $delete_id ") or die('query failed');
   if($delete_query){
      echo "<script type = \"text/javascript\">
									alert(\"Lecturer Deleted Sucessfully................\");
                           window.location = (\"manage_lecturers.php\")
									</script>";
   }else{
      echo "<script type = \"text/javascript\">
									alert(\"Lecturer could not be deleted................\");
                           window.location = (\"manage_lecturers.php\")
									</script>";
   };
};

if(isset($_POST['update_employee'])){
    $update_id = $_POST['id']; // Add this line to capture the id from the form
    $update_username = $_POST['update_username'];
    $update_email = $_POST['update_email'];

    $update_query = mysqli_query($conn, "UPDATE `employee` SET username = '$update_username', email= '$update_email' WHERE id = '$update_id'");

    if($update_query){
        echo "<script type = \"text/javascript\">
            alert(\"Lecturer updated successfully................\");
            window.location = (\"manage_lecturers.php\")
            </script>";
    }else{
        echo "<script type = \"text/javascript\">
            alert(\"lecturer could not be updated................\");
            window.location = (\"manage_lecturers.php\")
            </script>";
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
<title> ROOM FINDER SYSTEM </title>
	
	<link href="style.css" rel="stylesheet">
</head>
<body>
<section>

   <table align="center">

      <thead>
         <th>ID</th>
         <th>Username</th>
         <th>Email</th>
         <th>ACTION</th>
        
      </thead>

      <tbody class="white">
         <?php
         
            $select_products = mysqli_query($conn, "SELECT * FROM `employee`");
            if(mysqli_num_rows($select_products) > 0){
               while($row = mysqli_fetch_assoc($select_products)){
            
         ?>

         <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td> <?php echo $row['email']; ?></td>
           
            
            
            <td>
               <a href="manage_lecturers.php?delete=<?php echo $row['id']; ?>" class="btn" onclick="return confirm('are your sure you want to delete this Lecturer?');"> <i class="fas fa-trash"></i> DELETE </a>
               <a href="manage_lecturers.php?edit=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-edit"></i> UPDATE </a>
            </td>
         </tr>

         <?php
            };    
            }else{
               echo "<div class='empty'>No room added</div>";
            };
         ?>
      </tbody>
   </table>

</section>

<section>

   <?php
   
   if(isset($_GET['edit'])){
      $edit_id = $_GET['edit'];
      $edit_query = mysqli_query($conn, "SELECT * FROM `employee` WHERE id = $edit_id");
      if(mysqli_num_rows($edit_query) > 0){
         while($fetch_edit = mysqli_fetch_assoc($edit_query)){
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?php echo $fetch_edit['id']; ?>">
      <input type="text" class="box" required name="update_username" value="<?php echo $fetch_edit['username']; ?>">
      <input type="text" class="box" required name="update_email" value="<?php echo $fetch_edit['email']; ?>">
      
      <input type="submit" value="Update_employee" name="update_employee" class="btn">
      <input type="button" value="cancel" onClick="document.location.href='manage_lecturers.php';" />
   </form>

   <?php
            };
         };
         
      };
   ?>

</section>
<div class= "backbtn">
<a href="index.php" class="previous">&laquo; Back</a>
</div>
</body>
</html>
<?php

include 'db.php';


if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_query = mysqli_query($conn, "DELETE FROM `rooms` WHERE id = $delete_id ") or die('query failed');
   if($delete_query){
      echo "<script type = \"text/javascript\">
									alert(\"Room Deleted Sucessfully................\");
                           window.location = (\"manage_rooms.php\")
									</script>";
   }else{
      echo "<script type = \"text/javascript\">
									alert(\"Room could not be deleted................\");
                           window.location = (\"manage_rooms.php\")
									</script>";
   };
};

if(isset($_POST['update_rooms'])){
    $update_id = $_POST['id']; // Add this line to capture the id from the form
    $update_room_type = $_POST['update_room_type'];
    $update_days_of_the_week = $_POST['update_days_of_the_week'];
    $update_time_frame = $_POST['update_time_frame'];
    $update_room_name = $_POST['update_room_name'];

    $update_query = mysqli_query($conn, "UPDATE `rooms` SET room_type = '$update_room_type', days_of_the_week= '$update_days_of_the_week', time_frame='$update_time_frame', room_name='$update_room_name' WHERE id = '$update_id'");

    if($update_query){
        echo "<script type = \"text/javascript\">
            alert(\"Room updated successfully................\");
            window.location = (\"manage_rooms.php\")
            </script>";
    }else{
        echo "<script type = \"text/javascript\">
            alert(\"Room could not be updated................\");
            window.location = (\"manage_rooms.php\")
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
         <th>ROOM TYPE</th>
         <th>DAY OF THE WEEK</th>
         <th>TIME FRAME</th>
         <th>ROOM NAME</th>
         <th>ACTION</th>
      </thead>

      <tbody class="white">
         <?php
         
            $select_products = mysqli_query($conn, "SELECT * FROM `rooms`");
            if(mysqli_num_rows($select_products) > 0){
               while($row = mysqli_fetch_assoc($select_products)){
            
         ?>

         <tr>
            
            <td><?php echo $row['room_type']; ?></td>
            <td><?php echo $row['days_of_the_week']; ?></td>
            <td> <?php echo $row['time_frame']; ?></td>
            <td> <?php echo $row['room_name']; ?></td>
            
            
            <td>
               <a href="manage_rooms.php?delete=<?php echo $row['id']; ?>" class="btn" onclick="return confirm('are your sure you want to delete this room?');"> <i class="fas fa-trash"></i> DELETE </a>
               <a href="manage_rooms.php?edit=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-edit"></i> UPDATE </a>
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
      $edit_query = mysqli_query($conn, "SELECT * FROM `rooms` WHERE id = $edit_id");
      if(mysqli_num_rows($edit_query) > 0){
         while($fetch_edit = mysqli_fetch_assoc($edit_query)){
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?php echo $fetch_edit['id']; ?>">
      <input type="text" class="box" required name="update_room_type" value="<?php echo $fetch_edit['room_type']; ?>">
      <input type="text" class="box" required name="update_days_of_the_week" value="<?php echo $fetch_edit['days_of_the_week']; ?>">
      <input type="text" class="box" required name="update_time_frame" value="<?php echo $fetch_edit['time_frame']; ?>">
      <input type="text" class="box" required name="update_room_name" value="<?php echo $fetch_edit['room_name']; ?>">

      <input type="submit" value="update_rooms" name="update_rooms" class="btn">
      <input type="button" value="cancel" onClick="document.location.href='manage_rooms.php';" />
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
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {font-family: "Lato", sans-serif;}

.sidebar {
  height: 100%;
  width: 200px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  padding-top: 16px;
}

.sidebar a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 20px;
  color: #818181;
  display: block;
}

.sidebar a:hover {
  color: #f1f1f1;
}

.main {
  margin-left: 160px; 
  padding: 0px 10px;
}

@media screen and (max-height: 450px) {
  .sidebar {padding-top: 15px;}
  .sidebar a {font-size: 18px;}
}
</style>
</head>
<body>

<div class="sidebar">
 

  <div class="tab">
  <button class="tablinks" onclick="openCity(event, 'London')" id="defaultOpen">HOME</button> <br>
  <button class="tablinks" onclick="openCity(event, 'add_rooms')">ADD ROOMS</button><br>
  <button class="tablinks" onclick="openCity(event, 'manage_rooms')">MANAGE ROOMS</button><br>
  <button class="tablinks" onclick="openCity(event, 'Tokyo')">LOG OUT</button><br>
</div>
</div>

<div class="main">
  
</div>
     <div id = "add_rooms" class= "tabcontent">

     <form action="" method="post" enctype="multipart/form-data" class="add" align="center">
<h3>ADD A NEW ROOM</h3>
<div class="form-group">
<label for="room type">Room Type:</label>
          <select id="room type" name="room_type" class="roomtype" required>
            <option value="">Select Room Type</option>
            <option value="lecture room">Lecture Room</option>
            <option value="labs">Labs</option>
            <option value="halls">Halls</option>
          </select><br><br>
          <label for="Days of the week">Days of the week:</label>
          <select id="days_of_the_week" name="days_of_the_week" class="roomtype" required>
            <option value="">Select Day Of The Week</option>
            <option value="monday">Monday</option>
            <option value="tuesday">Tuesday</option>
            <option value="wednesday">Wednesday</option>
            <option value="thursday">Thursday</option>
            <option value="friday">Friday</option>
          </select><br><br>
          <label for="time frame">Time Frame:</label>
          <select id="time frame" name="time_frame" class="roomtype" required>
            <option value="">Select Time Frame</option>
            <option value="7:00am - 10:00am">7:00am - 10:00am</option>
            <option value="10:00am - 1:00pm">10:00am - 1:00pm</option>
            <option value="1:00pm - 4:00pm">1:00pm - 4:00pm</option>
          </select> <br>
          <label for="room_name">Room name</label>
          <input type="text" name="room_name" required>
</div>

    <div class="form-group">
        <button type="submit" class="btn" name="add_room">Add Room</button>
    </div>
</form>
<?php

include 'db.php';

if(isset($_POST['add_room'])){
   $room_type = $_POST['room_type'];
   $days_of_the_week = $_POST['days_of_the_week'];
   $time_frame = $_POST['time_frame'];
   $room_name = $_POST['room_name'];
  

   $insert_query = mysqli_query($conn, "INSERT INTO `rooms`(room_type, days_of_the_week, time_frame, room_name) VALUES('$room_type','$days_of_the_week','$time_frame','$room_name')") or die('query failed');

   if($insert_query){
      echo "<script type = \"text/javascript\">
									alert(\"Room Added Successful.................\");
                           window.location = (\"add_rooms.php\")
									</script>";
   }else{
      echo "<script type = \"text/javascript\">
									alert(\"Room could not be added................\");
                           window.location = (\"add_rooms.php\")
									</script>";
   }
};

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
   $update_room_id = $_POST['update_room_id'];
   $update_room_type = $_POST['update_room_type'];
   $update_days_of_the_week = $_POST['update_days_of_the_week'];
   $update_time_frame = $_POST['update_time_frame'];
   $update_room_name = $_POST['update_room_name'];

   $update_query = mysqli_query($conn, "UPDATE `rooms` SET room_type = '$update_room_type', days_of_the_week= '$update_days_of_the_week', time_frame = '$update_time_frame', room_name='$update_room_name' WHERE id = '$update_room_id'");

   if($update_query){
      echo "<script type=\"text/javascript\">
                alert(\"Room updated successfully................\");
                window.location = \"manage_rooms.php\";
            </script>";
   }else{
      echo "<script type=\"text/javascript\">
                alert(\"Room could not be updated................\");
                window.location = \"manage_rooms.php\";
            </script>";
   }
}

?>
     </div>
     <div id = "manage_rooms"class= "tabcontent">
     <?php
require_once 'db.php';
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
               <a href="add_rooms.php?delete=<?php echo $row['id']; ?>" class="btn" onclick="return confirm('are your sure you want to delete this room?');"> <i class="fas fa-trash"></i> DELETE </a>
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
      <input type="hidden" name="update_room_id" value="<?php echo $fetch_edit['id']; ?>">
      <input type="text" class="box" required name="update_room_type" value="<?php echo $fetch_edit['room_type']; ?>">
      <input type="text" class="box" required name="update_days_of_the_week" value="<?php echo $fetch_edit['days_of_the_week']; ?>">
      <input type="text" class="box" required name="update_time_frame" value="<?php echo $fetch_edit['time_frame']; ?>">
      <input type="text" class="box" required name="update_room_name" value="<?php echo $fetch_edit['room_name']; ?>">
      <input type="submit" value="update the room" name="update_room" class="btn">
      <input type="button" value="cancel" onClick="document.location.href='manage_rooms.php';" />
   </form>

   <?php
            };
         };
         
      };
   ?>

</section>
</body>
</html>

     </div>
     <script>
function openCity(event, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
</body>
</html> 


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


   $update_query = mysqli_query($conn, "UPDATE `rooms` SET room_type = '$update_room_type', days_of_the_week= '$update_days_of_the_week', time_frame = '$update_time_frame',room_type='$room_name' WHERE id = '$update_room_id'");

   if($update_query){
     
      echo "<script type = \"text/javascript\">
									alert(\"Room updated successfully................\");
                           window.location = (\"admin\manage_rooms.php\")
									</script>";
   }else{
      echo "<script type = \"text/javascript\">
									alert(\"Room could not be updated................\");
                           window.location = (\"admin\manage_rooms.php\")
									</script>";
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title> ROOM FINDER SYSTEM </title>
	
	<link href="admin.css" rel="stylesheet">
</head>
<body>
<section>
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

</section>
<div class= "backbtn">
<a href="index.php" class="previous">&laquo; Back</a>
</div>
</body>
</html> 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>student page</title>
  
    <link rel="stylesheet" href="studentpage.css">
</head>
  <div class="studentcontainer">
    <body class="studentpage_body" >

        <h1 class="studentheading">Hi student, select the fields below to see the available rooms.</h1>
        <form action="#" method="POST">
        <div class="studentform">
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
        </div>
    <button class="ggeneratebtn" type="submit" name="generatebtn"> Generate the available rooms</button><br><br>



    <div class= "availables">
    <?php
include 'db.php';

// Fetch data from table when generate button is clicked
if (isset($_POST['generatebtn'])) {
  $room_type = $_POST['room_type'];
  $days_of_the_week = $_POST['days_of_the_week'];
  $time_frame = $_POST['time_frame'];
 

  $sql = "SELECT room_name FROM rooms WHERE room_type = '$room_type' AND days_of_the_week = '$days_of_the_week' AND time_frame = '$time_frame'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      echo "<h2>Available Rooms:</h2>";
      echo "<ul>";
      // output room names
      while($row = $result->fetch_assoc()) {
          echo "<li>".$row["room_name"]."</li>";
      }
  
  } else {
      echo "No rooms available for the selected criteria.";
  }
  $conn->close();
}
?>
    </div>
    <input class = "logoutbutton" type="button" value="LOG OUT" onClick="document.location.href='login.php';" />
    
  </div> 
 
</form>
</body>
</html>
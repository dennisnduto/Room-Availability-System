<?php
include 'db.php';


$days_of_the_week = "";

// Check if form is submitted for booking and a room is selected
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == "book_room" && isset($_POST['selected_room'])) {
    $selectedRoom = $_POST['selected_room'];

    // Fetch room details
    $roomDetailsQuery = "SELECT * FROM rooms WHERE room_name = '$selectedRoom'";
    $roomDetailsResult = $conn->query($roomDetailsQuery);
    if ($roomDetailsResult->num_rows > 0) {
        $roomDetails = $roomDetailsResult->fetch_assoc();

        // Extract room details
        $id = $roomDetails['id'];
        $room_type = $roomDetails['room_type'];
        $days_of_the_week = $roomDetails['days_of_the_week']; 
        $time_frame = $roomDetails['time_frame'];

        // Insert booked room into bookedrooms table with all room details
        $insertSql = "INSERT INTO bookedrooms (room_type, days_of_the_week, time_frame, room_name) VALUES ('$room_type', '$days_of_the_week', '$time_frame', '$selectedRoom')";

        // Execute the insertion query
        if ($conn->query($insertSql) === TRUE) {
            echo "Room booked successfully.";
        } else {
            echo "Error: " . $insertSql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: Room details not found.";
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == "book_room") {
    echo "Please select a room to book."; 
}

// Fetch available rooms from the database excluding booked rooms
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == "book_room") {
    $room_type = $_POST['room_type'];
    $days_of_the_week = $_POST['days_of_the_week'];
    $time_frame = $_POST['time_frame'];
    $sql = "SELECT * FROM rooms WHERE room_type = '$room_type' AND days_of_the_week = '$days_of_the_week' AND time_frame = '$time_frame' AND room_name NOT IN (SELECT room_name FROM bookedrooms)";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecturer Page</title>
    <link rel="stylesheet" href="lecturerside.css">
    <script>
        function addToBookings() {
            var selectedRoom = document.getElementById("bookingsList").value;
            var confirmBooking = confirm("Are you sure you want to book room: " + selectedRoom + "?");
            if (confirmBooking) {
                document.getElementById("bookedRoomInput").value = selectedRoom;
                document.getElementById("bookingForm").submit();
            }
        }
    </script>
</head>
<body class="studentpage_body">
    <div class="studentcontainer">
        <h1 class="studentheading">Hi lecturer, select the fields below to see the available rooms and to book.</h1>
        <form id="bookingForm" action="#" method="POST">
            <div class="studentform">
                <label for="room_type">Room Type:</label>
                <select id="room_type" name="room_type" class="roomtype" required>
                    <option value="">Select Room Type</option>
                    <option value="lecture room">Lecture Room</option>
                    <option value="labs">Labs</option>
                    <option value="halls">Halls</option>
                </select><br><br>
                <label for="days_of_the_week">Days of the week:</label>
                <select id="days_of_the_week" name="days_of_the_week" class="roomtype" required>
                    <option value="">Select Day Of The Week</option>
                    <option value="monday">Monday</option>
                    <option value="tuesday">Tuesday</option>
                    <option value="wednesday">Wednesday</option>
                    <option value="thursday">Thursday</option>
                    <option value="friday">Friday</option>
                </select><br><br>
                <label for="time_frame">Time Frame:</label>
                <select id="time_frame" name="time_frame" class="roomtype" required>
                    <option value="">Select Time Frame</option>
                    <option value="7:00am - 10:00am">7:00am - 10:00am</option>
                    <option value="10:00am - 1:00pm">10:00am - 1:00pm</option>
                    <option value="1:00pm - 4:00pm">1:00pm - 4:00pm</option>
                </select> <br>
                
                <input type="hidden" id="bookedRoomInput" name="selected_room">
            </div>
            <button class="ggeneratebtn" type="submit" name="generatebtn"> Generate the available rooms</button><br><br>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == "book_room") {
                if ($result->num_rows > 0) {
                    echo "<h2>Available Rooms:</h2>";
                    echo "<select id='bookingsList' class='roomtype'>";
                    while($row = $result->fetch_assoc()) {
                        echo "<option>".$row["room_name"]."</option>";
                    }
                    echo "</select>";
                } else {
                    echo "No rooms available for the selected criteria.";
                }
            }
            ?>

            <!-- Input field to hold the action -->
            <input type="hidden" name="action" value="book_room">
        </form>
        <div class="bookbtndiv">
            <button class="bookbtn" onclick="addToBookings()">
                Book Now +
            </button>
        </div>
    </div>

    <div class="bookingdiv">
        <label for="bookingslabel" class="bookingslabel"> Your bookings will appear here:</label>
        </div>
        <div class="outputtable">
            <!-- PHP code to fetch and display bookings from the database -->
            <?php




if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_query = mysqli_query($conn, "DELETE FROM `bookedrooms` WHERE id = $delete_id ") or die('query failed');
   if($delete_query){
      echo "<script type = \"text/javascript\">
									alert(\"Room Deleted Sucessfully................\");
                           window.location = (\"lecturerside.php\")
									</script>";
   }else{
      echo "<script type = \"text/javascript\">
									alert(\"Room could not be deleted................\");
                           window.location = (\"lecturerside.php\")
									</script>";
   };
};

if(isset($_POST['update_bookedrooms'])){
    $update_id = $_POST['id']; // Add this line to capture the id from the form
    $update_room_type = $_POST['update_room_type'];
    $update_days_of_the_week = $_POST['update_days_of_the_week'];
    $update_time_frame = $_POST['update_time_frame'];
    $update_room_name = $_POST['update_room_name'];

    $update_query = mysqli_query($conn, "UPDATE `bookedrooms` SET room_type = '$update_room_type', days_of_the_week= '$update_days_of_the_week', time_frame='$update_time_frame', room_name='$update_room_name' WHERE id = '$update_id'");

    if($update_query){
        echo "<script type = \"text/javascript\">
            alert(\"Room updated successfully................\");
            window.location = (\"lecturerside.php\")
            </script>";
    }else{
        echo "<script type = \"text/javascript\">
            alert(\"Room could not be updated................\");
            window.location = (\"lecturerside.php\")
            </script>";
    }
}
?>

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
         
            $select_products = mysqli_query($conn, "SELECT * FROM `bookedrooms`");
            if(mysqli_num_rows($select_products) > 0){
               while($row = mysqli_fetch_assoc($select_products)){
            
         ?>

         <tr>
            
            <td><?php echo $row['room_type']; ?></td>
            <td><?php echo $row['days_of_the_week']; ?></td>
            <td> <?php echo $row['time_frame']; ?></td>
            <td> <?php echo $row['room_name']; ?></td>
            
            
            <td>
               <a href="lecturerside.php?delete=<?php echo $row['id']; ?>" class="btn" onclick="return confirm('are your sure you want to delete this room?');"> <i class="fas fa-trash"></i> DELETE </a>
               <a href="lecturerside.php?edit=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-edit"></i> UPDATE </a>
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
      $edit_query = mysqli_query($conn, "SELECT * FROM `bookedrooms` WHERE id = $edit_id");
      if(mysqli_num_rows($edit_query) > 0){
         while($fetch_edit = mysqli_fetch_assoc($edit_query)){
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?php echo $fetch_edit['id']; ?>">
      <input type="text" class="box" required name="update_room_type" value="<?php echo $fetch_edit['room_type']; ?>">
      <input type="text" class="box" required name="update_days_of_the_week" value="<?php echo $fetch_edit['days_of_the_week']; ?>">
      <input type="text" class="box" required name="update_time_frame" value="<?php echo $fetch_edit['time_frame']; ?>">
      <input type="text" class="box" required name="update_room_name" value="<?php echo $fetch_edit['room_name']; ?>">

      <input type="submit" value="update_rooms" name="update_bookedrooms" class="btn">
      <input type="button" value="cancel" onClick="document.location.href='lecturerside.php';" />
   </form>

   <?php
            };
         };
         
      };
   ?>

</section>

        </div>
        <div class="logoutbtn">
        <input class = "logoutbutton" type="button" value="LOG OUT" onClick="document.location.href='login.php';" />
        </div>
        
    </div>
</body>
</html>

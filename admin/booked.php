<?php
include 'db.php'; 

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Room Finder Admin Booked Report</title>
  
    <link rel="stylesheet" href="admin.css">
</head>
<body>

<div class="manage">
<h1>Total rooms Report</h1>
<table class="table table-bordered table-striped table-responsive-md">
        <thead>
            <tr>
                <th>ID</th>
                <th>Room Type</th>
                <th>Day of the week</th>
                <th>Time Frame</th>
                <th>Room Name</th>
               
            </tr>
        </thead>
        <tbody>
            <?php
            $query = mysqli_query($conn, "SELECT * FROM rooms");
            while($row = mysqli_fetch_assoc($query)) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['room_type']}</td>
                        <td>{$row['days_of_the_week']}</td>
                        <td>{$row['time_frame']}</td>
                        <td>{$row['room_name']}</td>
                       
                    </tr>";
            }
            ?>
        </tbody>
    </table> 
</div>
<div class="manage">
<h1>Booked Rooms Report</h1>
    <table class="table table-bordered table-striped table-responsive-md">
        <thead>
            <tr>
                <th>ID</th>
                <th>Room Type</th>
                <th>Day of the week</th>
                <th>Time Frame</th>
                <th>Room Name</th>
               
            </tr>
        </thead>
        <tbody>
            <?php
            $query = mysqli_query($conn, "SELECT * FROM bookedrooms");
            while($row = mysqli_fetch_assoc($query)) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['room_type']}</td>
                        <td>{$row['days_of_the_week']}</td>
                        <td>{$row['time_frame']}</td>
                        <td>{$row['room_name']}</td>
                       
                    </tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<div class="manage">
<h1>Registered Students Report</h1>
    <table class="table table-bordered table-striped table-responsive-md">
        <thead>
            <tr>
            <th>ID</th>
                <th>Username</th>
                <th>Email</th>
               
            </tr>
        </thead>
        <tbody>
            <?php
            $query = mysqli_query($conn, "SELECT * FROM users");
            while($row = mysqli_fetch_assoc($query)) {
                echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['username']}</td>
                <td>{$row['email']}</td>
                
                       
                    </tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<div class="manage">
<h1>Registered Lecturers Report</h1>
    <table class="table table-bordered table-striped table-responsive-md">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                
               
            </tr>
        </thead>
        <tbody>
            <?php
            $query = mysqli_query($conn, "SELECT * FROM employee");
            while($row = mysqli_fetch_assoc($query)) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['username']}</td>
                        <td>{$row['email']}</td>
                        
                       
                    </tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</section>
<div class= "backbtn">
<a href="index.php" class="previous">&laquo; Back</a>
</div>
</body>
</html>

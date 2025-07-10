<?php
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ROOM FINDER  Dashboard</title>
    
    <link rel="stylesheet" href="admin.css">
    
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h2>Room Finder Admin</h2>
        </div>
        <ul class="nav">
            <li><a href="index.php">Dashboard</a></li>
            <li><a href="add_rooms.php">Add Rooms</a></li>
            
            <li><a href="manage_rooms.php">Manage Rooms</a></li>
            <li><a href="manage_students.php">Manage Students</a></li>
            <li><a href="manage_lecturers.php">Manage Lecturers</a></li>
            <li><a href="booked_rooms.php">Manage Booked Rooms</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div class="dashboard-header">
            <h1>Welcome Admin!</h1>
            <div class="dashboard-actions">
            <input class = "logout-button" type="button" value="LOG OUT" onClick="document.location.href='login.php';" />
            </div>
        </div>
        <div class="logout-button">
            <a href="booked.php">Generate Report</a>
        </div>
        <?php
        require_once 'db.php'; 

        // Fetch total available available rooms
        $sqlRooms = "SELECT COUNT(*) AS total_rooms FROM rooms";
        $resultRooms = $conn->query($sqlRooms);
        $totalRooms = $resultRooms->fetch_assoc()['total_rooms'] ?? "Error fetching data";

        // Fetch total registered students
        $sqlStudents = "SELECT COUNT(*) AS total_students FROM users";
        $resultStudents = $conn->query($sqlStudents);
        $totalStudents = $resultStudents->fetch_assoc()['total_students'] ?? "Error fetching data";

        // Fetch total lecturers
        $sqlLecturers = "SELECT COUNT(*) AS total_Lecturers FROM employee";
        $resultLecturers = $conn->query($sqlLecturers);
        $totalLecturers = $resultLecturers->fetch_assoc()['total_Lecturers'] ?? "Error fetching data";

       

       // Fetch total booked rooms 
        $sqlBookedrooms = "SELECT COUNT(*) AS total_booked_rooms FROM bookedrooms "; 
        $resultBookedrooms = $conn->query($sqlBookedrooms);
        $totalBookedrooms = $resultBookedrooms->fetch_assoc()['total_booked_rooms'] ?? "Error fetching data";




        $conn->close();
        ?>
        <div class="dashboard-stats">
            <div class="stat-item" style="background-color: #f0ad4e;">
                <h2>Available Rooms</h2>
                <h1><?php echo $totalRooms; ?></h1>
            </div>

            <div class="stat-item" style="background-color: #5cb85c;">
                <h2>Registered Students</h2>
                <h1><?php echo $totalStudents; ?></h1>
            </div>
            

            <div class="stat-item" style="background-color: #5cb85c;">
                <h2>Registered Lecturers </h2>
                <h1><?php echo $totalLecturers; ?></h1>
            </div>
            
           
            <div class="stat-item" style="background-color: #5bc0de;">
                <h2>Booked Rooms</h2>
                <h1><?php echo $totalBookedrooms; ?></h1>
            </div>
    </div>          
</body>
</html>

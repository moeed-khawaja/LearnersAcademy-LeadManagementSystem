<?php
$db_hostname = 'localhost';
$db_database = 'learnersacademy';
$db_username = 'root';
$db_password = '1234';

$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="index.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <link rel="stylesheet" href="newlead.css" />


    <title>Lead Management System</title>
</head>


<style>

    table{
        margin-top: 25px;
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 50px;
    }

    th, td{
        border: 1.5px solid black;
        text-align: center;
    }

    th{
        font-size: 23px;
        font-family: Verdana;
    }

    td{
        font-size: 18px;
    }


</style>



<body>


<div id="menu">

    <div>
        <span>  <img src= "logo.jpeg" class= "logo_holder" > </span>
    </div>


    <div class= "menu-button">
        <a href="sales.php" style="color: white; text-decoration: none;">Sales </a>
    </div>

    <div class="menu_object">
        <button class="menu-button">New &nbsp; ▼</button>
        <div class="dropdown-content">
            <a id="top" href="newlead.php">New Student</a>
            <a id="bottom" href="newUser.php">New User</a>
        </div>
    </div>



    <div class="menu_object">
        <button class="menu-button">Update &nbsp; ▼</button>
        <div class="dropdown-content">
            <a id="top" href="updateLead.php">Student Info</a>
            <a id="bottom" href="updateUser.php">User Info</a>
        </div>
    </div>



    <div class="menu_object">
        <button class="menu-button">Delete &nbsp; ▼</button>
        <div class="dropdown-content">
            <a id="top" href="deleteStudent.php">Delete Student</a>
            <a id="bottom" href="deleteUser.php">Delete User</a>
        </div>
    </div>


    <div class= "menu-button">
        <a href="activeSales.php" style="color: white; text-decoration: none;">Active Sales </a>
    </div>


</div>






<div class= "title" style="margin-top: 25px; margin-bottom: 20px">
    <h1>Sales</h1>
</div>


<div class="commission" style="border: 2px solid  mediumblue; width: 200px; padding: 10px;">

    <form method="post" action="sales.php" >
        <label>Commission Rate:</label>
        <input type="text" name="commission" placeholder="500" style="width: 50px; margin-bottom: 5PX;">
    <input type="submit" name="submit" style="width: 200px;">
    </form>

</div>




<br><br>



<table>
    <tr>
        <th style="width: 35%">User</th>
        <th>Active Sales</th>
        <th>Commission</th>
    </tr>




<?php
if (isset($_POST['submit'])) {
$commissionRate = $_POST['commission'];
$commissionRate = intval($commissionRate);



    $sqlUserName = "SELECT  CONCAT(First_Name, ' ', Last_Name) AS name, User_id FROM User_entity";
    $result = $conn->query($sqlUserName);


    $userNames = [];
    $userIds = [];



while ($row = $result->fetch_assoc()) {
    $userNames [] = $row["name"];
    $userIds [] = $row["User_id"];

}




foreach ($userNames as $key => $data) {
?>

    <tr>
            <td><?php echo $userNames[$key] ?></td>
            <td>
                <?php
                $sqlsaleCount= "SELECT COUNT(*) AS sale_count FROM commission_entity WHERE user_id= $userIds[$key]";
                $result = $conn->query($sqlsaleCount);

                $row = $result->fetch_assoc();
                $saleCount = $row['sale_count'];

                echo $saleCount;
                ?>
            </td>
            <td>

                <?php
                $sqlsaleCount= "SELECT COUNT(*) AS sale_count FROM commission_entity WHERE user_id= $userIds[$key]";
                $result = $conn->query($sqlsaleCount);

                $row = $result->fetch_assoc();
                $saleCount = $row['sale_count'];

                echo $saleCount * $commissionRate;
                ?>
                \-
            </td>
        </tr>


<?php
    }


    ?>




    </table>







    <?php







}

?>







</body>
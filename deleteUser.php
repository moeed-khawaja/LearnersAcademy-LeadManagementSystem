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


    <link rel="stylesheet" href="deleteUser.css" />


    <title>Lead Management System</title>
</head>

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


<div class= "title">
    <h1>Delete User Record</h1>
</div>









<div class="search_c">
    <form method="post" action="deleteUser.php" id="searchForm">
        <input type="text" name="search" class="search_input" id="searchInput" placeholder="Search...">

        <span class="search_icon" onclick="submitForm()">
            <svg width="19px" height="19px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path opacity="1" d="M14 5H20" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path opacity="1" d="M14 8H17" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M21 11.5C21 16.75 16.75 21 11.5 21C6.25 21 2 16.75 2 11.5C2 6.25 6.25 2 11.5 2" stroke="#000" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path opacity="1" d="M22 22L20 20" stroke="#000" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </span>
    </form>
</div>


<script>
    function submitForm() {
        document.getElementById("searchForm").submit();
    }
</script>




<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
    $search = $_POST['search'];
    ?>

    <div class="cardHolder">


        <?php


        $count = -1;

        $sqlName = "SELECT CONCAT(First_Name, ' ', Last_Name) as name, User_id,Role, Email, Phone,User_Type_ID,Gender FROM User_Entity  where First_Name like '%$search%' or Last_Name like '%$search%'  ";
        $result = $conn->query($sqlName);

        $sqlUserTypeID = "SELECT User_Type_ID FROM User_Entity  WHERE First_Name LIKE '%$search%' or Last_Name like '%$search%'";
        $UserTypeID= $conn->query($sqlUserTypeID);


        $sqlUserTypeName = "SELECT User_Type_Name FROM User_type_entity  WHERE User_Type_ID =  SELECT User_Type_ID FROM User_Entity  WHERE First_Name LIKE '%$search%' or Last_Name like '%$search%'";
        $UserTypeName= $conn->query($sqlUserTypeName);







        $names = [];
        $email = [];
        $phone = [];
        $role = [];
        $gender = [];
        $id = [];


        while ($row = $result->fetch_assoc()) {
            $names[] = $row["name"];
            $role[] = $row["Role"];
            $email [] = $row["Email"];
            $phone [] = $row["Phone"];
            $gender [] = $row["Gender"];
            $id[] = $row["User_id"];
        }




        foreach ($names as $key => $data) {
            $count++;
            if ($count % 4 == 0) {
                echo "</div> <div class='cardHolder'>";
            }




            ?>







            <div class="card" >



                <div class="content">
                    <div class="back">
                        <div class="back-content">


                            <h2 style="text-align: center"><?php echo $data ?></h2>
                            <h3 style="color: #0647a0;"> <?php echo $role[$key] ?> </h3>


                        </div>
                    </div>
                    <div class="front">
                        <div class="img">
                            <div class= student_data>
                                <div class = "new">

                                    <p> Name: <?php echo $data ?></p>
                                    <p> Gender: <?php echo $gender[$key] ?></p>
                                    <p> Phone: <?php echo $phone[$key] ?></p>
                                    <p> Mode: <?php echo $email[$key] ?></p>
                                    <p> Role: <?php echo $role[$key] ?></p>
                                    <p> User Type: <?php echo $UserTypeName [$key]?></p>



                                    <form method="POST" action="deleteUser.php">
                                        <input type="hidden" name="idToDelete" value="<?php echo $id[$key]; ?>">
                                        <button type="submit" style="margin-left: 35%;" name="deleteButton">Delete</button>


                                    </form>

                                </div>




                            </div>
                        </div>

                    </div>
                </div>
            </div>





            <br><br>


            <?php


        }

        ?>
    </div>

    <?php

}
?>









<?php
if (isset($_POST['deleteButton'])) {

    $idToDelete = (int)$_POST['idToDelete'];
    $delsql = "DELETE FROM User_entity WHERE User_ID = $idToDelete";
    $result = $conn->query($delsql);


    if ($result) {

    ?>

        <div class="notification" style="background-color: #D1FAE5 ; border: 1px solid #80b366">
            <h3> ✔️  User Successfully Deleted</h3>
        </div>
    <?php
    }


    else {
        ?>
            <div class="notification" style="background-color:#f4cccc; border: 1px solid #cc0000">
                <h3 style="margin-bottom: -7px;"> ❌ User Deletion Failed</h3>
                <p style="font-size: 9.5px;">Hint: Maybe this user is associated with a student(s)</p>
            </div>

<?php

    }



}




?>









<br><br>









<div class="hamster_screen">
    <div aria-label="Orange and tan hamster running in a metal wheel" role="img" class="wheel-and-hamster">
        <div class="wheel"></div>
        <div class="hamster">
            <div class="hamster__body">
                <div class="hamster__head">
                    <div class="hamster__ear"></div>
                    <div class="hamster__eye"></div>
                    <div class="hamster__nose"></div>
                </div>
                <div class="hamster__limb hamster__limb--fr"></div>
                <div class="hamster__limb hamster__limb--fl"></div>
                <div class="hamster__limb hamster__limb--br"></div>
                <div class="hamster__limb hamster__limb--bl"></div>
                <div class="hamster__tail"></div>
            </div>
        </div>
        <div class="spoke"></div>
    </div>
</div>





</body>

</html>




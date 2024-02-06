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


   <link rel="stylesheet" href="new_user.css" />


    <title>Lead Management System</title>



    <style>
        .notification{
            padding-left: 15px;
            width: 300px;
            height: 65px;
            position: absolute;
            top: 200px;
            right: 50px;
        }
    </style>
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


    <div class= "title" style="font-size: 15px;">
        <h1>New User</h1>
    </div>




<br><br>







    <div id="forms_div" class="form">


        <form id="new_User" action="newUser.php" method="post">

<div class= "div_box">




            <div class="input-container">
            <input type= "text" id= "fname" name= "fname" class="input" placeholder= "First Name">
            <label for= "fname" class="label">First Name: </label>
            <div class="top-line"></div>
            <div class="under-line"></div>
            <span class="input-border"></span>
            </div>


            <br>

            <div class="input-container">
            <input type= "text" id= "lname" name= "lname"  class= "input" placeholder= "Last Name">
            <label for= "lname" class="label">Last Name: </label>
            <div class="top-line"></div>
            <div class="under-line"></div>
            <span class="input-border"></span>
            </div>



             <br>


            <div class="input-container">
            <input type= "text" id= "email" name= "email" placeholder="Email" class="input">
            <label for= "email" class= "label">Email: </label> <br>
            <div class="top-line"></div>

            <span class="input-border"></span>
            </div>




            <div class="input-container">
            <input type= "text" id= "role" name= "role" placeholder="Role" class="input">
            <label for= "role" class= "label">Role: </label>
            <div class="top-line"></div>

            <span class="input-border"></span>
            </div>




        </div>



<div class= "div_box">

            <p style="margin-bottom: 0px">Created Date:</p>
            <div class="input-container">
            <label for= "cdate" class="label">Created Date: </label>
            <input type= "date" id= "cdate" name= "cdate" class="input" placeholder="Created Date" required>
            <div class="top-line"></div>
            <div class="under-line"></div>
             </div>


<br>

             <div class="test">
            <label for= "gender" class="label_test" >Gender : </label>
            <select class="input_test" id="gender" name="gender">
            <option value= "Male">Male</option>
            <option value= "Female">Female</option>
            </select> </div>


<br>



            <label for= "user" name= "user_type" class="label_test">User Type: </label>
            <div class="test">

            <?php

            $sql = "SELECT User_Type_Name AS types FROM User_Type_Entity";
            $result = $conn->query($sql);

           $types = [];
            while ($row = $result->fetch_assoc()) {
                $types[] = $row["types"];
            }

            ?>

            <select id="user_type_id" name="user_type" class="input_test">
            <?php

            foreach ($types as $name) {
                echo "<option value=\"$name\">$name</option>";
            }
            ?>

            <div class="top-line"></div>








        </select>

</div>

    </div>






            <div class="input-container" id="phone">
            <input type= "text" id= "phone" name= "phone" class="input" placeholder="03312345678" >
            <label for= "phone" class="label">Phone: </label> <br>
            <div class="top-line"></div>

            <span class="input-border"></span>
            </div>


            <input type="submit" name="submit" value="Submit" class="btn" id="submit_button">

        </form>






    <script>
    function sendInfo(){
        var name= document.getElementById("fname").value;
        localStorage.setItem('fname', name);
        document.getElementById('new_lead').submit();

    }
    </script>

















<?php


if (isset($_POST['submit'])) {

    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $role = $_POST["role"];
    $cdate = $_POST["cdate"];
    $user_type = $_POST["user_type"];
    $gender= $_POST["gender"];
    $phone= $_POST["phone"];



    $sqlUser_type_id = "select user_type_id FROM user_type_entity WHERE user_type_name = '$user_type'";
    $result = $conn->query($sqlUser_type_id);

    $row = $result->fetch_assoc();


        $user_type_id = $row['user_type_id'];


    $sql = "INSERT INTO user_entity (First_Name, Last_Name, Email, Role, Created_Date, User_Type_ID,Gender,Phone) VALUES ('$fname', '$lname','$email','$role', '$cdate','$user_type_id','$gender','$phone')";
    $createUser= $conn->query($sql);


    if ($createUser) {

        ?>

        <div class="notification" style="background-color: #D1FAE5 ; border: 1px solid #80b366">
            <h3> ✔️  User Successfully Created</h3>
        </div>
        <?php
    }


    else {
        ?>
        <div class="notification" style="background-color:#f4cccc; border: 1px solid #cc0000">
            <h3 style="margin-bottom: -7px;"> ❌ User Creation Failed</h3>
        </div>

        <?php

    }







}

?>









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




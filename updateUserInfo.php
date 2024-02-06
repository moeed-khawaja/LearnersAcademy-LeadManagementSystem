<?php
$db_hostname = 'localhost';
$db_database = 'learnersacademy';
$db_username = 'root';
$db_password = '1234';

$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    $sqlName = "SELECT First_Name,Last_Name, Role,Email,Phone,Gender FROM User_Entity WHERE User_ID = $user_id ";
            $result = $conn->query($sqlName);

$row = $result->fetch_assoc();


    $fn = $row['First_Name'];
    $ln = $row['Last_Name'];
    $role = $row['Role'];
    $email = $row['Email'];
    $phone = $row['Phone'];
    $gender = $row['Gender'];
}

?>

<!DOCTYPE html>
<html>
<head >
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    
   <link rel="stylesheet" href="updateUserInfos.css" />


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
            <a id="top" href="deleteStudent.php">Student Info</a>
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
        <h1><?php echo $fn?></h1>
    </div> 




<br><br>







    <div id="forms_div" class="form">


        <form id="new_User" action="updateUser.php" method="post">

<div class= "div_box">

            <div class="input-container">     
       <input type="text" id="fname" name="fname" class="input" placeholder="First Name" value="<?php echo $fn ?>">
            <label for= "fname" class="label"> First Name: </label>
            <div class="top-line"></div>
            <div class="under-line"></div>
            <span class="input-border"></span>
            </div>
          

            <br>

            <div class="input-container">       
            <input type= "text" id= "lname" name= "lname"  class= "input" placeholder="Last Name" value="<?php echo $ln?>">
            <label for= "lname" class="label">Last Name: </label>
            <div class="top-line"></div>
            <div class="under-line"></div>
            <span class="input-border"></span>
            </div> 



             <br>
                        

            <div class="input-container">    
            <input type= "text" id= "email" name= "email" placeholder="email"  value="<?php echo $email?>" class="input">
            <label for= "email" class= "label">Email: </label> <br>
            <div class="top-line"></div>

            <span class="input-border"></span> 
            </div>


            

            <div class="input-container">    
            <input type= "text" id= "role" name= "role" value="<?php echo $role?>" placeholder="Role" class="input">
            <label for= "role" class= "label">Role: </label> 
            <div class="top-line"></div>

            <span class="input-border"></span> 
            </div>




        </div>
    


<div class= "div_box">


    <p>Update Date:</p>
    <div class="input-container">
        <input type= "date" id= "udate" name= "udate" class="input" placeholder="Updated Date" required>
        <label for= "udate" class="label"></label>
        <div class="top-line"></div>
        <div class="under-line"></div>
    </div>



    <br>

             <div class="test"> 
            <label for= "gender" class="label_test" value="<?php echo $gender?>">Gender : </label>
            <select class="input_test" id="gender" name="gender">
                <option value="Male" <?php echo ($gender === 'Male') ? 'selected' : ''; ?>>Male</option>
                <option value="Female" <?php echo ($gender === 'Female') ? 'selected' : ''; ?>>Female</option>
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

            $user_type_name_query = "SELECT user_type_name
                        FROM user_type_entity
                        WHERE user_type_id = (
                            SELECT user_type_id
                            FROM user_entity
                            WHERE user_id = $user_id
                        )";

            $resultUserType = $conn->query($user_type_name_query);

            if ($resultUserType && $resultUserType->num_rows > 0) {
                $rowUserType = $resultUserType->fetch_assoc();
                $selectedUserType = $rowUserType['user_type_name'];
            } else {
                $selectedUserType = "";
            }

            ?>


                <select id="user_type_id" name="user_type" class="input_test">
                    <?php
                    foreach ($types as $name) {
                        $selected = ($name == $selectedUserType) ? 'selected' : '';
                        echo "<option value=\"$name\" $selected>$name</option>";
                    }
                    ?>
                </select>
                <div class="top-line"></div>









</div>

    </div>






            <div class="input-container" id="phone">    
            <input type= "text" id= "phone" name= "phone" class="input" placeholder="phone" value="<?php echo $phone?>" > 
            <label for= "phone" class="label">Phone: </label> <br>
            <div class="top-line"></div>

            <span class="input-border"></span>
            </div>









            <input type="hidden" name="updateId" value="<?php echo $user_id; ?>">
            <button type="submit" name="updateButton"  id="submit_button" class="btn" >Update</button>

        </form>






  





<?php


if (isset($_POST['submit'])) {

    echo "helsososo";

    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $role = $_POST["role"];
    $udate =$_POST["udate"];
    $user_type = $_POST["user_type"];
    $gender= $_POST["gender"];
    $phone= $_POST["phone"];




    $sqlUser_type_id = "select user_type_id FROM user_type_entity WHERE user_type_name = '$user_type'";
    $result = $conn->query($sqlUser_type_id);

    $row = $result->fetch_assoc();


        $user_type_id = $row['user_type_id'];





    $sql = "UPDATE user_entity SET First_Name= $fname WHERE user_id=1;";
    $conn->query($sql);

   
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




</div>
</body>
</html>

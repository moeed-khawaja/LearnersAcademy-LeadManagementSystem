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
    
    
   <link rel="stylesheet" href="updateUser.css" />


    <title>Lead Management System</title>

    <style>

        .notification{
            padding-left: 15px;
            width: 300px;
            height: 65px;
            position: absolute;
            top: 185px;
            right: 10px;
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


    <div class= "title">
        <h1>Update User Info</h1>
    </div> 





<div class="search_c">
    <form method="post" action="updateUser.php" id="searchForm">
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
        document.getElementById('searchForm').submit();
    }
</script>
















<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
    $search = $_POST['search'];

echo "<div class='cardHolder'>";


    

$count = -1; 

    $sqlName = "SELECT CONCAT(First_Name, ' ', Last_Name) as name, User_ID,Role, Email,Phone,Gender, User_type_id FROM User_Entity WHERE First_Name like '%$search%' or Last_Name like '%$search%'  ";
            $result = $conn->query($sqlName);





            $id = [];
            $names = [];
            $role = [];
            $email = [];
            $phone = [];
            $gender = [];
            $User_typeID = [];





            while ($row = $result->fetch_assoc()) {
                $id[] = $row["User_ID"];
                $names[] = $row["name"];
                $role[] = $row["Role"];
                $email [] = $row["Email"];
                $phone [] = $row["Phone"];
                $gender [] = $row["Gender"];
                $User_typeID [] =  $row["User_type_id"];
            }



        
            foreach ($names as $key => $data) {
                $count++;
        if ($count % 4 == 0) {
            echo "</div> <div class='cardHolder'>";
        }




?>










<div class="card">
   <a href="updateUserInfo.php?user_id=<?php echo $id[$key]; ?>">



  <div class="content">


    <div class="back">
      <div class="back-content">
        
      <h2 style="text-align: center;"><?php echo $data ?></h2>
      <h3 style="color: #0647a0;"> <?php echo $role[$key] ?> </h3>

        



      </div>
    </div>
    <div class="front">
          <div class="img">
        <div class= student_data> 
    <div class = "new">
      <p > Name: <?php echo $data ?></p>
      <p> Role: <?php echo $role[$key] ?></p>
      <p> Email: <?php echo $email[$key] ?></p>
      <p> Phone: <?php echo $phone[$key] ?></p>
      <p> Gender: <?php echo $gender[$key] ?></p>

      <p> User Type: <?php
                        $sql = "SELECT User_Type_name FROM User_type_entity where User_type_id= $User_typeID[$key]";
                $result = $conn->query($sql);
                if ($result){
                    $row = $result->fetch_assoc();
                    echo $row["User_Type_name"];
                }
          ?></p>


     </div>

        </div>

      </div>
        </div>
      </div>
      </a>
    </div> 



<br><br>


                <?php
                

            }

?>
 </div>

<?php

}

?>

 </div>


<br><br>







    <?php



     if (isset($_POST['updateButton'])){

         $user_id = $_POST["updateId"];
         $fname = $_POST["fname"];
         $lname = $_POST["lname"];
         $email = $_POST["email"];
         $phone = $_POST["phone"];
         $udate = $_POST["udate"];
         $gender = $_POST["gender"];
         $role = $_POST["role"];
         $userType = $_POST["user_type"];



         $sql = "SELECT User_type_id FROM User_type_entity WHERE User_Type_Name = '$userType'";
         $result = $conn->query($sql);

         if ($result) {
             $row = $result->fetch_assoc();
             $userTypeId = $row['User_type_id'];

         }




         $sql = "UPDATE User_entity
                  SET First_Name = '$fname', Last_Name= '$lname', role= '$role', Email= '$email', Phone= '$phone', Gender= '$gender', updated_date= '$udate', user_type_id= $userTypeId
                  WHERE user_id = '$user_id'";


                  $result = $conn->query($sql);


         //Update notification
         if($result){
             ?>
             <div class="notification" style="background-color: #D1FAE5 ; border: 1px solid #80b366">
                 <h3> ✔️  User Info Updated</h3>
             </div>
             <?php
         }

         else {
             ?>
             <div class="notification" style="background-color:#f4cccc; border: 1px solid #cc0000">
                 <h3 style="margin-bottom: -7px;"> ❌ User Info not Updated</h3>
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



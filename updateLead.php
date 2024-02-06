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
    
    
   <link rel="stylesheet" href="updateLeads.css" />


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
        <h1>Update Student Info</h1>
    </div> 





<div class="search_c">
    <form method="post" action="updateLead.php" id="searchForm">
        <input type="text" name="search" class="search_input" id="searchInput" placeholder="Search...">

        <span class="search_icon" onclick="submitForm()">
            <svg width="19px" height="19px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <!-- Your SVG path here -->
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
    ?>

<div class="cardHolder">

    <?php
    

$count = -1; 

    $sqlName = "SELECT CONCAT(First_Name, ' ', Last_Name) as name, Lead_id, Standard, Email, Phone, Mode, Subject, Notes, Category_ID, Gender, User_ID FROM Lead_Entity WHERE (First_Name LIKE '%$search%' OR Last_Name LIKE '%$search%') AND sale_status = 0";
    $result = $conn->query($sqlName);


    $sqlCategoryID = "SELECT Category_ID FROM Lead_Entity  where First_Name like '%$search%' or Last_Name like '%$search%'";
            $categoryID= $conn->query($sqlCategoryID);









            $names = [];
            $standard = [];
            $email = [];
            $phone = [];
            $mode = [];
            $subject = [];
            $notes = [];
            $category = [];
            $gender = [];
            $id = [];
            $user_id = [];


            while ($row = $result->fetch_assoc()) {
                $names[] = $row["name"];
                $standard[] = $row["Standard"];
                $email [] = $row["Email"];
                $phone [] = $row["Phone"];
                $mode [] = $row["Mode"];
                $subject [] = $row["Subject"];
                $notes [] = $row["Notes"];
                $gender [] = $row["Gender"];
                $id[] = $row["Lead_id"];
                $user_id[] = $row["User_ID"];

            }


         
        
            foreach ($names as $key => $data) {
                $count++;
        if ($count % 4 == 0) {
            echo "</div> <div class='cardHolder'>";
        }
               



                ?>


<div class="card">
    <a href="updateStudentInfo.php?id=<?php echo htmlspecialchars($id[$key]); ?>">



  <div class="content">
    <div class="back">
      <div class="back-content">
        
      <h2 style="text-align: center;"><?php echo $data ?></h2>
      <h3 style="color: #0647a0;"> <?php echo $standard[$key] ?> </h3>


      </div>
    </div>
    <div class="front">
          <div class="img">
        <div class= student_data> 
    <div class = "new">

 <p> Name: <?php echo $data ?></p>
      <p> Gender: <?php echo $gender[$key] ?></p>
      <p> Email: <?php echo $email[$key] ?></p>
      <p> Phone: <?php echo $phone[$key] ?></p>
      <p> Subject: <?php echo $subject[$key] ?></p>
      <p> Standard: <?php echo $standard [$key]?></p>
      <p> Mode: <?php echo $mode[$key] ?></p>
      <p> Notes: <?php echo $notes[$key] ?></p>
        
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

else if(isset($_POST['updateButton'])){


    $lead_id = $_POST["updateId"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $mode = $_POST["mode"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $standard = $_POST["standard"];
    $notes = $_POST["notes"];
    $gender = $_POST["gender"];
    $user_id = $_POST["User_ID"];
    $lead_category = $_POST["lcategory"];
    $subject = $_POST["subject"];
    $udate = $_POST["udate"];




    $sql1 = "SELECT category_id FROM lead_category_entity WHERE category_name = '$lead_category'";
    $result = $conn->query($sql1);

    if ($result) {
        $row = $result->fetch_assoc();
        $category_id = $row['category_id'];
    }




    //Commission table entry upon successful sale
    if (isset($_POST["saleSwitch"])) {
        $saleStatus = true;

        $sql = "INSERT INTO commission_entity (Lead_id, User_id) Values('$lead_id', '$user_id')";
        $result = $conn->query($sql);
    }
    else $saleStatus = false;






    $sql = "UPDATE Lead_Entity
            SET First_Name = '$fname', Last_Name= '$lname', Mode= '$mode', Email= '$email', Phone= '$phone', Standard= '$standard', Gender= '$gender', User_ID= '$user_id', Category_ID= '$category_id', subject= '$subject', updated_date= '$udate', notes= '$notes'
                WHERE lead_id = '$lead_id'";
        $result = $conn->query($sql);


    $sql= "update Lead_entity set sale_status = $saleStatus where lead_id=  '$lead_id'";
    $saleResult = $conn->query($sql);






    //Update notification
    if($result){
        ?>

        <div class="notification" style="background-color: #D1FAE5 ; border: 1px solid #80b366">
            <h3> ✔️  Student Info Updated</h3>
        </div>
        <?php
    }


    else {
        ?>
        <div class="notification" style="background-color:#f4cccc; border: 1px solid #cc0000">
            <h3 style="margin-bottom: -7px;"> ❌ Student Info not Updated</h3>
        </div>

        <?php

    }


    //Sale notification
    if($result && $saleResult){
        ?>
        <div class="notification" style="background-color: #D1FAE5 ; border: 1px solid #80b366">
            <h3> 🥳 Congratulations, Sale Completed</h3>
        </div>
        <?php
    }





}




?>

 </div>


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




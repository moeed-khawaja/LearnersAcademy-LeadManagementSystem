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

    <style>

        .notification{
            padding-left: 15px;
            width: 300px;
            height: 65px;
            position: absolute;
            top: 175px;
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
        <h1>New Student</h1>
    </div> 




<br><br>


    <div id="forms_div" class="form">


        <form id="new_lead" action="newlead.php" method="post">

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
            <input type="hidden" id="countryCode" name="countryCode" />
            <input type= "text" id= "phone" name= "phone" class="input" > 
            <label for= "phone" class="label">Phone: </label> <br>
            <div class="top-line"></div>
            <div class="under-line"></div>
            <span class="input-border"></span>
            </div>    

            <br>



            <div class="test">    
            <label for= "standard" class="label_test">Standard: </label>
            <select id= "standard" name="standard" class="input_test">
                <option value= "Olevels">Olevels</option>
                <option value= "Alevels">Alevels</option>
            </select>
            <span class="input-border"></span>

        </div>




<br>

        
            <div class="test"> 
            <label for= "mode" class="label_test">Mode: </label>
            <div class="top-line"></div>
            <div class="under-line"></div>

            <select id= "mode" name= "mode" class="input_test">
                <option value= "Online">Online</option>
                <option value= "Physical">Physical</option>
            </select>
            </div>


</div>
<br><br>
<div class= "div_box" >

            <div class="input-container"> 
            <input type= "text" id= "subject" class="input" name= "subject" placeholder="Subject">
            <label for= "subject" class="label">Subject: </label> <br>
            <div class="top-line"></div>

            <span class="input-border"></span>
            </div>



             <br>


            <div class="input-container"> 
            <input type= "date" id= "cdate" name= "cdate" class="input" placeholder="Created Date" required>
            <label for= "cdate" class="label">Created Date: </label> 
            <div class="top-line"></div>
            <div class="under-line"></div>
             </div>


<br>

            
            <div class="input-container"> 
            <input type= "text" id= "notes"  class="input" name="notes" placeholder="Notes"> </input>
            <label for= "notes" class="label" >Notes: </label>
            <div class="top-line"></div>
            <span class="input-border"></span>
           </div>

           

            <br>

            

            <label for= "user" class="label_test">User: </label>
            <div class="test"> 

            <?php

            $sql = "SELECT CONCAT(First_Name, ' ', Last_Name) AS name FROM User_Entity";
            $result = $conn->query($sql);


            $names = [];
            while ($row = $result->fetch_assoc()) {
                $names[] = $row["name"];
            }

            ?>

            <select id="username" name="username" class="input_test">
            <?php

            foreach ($names as $name) {
                echo "<option value=\"$name\">$name</option>";
            }
            ?>

            <div class="top-line"></div>



        </select>

<br><br>
            <div class="test"> 
            <label for= "gender" class="label_test" >Gender : </label>
            <select class="input_test" id="gender" name="gender">
    <option value= "Male">Male</option>
    <option value= "Female">Female</option>
</select> </div> 



</div>

    </div>






            
            <div class="test"> 
            <label for= "lead_category" class="label_test" >Lead Category: </label>
            <select class="input_test" id="lcategory" name="lcategory">
    <option value= "Hot">Hot</option>
    <option value= "Medium">Medium</option>
    <option value= "Cold">Cold</option>
</select>


            <div class="under-line"></div>
        </div>

    </div>

            <br><br>    


            <input type="submit" name="submit" value="Submit" class="btn" id="submit_button" style="height: 50px;">
        </form>








    <script>
    function sendInfo(){
        var name= document.getElementById("fname").value;
        localStorage.setItem('fname', name);
        document.getElementById('new_lead').submit();

    }
</script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

<script>
    const phoneInputField = document.querySelector("#phone");
    const countryCodeInput = document.querySelector("#countryCode");

    const phoneInput = window.intlTelInput(phoneInputField, {
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        separateDialCode: true,  

    });


    phoneInputField.addEventListener("countrychange", function (e) {
        const selectedCountryCode = phoneInput.getSelectedCountryData().dialCode;
        countryCodeInput.value = selectedCountryCode;
    });
</script>



<?php


if (isset($_POST['submit'])) {

    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $countryCode = $_POST["countryCode"];
    $phone = $_POST["phone"];
    $standard = $_POST["standard"];
    $mode = $_POST["mode"];
    $subject = $_POST["subject"];
    $cdate = $_POST["cdate"];
    $notes = $_POST["notes"];
    $lcategory = $_POST["lcategory"];
    $gender = $_POST["gender"];
    $username = $_POST["username"];


list($firstName, $lastName) = explode(' ', $username, 2);

$fullPhoneNumber = $countryCode . $phone;


    $sqlUser = "select user_id from user_entity where First_Name = '$firstName' and Last_Name = '$lastName'";
    $result = $conn->query($sqlUser);

    $row = $result->fetch_assoc();


        $userID = $row['user_id'];


        $sqlCategory = "select category_id from lead_category_entity where Category_Name = '$lcategory' ";
        $result = $conn->query($sqlCategory);

        $row = $result->fetch_assoc();


        $leadCategory = $row['category_id'];


    $sql = "INSERT INTO lead_entity (First_Name, Last_Name,Email,Phone,Standard,Mode,Subject,Created_Date,Notes,User_ID,Category_ID,Gender, Sale_Status) VALUES ('$fname', '$lname','$email', '$fullPhoneNumber', '$standard','$mode','$subject','$cdate','$notes','$userID','$leadCategory', '$gender', 0)";
    $creation= $conn->query($sql);


    if ($creation) {

        ?>

        <div class="notification" style="background-color: #D1FAE5 ; border: 1px solid #80b366">
            <h3> ✔️  Student Successfully Created</h3>
        </div>
        <?php
    }


    else {
        ?>
        <div class="notification" style="background-color:#f4cccc; border: 1px solid #cc0000">
            <h3 style="margin-bottom: -7px;"> ❌ Student Creation Failed</h3>
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

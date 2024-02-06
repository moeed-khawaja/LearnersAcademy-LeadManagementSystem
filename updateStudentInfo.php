<?php
$db_hostname = 'localhost';
$db_database = 'learnersacademy';
$db_username = 'root';
$db_password = '1234';

$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);

if (isset($_GET['id'])) {
    $lead_id = $_GET['id'];
}

    $sqlName = "SELECT Lead_id, First_Name,Last_Name,Email,Phone,Standard, Mode, Subject, Notes, Gender, User_ID, Category_ID FROM Lead_Entity WHERE Lead_id = $lead_id";
    $result = $conn->query($sqlName);

    $row = $result->fetch_assoc();

    $id = $row["Lead_id"];
    $fn = $row['First_Name'];
    $ln = $row['Last_Name'];
    $mode = $row['Mode'];
    $email = $row['Email'];
    $phone = $row['Phone'];
    $standard = $row['Standard'];
    $subject = $row['Subject'];
    $notes = $row['Notes'];
    $gender = $row['Gender'];
    $user_id = $row['User_ID'];
    $lead_category_id = $row['Category_ID'];
    $saleSwitch = $row['Category_ID'];


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="index.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <link rel="stylesheet" href="updateStudentInfos.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
    <h1><?php echo $fn?></h1>
</div>



<br><br>


<div id="forms_div" class="form">


    <form id="new_lead" action="updateLead.php" method="post">

        <div class= "div_box">




            <div class="input-container">
                <input type= "text" id= "fname" name= "fname" class="input" placeholder= "First Name" value="<?php echo $fn ?>">
                <label for= "fname" class="label">First Name: </label>
                <div class="top-line"></div>
                <div class="under-line"></div>
                <span class="input-border"></span>
            </div>


            <br>

            <div class="input-container">
                <input type= "text" id= "lname" name= "lname"  class= "input" placeholder= "Last Name" value="<?php echo $ln ?>">
                <label for= "lname" class="label">Last Name: </label>
                <div class="top-line"></div>
                <div class="under-line"></div>
                <span class="input-border"></span>
            </div>



            <br>


            <div class="input-container">
                <input type= "text" id= "email" name= "email" placeholder="Email" class="input" value="<?php echo $email ?>">
                <label for= "email" class= "label">Email: </label> <br>
                <div class="top-line"></div>

                <span class="input-border"></span>
            </div>




            <div class="input-container">
                <input type="hidden" id="countryCode" name="countryCode" />
                <input type= "text" id= "phone" name= "phone" class="input" value="<?php echo $phone ?>" placeholder="Phone">
                <label for= "phone" class="label">Phone: </label> <br>
                <div class="top-line"></div>
                <span class="input-border"></span>
            </div>

            <br>



            <div class="test">
                <label for= "standard" class="label_test">Standard: </label>
                <select id= "standard" name="standard" class="input_test" value="<?php echo $standard ?>">
                    <option value="Olevels" <?php echo ($standard === 'Olevels') ? 'selected' : ''; ?>>Olevels</option>
                    <option value="Alevels" <?php echo ($standard === 'Alevels') ? 'selected' : ''; ?>>Alevels</option>

                </select>
                <span class="input-border"></span>

            </div>




            <br>


            <div class="test">
                <label for= "mode" class="label_test">Mode: </label>
                <div class="top-line"></div>
                <div class="under-line"></div>

                <select id= "mode" name= "mode" class="input_test">
                    <option value="Online" <?php echo ($mode === 'Online') ? 'selected' : ''; ?>>Online</option>
                    <option value="Physical" <?php echo ($mode === 'Physical') ? 'selected' : ''; ?>>Physical</option>
                </select>
            </div>


        </div>
        <br><br>
        <div class= "div_box" >

            <div class="input-container">
                <input type= "text" id= "subject" class="input" name= "subject" placeholder="Subject" value="<?php echo $subject ?>">
                <label for= "subject" class="label">Subject: </label> <br>
                <div class="top-line"></div>

                <span class="input-border"></span>
            </div>





            <p>Update Date:</p>
            <div class="input-container">
                <input type= "date" id= "udate" name= "udate" class="input" placeholder="Updated Date" required>
                <label for= "udate" class="label"></label>
                <div class="top-line"></div>
                <div class="under-line"></div>
            </div>


            <br>


            <div class="input-container">
                <input type= "text" id= "notes"  class="input" name="notes" placeholder="Notes" value="<?php echo $notes ?>"> </input>
                <label for= "notes" class="label" >Notes: </label>
                <div class="top-line"></div>
                <span class="input-border"></span>
            </div>



            <br>


            <label for="user" class="label_test">User: </label>
            <div class="test">

                <?php
                $sql = "SELECT CONCAT(First_Name, ' ', Last_Name) AS name, User_ID FROM User_Entity";
                $result = $conn->query($sql);

                $names = [];
                while ($row = $result->fetch_assoc()) {
                    $names[$row['User_ID']] = $row["name"];
                }

                $sqlLeadUser = "SELECT User_ID FROM Lead_entity WHERE Lead_id = '$lead_id'";
                $resultLeadUser = $conn->query($sqlLeadUser);

                if ($resultLeadUser && $resultLeadUser->num_rows > 0) {
                    $rowLeadUser = $resultLeadUser->fetch_assoc();
                    $selectedUserID = $rowLeadUser['User_ID'];
                } else {
                    $selectedUserID = "";
                }

                echo '<select id="username" name="User_ID" class="input_test">';
                foreach ($names as $userID => $name) {
                    $selected = ($userID == $selectedUserID) ? 'selected' : '';
                    echo "<option value=\"$userID\" $selected>$name</option>";
                }
                echo '</select>';
                ?>
                <div class="top-line"></div>
            </div>




                <br>
                <div class="test">
                    <label for= "gender" class="label_test" >Gender : </label>
                    <select class="input_test" id="gender" name="gender">
                        <option value="Male" <?php echo ($gender === 'Male') ? 'selected' : ''; ?>>Male</option>
                        <option value="Female" <?php echo ($gender === 'Female') ? 'selected' : ''; ?>>Female</option>
                    </select> </div>



            </div>










        <div class="test">
            <label for= "lead_category" class="label_test" >Lead Category: </label>
            <select class="input_test" id="lcategory" name="lcategory">
                <?php
                $lead_category_query = "SELECT Category_Name FROM lead_category_entity WHERE Category_ID = $lead_category_id ";
                $result = $conn->query($lead_category_query);
                $lead_category = strtolower(($result->fetch_assoc())['Category_Name'] ?? '');

                ?>
                <option value="Hot" <?php echo ($lead_category === 'hot') ? 'selected' : ''; ?>>Hot</option>
                <option value="Medium" <?php echo ($lead_category === 'medium') ? 'selected' : ''; ?>>Medium</option>
                <option value="Cold" <?php echo ($lead_category === 'cold') ? 'selected' : ''; ?>>Cold</option>

            </select>





            <div id="switch">
                <br><br>
                <h3 style="color: #0647a0; margin-bottom: -5px;" >Active Sale</h3>
                <label class="switch">
                    <input class="cb" type="checkbox" name="saleSwitch" />
                    <div class="toggle">
                        <span class="left">No</span>
                        <span class="right">Yes</span>
                    </div>
                </label>
            </div>








            </div>




</div>





<input type="hidden" name="updateId" value="<?php echo $id; ?>">
<button type="submit" name="updateButton"  id="submit_button" class="btn" >Update</button>

</form>

















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

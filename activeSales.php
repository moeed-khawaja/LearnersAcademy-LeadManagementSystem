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


    <link rel="stylesheet" href="deleteStudent.css" />


    <title>Lead Management System</title>


    <style>
        .clearAllButton{
            position: absolute;
            top: 200px;
            right: 50px;
        }

        .delete-button {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: rgb(255, 69, 69);
            border: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: white;
            cursor: pointer;
            transition-duration: 0.3s;
            overflow: hidden;
            position: relative;
        }

        .delete-svgIcon {
            width: 25px;
            transition-duration: 0.3s;
        }

        .delete-svgIcon path {
            fill: white;
        }

        .delete-button:hover {
            width: 90px;
            border-radius: 50px;
            transition-duration: 0.3s;
            background-color: rgb(255, 69, 69);
            align-items: center;
        }

        .delete-button:hover .delete-svgIcon {
            width: 20px;
            transition-duration: 0.3s;
            transform: translateY(60%);
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            transform: rotate(360deg);
        }

        .delete-button::before {
            display: none;
            content: "Delete All";
            color: white;
            transition-duration: 0.3s;
            font-size: 0.5px;
        }

        .delete-button:hover::before {
            display: block;
            padding-right: 10px;
            font-size: 13px;
            opacity: 1;
            transform: translateY(0px);
            transition-duration: 0.3s;
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
    <h1>Active Sales Record</h1>
</div>










<div class="search_c">
    <form method="post" action="activeSales.php" id="searchForm">
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


        $sqlName = "SELECT CONCAT(First_Name, ' ', Last_Name) as name, Lead_id, Standard, Email, Phone, Mode, Subject, Notes, Category_ID, Gender FROM Lead_Entity WHERE (First_Name LIKE '%$search%' OR Last_Name LIKE '%$search%') AND sale_status = 1";
        $result = $conn->query($sqlName);

        $sqlCategoryID = "SELECT Category_ID FROM Lead_Entity  where First_Name like '%$search%' or Last_Name like '%$search%";
        $categoryID= $conn->query($sqlCategoryID);


        $sqlCategoryName = "SELECT Category_Name FROM Lead_Category_Entity  where Category_ID = $categoryID";
        $categoryName= $conn->query($sqlCategoryName);






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
                            <h3 style="color: #0647a0;"> <?php echo $standard[$key] ?> </h3>


                        </div>
                    </div>
                    <div class="front">
                        <div class="img">
                            <div class= student_data>
                                <div class = "new">

                                    <p > Name: <?php echo $data ?></p>
                                    <p> Gender: <?php echo $gender[$key] ?></p>
                                    <p> Phone: <?php echo '+'.$phone[$key] ?></p>
                                    <p> Subject: <?php echo $subject[$key] ?></p>
                                    <p> Standard: <?php echo $standard [$key]?></p>
                                    <p> Mode: <?php echo $mode[$key] ?></p>



                                    <form method="POST" action="activeSales.php">
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

    $idToDelete = $_POST['idToDelete'];

    $sqlDel= "DELETE FROM commission_entity WHERE Lead_id= $idToDelete";
    $result = $conn->query($sqlDel);

    $sqlDel= "DELETE FROM Lead_entity WHERE Lead_id= $idToDelete";
    $result = $conn->query($sqlDel);






    if ($result) {

        ?>

        <div class="notification" style="background-color: #D1FAE5 ; border: 1px solid #80b366">
            <h3> ✔️  Student Successfully Deleted</h3>
        </div>
        <?php
    }


    else {
        ?>
        <div class="notification" style="background-color:#f4cccc; border: 1px solid #cc0000">
            <h3 style="margin-bottom: -7px;"> ❌ Student Deletion Failed</h3>
        </div>

        <?php

    }

}

?>







<div class="clearAllButton">

    <form method="POST" action="activeSales.php">
        <button class="delete-button" name="deleteAllButton">
    <svg class="delete-svgIcon" viewBox="0 0 448 512">
        <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"></path>
    </svg>
</button>
    </form>
</div>




<?php

    if (isset($_POST['deleteAllButton'])) {

        $sql= "DELETE FROM Lead_entity WHERE sale_status= 1";
        $result = $conn->query($sql);

        $sql= "DELETE FROM commission_entity";
        $result = $conn->query($sql);



        if ($result) {

            ?>

            <div class="notification" style="background-color: #D1FAE5 ; border: 1px solid #80b366">
                <h3> ✔️  Records Successfully Deleted</h3>
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




<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname  = "HotelDB";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if(isset($_POST['finish']))
    {
        $username  = $_POST['username'];
        $password  = $_POST['password'];

        //----------------------------------------------------------------------------------
        $result = mysqli_query($conn, "SELECT accountid FROM CustomerAccount WHERE username='$username' AND password='$password'"); 

        if (mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_assoc($result))
            {
               $id = $row["accountid"];
               $myfile = fopen("login.session", "w") or die("Unable to open file!");
               fwrite($myfile, $id);

               echo "<script>
                alert('Registration Successful!');
                window.location.href='../home2.html';
                </script>";
            }
         } else 
         {
            $adminacc = "SELECT * FROM Adminuser WHERE username= '".$_POST["username"]."'";
            $accresult = mysqli_query($conn, $adminacc);

            if(mysqli_num_rows($accresult) > 0)
            {
                echo "<script>
                window.location.href='../home3.html';
                </script>";
            }else
            {  
                echo "<script>
                alert('Incorrect Username or password!');
                window.location.href='../login.html';
                </script>";
                
            }
         }
         //------------------------------------------------------------------------------------
        
    }
}


?>

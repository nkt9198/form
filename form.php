<!DOCTYPE HTML>
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>

<?php

$link = mysqli_connect("localhost", "root","","user_form");
//Check Connection
if($link === false){
	die("ERROR: Could not connect.".mysql_connect_error());
}

// Escape user inputs for security
$fname = mysqli_real_escape_string($link, $_REQUEST['fname']);
$lname = mysqli_real_escape_string($link, $_REQUEST['lname']);
$email = mysqli_real_escape_string($link, $_REQUEST['email']);
$dob = mysqli_real_escape_string($link, $_REQUEST['dob']);
$mobile = mysqli_real_escape_string($link, $_REQUEST['mobile']);
$designation = mysqli_real_escape_string($link, $_REQUEST['designation']);
$gender = mysqli_real_escape_string($link, $_REQUEST['gender']);
$hobbies = mysqli_real_escape_string($link, $_REQUEST['hobbies']);
 
// Attempt insert query execution
$sql = "INSERT INTO user_info (fname, lname, email, dob, mobile, designation, gender, hobbies) 
VALUES ('$fname', '$lname', '$email', '$dob', '$mobile', '$designation', '$gender', '$hobbies')";
if(mysqli_query($link, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
?>

<?php
// define variables and set to empty values
$fnameErr = $lnameErr = $emailErr = $dobErr = $mobileErr = $designation = $genderErr = $hobbies = "";
$fname = $lname = $email = $dob = $mobile = $designation = $gender = $hobbies = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["fname"])) {
    $fnameErr = "FirstName is required";
  } else {
    $fname = test_input($_POST["fname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$fname)) {
      $fnameErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["lname"])) {
    $lnameErr = "LastName is required";
  } else {
    $lname = test_input($_POST["lname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$lname)) {
      $lnameErr = "Only letters and white space allowed";
    }
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }
  
  if (empty($_POST["dob"])) {
	  $dobErr = "DOB is required ";
  } else {
	  $dob = test_input($_POST["dob"]);
	  // check if dob only contains figure and whitespace
    }
	
	
  if (empty($_POST["mobile"])) {
    $mobileErr = "Mobile is required";
  } else {
    $mobile = test_input($_POST["mobile"]);
  }

  if (empty($_POST["designation"])) {
    $designation = "";
  } else {
    $designation = test_input($_POST["designation"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }
  
  if (empty($_POST["hobbies"])) {
    $hobbies = "";
  } else {
    $hobbies = test_input($_POST["hobbies"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>USER_INFO</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  FName: <input type="text" name="fname" value="<?php echo $fname;?>">
  <span class="error">* <?php echo $fnameErr;?></span>
  <br><br>
   LName: <input type="text" name="lname" value="<?php echo $lname;?>">
  <span class="error">* <?php echo $lnameErr;?></span>
  <br><br>
  E-mail: <input type="text" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  DOB: <input type="text" name="dob" value="<?php echo $dob;?>">
  <span class="error"><?php echo $dob;?></span>
  <br><br>
  Mobile: <input type="text" name="mobile" value="<?php echo $mobile;?>">
  <span class="error"><?php echo $mobile;?></span>
  <br><br>
  Designation: <input type="text" name="designation" value="<?php echo $designation;?>">
  <span class="error"><?php echo $designation;?></span>
  <br><br>
  Gender:
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">Other
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>
  Hobbies:
  <input type="checkbox" name="hobbies" <?php if (isset($hobbies) && $hobbies=="playing") echo "checked";?> value="playing">Playing
  <input type="checkbox" name="hobbies" <?php if (isset($hobbies) && $hobbies=="music") echo "checked";?> value="music">Music
  <input type="checkbox" name="hobbies" <?php if (isset($hobbies) && $hobbies=="singing") echo "checked";?> value="singing">Singing
  <input type="checkbox" name="hobbies" <?php if (isset($hobbies) && $hobbies=="reading") echo "checked";?> value="reading">Reading
  <span class="error"><?php echo $hobbies;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $fname;
echo "<br>";
echo $lname;
echo "<br>";
echo $email;
echo "<br>";
echo $dob;
echo "<br>";
echo $mobile;
echo "<br>";
echo $designation;
echo "<br>";
echo $gender;
echo "<br>";
echo $hobbies;

?>

</body>
</html>
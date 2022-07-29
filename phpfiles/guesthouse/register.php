<?php
$emptyerror = false;
$sucess = false;
$alreadyExist = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require("db.php");
    $tablename = 'login';
    $email = mysqli_real_escape_string($db, $_POST["email"]);
    $name = mysqli_real_escape_string($db, $_POST["name"]);
    $password = mysqli_real_escape_string($db, $_POST["password"]);
    $des = mysqli_real_escape_string($db, $_POST["des"]);
    $clgid = mysqli_real_escape_string($db, $_POST["clgid"]);
    $aadhaar = mysqli_real_escape_string($db, $_POST["aadhaar"]);
    $mob = mysqli_real_escape_string($db,$_POST["mob"]);

    if (empty($clgid) || empty($name) ||  empty($des) || empty($email) || empty($password) || empty($aadhaar) || empty($mob)) {
        $emptyerror = true;
    } else {
        $email .= "@iitp.ac.in";
        $query = "SELECT * from $tablename WHERE emailID = '$email'";
        $result = mysqli_query($db, $query) or die(mysqli_error($db));
        $num_rows = mysqli_num_rows($result);

        if ($num_rows > 0) {
            $alreadyExist = true;
        } else {
            $query = "INSERT INTO $tablename VALUES ('$email','$name','$password','$des','$clgid','$mob','$aadhaar')";
            mysqli_query($db, $query) or die(mysqli_error($db));

            $sucess = true;
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Register</title>
</head>

<body>
    <div class="col-md-4 container">
        <h1 style="text-align: center;">Register</h1>
        <?php
        if ($sucess) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Registeration successful
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        if ($emptyerror) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Enter all feilds!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        if ($alreadyExist) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Employee ID already exists. Try another
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        ?>
        <form action="register.php" method="post">
            <div>
                <label for="email" class="form-label">Email:</label>
                <input type="text" class="form-control" name="email" id="email">
                <div id="emailHelp" class="form-text">Enter email without @iitp.ac.in</div>
            </div>
            <div>
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" name="name" id="name">
            </div>
            <div>
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <div>
                <label for="des" class="form-label">Designation:</label>
                <select id="des" name="des" class="form-control">
                    <option disabled selected value> -- select an option -- </option>
                    <option value="Student">Student</option>
                    <option value="staff">Staff</option>
                </select>
            </div>
            <div>
                <label for="clgid" class="form-label">College ID/ Roll No:</label>
                <input type="text" class="form-control" name="clgid" id="clgid">
            </div>
            <div>
                <label for="mob" class="form-label">Mobile:</label>
                <input type="tel" class="form-control" name="mob" id="mob">
            </div>
            <div>
                <label for="aadhaar" class="form-label">Aadhaar:</label>
                <input type="text" class="form-control" name="aadhaar" id="aadhaar">
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-3">Submit</button>
        </form>
        <a href="login.php" class="d-block text-center mt-2">Login here?</a>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</html>
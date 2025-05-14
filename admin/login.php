<?php
session_start();
require_once 'define/define.php';
if(isset($_SESSION['ID'])) {
    header("location: ".ADMIN_URL."dashboard.php");
}
require_once 'classes/Authentication.php';

$msg = "";
if (isset($_SESSION['status'])) {
    $msg = $_SESSION['status'];
    unset($_SESSION['status']);
}

$loginObj = new Authentication();

if (isset($_POST['login'])) {
    // print_r($_POST); die;

    $email = mysqli_real_escape_string($loginObj->connection, $_POST['email']);
    $password = mysqli_real_escape_string($loginObj->connection, $_POST['password']);

    if (empty($email)) {
        $msg = "Email address is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = "Invailed email format";
    } elseif (empty($password)) {
        $msg = "Password is required";
    } else {
        $query = $loginObj->adminLoginById($email, $password);
        if ($query->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                $_SESSION['LOGGEDIN'] = true;
                $_SESSION['ID'] = $row['id'];
                $_SESSION['ROLE'] = $row['role'];
                $_SESSION['USERNAME'] = $row['username'];
                $_SESSION['NAME'] = $row['name'];

                $_SESSION['status'] = "Admin login successfully";
                header("location: " . ADMIN_URL . "dashboard.php");
                die();
            }
        } else {
            $_SESSION['status'] = "Email & password is not match!";
            header("location: " . ADMIN_URL . "login.php");
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Mobileshub - Admin Panel</title>
</head>

<body>
    <!-- Form Starts -->
    <div class="container py-5">
        <div class="row">
            <div class="col-md-3 m-auto">
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                    <caption class="mt-5 mb-4">
                        <h3 class="text-center text-dark mt-5 mb-3">Admin Panel</h3>
                    </caption>

                    <!-- MSG -->
                    <?php
                    if ($msg != "") {
                    ?>
                        <div class="alert alert-warning alert-dismissible fade show m-auto mb-2 w-100" role="alert">
                            <strong>Hey!</strong> <?php echo $msg; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } ?>
                    <!-- MSG -->

                    <div class="form-floating mb-2">
                        <input type="email" name="email" class="form-control" id="floatingInput" placeholder="example@gmail.com">
                        <label for="floatingInput">Email Address</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" name="password" class="form-control" id="floatingInput" placeholder="Password">
                        <label for="floatingInput">Password</label>
                    </div>

                    <div class="form-floating mb-4">
                        <button type="submit" name="login" value="login" class="btn btn-primary btn-sm d-block border-0 bg-dark w-100">Log In</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- Form End -->
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</html>
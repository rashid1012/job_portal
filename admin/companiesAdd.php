<?php
require_once 'session/session.php';
require_once 'define/define.php';
require_once 'classes/Companies.php';

$msg = "";
if (isset($_SESSION['status'])) {
    $msg = $_SESSION['status'];
    unset($_SESSION['status']);
}

$companiesObj = new Companies();

if (isset($_POST['addCompanies'])) {
    // print_r($_POST); die;

    $name = $_POST['name'];
    $email = mysqli_real_escape_string($companiesObj->connection, $_POST['email']);
    $password = mysqli_real_escape_string($companiesObj->connection, $_POST['password']);
    $website = $_POST['website'];
    $location = $_POST['location'];
    $description = $_POST['description'];

    if (empty($name)) {
        $msg = "Companies Name is required.";
    } elseif (!preg_match("/^[a-zA-Z.'\- ]*$/", $name)) {
        $msg = "Only letters, spaces, dots, apostrophes, and hyphens are allowed";
    } elseif (empty($email)) {
        $msg = "Email address is required";
    } elseif ($companiesObj->emailExists($email)) {
        $msg = "This email is already registered. Please use a different one.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = "Invailed email format";
    } elseif (empty($password)) {
        $msg = "Password is required";
    } elseif (strlen($password) < 6) {
        $msg = "Password must be at least 6 characters long";
    } elseif (empty($website)) {
        $msg = "Website is required";
    } elseif (!preg_match("/^[a-zA-Z.'\- ]*$/", $name) && !filter_var($name, FILTER_VALIDATE_URL)) {
        $msg = "Enter a valid name or a valid URL (e.g., http://rashid.com/)";
    } elseif (empty($location)) {
        $msg = "Location is required";
    } elseif (empty($description)) {
        $msg = "Description is required";
    } else {
        $query = $companiesObj->companiesAdd($name, $email, $password, $website, $location, $description);
        // print_r($_POST);
        // die;
        if ($query) {
            $_SESSION['status'] = "Companies Inserted Successfully";
            header("location: " . ADMIN_URL . "companiesList.php");
        } else {
            $_SESSION['status'] = "Something went wrong.!";
            header("location: " . ADMIN_URL . "companiesAdd.php");
        }
    }
}

?>

<!-- Header Include -->
<?php require_once 'templates/header.php'; ?>

<!-- Sidebar Include -->
<?php require_once 'templates/sidebar.php'; ?>

<div class="main">
    <div class="container mt-3">
        <div class="mb-3">
            <h3>Add Companies</h3>
        </div>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-1 bg-body-tertiary rounded-3">
                <li class="breadcrumb-item">
                    <a class="link-body-emphasis" href="dashboard.php">
                        <i class="bi bi-house-fill"></i>
                        <span class="visually-hidden">Home</span>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a class="link-body-emphasis fw-semibold text-decoration-none" href="companiesList.php">Companies</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Add Companies
                </li>
            </ol>
        </nav>
        <!-- Breadcrumb -->

        <!-- MSG -->
        <?php
        if ($msg != "") {
        ?>
            <div class="alert alert-warning alert-dismissible fade show m-auto mb-2 w-50" role="alert">
                <strong>Hey!</strong> <?php echo $msg; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>
        <!-- MSG -->

        <!-- Form Starts -->
        <div class="col-lg-4 m-auto">
            <div class="card">
                <div class="card-body">
                    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">

                        <!-- Companies Name -->
                        <div class="form-floating mb-2">
                            <input type="text" name="name" value="" class="form-control" placeholder="Enter Companies name" />
                            <label for="">Companies Name</label>
                        </div>

                        <!-- Emaill Address -->
                        <div class="form-floating mb-2">
                            <input type="text" name="email" value="" class="form-control" placeholder="Enter employee email address" />
                            <label for="">Email Address</label>
                        </div>

                        <!-- Password -->
                        <div class="form-floating mb-2">
                            <input type="password" name="password" value="" class="form-control" placeholder="Enter employee password" />
                            <label for="">Password</label>
                        </div>

                        <!-- Website -->
                        <div class="form-floating mb-2">
                            <input type="text" name="website" value="" class="form-control" placeholder="Enter website address" />
                            <label for="">Website</label>
                        </div>

                        <!-- Location -->
                        <div class="form-floating mb-2">
                            <input type="text" name="location" value="" class="form-control" placeholder="Enter location" />
                            <label for="">Location</label>
                        </div>

                        <!-- Description -->
                        <div class="form-floating mb-2">
                            <input type="text" name="description" value="" class="form-control" placeholder="Enter description" />
                            <label for="">Description</label>
                        </div>

                        <div class="form-floating text-center">
                            <button class="btn btn-success btn-sm border-0" name="addCompanies">Add Companies</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Form Ends -->
    </div>
</div>
<!-- Main Ends -->

<!-- Footer Include -->
<?php require_once 'templates/footer.php'; ?>
<?php
require_once 'session/session.php';
require_once 'define/define.php';
require_once 'classes/Candidates.php';

$msg = "";
if (isset($_SESSION['status'])) {
    $msg = $_SESSION['status'];
    unset($_SESSION['status']);
}

$candidatesObj = new Candidates();

// Display Query Here
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    // print_r($id); die;
    $candidatesShow = $candidatesObj->candidatesShowById($id);
}

if (isset($_POST['updateCandidates'])) {
    // print_r($_POST); die;

    $name = $_POST['name'];
    $email = mysqli_real_escape_string($candidatesObj->connection, $_POST['email']);
    $password = mysqli_real_escape_string($candidatesObj->connection, $_POST['password']);
    $skills = $_POST['skills'];
    $experience = $_POST['experience'];

    if (empty($name)) {
        $msg = "Candidates Name is required.";
    } elseif (!preg_match("/^[a-zA-Z.'\- ]*$/", $name)) {
        $msg = "Only letters, spaces, dots, apostrophes, and hyphens are allowed";
    } elseif (empty($email)) {
        $msg = "Email address is required";
    } elseif ($candidatesObj->emailExists($email)) {
        $msg = "This email is already registered. Please use a different one.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = "Invailed email format";
    } elseif (empty($password)) {
        $msg = "Password is required";
    } elseif (strlen($password) < 6) {
        $msg = "Password must be at least 6 characters long";
    } else {
        $query = $candidatesObj->candidatesAdd($name, $email, $password, $skills, $experience);
        // print_r($_POST);
        // die;
        if ($query) {
            $_SESSION['status'] = "Candidates Inserted Successfully";
            header("location: " . ADMIN_URL . "candidatesList.php");
        } else {
            $_SESSION['status'] = "Something went wrong.!";
            header("location: " . ADMIN_URL . "candidatesAdd.php");
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
            <h3>Edit Candidates</h3>
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
                    <a class="link-body-emphasis fw-semibold text-decoration-none" href="candidatesList.php">Candidates</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Edit Candidates
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
                    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                        <?php
                        while ($row = mysqli_fetch_array($candidatesShow)) {
                        ?>
                            <!-- Candidates Name -->
                            <div class="form-floating mb-2">
                                <input type="text" name="name" value="<?php echo $row['name'] ?>" class="form-control" placeholder="Enter Candidates name" />
                                <label for="">Candidates Name</label>
                            </div>

                            <!-- Emaill Address -->
                            <div class="form-floating mb-2">
                                <input type="text" name="email" value="<?php echo $row['email'] ?>" class="form-control" placeholder="Enter employee email address" />
                                <label for="">Email Address</label>
                            </div>

                            <!-- Resume -->
                            <!-- <div class="form-floating mb-2">
                            <input type="text" name="resume" value="" class="form-control" placeholder="Upload resume" />
                            <label for="">Resume</label>
                        </div> -->

                            <!-- Skills -->
                            <div class="form-floating mb-2">
                                <input type="text" name="skills" value="<?php echo $row['skills'] ?>" class="form-control" placeholder="Enter skills" />
                                <label for="">Skills</label>
                            </div>

                            <!-- Experience -->
                            <div class="mb-2">
                                <label class="form-control">
                                    <label>Experience</label>
                                    <select name="experience" required class="form-control">
                                        <option value="<?php echo $row['experience'] ?>">Select Experience</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                </label>
                            </div>

                            <div class="form-floating text-center">
                                <button class="btn btn-success btn-sm border-0" name="updateCandidates">Update Candidates</button>
                            </div>
                        <?php
                        }
                        ?>
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
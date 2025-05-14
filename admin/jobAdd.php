<?php
require_once 'session/session.php';
require_once 'define/define.php';
require_once 'classes/Job.php';

$msg = "";
if (isset($_SESSION['status'])) {
    $msg = $_SESSION['status'];
    unset($_SESSION['status']);
}

$jobObj = new Job();

if (isset($_POST['addJob'])) {
    // print_r($_POST); die;

    $company_id = $_POST['company_id'];
    $category_id = $_POST['category_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $salary = $_POST['salary'];
    $type = $_POST['type'];
    $status = $_POST['status'];

    if (empty($title)) {
        $msg = "Job title name is required.";
    } elseif (!preg_match("/^[a-zA-Z.'\- ]*$/", $title)) {
        $msg = "Only letters, spaces, dots, apostrophes, and hyphens are allowed";
    } elseif (empty($description)) {
        $msg = "Job description is required.";
    } elseif (empty($location)) {
        $msg = "Job location is required.";
    } elseif (empty($salary)) {
        $msg = "Job salary is required.";
    } elseif (!preg_match('/^\d+(\.\d{1,2})?$/', $salary)) {
        $msg = "Salary must be a valid number (e.g., 5000 or 5000.50)";
    } else {
        $query = $jobObj->jobAdd($company_id, $category_id, $title, $description, $location, $salary, $type, $status);
        // print_r($_POST);
        // die;
        if ($query) {
            $_SESSION['status'] = "Job Categories Inserted Successfully";
            header("location: " . ADMIN_URL . "jobList.php");
        } else {
            $_SESSION['status'] = "Something went wrong.!";
            header("location: " . ADMIN_URL . "jobList.php");
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
            <h3>Add Job</h3>
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
                    <a class="link-body-emphasis fw-semibold text-decoration-none" href="jobList.php">Job</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Add Job
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

                        <!-- company id -->
                        <div class="mb-2">
                            <label class="form-control">
                                <label>Select Company</label>
                                <select name="company_id" required class="form-control">
                                    <option value="">Select Companies</option>
                                    <?php
                                    $res = mysqli_query($jobObj->connection, "SELECT * FROM companies ORDER BY name DESC");
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </label>
                        </div>

                        <!-- Job Categories -->
                        <div class="mb-2">
                            <label class="form-control">
                                <label>Select Job Categories</label>
                                <select name="category_id" required class="form-control">
                                    <option value="">Select Job Categories</option>
                                    <?php
                                    $res = mysqli_query($jobObj->connection, "SELECT * FROM job_categories ORDER BY name DESC");
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </label>
                        </div>

                        <!-- Job Title Name -->
                        <div class="form-floating mb-2">
                            <input type="text" name="title" value="" class="form-control" placeholder="Enter Job Title" />
                            <label for="">Title</label>
                        </div>

                        <!-- Job description -->
                        <div class="form-floating mb-2">
                            <input type="text" name="description" value="" class="form-control" placeholder="Enter Job Description" />
                            <label for="">Description</label>
                        </div>

                        <!-- Job location -->
                        <div class="form-floating mb-2">
                            <input type="text" name="location" value="" class="form-control" placeholder="Enter Job location" />
                            <label for="">Location</label>
                        </div>

                        <!-- Job salary -->
                        <div class="form-floating mb-2">
                            <input type="text" name="salary" value="" class="form-control" placeholder="Enter Job salary" />
                            <label for="">Salary</label>
                        </div>

                        <!-- Type -->
                        <div class="mb-2">
                            <label for="" class="">Type</label>
                            <input type="radio" name="type" value="Full-time" placeholder="" checked />Full-time
                            <input type="radio" name="type" value="Part-time" placeholder="" />Part-time
                            <input type="radio" name="type" value="Contract" placeholder="" />Contract
                            <input type="radio" name="type" value="Internship" placeholder="" />Internship
                        </div>

                        <!-- Status -->
                        <div class="mb-2">
                            <label for="" class="">Status</label>
                            <input type="radio" name="status" value="Open" placeholder="" checked />Open
                            <input type="radio" name="status" value="Closed" placeholder="" />Closed
                        </div>

                        <div class="form-floating text-center">
                            <button class="btn btn-success btn-sm border-0" name="addJob">Add Job</button>
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
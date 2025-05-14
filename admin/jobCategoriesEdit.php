<?php
require_once 'session/session.php';
require_once 'define/define.php';
require_once 'classes/JobCategories.php';

$msg = "";
if (isset($_SESSION['status'])) {
    $msg = $_SESSION['status'];
    unset($_SESSION['status']);
}

$jobCategoriesObj = new JobCategories();

// Display Query Here
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    // print_r($id); die;
    $jobCategoriesShow = $jobCategoriesObj->jobCategoriesDisplayShowById($id);
}

if (isset($_POST['updateJobCategories'])) {
    // print_r($_POST); die;

    $name = $_POST['name'];

    if (empty($name)) {
        $msg = "Job Categories Name is required.";
    } elseif (!preg_match("/^[a-zA-Z.'\- ]*$/", $name)) {
        $msg = "Only letters, spaces, dots, apostrophes, and hyphens are allowed";
    } else {
        $query = $jobCategoriesObj->jobCategoriesDisplayUpdate($id, $name);
        // print_r($_POST);
        // die;
        if ($query) {
            $_SESSION['status'] = "Job Categories Updated Successfully";
            header("location: " . ADMIN_URL . "jobCategoriesList.php");
        } else {
            $_SESSION['status'] = "Something went wrong.!";
            header("location: " . ADMIN_URL . "jobCategoriesEdit.php");
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
            <h3>Edit Job Categories</h3>
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
                    <a class="link-body-emphasis fw-semibold text-decoration-none" href="jobCategoriesList.php">Job Categories</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Edit Job Categories
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
                    <form action="<?php echo $_SERVER["PHP_SELF"] . "?id=" . $_GET['id']; ?>" method="post">
                        <?php
                        while ($row = mysqli_fetch_array($jobCategoriesShow)) {
                        ?>
                            <!-- Job Categories Name -->
                            <div class="form-floating mb-2">
                                <input type="text" name="name" value="<?php echo $row['name'] ?>" class="form-control" placeholder="Enter Job Categories" />
                                <label for="">Job Categories</label>
                            </div>

                            <div class="form-floating text-center">
                                <button class="btn btn-success btn-sm border-0" name="updateJobCategories">Update Job Categories</button>
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
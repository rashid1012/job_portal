<?php
require_once 'define/define.php';
require_once 'session/session.php';
require_once 'classes/Companies.php';
require_once 'classes/JobCategories.php';
require_once 'classes/Job.php';
require_once 'classes/Candidates.php';
require_once 'classes/Applications.php';

$msg = "";
if (isset($_SESSION['status'])) {
    $msg = $_SESSION['status'];
    unset($_SESSION['status']);
}

?>
<!-- Header Include -->
<?php require_once 'templates/header.php' ?>

<!-- Sidebar Include -->
<?php require_once 'templates/sidebar.php' ?>

<div class="main">
    <div class="mt-3 mb-4">
        <h4>Dashboard</h4>
    </div>

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

    <div>
        <div class="row">
            <div class="col-sm-3 mb-3 mb-sm-0">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Total Companies</h5>
                        <p class="card-text text-center fs-4 fw-bold">
                            <?php
                            $obj = new Companies();
                            $data = $obj->total_companies();
                            // $data = $data->fetch_array();
                            $result = mysqli_num_rows($data);
                            print_r($result);
                            ?>
                        </p>
                        <div class="text-center">
                            <a href="companiesList.php" class="text-center text-decoration-none">Companies</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 mb-3 mb-sm-0">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Total Jobs</h5>
                        <p class="card-text text-center fs-4 fw-bold">
                            <?php
                            $obj = new Job();
                            $data = $obj->total_jobDisplay();
                            // $data = $data->fetch_array();
                            $result = mysqli_num_rows($data);
                            print_r($result);
                            ?>
                        </p>
                        <div class="text-center">
                            <a href="jobList.php" class="text-center text-decoration-none">Jobs</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 mb-3 mb-sm-0">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Total Candidates</h5>
                        <p class="card-text text-center fs-4 fw-bold">
                            <?php
                            $obj = new Candidates();
                            $data = $obj->total_candidates();
                            // $data = $data->fetch_array();
                            $result = mysqli_num_rows($data);
                            print_r($result);
                            ?>
                        </p>
                        <div class="text-center">
                            <a href="candidatesList.php" class="text-center text-decoration-none">Candidates</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Total Applications</h5>
                        <p class="card-text text-center fs-4 fw-bold">
                        <?php
                            $obj = new Applications;
                            $data = $obj->total_applications();
                            // $data = $data->fetch_array();
                            $result = mysqli_num_rows($data);
                            print_r($result);
                            ?>
                        </p>
                        <div class="text-center">
                            <a href="applicationsList.php" class="text-center text-decoration-none">Applications</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 mb-3 mb-sm-0 mt-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Total Job Categories</h5>
                        <p class="card-text text-center fs-4 fw-bold">
                            <?php
                            $obj = new JobCategories();
                            $data = $obj->total_jobCategoriesDisplay();
                            // $data = $data->fetch_array();
                            $result = mysqli_num_rows($data);
                            print_r($result);
                            ?>
                        </p>
                        <div class="text-center">
                            <a href="jobCategoriesList.php" class="text-decoration-none">Job Categories</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Footer Include -->
<?php require_once 'templates/footer.php' ?>
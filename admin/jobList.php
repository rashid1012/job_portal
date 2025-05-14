<?php
require_once 'session/session.php';
require_once 'classes/Job.php';

$msg = "";
if (isset($_SESSION['status'])) {
    $msg = $_SESSION['status'];
    unset($_SESSION['status']);
}

$JobObj = new Job();
?>

<!-- Header Include -->
<?php require_once 'templates/header.php'; ?>

<!-- Sidebar Include -->
<?php require_once 'templates/sidebar.php'; ?>

<div class="main">
    <div class="mb-3">
        <h3>Job</h3>
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
            <li class="breadcrumb-item active" aria-current="page">
                Job
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

    <div class="mb-3">
        <a href="jobAdd.php" class="btn btn-primary btn-sm">Add Job</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">TITLE</th>
                <th scope="col">LOCATION</th>
                <th scope="col">SALARY</th>
                <th scope="col">TYPE</th>
                <th scope="col">STATUS</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
            $data = $JobObj->jobDisplay();
            $index = 1;
            // // echo "<pre>";
            // // print_r($data);die;
            foreach ($data as $data) {
            ?>
                <tr>
                    <td><?= $index++; ?></td>
                    <td><?php echo $data['title']; ?></td>
                    <td><?php echo $data['location']; ?></td>
                    <td><?php echo $data['salary']; ?></td>
                    <td><?php echo $data['type']; ?></td>
                    <td><?php echo $data['status']; ?></td>
                    <td>
                        <a href="jobEdit.php?id=<?php echo $data['id'] ?>"><i class="bi bi-pencil-square text-dark"></i></a>
                        <a href="jobDelete.php?id=<?php echo $data['id'] ?>"><i class="bi bi-trash3 text-dark"></i></a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

</div>

<!-- Footer Include -->
<?php require_once 'templates/footer.php'; ?>
use JobCategories;
<?php
require_once 'session/session.php';
require_once 'classes/Candidates.php';

$msg = "";
if (isset($_SESSION['status'])) {
    $msg = $_SESSION['status'];
    unset($_SESSION['status']);
}

$candidatesObj = new Candidates();


?>

<!-- Header Include -->
<?php require_once 'templates/header.php'; ?>

<!-- Sidebar Include -->
<?php require_once 'templates/sidebar.php'; ?>

<div class="main">
    <div class="mb-3">
        <h3>Candidates</h3>
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
                Candidates
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
        <a href="candidatesAdd.php" class="btn btn-primary btn-sm">Add Candidates</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">NAME</th>
                <th scope="col">EMAIL</th>
                <th scope="col">SKILLS</th>
                <th scope="col">EXPERIENCE</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
            $candidatesDetails = $candidatesObj->candidatesDisplay();
            $index = 1;
            // echo "<pre>";
            // print_r($categoryDetails);die;
            foreach ($candidatesDetails as $candidatesDetails) {
            ?>
                <tr>
                    <td><?= $index++; ?></td>
                    <td><?php echo $candidatesDetails['name']; ?></td>
                    <td><?php echo $candidatesDetails['email']; ?></td>
                    <td><?php echo $candidatesDetails['skills']; ?></td>
                    <td><?php echo $candidatesDetails['experience']; ?></td>
                    <td>
                        <a href="candidatesEdit.php?id=<?php echo $candidatesDetails['id'] ?>"><i class="bi bi-pencil-square text-dark"></i></a>
                        <a href="candidatesDelete.php?id=<?php echo $candidatesDetails['id'] ?>"><i class="bi bi-trash3 text-dark"></i></a>
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
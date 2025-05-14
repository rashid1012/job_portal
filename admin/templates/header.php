<?php
// require_once 'define/define.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Job Portal</title>
</head>

<body>

    <header>
        <div class="px-3 py-3 border-bottom mb-3 float-end" style="width: 79%;">
            <div class="container d-flex flex-wrap justify-content-center">
                <form action="" method="GET" class="col-12 col-lg-auto d-flex mb-2 mb-lg-0 me-lg-auto">
                    <input type="text" name="search" class="form-control" placeholder="Search..." aria-label="Search">
                    <button type="submit" class="btn btn-primary mx-1">Search</button>
                </form>

                <div class="dropdown text-end">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                        <?= $_SESSION['NAME'] ?? null; ?>
                    </a>
                    <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="profile.php">My Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="logout.php?do=logout">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
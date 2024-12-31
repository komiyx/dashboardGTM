<?php
session_start();
include("./auth/connect.php");
if (!isset($_SESSION['valid'])) {
    header("Location: index.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>GTMBest - MY Data</title>
    <link rel="icon" type="image/png" href="img/aside-logo.png">
    <link type="text/css" rel="stylesheet" href="./flaviusmatis-simplePagination.js-da97104/simplePagination.css"/>
    <link rel="preload" as="style" onload="this.onload=null; this.rel='stylesheet'" href="./css/style.css">
    <link rel="preload" as="style" onload="this.onload=null; this.rel='stylesheet'" href="./css/home.css">
    <!-- Boostrap CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.min.js"></script>
    <!-- Font Awesome Icon -->
    <script src="https://kit.fontawesome.com/739d991940.js" crossorigin="anonymous"></script>
    <script src="./js/script.js" crossorigin="anonymous"></script>
    <style>
        #content {
            opacity: 1;
            transition: opacity 0.5s ease-in-out;
        }

        #content.fade-out {
            opacity: 0;
        }
    </style>
</head>

<body>
    <main class="app">
        <div class="app-wapper">
            <!-- navbar -->
            <div class="app-aside">
                <div class="app-aside-header">
                    <img src="./img/aside-logo.png" alt="">
                </div>
                <div class="el-scrollbar app-aside-main">
                    <div class="el-scrollbar-wrap el-scrollbar-wrap-hidden-default">
                        <div class="el-scrollbar-view">
                            <ul class="el-menu el-menu-vertical app-menu app-aside-main-menus">
                                <li class="el-menu-item menu-item load-content ">
                                    <a href="./home.php" class="el-menu-item">
                                        <div class="menu-item-content d-flex align-items-center">
                                            <i class="fa-solid fa-house-chimney"></i>
                                            <span class="text-capitalize ml-3">All Brand</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="el-menu-item menu-item load-content">
                                    <a href="./newdata.php" class="el-menu-item">
                                        <div class="menu-item-content d-flex align-items-center">
                                            <i class="fa-solid fa-circle-plus"></i>
                                            <span class="text-capitalize ml-3">New Add</span>
                                        </div>
                                    </a>
                                </li>
                                <div class="d-flex align-items-center">
                                    <div class="menu-item-title ">
                                        Section
                                    </div>
                                </div>
                                <li class="el-menu-item menu-item load-content">
                                    <a href="./indo_data.php" class="el-menu-item">
                                        <div class="menu-item-content d-flex align-items-center">
                                            <i class="fa-brands fa-app-store"></i>
                                            <span class="text-capitalize ml-3">INDO DATA</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="el-menu-item menu-item load-content is-active">
                                    <a href="./my_data.php" class="el-menu-item">
                                        <div class="menu-item-content d-flex align-items-center">
                                            <i class="fa-brands fa-app-store"></i>
                                            <span class="text-capitalize ml-3">MY DATA</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="el-menu-item menu-item load-content">
                                    <a href="./th_data.php" class="el-menu-item">
                                        <div class="menu-item-content d-flex align-items-center">
                                            <i class="fa-brands fa-app-store"></i>
                                            <span class="text-capitalize ml-3">TH DATA</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="el-menu-item menu-item load-content">
                                    <a href="./bdt_data.php" class="el-menu-item">
                                        <div class="menu-item-content d-flex align-items-center">
                                            <i class="fa-brands fa-app-store"></i>
                                            <span class="text-capitalize ml-3">BDT DATA</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content -->
            <div class="d-flex overflow-hidden flex-column flex-1">
                <div class="el-scrollbar app-main">
                    <div class="el-scrollbar-wrap el-scrollbar-wrap-hidden-default">
                        <div class="el-scrollbar-view" id="app-main">
                            <div class="header-wrapper">
                                <div class="placeholder"></div>
                                <div class="header d-flex justify-content-between align-items-center">
                                    <div class="title-top-nav text-uppercase">
                                        MY Data
                                    </div>
                                    <div class="d-flex items-ceter pr-5">
                                        <div class="d-flex items-center mr-5">
                                            <img src="./img/default-avatar.png" alt="" class="mr-2">
                                            <div class="span">
                                                <?php

                                                $id = $_SESSION['id'];
                                                $query = mysqli_query($conn, "SELECT*FROM users WHERE Id=$id");
                                                while ($result = mysqli_fetch_assoc($query)) {
                                                    $res_Email = $result['Email'];
                                                }

                                                echo $res_Email;
                                                ?>
                                            </div>
                                        </div>
                                        <a class="d-flex align-items-center cursor-pointer" href="./auth/logout.php">
                                            <i class="fa-solid fa-right-from-bracket mr-2"></i>
                                            <div class="text-33">LogOut</div>
                                        </a>
                                    </div>
                                </div>
                            </div>  
                            <div class="page-container w-100 h-100">
                                <!-- import section -->
                                <div class="wrapper" id="content">

                                    <div class="card-container">
                                        <div class="table-container">
                                            <div class="header mb-3">
                                                    <div class="el-row d-flex justify-content-between">
                                                        <div class="el-row">
                                                            <div class="el-form-item asterisk-left">
                                                                <div class="el-form-item-content">
                                                                    <button type="button" class="btn btn-primary" style="margin-left: 12px;" data-toggle="modal" data-target="#exportModal">
                                                                        Export as Excel
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="el-table-fit el-table">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered">
                                                        <thead class="thead-dark">
                                                            <tr>
                                                                <th style="min-width: 100px;">Deposit User</th>
                                                                <th style="min-width: 100px;">Username</th>
                                                                <th style="min-width: 130px;">Passowrd</th>
                                                                <th>FullName</th>
                                                                <th>Email</th>
                                                                <th>Mobile</th>
                                                                <th>bank</th>
                                                                <th>bankno</th>
                                                                <th>ewalletnum</th>
                                                                <th>URL</th>
                                                                <th>Created Time</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php

                                                                $query = "SELECT *
                                                                        FROM my_user_records 
                                                                        ORDER BY deposit_status DESC, created_time DESC LIMIT 20000";

                                                                $result = $conn->query($query);
                                                                
                                                                // Check if there are results
                                                                if ($result && $result->num_rows > 0) {
                                                                    // Loop through the results and output rows
                                                                    while ($row = $result->fetch_assoc()) {
                                                                        echo "<tr class='list-item'>";
                                                                        echo "<td>" . htmlspecialchars($row['deposit_status']) . "</td>";
                                                                        echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                                                                        echo "<td>" . htmlspecialchars($row['password']) . "</td>";
                                                                        echo "<td>" . htmlspecialchars($row['fullname']) . "</td>";
                                                                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                                                        echo "<td>" . htmlspecialchars($row['mobile']) . "</td>";
                                                                        echo "<td>" . htmlspecialchars($row['bank']) . "</td>";
                                                                        echo "<td>" . htmlspecialchars($row['bankno']) . "</td>";
                                                                        echo "<td>" . htmlspecialchars($row['ewalletnum']) . "</td>";
                                                                        echo "<td>" . htmlspecialchars($row['url']) . "</td>";
                                                                        echo "<td>" . htmlspecialchars($row['created_time']) . "</td>";
                                                                        echo "</tr>";
                                                                    }
                                                                } else {
                                                                    // If no data is found
                                                                    echo "<tr><td colspan='11' class='text-center'>No records found.</td></tr>";
                                                                }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div id="pagination-container" class="light-theme mt-4 d-flex justify-content-end"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <div class="modal fade" id="exportModal" tabindex="-1" role="dialog" aria-labelledby="exportModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exportModalLabel">Export by Filters</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="./controller/export_my.php">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="start_date">Start Date:</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>
                        <div class="form-group">
                            <label for="end_date">End Date:</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" required>
                        </div>
                        <div class="form-group">
                            <label for="limit">Number of Data:</label>
                            <select class="form-control" id="limit" name="limit" required>
                                <option value="all">All Records</option>
                                <option value="100">100</option>
                                <option value="500">500</option>
                                <option value="1000">1000</option>
                                <option value="5000">5000</option>
                                <option value="10000">10000</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Export</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./flaviusmatis-simplePagination.js-da97104/jquery.simplePagination.js"></script>
    <script>

            var items = $(".list-item");
            var numItems = items.length;
            var perPage = 10;

            items.slice(perPage).hide();

            $(document).ready(function () {


                $('#pagination-container').pagination({
                    items: numItems,
                    itemsOnPage: perPage,
                    prevText: "&laquo;",
                    nextText: "&raquo;",
                    onPageClick: function (pageNumber) {
                        var showFrom = perPage * (pageNumber - 1);
                        var showTo = showFrom + perPage;
                        items.hide().slice(showFrom, showTo).show();
                    }
                });
            });


    </script>
</body>

</html>
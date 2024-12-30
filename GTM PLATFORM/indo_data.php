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
    <title>GTMBest - INDO Data</title>
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
                                <li class="el-menu-item menu-item load-content is-active">
                                    <a href="./indo_data.php" class="el-menu-item">
                                        <div class="menu-item-content d-flex align-items-center">
                                            <i class="fa-brands fa-app-store"></i>
                                            <span class="text-capitalize ml-3">INDO DATA</span>
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
                                        Indo Data
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
                                                                    <form method="POST" action="./controller/export.php">
                                                                        <button type="submit" class="el-button el-button-reset" style="margin-left: 12px;">Export as Excel</button>
                                                                    </form>
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
                                                                <th>Bank / Emoney Selected</th>
                                                                <th>Bank / Emoney </th>
                                                                <th>Bank / Emoney Name</th>
                                                                <th>BankNo / EmoneyNo</th>
                                                                <th>URL</th>
                                                                <th>Created Time</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php

                                                                $query = "SELECT username, password, fullname, email, deposit_status, mobile, bank_emoney_selected, bank_emoney, bank_emoney_name, bank_no_emoney_no, url, created_time 
                                                                        FROM indo_user_records 
                                                                        ORDER BY deposit_status DESC, created_time DESC";

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
                                                                        echo "<td>" . htmlspecialchars($row['bank_emoney_selected']) . "</td>";
                                                                        echo "<td>" . htmlspecialchars($row['bank_emoney']) . "</td>";
                                                                        echo "<td>" . htmlspecialchars($row['bank_emoney_name']) . "</td>";
                                                                        echo "<td>" . htmlspecialchars($row['bank_no_emoney_no']) . "</td>";
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
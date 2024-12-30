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
    <title>GTMBest - HOME</title>
    <link rel="icon" type="image/png" href="img/aside-logo.png">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
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
                                <li class="el-menu-item menu-item load-content is-active">
                                    <div class="menu-item-content d-flex align-items-center">
                                        <i class="fa-solid fa-house-chimney"></i>
                                        <span class="text-capitalize ml-3">All Brand</span>
                                    </div>
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
                                    <div class="title-top-nav">
                                        Home
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
                                                <form action="">
                                                    <div class="el-row d-flex justify-content-between">
                                                        <div class="el-row">
                                                            <div class="col-12">
                                                                <button type="button" class="el-button el-button-primary px-4 py-1" data-toggle="modal"
                                                                data-target="#addnew">
                                                                    <span>Add New</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="el-table-fit el-table">
                                                <div class="table-responsive"> 
                                                     <table class="table table-striped table-bordered">
                                                        <thead class="thead-dark">
                                                            <tr>
                                                                <th style="min-width: 100px;">Country</th>
                                                                <th style="min-width: 130px;">Brand Name</th>
                                                                <th>URL</th>
                                                                <th>Install Date</th>
                                                                <th>Register</th>
                                                                <th>Deposit</th>
                                                                <th>Recent Data Update</th>
                                                                <th>Register Data Collected</th>
                                                                <th>Deposit Data Collected</th>
                                                                <th>Edit</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                            $targets = ['target', 'arena', 'ayo', 'tajir', 'pg', 'alitoto', 'plustogel', 'platinumslot', 'maxtoto',
                                                                        'puma99', 'megafafa', 'auroratoto', 'garuda','bomjudi','asiagam1ng','ponsel'];
                                                            $subqueries = [];

                                                            // Generate subqueries dynamically
                                                            foreach ($targets as $name) {
                                                                $subqueries[] = "(SELECT COUNT(*) 
                                                                                    FROM indo_user_records 
                                                                                    WHERE indo_user_records.url LIKE CONCAT('%', '$name', '%')
                                                                                ) AS register_count_$name";
                                                                $subqueries[] = "(SELECT created_time
                                                                                    FROM indo_user_records
                                                                                    WHERE indo_user_records.url LIKE CONCAT('%', '$name', '%')
                                                                                    ORDER BY created_time DESC
                                                                                    LIMIT 1
                                                                                ) AS recent_update_$name";
                                                            }

                                                            $query = "SELECT gtmrecord.*, " . implode(", ", $subqueries) . " FROM gtmrecord ORDER BY installdate DESC";
                                                            $result = $conn->query($query);

                                                            // Check if there are results
                                                            if ($result && $result->num_rows > 0) {
                                                                while ($row = $result->fetch_assoc()) {
                                                                    echo "<tr class='list-item'>";
                                                                    echo "<td>" . htmlspecialchars($row['country']) . "</td>";
                                                                    echo "<td>" . htmlspecialchars($row['brandname']) . "</td>";
                                                                    echo "<td>" . htmlspecialchars($row['url']) . "</td>";
                                                                    echo "<td>" . htmlspecialchars($row['installdate']) . "</td>";
                                                                    echo "<td>" . htmlspecialchars($row['register']) . "</td>";
                                                                    echo "<td>" . htmlspecialchars($row['deposit']) . "</td>";

                                                                    // Determine recent_update and register_count dynamically
                                                                    $recent_update = '-';
                                                                    $register_count = '-';

                                                                    foreach ($targets as $name) {
                                                                        if (isset($row['url']) && strpos($row['url'], $name) !== false) {
                                                                            $recent_update_date = $row["recent_update_$name"] ?? null;
                                                                            $recent_update = htmlspecialchars($recent_update_date ?? '-');
                                                            
                                                                            // Check if recent_update is today
                                                                            if ($recent_update_date && date('Y-m-d', strtotime($recent_update_date)) === date('Y-m-d')) {
                                                                                $recent_update = "<td style='background: #4eb24e; color:white; font-weight: bold;'>$recent_update</td>";
                                                                            } else {
                                                                                $recent_update = "<td>$recent_update</td>";
                                                                            }
                                                            
                                                                            $register_count = htmlspecialchars($row["register_count_$name"] ?? '-');
                                                                            break;
                                                                        }
                                                                    }

                                                                    echo "$recent_update";
                                                                    echo "<td>$register_count</td>";
                                                                    echo "<td>-</td>";
                                            
                                                                    // Add Edit button
                                                                    echo "<td>"
                                                                    . "<form method='GET' action='./controller/edit.php' style='display:inline;'>"
                                                                    . "<input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>"
                                                                    . "<button type='submit' class='btn btn-warning btn-sm'>Edit</button>"
                                                                    . "</form>"
                                                                    . "</td>";

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
            <!-- Modal -->
    <div class="modal fade" id="addnew" tabindex="-1" aria-labelledby="addnewLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content mx-3">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Order Now</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="./controller/add_brand.php" method="post">
                        <div class="form-group">
                            <label>Country:</label>
                            <select name="country" id="country" class="form-control" required>
                                <option value="INDO" id="country-1">INDO</option>
                                <option value="MY" id="country-2">MY</option>
                                <option value="TH" id="country-3">TH</option>
                                <option value="BDT" id="country-4">BDT</option>
                                <option value="HK" id="country-4">HK</option>
                                <option value="AUD" id="country-4">AUD</option>
                            </select>
                        </div>    
                        <div class="form-group">
                            <label>BrandName:</label>
                            <input type="text" class="form-control" name="brandname" required>
                        </div>    
                        <div class="form-group">
                            <label>Website url:</label>
                            <input type="text" class="form-control" name="url" required>
                        </div>  
                        <div class="form-group">
                            <label>Register:</label>
                            <select name="register" id="register" class="form-control" required>
                                <option value="YES" id="register-1">YES</option>
                                <option value="NO" id="register-2">NO</option>
                            </select>
                        </div>      
                        <div class="form-group">
                            <label>Deposit:</label>
                            <select name="deposit" id="deposit" class="form-control" required>
                                <option value="YES" id="deposit-1">YES</option>
                                <option value="NO" id="deposit-2">NO</option>
                            </select>
                        </div>      
                        <div class="col-12 m-0 p-0 mx-auto text-center">
                            <button type="submit" class="btn btn-primary submit_btn" name="submit">Add New</button>
                        </div>
                    </form>
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
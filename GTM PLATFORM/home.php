<?php
    session_start();
    include("./auth/connect.php");
    if(!isset($_SESSION['valid'])){
        header("Location: index.php");
       }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <title>GTMBest</title>
        <link rel="icon" href="/img/icon.webp">
        <link rel="icon" href="/img/aside-logo.png">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">
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
                                            <span class="text-capitalize ml-3">Home</span>
                                        </div>
                                    </li>
                                    <div class="d-flex align-items-center">
                                        <div class="menu-item-title ">
                                            PWA Tools
                                        </div>
                                    </div>
                                    <li class="el-menu-item menu-item load-content" >
                                        <div class="menu-item-content d-flex align-items-center">
                                            <i class="fa-brands fa-app-store"></i>
                                            <span class="text-capitalize ml-3">Create PWA</span>
                                        </div>
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
                                                        $query = mysqli_query($conn,"SELECT*FROM users WHERE Id=$id");
                                                        while($result = mysqli_fetch_assoc($query)){
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
                                                                <div class="el-form-item asterisk-left">
                                                                    <div class="el-form-item-content">
                                                                        <div class="el-input-wrapper">
                                                                            <span class="el-input-prefix">
                                                                                <span class="el-input-prefix-inner">
                                                                                    <i class="fa-solid fa-magnifying-glass mr-3"></i>
                                                                                </span>
                                                                            </span>
                                                                            <input type="text" class="el-input-inner" autocomplete="off" placeholder="Please search for the name" id="search-pwa">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="el-form-item asterisk-left">
                                                                    <div class="el-form-item-content">
                                                                        <button type="button" class="el-button el-button-primary">
                                                                            <span>Search</span>
                                                                        </button>
                                                                        <button type="button" class="el-button el-button-reset" style="margin-left: 12px;">
                                                                            <span>Reset</span>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="el-table-fit el-table">
                                                    <div class="el-table-inner-wrapper">
                                                        <div class="hidden-columns"></div>
                                                        <div class="el-table-header-wrapper">
                                                            <table class="el-table-header"> 
                                                                <colgroup>
                                                                    <col name="el-table-1" width="300">
                                                                    <col name="el-table-2" width="304">
                                                                    <col name="el-table-3" width="300">
                                                                    <col name="el-table-4" width="250">
                                                                    <col name="el-table-5" width="177">
                                                                    <col name="el-table-6" width="280">
                                                                </colgroup>
                                                                <thead>
                                                                    <tr>
                                                                        <th class="el-table-1 is-leaf el-table-cell" colspan="1" rowspan="1">
                                                                            <div class="cell">
                                                                                Country 
                                                                            </div>
                                                                        </th>
                                                                        <th class="el-table-2 is-leaf el-table-cell" colspan="1" rowspan="1">
                                                                            <div class="cell">
                                                                                Brand Name
                                                                            </div>
                                                                        </th>
                                                                        <th class="el-table-3 is-leaf el-table-cell" colspan="1" rowspan="1">
                                                                            <div class="cell">
                                                                                Website Url
                                                                            </div>
                                                                        </th>
                                                                        <th class="el-table-4 is-leaf el-table-cell" colspan="1" rowspan="1">
                                                                            <div class="cell">
                                                                                Install Date
                                                                            </div>
                                                                        </th>
                                                                        <th class="el-table-5 is-leaf el-table-cell" colspan="1" rowspan="1">
                                                                            <div class="cell">
                                                                                Register
                                                                            </div>
                                                                        </th>
                                                                        <th class="el-table-6 is-leaf el-table-cell" colspan="1" rowspan="1">
                                                                            <div class="cell">
                                                                                Deposit
                                                                            </div>
                                                                        </th>
                                                                        <th class="el-table-6 is-leaf el-table-cell" colspan="1" rowspan="1">
                                                                            <div class="cell">
                                                                                Deposit
                                                                            </div>
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                        <div class="el-table-body-wrapper">
                                                            <div class="el-scrollbar">
                                                                <div class="el-scrollbar-wrap el-scrollbar-wrap-hidden-default">
                                                                    <div class="el-scrollbar-view" style="display: inline-block; vertical-align: middle;">
                                                                        <table class="el-table-body" cellspacing="0" cellpadding="0" style="table-layout: fixed; ">
                                                                            <colgroup>
                                                                                <col name="el-table-1" width="300">
                                                                                <col name="el-table-2" width="304">
                                                                                <col name="el-table-3" width="300">
                                                                                <col name="el-table-4" width="250">
                                                                                <col name="el-table-5" width="177">
                                                                                <col name="el-table-6" width="280">
                                                                            </colgroup>
                                                                            <tbody tabindex="-1">

                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="el-pagination is-background container-pagination mt-5 justify-content-end d-flex">
                                                        <span class="el-pagination-total is-first">Total 1 page</span>
                                                        <button type="button" class="btn-prev" disabled>
                                                            <i class="fa-solid fa-angle-left"></i>
                                                        </button>
                                                        <ul class="el-pager">
                                                            <li class="is-active number" aria-current="true" aria-label="第 1 页" tabindex="0"> 1 </li>
                                                        </ul>
                                                        <button type="button" class="btn-next" disabled>
                                                            <i class="fa-solid fa-angle-right"></i>
                                                        </button>
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
            </div>
        </main>
    </body>
</html>
<?php
include("db.php");
$fac_id = $_SESSION['faculty_id'];
$dept = $_SESSION['dept'];
$sql = "SELECT * FROM advisor_courses WHERE advisor_id ='$fac_id' ";
$result = mysqli_query($conn, $sql);
$sql1 = "SELECT * FROM students";
$result1 = mysqli_query($conn, $sql1);

$sec_sql = "SELECT * FROM advisor WHERE faculty_id='$fac_id'";
$sec_sql_run = mysqli_query($conn,$sql);
$sec_data = mysqli_fetch_assoc($sec_sql_run);
$section = $sec_data['section'];
$year = $sec_data['year'];
$_SESSION['section'] = $section;
$_SESSION['year'] = $year;

$stud_query = "SELECT * FROM students WHERE section = '$section'";
$stud_run = mysqli_query($conn,$stud_query);



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MIC</title>
    <link rel="icon" type="image/png" sizes="32x32" href="image/icons/mkce_s.png">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-5/bootstrap-5.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <style>
    :root {
        --sidebar-width: 250px;
        --sidebar-collapsed-width: 70px;
        --topbar-height: 60px;
        --footer-height: 60px;
        --primary-color: #4e73df;
        --secondary-color: #858796;
        --success-color: #1cc88a;
        --dark-bg: #1a1c23;
        --light-bg: #f8f9fc;
        --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* General Styles with Enhanced Typography */

    /* Content Area Styles */
    .content {
        margin-left: var(--sidebar-width);
        padding-top: var(--topbar-height);
        transition: all 0.3s ease;
        min-height: 100vh;
    }

    /* Content Navigation */
    .content-nav {
        background: linear-gradient(45deg, #4e73df, #1cc88a);
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .content-nav ul {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        gap: 20px;
        overflow-x: auto;
    }

    .content-nav li a {
        color: white;
        text-decoration: none;
        padding: 8px 15px;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
        white-space: nowrap;
    }

    .content-nav li a:hover {
        background: rgba(255, 255, 255, 0.2);
    }

    .sidebar.collapsed+.content {
        margin-left: var(--sidebar-collapsed-width);
    }

    .breadcrumb-area {
        background: white;
        border-radius: 10px;
        box-shadow: var(--card-shadow);
        margin: 20px;
        padding: 15px 20px;
    }

    .breadcrumb-item a {
        color: var(--primary-color);
        text-decoration: none;
        transition: var(--transition);
    }

    .breadcrumb-item a:hover {
        color: #224abe;
    }



    /* Table Styles */



    .gradient-header {
        --bs-table-bg: transparent;
        --bs-table-color: white;
        background: linear-gradient(135deg, #4CAF50, #2196F3) !important;

        text-align: center;
        font-size: 0.9em;


    }


    td {
        text-align: left;
        font-size: 0.9em;
        vertical-align: middle;
        /* For vertical alignment */
    }






    /* Responsive Styles */
    @media (max-width: 768px) {
        .sidebar {
            transform: translateX(-100%);
            width: var(--sidebar-width) !important;
        }

        .sidebar.mobile-show {
            transform: translateX(0);
        }

        .topbar {
            left: 0 !important;
        }

        .mobile-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: none;
        }

        .mobile-overlay.show {
            display: block;
        }

        .content {
            margin-left: 0 !important;
        }

        .brand-logo {
            display: block;
        }

        .user-profile {
            margin-left: 0;
        }

        .sidebar .logo {
            justify-content: center;
        }

        .sidebar .menu-item span,
        .sidebar .has-submenu::after {
            display: block !important;
        }

        body.sidebar-open {
            overflow: hidden;
        }

        .footer {
            left: 0 !important;
        }

        .content-nav ul {
            flex-wrap: nowrap;
            overflow-x: auto;
            padding-bottom: 5px;
        }

        .content-nav ul::-webkit-scrollbar {
            height: 4px;
        }

        .content-nav ul::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 2px;
        }
    }

    .container-fluid {
        padding: 20px;
    }


    /* loader */
    .loader-container {
        position: fixed;
        left: var(--sidebar-width);
        right: 0;
        top: var(--topbar-height);
        bottom: var(--footer-height);
        background: rgba(255, 255, 255, 0.95);
        display: flex;
        /* Changed from 'none' to show by default */
        justify-content: center;
        align-items: center;
        z-index: 1000;
        transition: left 0.3s ease;
    }

    .sidebar.collapsed+.content .loader-container {
        left: var(--sidebar-collapsed-width);
    }

    @media (max-width: 768px) {
        .loader-container {
            left: 0;
        }
    }

    /* Hide loader when done */
    .loader-container.hide {
        display: none;
    }

    /* Loader Animation */
    .loader {
        width: 50px;
        height: 50px;
        border: 5px solid #f3f3f3;
        border-radius: 50%;
        border-top: 5px solid var(--primary-color);
        border-right: 5px solid var(--success-color);
        border-bottom: 5px solid var(--primary-color);
        border-left: 5px solid var(--success-color);
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .breadcrumb-area {
        background-image: linear-gradient(to top, #fff1eb 0%, #ace0f9 100%);
        border-radius: 10px;
        box-shadow: var(--card-shadow);
        margin: 20px;
        padding: 15px 20px;
    }

    .breadcrumb-item a {
        color: var(--primary-color);
        text-decoration: none;
        transition: var(--transition);
    }

    .breadcrumb-item a:hover {
        color: #224abe;
    }

    .timetable {
        margin: 20px auto;
        max-width: 1000px;
    }

    th,
    td {
        text-align: center;
        vertical-align: middle;
    }

    .table thead th {
        background-color: #007bff;
        color: white;
    }

    .add-btn {
        font-size: 14px;
        padding: 2px 8px;
    }

    .timetable td:hover {
        background-color: rgb(78, 184, 230);
        transition: background-color 0.3s ease;
    }

    #table3 td:hover {
        background-color: rgb(78, 184, 230);



    }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <?php include 'sidebar.php'; ?>

    <!-- Main Content -->
    <div class="content">

        <div class="loader-container" id="loaderContainer">
            <div class="loader"></div>
        </div>

        <!-- Topbar -->
        <?php include 'topbar.php'; ?>

        <!-- Breadcrumb -->
        <div class="breadcrumb-area custom-gradient">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Research</li>
                </ol>
            </nav>
        </div>

        <!-- Content Area -->
        <div class="container-fluid">
            <div class="custom-tabs">
                <h2><?php echo $section; ?></h2>
                <ul class="nav nav-tabs" role="tablist">
                    <!-- Center the main tabs -->
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-bs-toggle="tab" id="edit-bus-tab" href="#courses" role="tab"
                            aria-selected="true">
                            <span class="hidden-xs-down" style="font-size: 0.9em;"><i class="fas fa-book tab-icon"></i>
                                Courses</span>
                        </a>

                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" id="edit-bus-tab" href="#student" role="tab"
                            aria-selected="true">
                            <span class="hidden-xs-down" style="font-size: 0.9em;"><i class="fas fa-book tab-icon"></i>
                                Students</span>
                        </a>

                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" id="edit-bus-tab" href="#time_table" role="tab"
                            aria-selected="true">
                            <span class="hidden-xs-down" style="font-size: 0.9em;"><i class="fas fa-book tab-icon"></i>
                                Time Table</span>
                        </a>

                    </li>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link att" data-bs-toggle="tab" id="edit-bus-tab" href="#attendance" role="tab"
                            aria-selected="true">
                            <span class="hidden-xs-down" style="font-size: 0.9em;"><i class="fas fa-book tab-icon"></i>
                                Attendance</span>
                        </a>

                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="courses" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-header mb-3 " style="text-align: right;">

                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="table1" class="table table-striped table-bordered">
                                            <thead class="gradient-header">

                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Course</th>
                                                    <th>Choose Faculty</th>
                                                    <th>Alloted Faculty</th>
                                                    <th style="width: 200px;">Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                        // Fetch all faculty members once before the loop
                                                        $faculty_query = "SELECT * FROM faculty WHERE department='$dept'";
                                                        $faculty_result = mysqli_query($conn, $faculty_query);
                                                        $faculty_list = [];
                                                        while ($row = mysqli_fetch_assoc($faculty_result)) {
                                                            $faculty_list[] = $row;
                                                        }

                                                        $s = 1;
                                                        while ($data = mysqli_fetch_assoc($result)) { // Fetch courses
                                                        ?>
                                                <tr>
                                                    <td><?= $s++; ?></td> <!-- Corrected S.No display -->
                                                    <td><button class="btn btn-primary" type="button" id="cdetail"
                                                            value="<?= $data['course_id']; ?>" data-bs-toggle="modal"
                                                            data-bs-target="#coursedetail"><?= $data['course_id']; ?></button>
                                                    </td>
                                                    <!-- Fixed echo issue -->
                                                    <td>
                                                        <form id="facchoose">
                                                            <input type="text" name="rid"
                                                                value="<?php echo $data['id']; ?>" hidden>
                                                            <select id="flist" name="flist">
                                                                <option value="" disabled selected>Choose Faculty
                                                                </option>
                                                                <?php
                                                                        foreach ($faculty_list as $faculty) {
                                                                        ?>
                                                                <option value="<?= $faculty['faculty_id'] ?>">
                                                                    <?= $faculty['faculty_name'] ?></option>
                                                                <?php
                                                                        }
                                                                        ?>
                                                            </select>
                                                            <button type="submit" id="btn"
                                                                value="<?php echo $data['id']; ?>"
                                                                class="btn btn-secondary">Assign</button>
                                                        </form>
                                                    </td>

                                                    <td>
                                                        <?php
                                                            if($data['faculty']==NULL){
                                                                ?>
                                                        <button class="btn btn-dark">Not Assigned</button>
                                                        <?php
                                                            }
                                                            else{
                                                                ?>
                                                        <button type="button" id="fdetail"
                                                            value="<?= $data['faculty'];?>" data-bs-toggle="modal"
                                                            data-bs-target="#facdetail"
                                                            class="btn btn-success"><?php echo $data['faculty']; ?></button>
                                                    </td>
                                                    <?php
                                                            }
                                                            ?>
                                                    <td><button class="btn btn-danger">Delete</button></td>
                                                </tr>
                                                <?php
                                                    }
                                                    ?>

                                            </tbody>


                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="tab-pane fade show" id="student" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-header mb-3 " style="text-align: right;">
                                    <button id="open_student" class="btn btn-sm btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#studentModal">
                                        <b>ADD</b>
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="table2" class="table table-striped table-bordered">
                                            <thead class="gradient-header">
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Register No</th>
                                                    <th>Student Name</th>
                                                    <th style="width: 200px;">Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                            $s=1;
                                            while($students = mysqli_fetch_assoc($stud_run)){
                                            ?>
                                                <tr>
                                                    <td><?php echo $s++ ?></td>
                                                    <td><?php echo $students['reg_no'] ?></td>
                                                    <td><?php echo $students['name'] ?></td>
                                                    <td><button class="btn btn-info">Edit</button>&nbsp;<button
                                                            class="btn btn-danger">Delete</button></td>

                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade show" id="time_table" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-header mb-3 " style="text-align: right;">
                                    <button id="open_student" class="btn btn-sm btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#studentModal">
                                        <b>ADD</b>
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="container">
                                        <h2 class="text-center my-4"></h2>

                                        <table id="tt_table" class="table table-bordered timetable">
                                            <thead>

                                                <tr>
                                                    <th>Day</th>
                                                    <th>Hour-1</th>
                                                    <th>Hour-2</th>
                                                    <th>Hour-3</th>
                                                    <th>Hour-4</th>
                                                    <th>Hour-5</th>
                                                    <th>Hour-6</th>
                                                    <th>Hour-7</th>


                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                        $tt_sql = "SELECT * FROM time_table WHERE section='$section' AND dept='$dept' AND section='$section'";
                                        $tt_run = mysqli_query($conn,$tt_sql);
                                        while($row = mysqli_fetch_assoc($tt_run)){
                                        
                                        ?>
                                                <tr>
                                                    <td><?php echo $row['day']; ?></td>
                                                    <td value="<?php echo $row['id']; ?>" data-hour="hour1" class="tt">
                                                        <?php
                                                                if($row['hour1']!=NULL){
                                                                
                                                ?>
                                                        <span style="color:green">
                                                            Subject : <?php echo $row['hour1']; ?>
                                                        </span>
                                                        <?php
                                                }
                                            ?>



                                                    </td>
                                                    <td value="<?php echo $row['id']; ?>" data-hour="hour2" class="tt"><?php
                                                if($row['hour2']!=NULL){
                                                
                                                ?>
                                                        <span style="color:green">
                                                            Subject : <?php echo $row['hour2']; ?>
                                                        </span> <?php
                                                }
                                                ?>
                                                    </td>
                                                    <td value="<?php echo $row['id']; ?>" data-hour="hour3" class="tt"><?php
                                                if($row['hour3']!=NULL){
                                                
                                                ?>
                                                        <span style="color:green">
                                                            Subject : <?php echo $row['hour3']; ?>
                                                        </span> <?php
                                                }
                                                ?>
                                                    </td>
                                                    <td value="<?php echo $row['id']; ?>" data-hour="hour4" class="tt"><?php
                                                if($row['hour4']!=NULL){
                                                
                                                ?>
                                                        <span style="color:green">
                                                            Subject : <?php echo $row['hour4']; ?>
                                                        </span> <?php
                                                }
                                                ?>
                                                    </td>
                                                    <td value="<?php echo $row['id']; ?>" data-hour="hour5" class="tt"><?php
                                                if($row['hour5']!=NULL){
                                                
                                                ?>
                                                        <span style="color:green">
                                                            Subject : <?php echo $row['hour5']; ?>
                                                        </span> <?php
                                                }
                                                ?>
                                                    </td>
                                                    <td value="<?php echo $row['id']; ?>" data-hour="hour6" class="tt"><?php
                                                if($row['hour6']!=NULL){
                                                
                                                ?>
                                                        <span style="color:green">
                                                            Subject : <?php echo $row['hour6']; ?>
                                                        </span> <?php
                                                }
                                                ?>
                                                    </td>
                                                    <td value="<?php echo $row['id']; ?>" data-hour="hour7" class="tt"><?php
                                                if($row['hour7']!=NULL){
                                                
                                                ?>
                                                        <span style="color:green">
                                                            Subject : <?php echo $row['hour7']; ?>
                                                        </span>
                                                        <?php
                                                }
                                                ?>
                                                    </td>
                                                </tr>
                                                <?php
                                        }
                                        ?>





                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade show" id="attendance" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-header mb-3 " style="text-align: right;">
                                    Date : <h2 id="date"></h2>

                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <h2>Advisor TimeTable</h2>
                                        <table id="table3" class="table table-striped table-bordered">
                                            <thead class="gradient-header">
                                                <tr>
                                                    <th>Day</th>
                                                    <th>Hour-1</th>
                                                    <th>Hour-2</th>
                                                    <th>Hour-3</th>
                                                    <th>Hour-4</th>
                                                    <th>Hour-5</th>
                                                    <th>Hour-6</th>
                                                    <th>Hour-7</th>


                                                </tr>
                                            </thead>
                                            <tbody>
                                                <td id="day"></td>
                                                <td id="h1" class="hatt"></td>
                                                <td id="h2" class="hatt"></td>
                                                <td id="h3" class="hatt"></td>
                                                <td id="h4" class="hatt"></td>
                                                <td id="h5" class="hatt"></td>
                                                <td id="h6" class="hatt"></td>
                                                <td id="h7" class="hatt"></td>


                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                                <br><br><br>



                                <div class="card-body">
                                    <div class="table-responsive">
                                        <h2>Subject Wise TimeTable</h2>

                                        <table id="table4" class="table table-striped table-bordered">
                                            <thead class="gradient-header">
                                                <tr>
                                                    <th>Day</th>
                                                    <th>Hour-1</th>
                                                    <th>Hour-2</th>
                                                    <th>Hour-3</th>
                                                    <th>Hour-4</th>
                                                    <th>Hour-5</th>
                                                    <th>Hour-6</th>
                                                    <th>Hour-7</th>


                                                </tr>
                                            </thead>
                                            <tbody>
                                                <td id="day2"></td>
                                                <td id="h11" class="hatt1"></td>
                                                <td id="h22" class="hatt1"></td>
                                                <td id="h33" class="hatt1"></td>
                                                <td id="h44" class="hatt1"></td>
                                                <td id="h55" class="hatt1"></td>
                                                <td id="h66" class="hatt1"></td>
                                                <td id="h77" class="hatt1"></td>


                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>







    <!-- Footer -->
    <!------------------------------------MODAL---------------------------------------------->

    <!-- Modal -->
    <div class="modal fade" id="coursedetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        Course name: <span id="coursename">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="facdetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        Faculty name: <span id="facname">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>




    <div class="modal fade" id="tt_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="tt_sub">
                        <input type="text" id="row" name="id" hidden>
                        <input type="text" id="hour" name="hour" hidden>
                        <label for="year">Select course:</label>
                        <select id="course" name="code">
                            <option value="" disabled selected>Choose course</option>
                        </select>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="hmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        Course name : <span id="c_name"></span><br><br>
                        Faculty name : <span id="f_name"></span><br><br>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>

                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="tt2_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Course Name: <span id="c_name1"></span><br><br>
                    Year: <span id="year1"></span><br><br>
                    Department: <span id="dept1"></span><br><br>
                    Section: <span id="section1"></span><br><br>

                    <table  class="table table-striped table-bordered">
                        <thead class="gradient-header">
                            <th>Reg</th>
                            <th>Name</th>
                            <th>Action</th>
                        </thead>
                        <tbody id="stu_list1">

                        </tbody>
                    </table>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>

                </div>
            </div>
        </div>
    </div>








    <!------------------------------------END MODAL---------------------------------------------->
    <?php include 'footer.php'; ?>


    </div>
    <script src="script.js"> </script>
    <script>
    $(document).ready(function() {
        $('#table1').DataTable();
        $('#table2').DataTable();

    });
    $(document).on('click', '.journalapproveBtn, .journalrejectBtn', function() {
        var applicantId = $(this).data('id');
        var action = $(this).hasClass('journalapproveBtn') ? 'approve' : 'reject';

        if (action === 'approve') {
            // Confirmation for approval
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to accept this Event?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Accept it!',
                cancelButtonText: 'No, cancel!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'approve.php',
                        method: 'POST',
                        data: {
                            id: applicantId,
                            action: action,
                            data: 'journal',
                            page: 'hod'
                        },
                        dataType: 'json',
                        success: function(res) {
                            if (res.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Accepted!',
                                    text: res.message
                                }).then(() => {
                                    var table = $('#journal_table').DataTable().ajax
                                        .reload(null, false);
                                    var row = table.row($(
                                            `button[data-id='${applicantId}']`)
                                        .parents('tr'));
                                    row.remove().draw(false);
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: res.message
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Request Failed',
                                text: 'An error occurred while processing your request: ' +
                                    error
                            });
                        }
                    });
                }
            });
        } else if (action === 'reject') {
            // Confirmation for rejection and reason input
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to Reject this Event?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Reject it!',
                cancelButtonText: 'No, cancel!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Reject Event',
                        text: "Please provide a reason for rejection:",
                        icon: 'warning',
                        input: 'textarea',
                        inputPlaceholder: 'Enter your reason here...',
                        showCancelButton: true,
                        confirmButtonText: 'Reject',
                        cancelButtonText: 'Cancel',
                        reverseButtons: true,
                        inputValidator: (value) => {
                            if (!value) {
                                return 'You need to provide a reason!';
                            }
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var rejectionReason = result.value;

                            $.ajax({
                                url: 'approve.php',
                                method: 'POST',
                                data: {
                                    id: applicantId,
                                    action: action,
                                    reason: rejectionReason,
                                    data: 'journal',
                                    page: 'hod'
                                },
                                dataType: 'json',
                                success: function(res) {
                                    if (res.success) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Rejected',
                                            text: res.message
                                        }).then(() => {
                                            var table = $('#journal_table')
                                                .DataTable();
                                            var row = table.row($(
                                                `button[data-id='${applicantId}']`
                                            ).parents('tr'));
                                            row.remove().draw(false);
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: res.message
                                        });
                                    }
                                },
                                error: function(xhr, status, error) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Request Failed',
                                        text: 'An error occurred while processing your request: ' +
                                            error
                                    });
                                }
                            });
                        }
                    });
                }
            });
        }
    });

    $(document).on("submit", "#facchoose", function(e) {
        e.preventDefault();
        var form = new FormData(this);
        form.append("assign", true);
        $.ajax({
            type: "POST",
            url: "backend.php",
            data: form,
            processData: false,
            contentType: false,
            success: function(response) {
                var res = jQuery.parseJSON(response);
                if (res.status == 200) {
                    alert("asigned succesfully");
                }
            }
        })
    })

    $(document).on("click", "#cdetail", function(e) {
        e.preventDefault();
        var course_id = $(this).val();
        console.log(course_id);
        $.ajax({
            type: "POST",
            url: "backend.php",
            data: {
                "id": course_id,
                "coursename": true
            },
            success: function(response) {
                var res = jQuery.parseJSON(response);
                console.log(response);
                if (res.status == 200) {
                    $('#coursename').text(res.data.name);
                    $('#coursedetail').modal('show');
                }
            }
        })

    });

    $(document).on("click", "#fdetail", function(e) {
        e.preventDefault();
        var fac_id = $(this).val();
        console.log(fac_id);
        $.ajax({
            type: "POST",
            url: "backend.php",
            data: {
                "id": fac_id,
                "facultyname": true
            },
            success: function(response) {
                var res = jQuery.parseJSON(response);
                console.log(response);
                if (res.status == 200) {
                    $('#facname').text(res.data.faculty_name);
                    $('#facdetail').modal('show');
                }
            }
        })

    });


    var selectedCell;

    function editSlot(btn) {
        selectedCell = $(btn).parent(); // Store selected cell
        $('#editModal').modal('show'); // Show modal
    }

    function saveSlot() {
        var subject = $('#subjectInput').val();
        if (subject.trim() !== '') {
            selectedCell.html(subject);
        }
        $('#editModal').modal('hide');
    }


    $(document).on("click", ".tt", function(e) {
        e.preventDefault();
        var row_id = $(this).attr("value");
        $("#row").val(row_id);
        var hour_id = $(this).data("hour");
        $("#hour").val(hour_id);

        $("#tt_modal").modal('show');
        $.ajax({
            type: "POST",
            url: "backend.php",
            data: {
                "indcourse": true,
            },
            success: function(response) {
                var res = jQuery.parseJSON(response);
                let select = $("#course");

                if (res.status == 200) {
                    $.each(res.data, function(index, item) {
                        select.append(
                            `<option value="${item.course_id}">${item.course_id}</option>`
                        );
                    });
                }
            }
        })



    });

    $(document).on("submit", "#tt_sub", function(e) {
        e.preventDefault();
        var form = new FormData(this);
        console.log(form);

        form.append("tt", true);
        console.log("hii");
        $.ajax({
            type: "POST",
            url: "backend.php",
            data: form,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log(response);
                var res = jQuery.parseJSON(response);
                if (res.status == 200) {
                    alert("done");
                }
            }
        })


    });

    $(document).on("click", ".att", function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "backend.php",
            data: {
                "get_tt": true,
            },
            success: function(response) {
                var res = jQuery.parseJSON(response);
                if (res.status == 200) {
                    $("#day").text(res.data.day);
                    $("#h1").text(res.data.hour1);
                    $("#h2").text(res.data.hour2);
                    $("#h3").text(res.data.hour3);
                    $("#h4").text(res.data.hour4);
                    $("#h5").text(res.data.hour5);
                    $("#h6").text(res.data.hour6);
                    $("#h7").text(res.data.hour7);
                    $("#date").text(res.date);



                }
            }

        })
    });


    $(document).on("click", ".hatt", function(e) {
        e.preventDefault();
        var code = $(this).text();
        $.ajax({
            type: "POST",
            url: "backend.php",
            data: {
                "code": code,
                "getcdetail": true,
            },
            success: function(response) {
                console.log(response);
                var res = jQuery.parseJSON(response);
                if (res.status == 200) {
                    $("#c_name").text(res.cname);
                    $("#f_name").text(res.fac_name);
                    $("#hmodal").modal('show');
                }

            }
        });
    });

    $(document).ready(function() {
        console.log("done");
        $.ajax({
            type: "POST",
            url: "backend.php",
            data: {
                "getothertt": true
            },
            success: function(response) {
                var res = jQuery.parseJSON(response);
                $.each(res, function(index, data) {
                    $("#day2").text(data.day);

                    $("#h11").text(data.schedule.hour1 || "-");
                    $("#h22").text(data.schedule.hour2 || "-");
                    $("#h33").text(data.schedule.hour3 || "-");
                    $("#h44").text(data.schedule.hour4 || "-");
                    $("#h55").text(data.schedule.hour5 || "-");
                    $("#h66").text(data.schedule.hour6 || "-");
                    $("#h77").text(data.schedule.hour7 || "-");
                });
            }

        })


    });

    $(document).on("click", ".hatt1", function(e) {
    var course = $(this).text();
    if (course == '-') {
        alert("You don't have any class");
    }
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "backend.php",
        data: {
            "course1": course,
            "fetch_c_detail": true,
        },
        success: function(response) {
            var res = jQuery.parseJSON(response);
            if (res.status == 200) {
                console.log(res.stud);
                $("#c_name1").text(res.c_name);
                $("#year1").text(res.year);
                $("#dept1").text(res.dept);
                $("#section1").text(res.section);
                let tbody = $("#stu_list1");
                tbody.empty();

                res.stud.forEach((stud) => {
                    let row = `<tr>
                        <td>${stud.reg_no}</td>
                        <td>${stud.name}</td>
                        <td>
                            <input type="radio" name="status_${stud.reg_no}" value="OD"> OD 
                            &nbsp;
                            <input type="radio" name="status_${stud.reg_no}" value="Leave"> Leave
                        </td>
                    </tr>`;
                    tbody.append(row);
                });
                $("#tt2_modal").modal("show");
            }
        }
    });
});

    </script>

</body>

</html>
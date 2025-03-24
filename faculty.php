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
        th, td {
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
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="courses" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-header mb-3 " style="text-align: right;">
                                    
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                    <table id="journal_table" class="table table-striped table-bordered">
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
                                                            <td><button class="btn btn-primary" type="button" id="cdetail" value="<?= $data['course_id']; ?>" data-bs-toggle="modal" data-bs-target="#coursedetail"><?= $data['course_id']; ?></button></td>
                                                            <!-- Fixed echo issue -->
                                                            <td>
                                                                <form id="facchoose">
                                                                    <input type="text" name="rid"
                                                                        value="<?php echo $data['id']; ?>" hidden>
                                                                    <select id="flist" name="flist">
                                                                        <option value="" disabled selected>Choose Faculty</option>
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
                                                                        value="<?php echo $data['id']; ?>" class="btn btn-secondary">Assign</button>
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
                                                            <button type="button" id="fdetail" value="<?= $data['faculty'];?>" data-bs-toggle="modal" data-bs-target="#facdetail" class="btn btn-success"><?php echo $data['faculty']; ?></button></td>
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
                                    <button id="open_student" class="btn btn-sm btn btn-primary"
                                        data-bs-toggle="modal" data-bs-target="#studentModal">
                                        <b>ADD</b>
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="journal_table" class="table table-striped table-bordered">
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
                                                    <td><button class="btn btn-info">Edit</button>&nbsp;<button class="btn btn-danger">Delete</button></td>

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
                                    <button id="open_student" class="btn btn-sm btn btn-primary"
                                        data-bs-toggle="modal" data-bs-target="#studentModal">
                                        <b>ADD</b>
                                    </button>
                                </div>
                                <div class="card-body">
                                <div class="container">
    <h2 class="text-center my-4"></h2>

    <table class="table table-bordered timetable">
        <thead>
            <tr>
                <th>Time Slot</th>
                <th>Monday</th>
                <th>Tuesday</th>
                <th>Wednesday</th>
                <th>Thursday</th>
                <th>Friday</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Hour-1</td>
                <td data-bs-toggle="modal" data-bs-target="#facdetail"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Hour-2</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
        
            </tr>
            <tr>
                <td>Hour-3</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Hour-4</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Hour-5</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Hour-6</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Hour-7</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
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
            <button type="button" class="btn btn-primary">Save changes</button>
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
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        </div>
    </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Timetable Slot</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <label for="subjectInput">Enter Subject:</label>
                <input type="text" id="subjectInput" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="saveSlot()">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>








    <!------------------------------------END MODAL---------------------------------------------->
    <?php include 'footer.php'; ?>


    </div>
    <script src="script.js"> </script>
    <script>
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

        $(document).on("click","#cdetail",function(e){
        e.preventDefault();
        var course_id = $(this).val();
        console.log(course_id);
        $.ajax({
            type:"POST",
            url:"backend.php",
            data:{
                "id":course_id,
                "coursename":true
            },
            success:function(response){
                var res =jQuery.parseJSON(response);
                console.log(response);
                if(res.status == 200){
                    $('#coursename').text(res.data.name);
                    $('#coursedetail').modal('show');
                }
            }
        })

    });

    $(document).on("click","#fdetail",function(e){
        e.preventDefault();
        var fac_id = $(this).val();
        console.log(fac_id);
        $.ajax({
            type:"POST",
            url:"backend.php",
            data:{
                "id":fac_id,
                "facultyname":true
            },
            success:function(response){
                var res =jQuery.parseJSON(response);
                console.log(response);
                if(res.status == 200){
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
    </script>

</body>

</html>
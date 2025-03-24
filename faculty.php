<?php
include("db.php");
$fac_id = $_SESSION['faculty_id'];
$dept = $_SESSION['dept'];
$sql = "SELECT * FROM advisor_courses WHERE advisor_id ='$fac_id' ";
$result = mysqli_query($conn, $sql);
$sql1 = "SELECT * FROM students";
$result1 = mysqli_query($conn, $sql1);


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
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="courses" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-header mb-3 " style="text-align: right;">
                                    <button id="open_journal" class="btn btn-sm btn btn-primary"
                                        data-bs-toggle="modal" data-bs-target="#journalModal">
                                        <b></b>
                                    </button>
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
                                                            <td><?= $data['course_id']; ?></td>
                                                            <!-- Fixed echo issue -->
                                                            <td>
                                                                <form id="facchoose">
                                                                    <input type="text" name="rid"
                                                                        value="<?php echo $data['id']; ?>" hidden>
                                                                    <select id="flist" name="flist">
                                                                        <option value="">Choose Faculty</option>
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
                                                                        value="<?php echo $data['id']; ?>">Assign</button>
                                                                </form>
                                                            </td>
                                                            <td><?php echo $data['faculty']; ?></td>
                                                            <td><button>Delete</button></td>
                                                        </tr>
                                                        <?php
}
?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane p-20" id="student" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="card-header mb-3" style="text-align: right;">
                                            <!-- <h4 class="mb-0">Conference Information</h4> -->
                                            <button id="open_conference" class="btn btn-sm btn-primary"
                                                data-bs-toggle="modal" data-bs-target="#conferenceModal">
                                                <b>Open Conference Form</b></button>

                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="conference_table" class="table table-striped table-bordered">
                                                    <thead class="gradient-header">
                                                        <tr>
                                                            <th>S.No</th>
                                                            <th>Paper Title</th>
                                                            <th>Conference Name</th>
                                                            <th>Conference Details</th>
                                                            <th>Document</th>
                                                            <th style="width: 200px;">Action</th>
                                                        </tr>
                                                    </thead>

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
        </div>
    </div>


        <!-- Footer -->
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
    </script>

</body>

</html>
<?php
include("db.php");
$fac_id = $_SESSION['faculty_id'];
$dept = $_SESSION['dept'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MIC</title>
    <!-- Styles -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<!-- Or for RTL support -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script> 
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
        select {
            padding: 8px;
            font-size: 16px;
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
                <ul class="nav nav-tabs" role="tablist"> <!-- Center the main tabs -->
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-bs-toggle="tab" id="edit-bus-tab" href="#publication" role="tab" aria-selected="true">
                            <span class="hidden-xs-down" style="font-size: 0.9em;"><i class="fas fa-book tab-icon"></i>Courses</span>
                        </a> 
                    </li>                   
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="publication" role="tabpanel">                        
                        
                        <div class="tab-content">
                            <div class="tab-pane p-20 active" id="journal" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-header mb-3 " style="text-align: right;">
                                        <button type="button" class="btn btn-primary" value="<?php echo $dept; ?>" id="addcourse">ADD</button>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="journal_table" class="table table-striped table-bordered">
                                                    <thead class="gradient-header">
                                                        <tr>
                                                            <th>S.No</th>
                                                            <th>Paper Title</th>
                                                            <th>Journal Name</th>
                                                            <th>J.Detail</th>
                                                            <th>Document</th>
                                                            <th style="width: 200px;">Action</th>

                                                        </tr>
                                                    </thead>
                                                   
                                                </table>
                                            </div>
                                        </div>
                                        <!-- </div> -->
                                    </div>
                                </div>
                            </div>
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>


<!-----------------------------------------MODAL--------------------------->




<!-- Modal -->
<div class="modal fade" id="fac_add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Course Selection</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="add_course">

      <div class="modal-body">
        <label for="year">Select Academic Year:</label>
        <select id="year" name="year">
        <option value="" disabled selected>Choose Academic Year</option>

        </select>
        <br><br>

        <label for="year">Select Advisor:</label>
        <select id="advisor" name="advisor">
        <option value="" disabled selected>Choose Advisor</option>

        </select>
        <br><br>

        <label for="section">Select Section:</label>
        <select id="section" name="section">
        <option value="" disabled selected>Choose section</option>
        <option value="A">A</option>
        <option value="B">B</option>

        </select>
        <br><br>
        <label>Select Courses (Choose exactly 8 courses):</label>
        <div id="courses-list"></div>
        <p id="error-msg" style="color:red; display:none;">You can select only 8 courses!</p>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
      </div>
      </form>

    </div>
  </div>
</div>



<!------------------------------- MODAL ENDS -------------------------------->
        <!-- Footer -->
        <?php include 'footer.php'; ?>
    </div>
    <script src="script.js" > </script>
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
                                            var table =   $('#journal_table').DataTable().ajax.reload(null, false);
                                            var row = table.row($(`button[data-id='${applicantId}']`).parents('tr'));
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
                                        text: 'An error occurred while processing your request: ' + error
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
                                                    var table = $('#journal_table').DataTable();
                                            var row = table.row($(`button[data-id='${applicantId}']`).parents('tr'));
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
                                                text: 'An error occurred while processing your request: ' + error
                                            });
                                        }
                                    });
                                }
                            });
                        }
                    });
                }
            });


            $(document).on("click","#addcourse",function(e){

                e.preventDefault();
                $dept = $(this).val();
                $.ajax({
                    type:"POST",
                    url:"backend.php",
                    data:{
                        course:true,
                        dept:$dept,
                    },
                    success:function(response){
                        var res = jQuery.parseJSON(response);
                        console.log(res);
                        let select = $("#year");
                        let selectad = $("#advisor");
                        if(res.status==200){
                            $.each(res.data,function(index,item){
                                select.append(`<option value="${item.year}">${item.year}</option>`);
                            });
                            $.each(res.data1,function(index,item){
                                selectad.append(`<option value="${item.faculty_id}">${item.faculty_name}</option>`);
                            })
                            $("#fac_add").modal("show");
                        }   

                    }
                })
            });

            $(document).on("change", "#year", function (e) {
    e.preventDefault();
    var year = $(this).val();
    console.log(year);
    
    $.ajax({
        type: "POST",
        url: "backend.php",
        data: {
            "yearc": true,
            "year": year,
        },
        success: function (response) {
            console.log(response);
            var res = jQuery.parseJSON(response);
            if (res.status == 200) {
                console.log(res);
                var coursesList = $("#courses-list");
                coursesList.empty();

                res.data.forEach(function (course) {
                    var checkbox = `<input type="checkbox" name="courses[]" value="${course.code}" class="course-checkbox">${course.code} -  ${course.name} <br>`;
                    coursesList.append(checkbox);
                });

                $(".course-checkbox").on("change", function () {
                    var selectedCourses = $(".course-checkbox:checked").length;
                    
                    if (selectedCourses > 8) {
                        $(this).prop("checked", false);
                        $("#error-msg").show();
                    } else {
                        $("#error-msg").hide();
                    }
                });
            }
        }
    });
});

$(document).on("submit","#add_course",function(e){
    console.log("hiiii");
    e.preventDefault();
    var form = new FormData(this);
    var courses = $(".course-checkbox:checked").map(function () {
        return this.value;
    }).get();
    form.append("courses",JSON.stringify(courses));
    form.append("cdata",true);
    $.ajax({
        type:"POST",
        url:"backend.php",
        data:form,
        contentType:false,
        processData:false,
        success:function(response){
            var res = jQuery.parseJSON(response);
            if(res.status==200){
                alert("assigned succesfully");
            }
            else{
                alert("error");
            }
        }
    })
});



            document.getElementById("options").addEventListener("mousedown", function(e) {
    e.preventDefault();
    let option = e.target;
    
    // Toggle selected state
    if (option.selected) {
        option.selected = false;
    } else {
        option.selected = true;
    }

    return false;
});


   

           
    </script>
   
</body>

</html> 
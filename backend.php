<?php

include("db.php");
$fac_id = $_SESSION['faculty_id'];
$section = $_SESSION['section'];
$year = $_SESSION['year'];
$dept = $_SESSION['dept'];







if(isset($_POST['course'])){
    $dept = $_POST['dept']; 
    $sql = "SELECT * FROM academic_year";
    $sql1 = "SELECT * FROM faculty WHERE department = '$dept' AND role='faculty'";
    $query_run1 = mysqli_query($conn,$sql1);
    $query_data1 = mysqli_fetch_all($query_run1,MYSQLI_ASSOC);
    $query_run = mysqli_query($conn,$sql);
    $query_data = mysqli_fetch_all($query_run,MYSQLI_ASSOC);
    if($query_data){
        $res=[
            "status"=>200,
            "message"=>"success",
            "data"=>$query_data,
            "data1"=>$query_data1,
        ];
        echo json_encode($res);

    }

}

if(isset($_POST['yearc'])){
    $year = $_POST['year'];
    $sql = "SELECT * FROM course WHERE year = '$year'";
    $query_run = mysqli_query($conn,$sql);
    $data = mysqli_fetch_all($query_run,MYSQLI_ASSOC);
    if($data){
        $res=[
            "status"=>200,
            "message"=>"success",
            "data"=>$data,
        ];
        echo json_encode($res);
    }
}

if(isset($_POST['cdata'])){
    $advisor_id = $_POST['advisor'];
    $courses = json_decode($_POST['courses'], true);  
    $year = $_POST['year'];
    $section = $_POST['section'];
    $run = false;
    $query = "INSERT INTO advisor(faculty_id,year,section) VALUES('$advisor_id','$year','$section')";
    $q_run = mysqli_query($conn,$query);
    $sql_dept = "SELECT * FROM faculty WHERE faculty_id='$advisor_id'";
    $sql_dept_run = mysqli_query($conn,$sql_dept);
    $sql_dept_data = mysqli_fetch_array($sql_dept_run);
    $dept = $sql_dept_data['department'];

    foreach($courses as $course){
        $sql = "INSERT INTO advisor_courses(advisor_id,course_id,section,year,dept) VALUES('$advisor_id','$course','$section','$year','$dept')";
        $query_run = mysqli_query($conn,$sql);
        $run = true;

    }

    $sql_tt = "INSERT INTO time_table (year, dept, section, day, hour1, hour2, hour3, hour4, hour5, hour6, hour7) VALUES 
    ('$year', '$dept', '$section', 'Monday', '', '', '', '', '', '', ''),
    ('$year', '$dept', '$section', 'Tuesday', '', '', '', '', '', '', ''),
    ('$year', '$dept', '$section', 'Wednesday', '', '', '', '', '', '', ''),
    ('$year', '$dept', '$section', 'Thursday', '', '', '', '', '', '', ''),
    ('$year', '$dept', '$section', 'Friday', '', '', '', '', '', '', '')";
    $sql_tt_run = mysqli_query($conn,$sql_tt);
    if($run){
        $res=[
            "status"=>200,
            "message"=>"done",
        ];
        echo json_encode($res);
    }
    
}

if(isset($_POST['assign'])){
    $id = $_POST['flist'];
    $rid = $_POST['rid'];
    $sql = "UPDATE advisor_courses SET faculty = '$id' WHERE id = '$rid'";
    $query_run = mysqli_query($conn,$sql);
    if($query_run){
        $res=[
            "status"=>200,
            "message"=>"success",
        ];
        echo json_encode($res);
    }
}

if(isset($_POST['coursename'])){
    $course_id = $_POST['id'];
    $sql="SELECT * FROM course where code='$course_id'";
    $query_run = mysqli_query($conn,$sql);
    $query_data = mysqli_fetch_assoc($query_run);
    if($query_data){
        $res=[
            "status"=>200,
            "message"=>"success",
            "data"=>$query_data
        ];
        echo json_encode($res);
    }
}


if(isset($_POST['facultyname'])){
    $fac_id = $_POST['id'];
    $sql="SELECT * FROM faculty where faculty_id = '$fac_id'";
    $query_run = mysqli_query($conn,$sql);
    $query_data = mysqli_fetch_assoc($query_run);
    if($query_data){
        $res=[
            "status"=>200,
            "message"=>"success",
            "data"=>$query_data
        ];
        echo json_encode($res);
    }
}

if(isset($_POST['indcourse'])){

    $sql = "SELECT * FROM advisor_courses WHERE advisor_id='$fac_id'";
    $sql_run = mysqli_query($conn,$sql);
    $query_data = mysqli_fetch_all($sql_run,MYSQLI_ASSOC);
    if($query_data){
        $res=[
            "status"=>200,
            "message"=>"done",
            "data"=>$query_data,

        ];
        echo json_encode($res);
    }

}


if(isset($_POST['tt'])){
    $row = $_POST['id'];
    $hour = $_POST['hour'];
    $course = $_POST['code'];
    $sql = "SELECT * FROM advisor WHERE faculty_id='$fac_id'";
    $sql_run = mysqli_query($conn,$sql);
    $sql_data = mysqli_fetch_array($sql_run);
    $year = $sql_data['year'];
    $section = $sql_data['section'];
    $sql1  = "UPDATE time_table SET $hour='$course' WHERE id='$row'";
    $sql1_run = mysqli_query($conn,$sql1);
    if($sql1_run){
        $res=[
            "status"=>200,
            "message"=>"Done",
        ];
        echo json_encode($res);
    }

}

if(isset($_POST['get_tt'])){
    $date = date("d/m/Y");
    $day = date("l");
    $sql = "SELECT * FROM time_table WHERE section='$section' AND year='$year' AND day = '$day' AND dept='$dept' ";
    $sql_run = mysqli_query($conn,$sql);
    $sql_data = mysqli_fetch_array($sql_run);
    if($sql_data){
        $res=[
            "status"=>200,
            "message"=>"done",
            "data"=>$sql_data,
            "date"=>$date,
        ];
        echo json_encode($res);
    }
}



if(isset($_POST['getcdetail'])){
    $code = $_POST['code'];
    $sql = "SELECT * FROM advisor_courses WHERE course_id='$code' AND dept='$dept'";
    $sql_run = mysqli_query($conn,$sql);
    $sql_data = mysqli_fetch_array($sql_run);
    $fac1_id = $sql_data['faculty'];
    $sql1 = "SELECT * FROM faculty WHERE faculty_id='$fac1_id'";
    $sql1_run = mysqli_query($conn,$sql1);
    $sql1_data = mysqli_fetch_array($sql1_run);
    $fac1_name = $sql1_data['faculty_name'];
    $sql2 = "SELECT * FROM course WHERE code='$code'";
    $sql2_run  = mysqli_query($conn,$sql2);
    $sql2_data = mysqli_fetch_array($sql2_run);
    $c_name = $sql2_data['name'];
    if($sql_data && $sql1_data && $sql2_data){
        $res=[
            "status"=>200,
            "message"=>"succcess",
            "cname"=>$c_name,
            "fac_name"=>$fac1_name,
        ];
        echo json_encode($res);
    }




}

if(isset($_POST["getothertt"])){

    // Fetch courses assigned to this faculty
    $sql1 = "SELECT course_id FROM advisor_courses WHERE faculty='$fac_id'";
    $sql1_run = mysqli_query($conn, $sql1);

    $courses = [];
    while($sql1_data = mysqli_fetch_assoc($sql1_run)){
        $courses[] = $sql1_data['course_id'];
    }

    if(!empty($courses)){
        $today = date('l'); 

        // Fetch timetable where the day is today
        $sql2 = "SELECT * FROM time_table WHERE day='$today'";
        $sql2_run = mysqli_query($conn, $sql2);

        $timetable = [];
        while($row = mysqli_fetch_assoc($sql2_run)){
            $entry = [
                "year" => $row["year"],
                "department" => $row["dept"],
                "section" => $row["section"],
                "day" => $row["day"],
                "schedule" => []
            ];

            for($i = 1; $i <= 7; $i++){
                $hour = "hour" . $i;
                if(in_array($row[$hour], $courses)){ 
                    $entry["schedule"][$hour] = $row[$hour];
                }
            }

            if(!empty($entry["schedule"])){
                $timetable[] = $entry;
            }
        }

        echo json_encode($timetable);
    } else {
        echo json_encode(["error" => "No courses found for this faculty"]);
    }
}

if(isset($_POST['fetch_c_detail'])){
    $code = $_POST['course1'];
    $sql1 = "SELECT * FROM course WHERE code='$code'";
    $sql2 = "SELECT * FROM advisor_courses WHERE course_id='$code' AND faculty='$fac_id'";
    $sql1_run = mysqli_query($conn,$sql1);
    $sql2_run = mysqli_query($conn,$sql2);
    $sql1_data = mysqli_fetch_array($sql1_run);
    $sql2_data = mysqli_fetch_array($sql2_run);
    $year = $sql2_data['year'];
    $section = $sql2_data['section'];
    $dept = $sql2_data['dept'];
    $c_name = $sql1_data['name'];

    $stud_sql = "SELECT * FROM students WHERE section='$section'";
    $stud_sql_run = mysqli_query($conn,$stud_sql);
    $students =  [];
    while($row = mysqli_fetch_assoc($stud_sql_run)){
        $students[] = $row;

    }
    if($sql2_data){
        $res=[
            "status"=>200,
            "dept"=>$dept,
            "section"=>$section,
            "year"=>$year,
            "c_name"=>$c_name,
            "stud"=>$students,
        ];
        echo json_encode($res);
    }


}


?>
<?php

if (isset($_POST['btnCartSubmit'])) {
  # code...
  $query = "SELECT * FROM tblstudent s, course c WHERE s.COURSE_ID=c.COURSE_ID AND IDNO=".$_SESSION['IDNO'];
            $result = mysqli_query($mydb->conn,$query) or die(mysqli_error($mydb->conn));
            $row = mysqli_fetch_assoc($result);

$sql = "SELECT sum(UNIT) as 'Unit' FROM subject WHERE COURSE_ID =".$row['COURSE_ID']." AND SEMESTER='" .$_SESSION['SEMESTER']."'";
$result = mysqli_query($mydb->conn,$sql) or die(mysqli_error($mydb->conn));
$totunits = mysqli_fetch_assoc($result);


// echo $totunits['Unit']; 
// units to be taken
$totunit =0;

            $query = "SELECT * FROM tblstudent s, course c WHERE s.COURSE_ID=c.COURSE_ID AND IDNO=".$_SESSION['IDNO'];
            $result = mysqli_query($mydb->conn,$query) or die(mysqli_error($mydb->conn));
            $row = mysqli_fetch_assoc($result);

            $query = "SELECT * 
                      FROM `subject` s, `course` c WHERE s.COURSE_ID=c.COURSE_ID
                      AND COURSE_NAME='".$row['COURSE_NAME']."' AND COURSE_LEVEL=".$row['YEARLEVEL']."
                      AND  SEMESTER ='".$_SESSION['SEMESTER']."' AND
                      NOT FIND_IN_SET(  `PRE_REQUISITE` , ( 
                      SELECT GROUP_CONCAT(SUBJ_CODE SEPARATOR ',') FROM tblstudent s,grades g,subject sub
                      WHERE s.IDNO=g.IDNO AND g.SUBJ_ID=sub.SUBJ_ID AND AVE <=74.5 
                      AND  s.IDNO =" .$_SESSION['IDNO'].")
                      )";

                $mydb->setQuery($query);
                $cur = $mydb->loadResultList(); 
                foreach ($cur as $result) {  
                   $totunit +=  $result->UNIT ;
                }
 
            if (isset( $_SESSION['gvCart'])){ 

             $count_cart = count($_SESSION['gvCart']);

                for ($i=0; $i < $count_cart  ; $i++) {  

                    $query = "SELECT * FROM `subject` s, `course` c 
                    WHERE s.COURSE_ID=c.COURSE_ID AND SUBJ_ID=" . $_SESSION['gvCart'][$i]['subjectid'];
                     $mydb->setQuery($query);
                     $cur = $mydb->loadResultList(); 
                      foreach ($cur as $result) {   
                           $totunit +=  $result->UNIT ;
                      }  
                }
  
              } 


    if ($totunit > $totunits['Unit']) {
      # code...
    message("Warning....! Your total units have exceeded, ".$totunits['Unit'] ." units are only allowed to taken.","error");
    redirect("index2.php?q=cart"); 
    } 
}


?>
<form action="index2.php?q=payment" method="POST">
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
 <!-- Main content -->
 <?php   //check_message();  ?> 
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h3 class="page-header">
            <i class="fa fa-user"></i> Student Information
            <small class="pull-right">Date: <?php echo date('m/d/Y'); ?></small>
          </h3>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-8 invoice-col"> 
          <address>
            <?php
            $stud = New Student();
            $singleStud = $stud->single_student($_SESSION['IDNO']);
            $currentYear = date('Y');
            $nextYear =  date('Y') + 1;
            $sy = $currentYear .'-'.$nextYear;
            $_SESSION['SY'] = $sy; 

            $startYear = $currentYear - 5;
            $endYear = $nextYear + 3;

            ?>
            <b>Name : <?php echo $singleStud->LNAME. ', ' .$singleStud->FNAME .' ' .$singleStud->EXT .' ' .$singleStud->MNAME;?></b><br>
            Address : <?php echo $singleStud->CURRENT_ADD;?><br> 
            
          </address>
          <select class="form-control" name="GRADE">
						<?php
						if(!empty($singleStud->COURSE_ID)){
							$course = New Course();
							$singlecourse = $course->single_course($singleStud->COURSE_ID);
							if($singlecourse->COURSE_MAJOR != "N/A"){
							echo '<option value='.$singlecourse->COURSE_ID.' >'.$singlecourse->COURSE_NAME.' - Grade '.$singlecourse->COURSE_LEVEL.' ('.$singlecourse->COURSE_MAJOR.')</option>';
							}else{
							echo '<option value='.$singlecourse->COURSE_ID.' >'.$singlecourse->COURSE_NAME.' - Grade '.$singlecourse->COURSE_LEVEL.' </option>';
							}
						}else{
							echo '<option value="Select">Select</option>';
						}
					
						?>
						<?php 
						$mydb->setQuery("SELECT * FROM `course`");
						$cur = $mydb->loadResultList();

						foreach ($cur as $result) {
							if($result->COURSE_MAJOR != "N/A"){
                                echo '<option value='.$result->COURSE_ID.' >'.$result->COURSE_NAME.' - Grade '.$result->COURSE_LEVEL.' ('.$result->COURSE_MAJOR.')</option>';
							}else{
								echo '<option value='.$result->COURSE_ID.' >'.$result->COURSE_NAME.' - Grade '.$result->COURSE_LEVEL.' </option>';
							}
						}
						?>
					</select> 
          <select id="schoolYear" name="schoolYear" class="form-control">
					<?php
					// Loop through the range of years to create options
					for ($year = $startYear; $year <= $endYear; $year++) {
						$selected = ($year . '-' . ($year + 1) == $sy) ? 'selected' : ''; // Check if the year matches the current school year
						echo "<option value=\"$year-$nextYear\" $selected>$year-$nextYear</option>";
					}
					?>
					</select>
          
        </div>
      </div>
</div>


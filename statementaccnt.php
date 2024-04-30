<?php
require_once("include/initialize.php");
   
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SNHS Balugo Extension Enrollment System  </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link href="<?php echo web_root; ?>admin/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo web_root; ?>admin/css/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?php echo web_root; ?>admin/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo web_root; ?>admin/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
 
   <link href="<?php echo web_root; ?>admin/css/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo web_root; ?>admin/font/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  <link href="<?php echo web_root; ?>admin/font/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- DataTables CSS -->
    <link href="<?php echo web_root; ?>admin/css/dataTables.bootstrap.css" rel="stylesheet">
 
     <!-- datetime picker CSS -->
<link href="<?php echo web_root; ?>css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
 <link href="<?php echo web_root; ?>css/datepicker.css" rel="stylesheet" media="screen">
 
 <link href="<?php echo web_root; ?>admin/css/costum.css" rel="stylesheet">
</head>
<body onload="window.print()">
<div class="wrapper"> 
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <h3 align="center">Statement of Accounts</h3>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <h4 class="page-header">
            <i class="fa fa-user"></i> Student Information
            <small class="pull-right">Date: <?php echo date('m/d/Y'); ?></small>
          </h4>
        </div>
        <!-- /.col -->
      </div> 
      <table>
        <tr>
          <td width="75%" colspan="2" >
            <address>
            <b>Name : <?php echo $_SESSION['LNAME']. ', ' .$_SESSION['FNAME'] .' ' .$_SESSION['EXT'] .' ' .$_SESSION['MNAME'];?></b><br>
            Address : <?php echo $_SESSION['CURRENT_ADD'];?><br> 
            
          </address>
          </td>
          <td >
             <b>Grade Level:  <?php 

            $course = New Course();
            $singlecourse = $course->single_course($_SESSION['COURSEID']);
            echo $_SESSION['COURSE_YEAR'] = $singlecourse->COURSE_NAME.' - Grade '.$singlecourse->COURSE_LEVEL;
            $_SESSION['COURSELEVEL'] = $singlecourse->COURSE_LEVEL;
            ?></b><br>
          <b>Academic Year : <?php echo $_SESSION['SY']; ?></b>
          </td>
        </tr>
      </table>
         
<?php 
// if (isset($_POST['btnCartSubmit'])) {
  
  if (isset($_SESSION['gvCart'])){
  # code...
?>
<!-- Table row -->
<div class="row">
  <div class="col-xs-12 table-responsive">
    <table class="table table-striped">
      <thead>
      <tr> 
        <th>Id</th>
        <th>Subject</th>
        <th>Description</th>
        <th>Unit</th>  
      </tr>
      </thead>
      <tbody>
      <?php  
        $totunit = '';
          if (isset($_SESSION['gvCart'])){


             $count_cart = count($_SESSION['gvCart']);

                for ($i=0; $i < $count_cart  ; $i++) {  

                    $query = "SELECT * FROM `subject` s, `course` c WHERE s.COURSE_ID=c.COURSE_ID AND SUBJ_ID=" . $_SESSION['gvCart'][$i]['subjectid'];
                     $mydb->setQuery($query);
                     $cur = $mydb->loadResultList(); 
                      foreach ($cur as $result) { 

                         echo '<tr>';
                          // echo '<td width="5%" align="center"></td>';
                          echo '<td>' . $result->SUBJ_ID.'</a></td>';
                          echo '<td>'. $result->SUBJ_CODE.'</td>';
                          echo '<td>'. $result->SUBJ_DESCRIPTION.'</td>';
                          echo '<td>' . $result->UNIT.'</a></td>';
                          echo '</tr>';
                        
                          $totunit +=  $result->UNIT; 
                      }      
                }  
              } 
          ?>
      </tbody>
     </table>  
<?php
}else{ 
?> 
    <table class="table table-striped">
      <thead>
      <tr> 
        <th>Id</th>
        <th>Subject</th>
        <th>Description</th>
        <th>Unit</th>  
      </tr>
      </thead>
      <tbody> 
      <?php 
        $mydb->setQuery("SELECT * FROM `subject` s, `course` c, `tblschedule` sc
        WHERE s.COURSE_ID=c.COURSE_ID 
        AND s.SUBJ_ID = sc.SUBJ_ID
        AND c.COURSE_ID = '".$_SESSION['COURSEID']."' ");

        $cur = $mydb->loadResultList();

        foreach ($cur as $result) {
        echo '<tr>';
        echo '<td>'.$result->SUBJ_ID.'</td>';
        echo '<td>'.$result->SUBJ_CODE.'</td>'; 
        echo '<td>'.$result->SUBJ_DESCRIPTION.'</td>';
        echo '<td>'.$result->sched_day.' '.$result->sched_time.' '.$result->sched_room.'</td>';
        echo '</tr>';
        }
      ?>
      </tbody>
    </table> 
<?php
}
?>

      <!-- /.row --> 
    </section> 
    </div>
 </body>
 </html>
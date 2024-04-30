 <?php
 require_once ("include/initialize.php"); 
//  if (@$_GET['page'] <= 2 or @$_GET['page'] > 5) {
//   # code...
//     // unset($_SESSION['PRODUCTID']);
//     // // unset($_SESSION['QTY']);
//     // // unset($_SESSION['TOTAL']);
// } 


 
if(isset($_POST['sidebarLogin'])){
  $email = trim($_POST['U_USERNAME']);
  $upass  = trim($_POST['U_PASS']);
  $h_upass = sha1($upass);
  
   if ($email == '' OR $upass == '') {

      message("Invalid Username and Password!", "error");
      redirect(web_root."index2.php");
         
    } else {   
        $stud = new Student();
        $studres = $stud->studAuthentication($email,$h_upass);

        if ($studres==true){
          
          $sql="INSERT INTO `tbllogs` (`USERID`, `LOGDATETIME`, `LOGROLE`, `LOGMODE`) 
          VALUES (".$_SESSION['IDNO'].",'".date('Y-m-d H:i:s')."','Student','Logged in')";
          $mydb->setQuery($sql);
          $mydb->executeQuery();

           redirect(web_root."index2.php?q=profile");
        }else{
             message("Invalid Username and Password! Please contact administrator", "error");
             redirect(web_root."index2.php");
        }
 
 }
}

if(isset($_POST['oldLogin'])){
  $email = trim($_POST['U_USERNAME']);
  $upass  = trim($_POST['U_PASS']);
  $h_upass = sha1($upass);
  
   if ($email == '' OR $upass == '') {

      message("Invalid Username and Password!", "error");
      redirect(web_root."index2.php");
         
    } else {   
        $stud = new Student();
        $studres = $stud->studAuthentication($email,$h_upass);

        if ($studres==true){
          
          $sql="INSERT INTO `tbllogs` (`USERID`, `LOGDATETIME`, `LOGROLE`, `LOGMODE`) 
          VALUES (".$_SESSION['IDNO'].",'".date('Y-M-d h:i:s')."','Student','Logged in')";
       
         mysqli_query($mydb->conn,$sql) or die(mysqli_error($mydb->conn));

           redirect(web_root."index2.php?q=profile");
        }else{
             message("Invalid Username and Password! Please contact administrator", "error");
             redirect(web_root."index2.php?q=enrol");
        }
 
 }
}


 if(isset($_POST['modalLogin'])){
  $email = trim($_POST['U_USERNAME']);
  $upass  = trim($_POST['U_PASS']);
  $h_upass = sha1($upass);
  
   if ($email == '' OR $upass == '') { 
      message("Invalid Username and Password!", "error");
       redirect(web_root."index2.php?q=profile");
         
    } else {   
        $stud = new Student();
        $studres = $stud::studAuthentication($email,$h_upass);

        if ($studres==true){
           redirect(web_root."index2.php?q=orderdetails");
        }else{
             message("Invalid Username and Password! Please contact administrator", "error");
             redirect(web_root."index2.php");
        }
 
 }
 }
 ?> 
 

 
<!-- `IDNO`, `FNAME`, `LNAME`, `MNAME`, `SEX`, `BDAY`, `BPLACE`, `STATUS`, `AGE`, `NATIONALITY`,
`RELIGION`, `CONTACT_NO`, `HOME_ADD`, `EMAIL`, `ACC_PASSWORD`, `student_status`, `schedID`, `course_year` -->
<?php
if (isset($_POST['regsubmit'])) {

	$_SESSION['STUDID'] 	  =  $_POST['IDNO'];
	$_SESSION['COURSEID'] 	  =  $_POST['GRADE'];
	
	$_SESSION['psa_no'] 	  =  $_POST['psa_no'];
	
	if(isset($_FILES['psa_file']) && $_FILES['psa_file']['error'] === UPLOAD_ERR_OK) {
		$tmp_file_path = $_FILES['psa_file']['tmp_name'];
        $uploads_directory = 'uploads/'; 
        $file_name = $_FILES['psa_file']['name'];
        $destination = $uploads_directory . $file_name;
        if(move_uploaded_file($tmp_file_path, $destination)) {
            $_SESSION['psa_file'] = $destination;
        } else {
            echo "Error moving uploaded file.";
        }
	}else{
		$_SESSION['psa_file'] 	  =  "";
	}

	if(isset($_FILES['report_card']) && $_FILES['report_card']['error'] === UPLOAD_ERR_OK) {
		$tmp_file_path = $_FILES['report_card']['tmp_name'];
        $uploads_directory = 'uploads/'; 
        $file_name = $_FILES['report_card']['name'];
        $destination = $uploads_directory . $file_name;
        if(move_uploaded_file($tmp_file_path, $destination)) {
            $_SESSION['report_card'] = $destination;
        } else {
            echo "Error moving uploaded file.";
        }
	}else{
		$_SESSION['report_card'] 	  =  "";
	}

	$_SESSION['lrn'] 	  	=  $_POST['lrn'];
	$_SESSION['LRN_NO'] 	  	=  $_POST['lr_no'];
	$_SESSION['returning'] 	  	=  $_POST['returning'];
	$_SESSION['FNAME'] 	      =  $_POST['FNAME'];
	$_SESSION['LNAME']  	  =  $_POST['LNAME'];
	$_SESSION['MI']           =  $_POST['MI'];
	$_SESSION['EXT']           =  $_POST['EXT'];
	$_SESSION['SEX']          =  $_POST['sex'];
	$_SESSION['BIRTHDATE']    = date_format(date_create($_POST['BIRTHDATE']),'Y-m-d'); 
	//$_SESSION['age']          =  $_POST['age'];
	$_SESSION['schoolYear']          =  $_POST['schoolYear'];
	$_SESSION['mother_tongue']          =  $_POST['mother_tongue'];
	if($_POST['ip'] == 1){
		$_SESSION['ip_name']          =  $_POST['ip_name'];
	}else{
		$_SESSION['ip_name']          =  "";
	}

	if($_POST['beneficiary'] == 1){
		$_SESSION['beneficiary_id']          =  $_POST['beneficiary_id'];
	}else{
		$_SESSION['beneficiary_id']          =  "";
	}

	if($_POST['disability'] == 1){
		$_SESSION['disability_name']          =  $_POST['disability_name'];
	}else{
		$_SESSION['disability_name']          =  "";
	}

	$_SESSION['BIRTHPLACE']   =  $_POST['BIRTHPLACE'];

	$_SESSION['CADDRESS']     =  $_POST['CADDRESS'];
	$_SESSION['paddress']     =  $_POST['paddress'];
	if($_POST['paddress'] == 1){
		$_SESSION['PADDRESS']     =  $_POST['CADDRESS'];
	}else{
		$_SESSION['PADDRESS']     =  $_POST['PADDRESS'];
	}
	
	$_SESSION['GUARDIAN1']     =  $_POST['GUARDIAN1'];
	$_SESSION['GUARDIAN2']     =  $_POST['GUARDIAN2'];
	$_SESSION['GUARDIAN3']     =  $_POST['GUARDIAN3'];
	$_SESSION['GCONTACT1']     =  $_POST['GCONTACT1'];
	$_SESSION['GCONTACT2']     =  $_POST['GCONTACT2'];
	$_SESSION['GCONTACT3']     =  $_POST['GCONTACT3'];

	$_SESSION['USER_NAME']    =  $_POST['USER_NAME']; 
	$_SESSION['PASS']    	  =  $_POST['PASS']; 
	$_SESSION['CONFIRM_PASS']    	  =  $_POST['CONFIRM_PASS']; 

	$student = New Student();
	$res = $student->find_all_student($_POST['LNAME'],$_POST['FNAME'],$_POST['MI']);

	if ($res) {
		# code...
		message("Student already exist.", "error");
		redirect(web_root."index2.php?q=enrol");

	}else{
		$sql="SELECT * FROM tblstudent WHERE ACC_USERNAME='" . $_SESSION['USER_NAME'] . "'";
		$userresult = mysqli_query($mydb->conn,$sql) or die(mysqli_error($mydb->conn));
		$userStud  = mysqli_fetch_assoc($userresult);

		if($userStud){
			message("Username is already taken.", "error");
			redirect(web_root."index2.php?q=enrol");
		}else{
			if($_SESSION['COURSEID']=='Select'){
				message("Please select grade level", "error");
				redirect(web_root."index2.php?q=enrol");
			}else{
				if ($_SESSION['PASS'] != $_SESSION['CONFIRM_PASS']) {
					message("Passwords do not match", "error");
					redirect(web_root."index2.php?q=enrol");
					
				}else{
					$student = New Student();
					$student->IDNO 				= $_SESSION['STUDID'];
					$student->FNAME 			= $_SESSION['FNAME'];
					$student->LNAME 			= $_SESSION['LNAME'];
					$student->MNAME 			= $_SESSION['MI'];
					$student->EXT 				= $_SESSION['EXT'];
					
					$student->BALIK_ARAL 		= $_SESSION['returning'];
					$student->PSA_NO 			= $_SESSION['psa_no'];
					$student->REPORT_CARD 		= $_SESSION['report_card'];
					$student->PSA_FILE 			= $_SESSION['psa_file'];
					$student->LRN_NO 			= $_SESSION['lrn'];
					$student->LR_NO 			= $_SESSION['LRN_NO'];
					$student->SEX 				= $_SESSION['SEX'];
					$student->BDAY 				= $_SESSION['BIRTHDATE'];
					$student->BPLACE 			= $_SESSION['BIRTHPLACE'];
					//$student->AGE 				= $_SESSION['age'];
					$student->MOTHER_TONGUE 	= $_SESSION['mother_tongue'];
					$student->IP_NAME 			= $_SESSION['ip_name'];
					$student->BENEFICIARY_ID 	= $_SESSION['beneficiary_id'];
					$student->DISABILITY_NAME 	= $_SESSION['disability_name'];
					$student->CURRENT_ADD 		= $_SESSION['CADDRESS'];
					$student->PERMANENT_ADD 	= $_SESSION['PADDRESS'];
					$student->ACC_USERNAME		= $_SESSION['USER_NAME'];
					$student->ACC_PASSWORD 		= sha1($_SESSION['PASS']);
					$student->COURSE_ID   		= $_SESSION['COURSEID'];
					$student->SYEAR   		= $_SESSION['schoolYear'];
					$student->student_status 	='New';

					$sql="SELECT * FROM course WHERE COURSE_ID ='" . $_SESSION['COURSEID'] . "'";
					$userresult = mysqli_query($mydb->conn,$sql) or die(mysqli_error($mydb->conn));
					if (mysqli_num_rows($userresult) > 0) {
						while ($row = mysqli_fetch_assoc($userresult)) {
							$student->YEARLEVEL   		= $row['COURSE_LEVEL'];
						}
					}
					//$student->YEARLEVEL   		= 7; 
					$student->NewEnrollees  	= 1; 
					$student->create();

					$studentdetails = New StudentDetails();
					$studentdetails->IDNO = $_SESSION['STUDID'];
					$studentdetails->GUARDIAN1 = $_SESSION['GUARDIAN1'];
					$studentdetails->GUARDIAN2 = $_SESSION['GUARDIAN2'];
					$studentdetails->GUARDIAN3 = $_SESSION['GUARDIAN3'];
					$studentdetails->GCONTACT1 = $_SESSION['GCONTACT1']; 
					$studentdetails->GCONTACT2 = $_SESSION['GCONTACT2']; 
					$studentdetails->GCONTACT3 = $_SESSION['GCONTACT3']; 
					$studentdetails->create(); 

					$studAuto = New Autonumber();
					$studAuto->studauto_update();

					@$_SESSION['IDNO'] = $_SESSION['STUDID'];
					redirect("index2.php?q=profile");
				}
			}
		}

# code...
// unset($_SESSION['STUDID']);
// unset($_SESSION['FNAME']);
// unset($_SESSION['LNAME']);
// unset($_SESSION['MI']);
// unset($_SESSION['PADDRESS']);
// unset($_SESSION['SEX']);
// unset($_SESSION['BIRTHDATE']); 
// unset($_SESSION['BIRTHPLACE']);
// unset($_SESSION['RELIGION']);
// unset($_SESSION['CONTACT']);
// unset($_SESSION['CIVILSTATUS']);
// unset($_SESSION['GUARDIAN']);
// unset($_SESSION['GCONTACT']);
// unset($_SESSION['COURSEID']);
// unset($_SESSION['SEMESTER']); 
// unset($_SESSION['USER_NAME']);
// unset($_SESSION['PASS']); 
	}
}


$currentYear = date('Y');
$nextYear =  date('Y') + 1;
$sy = $currentYear .'-'.$nextYear;
$_SESSION['SY'] = $sy; 

$startYear = $currentYear - 5;
$endYear = $nextYear + 3;

$studAuto = New Autonumber();
$autonum = $studAuto->stud_autonumber();
?>
<?php
	// $currentyear = date('Y');
	// $nextyear =  date('Y') + 1;
	// $sy = $currentyear .'-'.$nextyear;
	// $_SESSION['SY'] = $sy;
	// // $newDate    = Carbon::createFromFormat('Y-m-d',$_SESSION['SY'] )->addYear(1);


	// $studAuto = New Autonumber();
	// $autonum = $studAuto->stud_autonumber();
?>

<form action="" class="form-horizontal well" method="post"  enctype="multipart/form-data">
<!-- <form action="index.php?q=subject" class="form-horizontal well" method="post" > -->
	<div class="table-responsive">
		<div class="col-md-8">
			<h2>Basic Education Enrollment Form</h2>
		</div>
		<table class="table">
			<tr>
				<td>
					<label>ID</label>
				</td>
				<td colspan="2">
					<input class="form-control input-md" readonly id="IDNO" name="IDNO" placeholder="Student Id" type="text" value="<?php echo isset($_SESSION['STUDID']) ? $_SESSION['STUDID'] : $autonum->AUTO; ?>">
				</td>
				
			</tr>
			<tr>
				<td>
					<label>School Year</label>
				</td>
				<td colspan="2">
					<select id="schoolYear" name="schoolYear" class="form-control">
					<?php
					// Loop through the range of years to create options
					for ($year = $startYear; $year <= $endYear; $year++) {
						$selected = ($year . '-' . ($year + 1) == $sy) ? 'selected' : ''; // Check if the year matches the current school year
						echo "<option value=\"$year-$nextYear\" $selected>$year-$nextYear</option>";
					}
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					Check the appropriate box only:
					<label>With LRN?</label>
				</td>
				<td colspan="2">
					<br>
					<input type="radio" id="lrnYes" name="lrn" value="1">
					<label for="lrnYes">Yes</label>
					<input type="radio" id="lrnNo" name="lrn" value="0" checked>
					<label for="lrnNo">No</label>
				</td>
			</tr>
			<tr>
				<td>
					<br>
					<label>Returning (Balik-Aral)</label>
				</td>
				<td colspan="2">
					<br>
					<input type="radio" id="returningYes" name="returning" value="1">
					<label for="returningYes">Yes</label>
					<input type="radio" id="returningNo" name="returning" value="0" checked>
					<label for="returningNo">No</label>
				</td>
			</tr>
			<tr>
				<td>
					<label>Learner Reference No.:</label>
				</td>
				<td colspan="2" style="width:30%">
					<input type="text" name="lr_no" id="lr_no" class="form-control">
				</td>
			</tr>
			<tr>
				<td>
					<label>Grade to Enroll</label>
				</td>
				<td colspan="2">
					<select class="form-control" name="GRADE">
						<?php
						if(isset($_SESSION['GRADE'])){
							$course = New Course();
							$singlecourse = $course->single_course($_SESSION['GRADE']);
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
				</td>
				<td>
					<label for="report_card">Upload Previous Report Card:</label>
					<input type="file" id="report_card" name="report_card"><br><br>
				</td>
			</tr>

			<tr>
				<td>
					<label>PSA Birth Certificate No.</label> (if available upon registration)
				</td>
				<td colspan="2">
					<input type="text" name="psa_no" id="psa_no" class="form-control">
				</td>
				<td>
					<label for="psa_file">Upload PSA File:</label>
					<input type="file" id="psa_file" name="psa_file"><br><br>
				</td>
			</tr>

			<tr>
				<td>
					<label>Name</label>
				</td>
				<td colspan="2">
					<input required="true"  class="form-control input-md" id="LNAME" name="LNAME" placeholder="Last Name" type="text" value="<?php echo isset($_SESSION['LNAME']) ? $_SESSION['LNAME'] : ''; ?>">
				</td> 
				<td>
					<input required="true"   class="form-control input-md" id="FNAME" name="FNAME" placeholder="First Name" type="text" value="<?php echo isset($_SESSION['FNAME']) ? $_SESSION['FNAME'] : ''; ?>">
				</td>
			</tr>
			<tr>
				<td>
				</td>
				<td colspan="2">
					<input class="form-control input-md" id="MI" name="MI" placeholder="Middle Name" type="text" value="<?php echo isset($_SESSION['MI']) ? $_SESSION['MI'] : ''; ?>">
				</td>
				<td colspan="">
					<input class="form-control input-md" id="EXT" name="EXT" placeholder="Extension " type="text" value="<?php echo isset($_SESSION['EXT']) ? $_SESSION['EXT'] : ''; ?>">
				</td> 
			</tr>
			<tr>
				<td ><label>Sex </label></td> 
				<td colspan="">
					<label>
						<input checked id="optionsRadios1" name="sex" type="radio" value="Female">Female 
						<input id="optionsRadios2" name="sex" type="radio" value="Male"> Male
					</label>
				</td>
				
				<!--<td style="text-align:right">
					<label>Age</label>
				</td>
				<td colspan=""> 
					<div class="input-group" >
						<input type="number" name="age" id="age" class="form-control input-md">
					</div>             
				</td>-->
			</tr>
			<tr>
				<td>
					<label>Date of birth</label>
				</td>
				<td colspan=""> 
					<div class="input-group" >
						<div class="input-group-addon"> 
							<i class="fa fa-calendar"></i>
						</div>
						<input  required="true" name="BIRTHDATE"  id="BIRTHDATE"  type="date" class="form-control input-md" value="<?php echo isset($_SESSION['BIRTHDATE']) ? $_SESSION['BIRTHDATE'] : ''; ?>">
					</div>             
				</td>
				<td>
					<label>Place of Birth</label><br>
					(Municipality/City)
				</td>
				<td colspan="">
					<input required="true"  class="form-control input-md" id="BIRTHPLACE" name="BIRTHPLACE" placeholder="Place of Birth" type="text" value="<?php echo isset($_SESSION['BIRTHPLACE']) ? $_SESSION['BIRTHPLACE'] : ''; ?>">
				</td>
			</tr>
			<tr>
				<td>
					<label>Mother Tongue</label>
				</td>
				<td>
					<input type="text" name="mother_tongue" id="mother_tongue" class="form-control input-md">
				</td>
				
			</tr>
			<tr>
				<td colspan="2">
					<label>Belonging to any Indigenous Peoples (IP) Community / Indigenous Cultural Community</label><br>
					<input type="radio" id="ipYes" name="ip" value="1">
					<label for="ipYes">Yes</label>
					<input type="radio" id="ipNo" name="ip" value="0" checked>
					<label for="ipNo">No</label>
				</td>
				<td colspan="2">
					<label>If yes, please specify:</label><br>
					<input type="text" name="ip_name" id="ip_name" class="form-control input-md" disabled>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<label>Is your family a beneficiary of 4Ps?</label><br>
					<input type="radio" id="4psYes" name="beneficiary" value="1">
					<label for="4psYes">Yes</label>
					<input type="radio" id="4psNo" name="beneficiary" value="0" checked>
					<label for="4psNo">No</label>
				</td>
				<td colspan="2">
					<label>If yes, write the 4Ps Household ID Number:</label><br>
					<input type="text" name="beneficiary_id" id="beneficiary_id" class="form-control input-md" disabled>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<label>Is the child a Learner with disablity?</label><br>
					<input type="radio" id="disabilityYes" name="disability" value="1">
					<label for="disabilityYes">Yes</label>
					<input type="radio" id="disabilityNo" name="disability" value="0" checked>
					<label for="disabilityNo">No</label>
				</td>
				<td colspan="2">
					<label>If yes, specify the type of disablity:</label><br>
					<input type="text" name="disability_name" id="disability_name" class="form-control input-md" disabled>
				</td>
			</tr>
			<tr>
				<td colspan="6">
					Address
				</td>
			</tr>
			<tr>
				<td><label>Current Address</label></td>
				<td colspan="5"  >
				<input required="true"  class="form-control input-md" id="CADDRESS" name="CADDRESS" placeholder="Permanent Address" type="text" value="<?php //echo isset($_SESSION['CADDRESS']) ? $_SESSION['CADDRESS'] : ''; ?>">
				</td> 
			</tr>
			<tr>
				<td>
					<label>Permanent Address</label>
				</td>
				<td colspan="5"  >
					<label>Same with your Current Address?</label>
					<input type="radio" id="addressYes" name="paddress" value="1" checked>
					<label for="addressYes">Yes</label>
					<input type="radio" id="addressNo" name="paddress" value="0">
					<label for="addressNo">No</label><br>
					<input required="true"  class="form-control input-md" id="PADDRESS" name="PADDRESS" placeholder="Permanent Address" type="text" value="<?php //echo isset($_SESSION['PADDRESS']) ? $_SESSION['PADDRESS'] : ''; ?>" disabled>
				</td> 
			</tr>
			<!--<tr>
				<td><label>Nationality</label></td>
				<td colspan="2"><input required="true"  class="form-control input-md" id="NATIONALITY" name="NATIONALITY" placeholder="Nationality" type="text" value="<?php //echo isset($_SESSION['CONTACT']) ? $_SESSION['CONTACT'] : ''; ?>">
							</td>
				<td><label>Religion</label></td>
				<td colspan="2"><input  required="true" class="form-control input-md" id="RELIGION" name="RELIGION" placeholder="Religion" type="text" value="<?php //echo isset($_SESSION['RELIGION']) ? $_SESSION['RELIGION'] : ''; ?>">
				</td>
			</tr>
			<tr>
			<td><label>Contact No.</label></td>
				<td colspan="6"><input required="true"  class="form-control input-md" id="CONTACT" name="CONTACT" placeholder="Contact Number" type="number" maxlength="11" value="<?php //echo isset($_SESSION['CONTACT']) ? $_SESSION['CONTACT'] : ''; ?>">
							</td>
				
			</tr>
			<tr>
				<td><label>Civil Status</label></td>
				<td colspan="2">
					<select class="form-control input-sm" name="CIVILSTATUS">
						<option value="<?php //echo isset($_SESSION['CIVILSTATUS']) ? $_SESSION['CIVILSTATUS'] : 'Select'; ?>"><?php //echo isset($_SESSION['CIVILSTATUS']) ? $_SESSION['CIVILSTATUS'] : 'Select'; ?></option>
						<option value="Single">Single</option>
						<option value="Married">Married</option> 
						<option value="Widow">Widow</option>
					</select>
				</td>
			</tr>-->
			
			<tr>
				<td colspan="6">
					Parent's/Guardian's Information
				</td>
			</tr>
			<tr>
				<td><label>Father's Name</label></td>
				<td colspan="">
					<input required="true"  class="form-control input-md" id="GUARDIAN1" name="GUARDIAN1" placeholder="Parents/Guardian Name" type="text"value="<?php echo isset($_SESSION['GUARDIAN1']) ? $_SESSION['GUARDIAN1'] : ''; ?>">
				</td>
				<td><label>Contact No.</label></td>
				<td colspan=""><input  required="true" class="form-control input-md" id="GCONTACT1" name="GCONTACT1" placeholder="Contact Number" type="number" value="<?php echo isset($_SESSION['GCONTACT1']) ? $_SESSION['GCONTACT1'] : ''; ?>"></td>
			</tr>
			<tr>
				<td><label>Mother's Name</label></td>
				<td colspan="">
					<input required="true"  class="form-control input-md" id="GUARDIAN2" name="GUARDIAN2" placeholder="Parents/Guardian Name" type="text"value="<?php echo isset($_SESSION['GUARDIAN2']) ? $_SESSION['GUARDIAN2'] : ''; ?>">
				</td>
				<td><label>Contact No.</label></td>
				<td colspan=""><input  required="true" class="form-control input-md" id="GCONTACT2" name="GCONTACT2" placeholder="Contact Number" type="number" value="<?php echo isset($_SESSION['GCONTACT2']) ? $_SESSION['GCONTACT2'] : ''; ?>"></td>
			</tr>
			<tr>
				<td><label>Legal Guardian's Name</label></td>
				<td colspan="">
					<input required="true"  class="form-control input-md" id="GUARDIAN3" name="GUARDIAN3" placeholder="Parents/Guardian Name" type="text"value="<?php echo isset($_SESSION['GUARDIAN3']) ? $_SESSION['GUARDIAN3'] : ''; ?>">
				</td>
				<td><label>Contact No.</label></td>
				<td colspan=""><input  required="true" class="form-control input-md" id="GCONTACT3" name="GCONTACT3" placeholder="Contact Number" type="number" value="<?php echo isset($_SESSION['GCONTACT3']) ? $_SESSION['GCONTACT3'] : ''; ?>"></td>
			</tr>
			<tr>
				<td colspan="6">
					Login Account
				</td>
			</tr>
			<tr>
				<td><label>Username</label></td>
				<td colspan="">
					<input required="true"  class="form-control input-md" id="USER_NAME" name="USER_NAME" placeholder="Username" type="text"value="<?php echo isset($_SESSION['USER_NAME']) ? $_SESSION['USER_NAME'] : ''; ?>">
				</td>
				
			</tr>
			<tr>
				<td><label>Password</label></td>
				<td colspan="">
						<input required="true"  class="form-control input-md" id="PASS" name="PASS" placeholder="Password" type="password"value="<?php echo isset($_SESSION['PASS']) ? $_SESSION['PASS'] : ''; ?>">
				</td>
				<td><label>Confirm Password</label></td>
				<td colspan="">
					<input required="true" class="form-control input-md" id="CONFIRM_PASS" name="CONFIRM_PASS" placeholder="Confirm Password" type="password">
				</td>
			</tr>
			<tr>
				<td></td>
				<td colspan="5">	
					<button class="btn btn-success btn-lg" name="regsubmit" type="submit">Submit</button>
				</td>
			</tr>
		</table>
	</div>
</form>

<!DOCTYPE html>
<html>
<head>
<?php include('head.html'); ?>
<?php include('session.php'); ?>

</head>
<body>
<?php include('sidebar.php');?>
<?php include('menu.php');?>

<?php

$getfarmer = $dbConn->query("SELECT * FROM tbl_farmersprof");

    if(isset($_POST['saveprofiling'])){

        $prefname  = $_POST['txtprefname'];
        $lastname  = $_POST['txtlastname'];
        $firstname = $_POST['txtfirstname'];
        $midname   = $_POST['txtmidname'];
        $suffname   = $_POST['txtsuffname'];
        $region    = $_POST['txtreg'];
        $prov      = $_POST['txtprov'];
        $mun       = $_POST['txtmun'];
        $bar       = $_POST['txtbar'];
        $address   = $_POST['txtaddress'];
        $sex       = $_POST['txtsex'];
        $bdate     = $_POST['txtbdate'];
      
  
        $getProf = $dbConn->query('SELECT * FROM tbl_farmersprof order by ID DESC LIMIT 1');
        $rowProf = mysqli_fetch_assoc($getProf);
        $month   = date('m');
        $day     =date('d');
        $year    = date('Y');
    
        $getregion  = $dbConn->query('SELECT * FROM psgc_region');
        $rowreg  = mysqli_fetch_assoc($getregion); 

        $getmun  = $dbConn->query('SELECT * FROM psgc_municipalities');
        $rowmun  = mysqli_fetch_assoc($getmun); 
        
        $get_Profiling = $rowProf['ID'] + 1;
        $rfcode = 'PROFCODE'.'-'.'10'.$month. $day. $year. $get_Profiling;

        $dbConn->query("INSERT INTO tbl_farmersprof (RFCode, Info_Prefname, Info_LName, Info_FName, Info_MName, Info_SuffName, Info_Region, Info_Province, Info_Municipality, Info_Barangay, Info_Address, Info_Sex, Info_Bdate, Info_UserID) 
        VALUES ('$rfcode', '$prefname', '$lastname', '$firstname', '$midname', '$suffname', '$region', '$prov', '$mun', '$bar', '$address', '$sex', '$bdate', '$userid')");

        echo "<script>window.location.href='frm_rubberfarm.php?RFCode=$rfcode';</script>";

    }   
?>

<div class="container-fluid px-3 py-0">
	<div class="col-lg-12 bg-white border p-3">
        <div class="form-row">
      		<div class="col-lg-11">
	         <!-- Page Heading -->
	         <h3 class="text-gray-800">Farmers Profile</h3>
		   </div>
		   <div class="col-lg-1">
             <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addFarmer">
	            <i class="fas fa-plus fa-xs"></i>
                Add Profile
              </a>
            </div>
 		</div>
   		<div class="form-row mt-2">
      	<div class="col-lg-12">
	         <!-- Data Table --> 
    <table id="example" class="display table-striped table-bordered text-xs">
				<thead class="bg-accent text-xs">
					<tr>
						<th>Actions</th>
						<th>Name</th>
						<th>Region</th>
						<th>Province</th>
						<th>Municipality</th>
						<th>Address</th>
						<th>Sex</th>
						<th>Birthdate</th>
					</tr>
				</thead>
				
				<tbody>
					<?php while($rowfarmer = mysqli_fetch_assoc($getfarmer)){
						
						// Convert PSGC code to Location Names
						$geocode = $rowfarmer['Info_Region'];
						$getLocation = $dbConn->query("SELECT * FROM psgc_region WHERE psgc_code LIKE '$geocode%'");
						$rowLocation = mysqli_fetch_assoc($getLocation);          

						//PROVINCE
						$provCode = $rowfarmer['Info_Province'];
						$getProv = $dbConn->query("SELECT * FROM psgc_provinces WHERE Code LIKE '$provCode%'");
						$rowProv = mysqli_fetch_assoc($getProv); 

						//MUNICIPALITY
						$munCode = $rowfarmer['Info_Municipality'];
						$getMun = $dbConn->query("SELECT * FROM psgc_municipalities WHERE Code LIKE '$munCode%'");
						$rowMun = mysqli_fetch_assoc($getMun); 
				 
				   
				   ?>
					<tr>
						<td>
							<a href="frm_rubberfarm.php?RFCode=<?php echo $rowfarmer['RFCode'];?>" class="btn btn-sm btn-success text-xs form-control form-control-sm border">
							<i class="fas fa-eye fa-xs fa-white mr-2"></i>
							View
							</a>
											
				            <a href="#" class="mt-1 btn btn-sm text-xs form-control form-control-sm btn-primary" data-toggle="modal" data-target="#editProf">
							<i class="fas fa-pen fa-xs fa-white mr-2"></i>
							Edit
							</a>
							<?php include('modal_edit_profiles.php'); ?>
						</td>
						<td><?=$rowfarmer['Info_Prefname'] .' '. $rowfarmer['Info_FName'] .' '. $rowfarmer['Info_MName'] .'. '. $rowfarmer['Info_LName'];?></td>
						<td><?=$rowLocation['name'];?></td>
						<td><?=$rowProv['Province'];?></td>
						<td><?=$rowMun['Municipality'];?></td>
						<td><?=$rowfarmer['Info_Address'];?></td>
						<td><?=$rowfarmer['Info_Sex'];?></td>
						<td><?=$rowfarmer['Info_Bdate'];?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
       	</div>
   	</div>
	</div>
</div>


<!-- MODAL: ADD USER -->
<div class="modal fade" id="addFarmer" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
        <form method="post">
	        <div class="modal-content">      
		        <div class="modal-body modal-bg">
		        	 <div class="container-fluid px-3 py-0">
		               <div class="col-lg-12 bg-white p-3">
		                    <div class="form-row">
				                <div class="col-lg-12">
				                    <!-- Page Heading -->
				                    <h1 class="h3 mb-2 text-gray-800">Add Farmer Profile</h1>
				                    <hr 999/>
				                </div>
			                	<div class="form-row border">
			                            <div class="col-lg-2 bg-label p-2">
			                                Name
			                            </div>
			                            <div class="col-lg-1 p-2">
			                                <select class="form-control text-xs" name="txtprefname" required>
			                                    <option>Select Type</option>
			                                    <option disabled>-------------</option>   
			                                    <option value="MR.">Mr.</option>
			                                    <option value="MS.">Ms.</option>
			                                    <option value="MRS.">Mrs.</option>
			                                </select>
			                            </div>
			                            <div class="col-lg-3 p-2">
			                                <input type="text" class="form-control text-xs" name="txtfirstname" onkeyup="this.value = this.value.toUpperCase();" placeholder="First Name"required>
			                            </div>
			                            <div class="col-lg-2 p-2">
			                                <input type="text" class="form-control text-xs" name="txtmidname" onkeyup="this.value = this.value.toUpperCase();" placeholder="Middle Name"required>
			                            </div>
			                            <div class="col-lg-3 p-2">
			                                <input type="text" class="form-control text-xs" name="txtlastname" onkeyup="this.value = this.value.toUpperCase();" placeholder="Last Name"required>
			                            </div>
			                            <div class="col-lg-1 p-2">
			                                <input type="text" class="form-control text-xs" name="txtsuffname" onkeyup="this.value = this.value.toUpperCase();" placeholder="SN">
			                            </div>
		                        </div>    
		                        <div class="form-row border border-top-0">
			                        <div class="col-lg-2 bg-label p-2" id="regdiv">
			                            Address
			                        </div>
			                        <div class="col-lg-3 p-2">
			                            <?php $getRegion = $dbConn->query('SELECT * FROM psgc_region');?>
			                            <select name="txtreg" id="reg" placeholder="Region" onChange="getProvince(this.value)" class="form-control text-xs" required>
			                                <option value="">SELECT REGION</option>
			                                <?php while($rowRegion = mysqli_fetch_assoc($getRegion)) { ?>
			                                <option value="<?php echo $rowRegion['psgc_code']; ?>">
			                                <?php echo $rowRegion['name']; ?>
			                                </option>
			                                <?php } ?>
			                            </select>
			                        </div>
			                        <div class="col-lg-2 p-2"  id="provdiv">
			                            <select name="txtprov" class="form-control text-xs" placeholder="Province" disabled> 
			                                <option value="">SELECT PROVINCE</option>
			                            </select>
			                        </div>
			                        <div class="col-lg-2 p-2" id="mundiv">
			                            <select name="txtmun" class="form-control text-xs" placeholder="Municipality" disabled>
			                                <option value="">SELECT MUNICIPALITY</option>
			                            </select>
			                        </div>
			                        <div class="col-lg-3 p-2" id="barangaydiv">
			                            <select name="txtbar" class="form-control text-xs" placeholder="Barangay" disabled>
			                                <option value="">SELECT BARANGAY</option>
			                            </select>
			                        </div>
			                        <div class="col-lg-2 bg-label p-2">
			                        </div>
			                        <div class="col-lg-10 p-2">
			                                <input type="text" class="form-control text-xs" name="txtaddress" onkeyup="this.value = this.value.toUpperCase();" placeholder="Address line"required>
			                        </div>
			                         <div class="col-lg-2 bg-label p-2">
		                                Sex
		                            </div>
		                            <div class="col-lg-3 p-2">
		                                <select class="form-control text-xs" name="txtsex" required>
			                                <option>Select </option>
			                                <option disabled>-------------</option>   
			                                <option value="MALE">Male</option>
			                                <option value="FEMALE">Female</option>
			                            </select>
		                            </div> 

		                             <div class="col-lg-3 bg-label p-2">
			                            Birthdate
			                        </div>
			                        <div class="col-lg-3 p-2">
			                        <input type="Date" class="form-control text-xs" name="txtbdate" placeholder="Date" required>
			                        </div>
			                    </div>
			                	
			                </div>
		                	<div class="modal-footer">
			                  <div class="form-group">
			                    <button type="submit" name="saveprofiling" onclick="return confirm('Do you want to save?')" class="btn btn-success">
			                        <i class="fas fa-save fa-xs"></i> Save</button>
			                    <button type="submit" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
			                  </div>
			                </div>
		                </div>
		            </div>  
		        </div>
	        </div>
        <!-- MODAL FOOTER - END -->
        </form> <!-- end of form method="post" -->
    </div>    <!-- end of modal-content -->
  </div>      <!-- end of modal-dialog -->
<!-- END OF MODAL -->

<?php include('footer.html'); ?></body></html>


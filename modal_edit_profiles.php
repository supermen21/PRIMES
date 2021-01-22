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
			                    <button type="submit" name="saveprofiling" class="btn btn-success">
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
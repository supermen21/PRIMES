<?php include('head.html'); ?>
<?php include('session.php'); ?>
<body>
<?php include('sidebar.php');?>
<?php include('menu.php');?>
<?php 
     
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
        $rfcode = '10'.$month. $day. $year. $get_Profiling;

        $dbConn->query("INSERT INTO tbl_farmersprof (RFCode, Info_Prefname, Info_LName, Info_FName, Info_MName, Info_SuffName, Info_Region, Info_Province, Info_Municipality, Info_Barangay, Info_Address, Info_Sex, Info_Bdate, Info_UserID) 
        VALUES ('$rfcode', '$prefname', '$lastname', '$firstname', '$midname', '$suffname', '$region', '$prov', '$mun', '$bar', '$address', '$sex', '$bdate', '$userid')");

        echo "<script>window.location.href='frm_rubberfarm.php?userid=$userid&&RFCode=$rfcode';</script>";
    }   
?>

<div class="container-fluid px-3 py-0">
    <div class="col-lg-12 bg-white border p-3">
        <div class="form-row">
            <div class="col-lg-12">
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Farmers Profile</h1>
            </div>
        </div>
        <div class="form-row">
            <div class="col-lg-12">
            <!-- Data Table -->
            <form method="post">
                <div style="font-size: 0.7rem;">
                        <div class="form-row border">
                            <div class="col-lg-2 bg-label p-2">
                                Name
                            </div>
                            <div class="col-lg-1 p-2">
                                <select class="form-control text-xs" name="txtprefname" required>
                                    <option>Select Type</option>
                                    <option disabled>-------------</option>   
                                    <option value="MR">Mr.</option>
                                    <option value="MS">Ms.</option>
                                    <option value="MRS">Mrs.</option>
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
                    </div>
                    <div class="form-row border border-top-0">
                        <div class="col-lg-2 bg-label p-2">
                            Sex
                        </div>
                        <div class="col-lg-2 p-2">
                            <select class="form-control text-xs" name="txtsex" required>
                                <option>Select </option>
                                <option disabled>-------------</option>   
                                <option value="MALE">Male</option>
                                <option value="FEMALE">Female</option>
                            </select>
                        </div>
                        <div class="col-lg-2 bg-label p-2">
                            Birthdate
                        </div>
                        <div class="col-lg-2 p-2">
                        <input type="Date" class="form-control text-xs" name="txtbdate" placeholder="Date" required>
                        </div>
                    </div>
                    </div>
                    <button type="submit" name="saveprofiling" class="btn btn-sm btn-success mt-2">
                        <i class="fas fa-save fa-xs"></i>
                        Save
                    </button>
                </form>
            </div>
        </div>
   </div>
</div>
<?php include('footer.html'); ?>
</body>
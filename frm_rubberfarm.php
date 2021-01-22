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

$rfcode   = $_REQUEST['RFCode'];
//$query = $dbConn->query("SELECT * FROM tbl_farmersprof WHERE RFCode = '$rfcode'");
// $row   = mysqli_fetch_assoc($query);

  // TESTING CODE
  // echo "<script type='text/javascript'>alert('')</script>";
  // SAVE / INSERT
  if(isset($_POST['saveRubberFarm'])){
      $frcode        = $_POST['RFCode'];
      $fregion       = $_POST['txtfReg'];
      $fprov         = $_POST['txtfProv'];
      $fmun          = $_POST['txtfMun'];
      $fbar          = $_POST['txtfBar'];
      $totalarea     = $_POST['txtTotalArea'];
      $areaplanted   = $_POST['txtAreaPlanted'];
      $totaltrees    = $_POST['txtTotalTrees'];
      $noplanted     = $_POST['txtNoPlanted'];


       $query_farmcode = $dbConn->query('SELECT * FROM tbl_farmersprof order by ID DESC LIMIT 1');
       $rowfarmcode = mysqli_fetch_array($query_farmcode);
        $farmcode    = $frcode + $rowfarmcode['ID'];
        $frmcode ='FARMCODE-'. '00'. $farmcode;

    $dbConn->query('INSERT INTO tbl_farmdetails(RFCode, FarmCode, Info_FarmRegion, Info_FarmProv, Info_FarmMun, Info_FarmBar, Info_TotalArea, Info_AreaPlanted, Info_TotalTrees, Info_NoTreesPlanted, Info_UserID)   
                    VALUES ("' . $frcode . '" ,
                            "' . $frmcode . '" ,
                            "' . $fregion . '" ,
                            "' . $fprov . '" , 
                            "' . $fmun   . '" ,
                            "' . $fbar . '" , 
                            "' . $totalarea . '" ,
                            "' . $areaplanted   . '" ,  
                            "' . $totaltrees   . '" ,
                            "' . $noplanted . '",  
                            "' . $userid   . '" )');
      echo "<script>window.location.href='frm_rubberfarm.php?RFCode=$rfcode';</script>";
  }

?>

<div class="col-lg-12 bg-white border p-3">
  <div class="form-row">
    <div class="col-lg-11">
      <!-- Page Heading -->
      <h3 class="text-gray-800">List of Rubber Farm details</h3>
      <hr 999/>
    </div>
  
  <div class="col-lg-1">
    <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addUser">
      <i class="fas fa-plus fa-xs"></i>
      Rubber Details
    </a>
  </div>
  </div>
  <div class="container-fluid mb-3 mt-3">
       
    <table id="" class="display table-striped table-bordered text-xs">
        <thead class="text-sm">
          <tr style="color:white;background-color: #0e918c;">
            <th>ACTIONS</th>
            <!-- <th class="d-sm-table-cell">Farmer's Name</th> -->
            <th class="d-sm-table-cell">Region</th> 
            <th class="d-sm-table-cell">Province</th>
            <th class="d-sm-table-cell">Municipality</th>  
            <th class="d-sm-table-cell">Barangay</th>
            <th class="d-sm-table-cell">Total Area</th>
            <th class="d-sm-table-cell">Area Planted</th>    
            <th class="d-sm-table-cell">Total Trees</th>     
            <th class="d-sm-table-cell">No. Trees Planted</th> 
          </tr>
        </thead>
        <tbody>
        <?php $getRubber = $dbConn->query("SELECT * FROM tbl_farmdetails WHERE Info_UserID = '$userid' AND RFCode = '$rfcode'"); 
               while($rowRubber = mysqli_fetch_assoc($getRubber)){

                // Convert PSGC code to Location Names
            $geocode = $rowRubber['Info_FarmRegion'];
            $getLocation = $dbConn->query("SELECT * FROM psgc_region WHERE psgc_code LIKE '$geocode%'");
            $rowLocation = mysqli_fetch_assoc($getLocation);          

            //PROVINCE
            $provCode = $rowRubber['Info_FarmProv'];
            $getProv = $dbConn->query("SELECT * FROM psgc_provinces WHERE Code LIKE '$provCode%'");
            $rowProv = mysqli_fetch_assoc($getProv); 

            //MUNICIPALITY
            $munCode = $rowRubber['Info_FarmMun'];
            $getMun = $dbConn->query("SELECT * FROM psgc_municipalities WHERE Code LIKE '$munCode%'");
            $rowMun = mysqli_fetch_assoc($getMun);
             

            //BARANGAY
            $barCode = $rowRubber['Info_FarmBar'];
            $getBar = $dbConn->query("SELECT * FROM psgc_barangays WHERE Code LIKE '$barCode%'");
            $rowBar = mysqli_fetch_assoc($getBar);
             ?>
             <tr>
                <td><a href="frm_rubberprod.php?RFCode=<?=$rowRubber['RFCode'];?>" class="btn btn-sm btn-success form-control form-control-sm">
              <i class="fas fa-eye fa-xs fa-white mr-2"></i> View</a></td>
                <!-- <td><?php 
                      // $getfarmer = $dbConn->query("SELECT * FROM tbl_farmersprof WHERE Info_UserID = '$userid' AND RFCode ='$rfcode'");
                      // while($rowfarmer = mysqli_fetch_assoc($getfarmer)){ echo
                      // $rowfarmer['Info_Prefname'] .' '. $rowfarmer['Info_FName'] .' '. $rowfarmer['Info_MName'] .'. '. $rowfarmer['Info_LName'];}?></td> -->
                <td><?php echo $rowLocation['name'];?></td>    
                <td><?php echo $rowProv['Province'];?></td>
                <td><?php echo $rowMun['Municipality'];?></td>
                <td><?php echo $rowBar['Barangay'];?></td>
                <td><?php echo $rowRubber['Info_TotalArea'];?></td>
                <td><?php echo $rowRubber['Info_AreaPlanted'];?></td>
                <td><?php echo $rowRubber['Info_TotalTrees'];?></td>
                <td><?php echo $rowRubber['Info_NoTreesPlanted'];?></td>
            </tr>
        <?php }?>
        </tbody>
       </table> 
  </div>
</div>
<?php include('footer.html'); ?>
</body>
</html>

<!-- MODAL: ADD USER -->
<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-m" role="document">
      <form method="post">
        <div class="modal-content">      
          <div class="modal-body modal-bg">

            <div class="container-fluid px-3 py-0">
              <div class="col-lg-12 bg-white p-3">
                <div class="form-row">
                <div class="col-lg-12">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Add Rubber Farmer</h1>
                    <hr 999/>
                </div>
                 <input type="hidden" name="RFCode" value="<?php echo $rfcode; ?>">
            
                  <div class="form-row">
                    <div class="col-lg-12 p-2">
                      <label>Region</label>
                      <?php $getRegion = $dbConn->query("SELECT * FROM psgc_region");?>   
                      <select name="txtfReg" id="freg" placeholder="Region" onChange="getfProvince(this.value)" class="form-control text-xs" required>
                          <option value="">SELECT REGION</option>
                          <?php while($rowRegion = mysqli_fetch_assoc($getRegion)) { ?>
                          <option value="<?php echo $rowRegion['psgc_code']; ?>">
                          <?php echo $rowRegion['name']; ?>
                          </option>
                          <?php } ?>
                      </select>
                    </div>
                    <div class="col-lg-12 p-2"  id="fprovdiv">
                      <label>Province</label>
                      <select name="txtfProv" class="form-control text-xs" placeholder="Province" disabled> 
                          <option value="">SELECT PROVINCE</option>
                      </select>
                    </div>
                    <div class="col-lg-12 p-2" id="fmundiv">
                      <label>Municipality</label>
                      <select name="txtfMun" class="form-control text-xs" placeholder="Municipality" disabled>
                          <option value="">SELECT MUNICIPALITY</option>
                      </select>
                    </div>
                    <div class="col-lg-12 p-2" id="fbarangaydiv">
                      <label>Barangay</label>
                      <select name="txtfBar" class="form-control text-xs" placeholder="Barangay" disabled>
                          <option value="">SELECT BARANGAY</option>
                      </select>
                    </div>
                <div>
           
                <div class="form-row">
                  <div class="col-lg-6 p-2">
                      <label>Total Area</label>
                      <input type="text" class="form-control text-xs" name="txtTotalArea" onkeyup="this.value = this.value.toUpperCase();" placeholder="Total Area"required>
                  </div> 
                  <div class="col-lg-6 p-2">
                      <label>Area Planted</label>
                      <input type="text" class="form-control text-xs" name="txtAreaPlanted" onkeyup="this.value = this.value.toUpperCase();" placeholder="Area Planted"required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-lg-6 p-2">
                      <label>Total Trees</label>
                      <input type="text" class="form-control text-xs" name="txtTotalTrees" onkeyup="this.value = this.value.toUpperCase();" placeholder="Total Trees"required>
                  </div> 
                  <div class="col-lg-6 p-2">
                      <label>No. of Planted</label>
                      <input type="text" class="form-control text-xs" name="txtNoPlanted" onkeyup="this.value = this.value.toUpperCase();" placeholder="No. of Planted"required>
                  </div>
                </div>
                <div class="modal-footer">
                  <div class="form-group">
                    <button type="submit" name="saveRubberFarm" class="btn btn-success">
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
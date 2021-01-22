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
$getRubber = $dbConn->query("SELECT * FROM tbl_production WHERE Info_UserID = '$userid' AND RFCode = '$rfcode'"); 
// $frmcode2 = $_REQUEST['FarmCode'];
// $query = $dbConn->query("SELECT * FROM tbl_production WHERE RFCode = '$rfcode' AND FarmCode ='$frmcode2'");
// $row   = mysqli_fetch_assoc($query);

  // TESTING CODE
  // echo "<script type='text/javascript'>alert('')</script>";
  // SAVE / INSERT
  if(isset($_POST['saveRubberProd'])){
      $frcode    = $_POST['RFCode'];
      $frmcode   = $_POST['FarmCode'];
      $datehar   = $_POST['txtDateHar'];
      $notrees   = $_POST['txtNoTrees'];
      $voltap    = $_POST['txtVolTapped'];
      $estcost   = $_POST['txtEstCost'];


       $query_farmcode = $dbConn->query('SELECT * FROM tbl_farmersprof order by ID DESC LIMIT 1');
       $rowfarmcode = mysqli_fetch_array($query_farmcode);
        $farmcode    = $frcode + $rowfarmcode['ID'];
        $frmcode ='FARMCODE-'. '00'. $farmcode;

    $dbConn->query('INSERT INTO tbl_production(RFCode, FarmCode, Info_DateHarvested, Info_NoTreesTapped, Info_VolumeTapped, Info_EstCost, Info_UserID)   
                    VALUES ("' . $frcode . '" ,
                            "' . $frmcode . '" ,
                            "' . $datehar . '" ,
                            "' . $notrees . '" , 
                            "' . $voltap   . '" ,
                            "' . $estcost . '",  
                            "' . $userid   . '" )');
      echo "<script>window.location.href='frm_rubberprod.php?RFCode=$rfcode';</script>";
  }

?>
<div class="col-lg-12 bg-white border p-3">
  <div class="form-row">
    <div class="col-lg-11">
      <!-- Page Heading -->
      <h3 class="text-gray-800">List of Rubber Production details</h3>
      <hr 999/>
    </div>
  
    <div class="col-lg-1">
      <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addUser">
        <i class="fas fa-plus fa-xs"></i>
        Rubber Production Details
      </a>
    </div>
  </div>
  <div class="container-fluid mb-3 mt-3">
    <table id="" class="table-bordered display text-xs" style="width:100%;">
      <thead class="text-sm">
        <tr style="color:white;background-color: #0e918c;">
          <th class="d-sm-table-cell">Date Harvested</th> 
          <th class="d-sm-table-cell">No. of Trees Tapped</th>
          <th class="d-sm-table-cell">Volume Tapped</th>  
          <th class="d-sm-table-cell">Estimated Cost</th>
        </tr>
      </thead>
      <tbody>
        <?php 
               while($rowRubber = mysqli_fetch_assoc($getRubber)){
             ?>
             <tr> 
                <td><?php echo $rowRubber['Info_DateHarvested'];?></td>
                <td><?php echo $rowRubber['Info_NoTreesTapped'];?></td>
                <td><?php echo $rowRubber['Info_VolumeTapped'];?></td>
                <td><?php echo $rowRubber['Info_EstCost'];?></td>
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
                    <h1 class="h3 mb-2 text-gray-800">Add Production Farmer</h1>
                    <hr 999/>
                </div>
                 <input type="hidden" name="RFCode" value="<?php echo $rfcode; ?>">
                 <div class="form-row">
                        <div class="col-lg-6 p-2">
                            <label>Date Harvested:</label>
                            <input type="date" class="form-control" name="txtDateHar">
                        </div>
                        <div class="col-lg-6 p-2">
                            <label>No. Trees Tapped:</label>
                            <input type="text" class="form-control" name="txtNoTrees">
                        </div>
                  </div>
                  
                  <div class="form-row">
                        <div class="col-lg-6 p-2">
                            <label>Volume Tapped:</label>
                            <input type="text" class="form-control" name="txtVolTapped">
                        </div>
                        <div class="col-lg-6 p-2">
                            <label>Estimated Cost:</label>
                            <input type="text" class="form-control" name="txtEstCost">
                        </div>
                  </div>
                <div class="modal-footer">
                  <div class="form-group">
                    <button type="submit" name="saveRubberProd" class="btn btn-success">
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
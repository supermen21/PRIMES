<?php include('head.html'); ?>
<?php include('session.php'); ?>
<body>
<?php include('sidebar.php');?>
<?php include('menu.php');?>

<?php 
$rfcode = $_REQUEST['RFCode'];

    if(isset($_POST['addFarmDetails'])){
        //Rubber Farm Table
      $rfcodeArr      = $_POST['RFCode'];
      $fregionArr     = $_POST['txtfReg'];
      $fprovArr       = $_POST['txtfProv'];
      $fmunArr        = $_POST['txtfMun'];
      $fbarArr        = $_POST['txtfBar'];
      $totalareaArr   = $_POST['txtTotalArea'];
      $areaplantedArr = $_POST['txtAreaPlanted'];
      $totaltreesArr  = $_POST['txtTotalTrees'];
      $noplantedArr   = $_POST['txtNoPlanted'];
      
    //   $dateHarArr        = $_POST['txtDateHar'];
    //   $notreestappedArr  = $_POST['txtnoTapped'];
    //   $voltappedArr      = $_POST['txtVolTapped'];
    //   $estcostArr        = $_POST['txtestcost'];     
      
      $dbConn->query("DELETE FROM tbl_farmdetails WHERE RFCode='$rfcodeArr'");

        if(!empty($areaplantedArr)){
            for($i = 0; $i < count($totaltreesArr); $i++){
                if(!empty($areaplantedArr[$i])){
                    $frcode      = $rfcodeArr;
                    $fregion     = $fregionArr;
                    $fprov       = $fprovArr;
                    $fmun        = $fmunArr;
                    $fbar        = $fbarArr;
                    $totalarea   = $totalareaArr; 
                    $areaplanted = $areaplantedArr;
                    $totaltrees  = $totaltreesArr; 
                    $noplanted   = $noplantedArr;

                    // $dateHar       = $dateHarArr;
                    // $notreestapped = $notreestappedArr;
                    // $voltapped     = $voltappedArr;
                    // $estcost       = $estcostArr;

                    $query_farmcode = $dbConn->query('SELECT * FROM tbl_farmersprof order by ID DESC LIMIT 1');
                    $rowfarmcode = mysqli_fetch_array($query_farmcode);
                    $farmcode    = $frcode + $rowfarmcode['ID'];

                    $dbConn->query('INSERT INTO tbl_farmdetails (RFCode, FarmCode, Info_FarmRegion, Info_FarmProv, Info_FarmMun, Info_FarmBar, Info_TotalArea, Info_AreaPlanted, Info_TotalTrees, Info_NoTreesPlanted, Info_UserID) VALUES 
                    ("'.$frcode.'", "'.$farmcode.'","'.$fregion.'", "'.$fprov.'", "'.$fmun.'", "'.$fbar.'", "'.$totalarea.'", "'.$areaplanted.'", "'.$totaltrees.'", "'.$noplanted.'","'.$userid.'")');
                    
                    // $dbConn->query('INSERT INTO tbl_production (RFCode, FarmCode, Info_DateHarvested, Info_NoTreesTapped, Info_VolumeTapped, Info_EstCost, Info_UserID) VALUES 
                    // ("'.$frcode.'", "'.$farmcode.'","'.$dateHar.'", "'.$notreestapped.'", "'.$voltapped.'", "'.$estcost.'", "'.$userid.'")');
                
                    echo '<script language="javascript">alert("Save successfully!")</script>';
                }
            }
        }
    }
?>

<div class="container-fluid px-3 py-0">
    <div class="col-lg-12 bg-white border p-3">
        <div class="form-row mt-3">
            <div class="col-lg-12">
              <h5 class="custom-font">Rubber Farm Table</h5>
            </div>
        </div>
        <div class="form-group row mb-0">
            <div class="col-lg-12">
                <form method="post"> 
                    <table id="datatable" class="table table-bordered table-striped custom-font" width="100%" cellspacing="0">
                        <thead class="custom-ffedis text-black bg-accent text-xs">
                            <tr>
                                <td>Region</td>
                                <td>Province</td>
                                <td>Municipality</td>
                                <td>Barangay</td>
                                <td>Total Area (ha)</td>
                                <td>Area Planted (ha)</td>
                                <td>Total Trees Planted</td>
                                <td>No. of Trees Planted</td>
                                <td>Actions</td>
                            </tr>
                        </thead>

                        <?php $queryfrmdet = $dbConn->query("SELECT * FROM tbl_farmdetails WHERE RFCode = '$rfcode' ORDER BY INFO_DATETIME ASC");  ?>
                        <?php $countdet = mysqli_num_rows($queryfrmdet);?>
                       <tbody>
                            
                            <?php if($countdet==0){?>
                                
                                <input type="hidden" name="RFCode" value="<?php echo $rfcode; ?>">
                                <tr class="fieldGroup">
                                    <td>
                                    <?php $getFRegionfrm = $dbConn->query("SELECT DISTINCT psgc_code, name FROM psgc_region ORDER BY psgc_code");?>
                                        <select name="txtfReg" id="regdiv" placeholder="Region" onChange="getProvince(this.value)" class="form-control text-xs" required>
                                            <option value="">SELECT REGION</option>
                                            <?php while($rowFRegionfrm = mysqli_fetch_assoc($getFRegionfrm)) { ?>
                                            <option value="<?php echo $rowFRegionfrm['psgc_code']; ?>">
                                            <?php echo $rowFRegionfrm['name']; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    
                                    <td id="provdiv">
                                        <select name="txtfProv" class="form-control text-xs" placeholder="Province" disabled> 
                                            <option value="">SELECT PROVINCE</option>
                                        </select>
                                    </td>
                                    
                                    <td id="mundiv">
                                        <select name="txtfMun" class="form-control text-xs" placeholder="Municipality" disabled> 
                                            <option value="">SELECT MUNICIPALITY</option>
                                        </select>
                                    </td>
                                    
                                    <td id="barangaydiv">
                                        <select name="txtfBar" class="form-control text-xs" placeholder="Barangay" disabled> 
                                            <option value="">SELECT BARANGAY</option>
                                        </select>
                                    </td>

                                    <td>
                                        <input type="text" class="form-control text-xs" name="txtTotalArea" placeholder="Total Area (ha)">
                                    </td>

                                    <td>
                                        <input type="text" class="form-control text-xs" name="txtAreaPlanted" placeholder="Area Planted (ha)">
                                    </td>

                                    <td>
                                        <input type="text" class="form-control text-xs" name="txtTotalTrees" placeholder="Total Trees Planted">
                                    </td>

                                    <td>
                                        <input type="text" class="form-control text-xs" name="txtNoPlanted" placeholder="No. of Trees Planted">
                                    </td>
                                
                                    <td class="text-center"><button type="button" id="addMore" name="somethingbtn" class="btn btn-success btn-sm addMore"><i class="fas fa-plus fa-white"></i></button></td>
                                </tr>

                            <?php }
                                $detailsCount = 0; 
                                while($rowfarmdet = mysqli_fetch_assoc($queryfrmdet)){ 
                                    // Convert PSGC code to Location Names
                                $reg = $rowfarmdet['Info_FarmRegion'];
                                $getLocation = $dbConn->query("SELECT * FROM psgc_region WHERE psgc_code LIKE '$reg%'");
                                $rowLocation = mysqli_fetch_assoc($getLocation);                  

                                //   PROVINCE
                                $provCode = $rowfarmdet['Info_FarmProv'];
                                $getProv = $dbConn->query("SELECT * FROM psgc_provinces WHERE Code LIKE '$provCode%'");
                                $rowProv = mysqli_fetch_assoc($getProv);  
                                
                                //   MUNICIPALITY
                                $munCode = $rowfarmdet['Info_FarmMun'];
                                $getMun  = $dbConn->query("SELECT * FROM psgc_municipalities WHERE Code LIKE '$munCode%'");
                                $rowMun  = mysqli_fetch_assoc($getMun); 
                                
                                //   BARANGAY
                                $barCode = $rowfarmdet['Info_FarmBar'];
                                $getBar  = $dbConn->query("SELECT * FROM psgc_barangays WHERE Code LIKE '$barCode%'");
                                $rowBar  = mysqli_fetch_assoc($getBar); 

                                $detailsCount = $detailsCount + 1; 
                            ?>
                                <tr class="fieldGroup">
                                    <td>
                                        <?php $getFRegionfrm = $dbConn->query("SELECT DISTINCT psgc_code, name FROM psgc_region ORDER BY psgc_code");?>
                                        <select name="txtfReg" id="regdiv" placeholder="Region" onChange="getProvince(this.value)" class="form-control text-xs" required>
                                            <option value="<?php  echo $rowLocation['name']; ?>"><?php  echo $rowLocation['name']; ?></option>
                                            <option value="" disabled>SELECT REGION</option>
                                            <?php while($rowFRegionfrm = mysqli_fetch_assoc($getFRegionfrm)) { ?>
                                            <option value="<?php echo $rowFRegionfrm['psgc_code']; ?>">
                                            <?php echo $rowFRegionfrm['name']; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    
                                    <td id="provdiv">
                                        <select name="txtfProv" class="form-control text-xs" placeholder="Province" disabled> 
                                            <option value="<?php  echo $rowProv['Province']; ?>"><?php  echo $rowProv['Province']; ?></option>
                                            <option value="" disabled>SELECT PROVINCE</option>
                                        </select>
                                    </td>
                                    
                                    <td id="mundiv">
                                        <select name="txtfMun" class="form-control text-xs" placeholder="Municipality" disabled> 
                                            <option value="<?php  echo $rowMun['Municipality']; ?>"><?php  echo $rowMun['Municipality']; ?></option>
                                            <option value="">SELECT MUNICIPALITY</option>
                                        </select>
                                    </td>
                                    
                                    <td id="barangaydiv">
                                        <select name="txtfBar" class="form-control text-xs" placeholder="Barangay" disabled> 
                                            <option value="<?php  echo $rowBar['Barangay']; ?>"><?php  echo $rowBar['Barangay']; ?></option>
                                            <option value="">SELECT BARANGAY</option>
                                        </select>
                                    </td>

                                    <td>
                                        <input type="text" class="form-control text-xs" name="txtTotalArea" placeholder="Total Area (ha)" value="<?php echo $rowfarmdet['Info_TotalArea'];?>">
                                    </td>

                                    <td>
                                        <input type="text" class="form-control text-xs" name="txtAreaPlanted" placeholder="Area Planted (ha)" value="<?php echo $rowfarmdet['Info_AreaPlanted'];?>">
                                    </td>

                                    <td>
                                        <input type="text" class="form-control text-xs" name="txtTotalTrees" placeholder="Total Trees Planted" value="<?php echo $rowfarmdet['Info_TotalTrees'];?>">
                                    </td>

                                    <td>
                                        <input type="text" class="form-control text-xs" name="txtNoPlanted" placeholder="No of Trees Planted" value="<?php echo $rowfarmdet['Info_NoTreesPlanted'];?>">
                                    </td>

                                    <td class="text-center">
                                        <?php if($detailsCount==1){ ?>
                                        <button type="button" id="addMore" name="somethingbtn" class="btn btn-success btn-sm addMore"><i class="fas fa-plus fa-white"></i></button>
                                        <?php } else { ?>
                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm remove"><i class="fas fa-minus fa-white"></i></a>
                                        <?php } ?>
                                    </td>
                                </tr>

                            <?php } ?>

                                <tr class="fieldGroupCopy" style="display: none;">
                                    <input type="hidden" name="RFCode" value="<?php echo $rfcode; ?>">
                              
                                    <td>
                                        <?php $getFRegionfrm = $dbConn->query("SELECT DISTINCT psgc_code, name FROM psgc_region ORDER BY psgc_code");?>
                                        <select name="txtfReg" id="regdiv" placeholder="Region" onChange="getProvince(this.value)" class="form-control text-xs" required>
                                            <option value="">SELECT REGION</option>
                                            <?php while($rowFRegionfrm = mysqli_fetch_assoc($getFRegionfrm)) { ?>
                                            <option value="<?php echo $rowFRegionfrm['psgc_code']; ?>">
                                            <?php echo $rowFRegionfrm['name']; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    
                                    <td id="provdiv">
                                        <select name="txtfProv" class="form-control text-xs" placeholder="Province" disabled> 
                                            <option value="">SELECT PROVINCE</option>
                                        </select>
                                    </td>
                                    
                                    <td id="mundiv">
                                        <select name="txtfMun" class="form-control text-xs" placeholder="Municipality" disabled> 
                                            <option value="">SELECT MUNICIPALITY</option>
                                        </select>
                                    </td>
                                    
                                    <td id="barangaydiv">
                                        <select name="txtfBar" class="form-control text-xs" placeholder="Barangay" disabled> 
                                            <option value="">SELECT BARANGAY</option>
                                        </select>
                                    </td>

                                    <td>
                                        <input type="text" class="form-control text-xs" name="txtTotalArea" placeholder="Total Area (ha)">
                                    </td>

                                    <td>
                                        <input type="text" class="form-control text-xs" name="txtAreaPlanted" placeholder="Area Planted (ha)">
                                    </td>

                                    <td>
                                        <input type="text" class="form-control text-xs" name="txtTotalTrees" placeholder="Total Trees Planted">
                                    </td>

                                    <td>
                                        <input type="text" class="form-control text-xs" name="txtNoPlanted" placeholder="No. of Trees Planted">
                                    </td>
                                    
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm remove"><i class="fas fa-minus fa-white"></i></a>
                                    </td>
                                </tr>
                        </tbody> 
                    </table>

                    <button type="submit" name="addFarmDetails" class="btn btn-sm btn-primary form-control form-control-sm text-xs col-lg-1 ml-1 mt-3">
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

<!-- DYNAMIC ADD / REMOVE FORM GROUP -->
<script>
$(document).ready(function(){
    //group add limit
    var maxGroup = 20;
    var row_id = 0;
    
    //add more fields group
    $(".addMore").click(function(){
        if($('body').find('.fieldGroup').length < maxGroup){
            var fieldHTML = '<tr class="fieldGroup">'+$(".fieldGroupCopy").html()+'</tr>';
            $('body').find('.fieldGroup:last').after(fieldHTML);
        }else{
            alert('Maximum '+maxGroup+' groups are allowed.');
        }
    });
    
    //remove fields group
    $("body").on("click",".remove",function(){ 
        $(this).parents(".fieldGroup").remove();
    });
});



$(document).ready(function(){
    //group add limit
    var maxGroup = 20;
    var row_id = 0;
    
    //add more fields group
    $(".addMoreRP").click(function(){
        if($('body').find('.fieldGroupRP').length < maxGroup){
            var fieldHTML = '<tr class="fieldGroupRP">'+$(".fieldGroupCopyRP").html()+'</tr>';
            $('body').find('.fieldGroupRP:last').after(fieldHTML);
        }else{
            alert('Maximum '+maxGroup+' groups are allowed.');
        }
    });
    
    //remove fields group
    $("body").on("click",".remove",function(){ 
        $(this).parents(".fieldGroupRP").remove();
    });
});
</script>
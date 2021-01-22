<?php require_once('config/database_connection.php');
	$codeRegion		=$_GET['region'];
	$codeProvince	=$_GET['province'];
	$prov = substr($codeProvince,0,4);
	
	$getFMunicipality 	= $dbConn->query("SELECT DISTINCT `Municipality`, `Code` FROM psgc_municipalities WHERE Left(Code,4) like '%$prov%' ORDER BY Municipality");
?>
	
                      <label>Municipality</label>
	<select name="txtfMun" id="fmundiv" class="form-control text-xs" onchange="getfBar(<?php echo $codeRegion?>,<?php echo $codeProvince?>,this.value)">
		<option value=""><?php echo "Select Municipality" ?></option>
		<?php while($rowFMunicipality = mysqli_fetch_assoc($getFMunicipality)) { ?>
        <option value="<?php echo $rowFMunicipality['Code']?>"><?php echo $rowFMunicipality['Municipality']?></option>
		<?php } ?>
	 </select>

		<!-- <div id="mundiv">
		<div class="form-row">
			 <?php //while($rowMunicipality = mysqli_fetch_assoc($getMunicipality)) { ?>
			<div class="col-lg-3">
				<input type="checkbox" name="txtMunici[]" value="<?php //echo $rowMunicipality['Code'];?>">
				<?php //echo $rowMunicipality['Municipality']?>
	        </div>
		<?php //} ?>
 	</div>

 	</div>
 -->


	 
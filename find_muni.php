<?php require_once('config/database_connection.php');
	$codeRegion		=$_GET['region'];
	$codeProvince	=$_GET['province'];
	$prov = substr($codeProvince,0,4);
	
	$getMunicipality 	= $dbConn->query("SELECT DISTINCT `Municipality`, `Code` FROM psgc_municipalities WHERE Left(Code,4) like '%$prov%' ORDER BY Municipality");
?>
	
	<select name="txtmun" id="mundiv" class="form-control text-xs" onchange="getBar(<?php echo $codeRegion?>,<?php echo $codeProvince?>,this.value)">
		<option value=""><?php echo "Select Municipality" ?></option>
		<?php while($rowMunicipality = mysqli_fetch_assoc($getMunicipality)) { ?>
        <option value="<?php echo $rowMunicipality['Code']?>"><?php echo $rowMunicipality['Municipality']?></option>
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


	 
<?php require_once('config/database_connection.php');
	$codeRegion			= $_GET['region'];
	$codeProvince		= $_GET['province'];
	$codeMunicipality	= $_GET['municipality'];
	$prov = substr($codeProvince,0,4);
	$mun = substr($codeMunicipality,0,6);

	$getFBarangay= $dbConn->query("SELECT DISTINCT `Barangay`, `Code` FROM psgc_barangays WHERE Left(Code,6) like '%$mun%' ORDER BY Barangay");
?>
                      <label>Barangay</label>
	<select name="txtfBar" id="fbarangaydiv" class="form-control text-xs">
	    <option value=""><?php echo "Select Barangay" ?></option>
		<?php while($rowFBarangay = mysqli_fetch_assoc($getFBarangay)) { ?>
		<option value="<?php echo $rowFBarangay['Code']; ?>" ><?php echo $rowFBarangay['Barangay'];?></option>
		<?php }	?>
 	</select>

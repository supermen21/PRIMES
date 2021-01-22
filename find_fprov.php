<?php require_once('config/database_connection.php');
	$fcodeRegion = substr($_GET['region'],0,2);

    $getFProvince = $dbConn->query("SELECT DISTINCT `Code`, `Province` FROM psgc_provinces WHERE Left(Code,2) like '$fcodeRegion%'");
?>

                      <label>Province</label>
    <select name="txtfProv" id="fprovdiv" class="form-control text-xs" onchange="getfMuni(<?php echo $fcodeRegion; ?>,this.value)">
        <option value=""><?php echo "Select Province" ?></option>
        <?php while($rowFProvince = mysqli_fetch_assoc($getFProvince)) { ?>
        <option value="<?php echo $rowFProvince['Code']; ?>" ><?php echo $rowFProvince['Province']?></option>
        <?php } ?>
	</select>

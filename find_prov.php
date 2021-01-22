<?php require_once('config/database_connection.php');
	$codeRegion = substr($_GET['region'],0,2);

    $getProvince = $dbConn->query("SELECT DISTINCT `Code`, `Province` FROM psgc_provinces WHERE Left(Code,2) like '$codeRegion%'");
?>

    <select  name="txtprov"  id="provdiv" class="form-control text-xs" onchange="getMuni(<?php echo $codeRegion; ?>,this.value)">
        <option value=""><?php echo "Select Province" ?></option>
        <?php while($rowProvince = mysqli_fetch_assoc($getProvince)) { ?>
        <option value="<?php echo $rowProvince['Code']; ?>" ><?php echo $rowProvince['Province']?></option>
        <?php } ?>
	</select>

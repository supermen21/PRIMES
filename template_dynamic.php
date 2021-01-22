  <!-- Interventions: Department of the Interior and Local Government (OTHER) -->
  <div class="form-row mt-3">
                        <div class="col-lg-12">
                        <h5 class="custom-font">Other</h5>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-lg-12">
                            <table id="OTHERS" class="table table-bordered table-striped custom-font" width="100%" cellspacing="0">
                                <thead class="custom-ffedis text-white bg-accent text-xs">
                                    <tr>
                                        <!-- TABLE HEADER -->
                                    </tr>
                                </thead>
                                <?php $queryOTHER = $dbConn->query("SELECT * FROM tbl_interventions WHERE SID = '$SID' AND INFO_MAIN LIKE '%.5%' ORDER BY INFO_DATETIME ASC"); ?>
                                <?php $countOTHER = mysqli_num_rows($queryOTHER); ?>
                                <tbody>
                                <?php if($countOTHER==0){?>
                                    <!-- OFFICE -->
                                    <input type="hidden" name="SID" value="<?php echo $SID; ?>">

                                    <tr class="fieldGroupOTHER">
                                        <!-- FIELD DISPLAY -->
                                      <td class="text-center"><button type="button" id="addMoreOTHER" name="somethingbtn" class="btn btn-success btn-sm addMoreOTHER"><i class="fas fa-plus fa-white"></i></button></td>
                                    </tr>


                                <?php }
                                    $certCountOTHER = 0; // counter for certificates. 1st record will have 'add' button, succeeding rows will have 'remove' button.
                                    while($rowOTHER = mysqli_fetch_assoc($queryOTHER)){ 
                                                $certCountOTHER = $certCountOTHER + 1; ?>
                                    <tr class="fieldGroupOTHER">
                                        <!-- FIELD DISPLAY ECHO -->
                                           <td class="text-center">
                                            <?php if($certCountOTHER==1){ ?>
                                            <button type="button" id="addMoreOTHER" name="somethingbtn" class="btn btn-success btn-sm addMoreOTHER"><i class="fas fa-plus fa-white"></i></button>
                                            <?php } else { ?>
                                            <a href="javascript:void(0)" class="btn btn-danger btn-sm removeOTHER"><i class="fas fa-minus fa-white"></i></a>
                                            <?php } ?>
                                            </td>
                                        </tr>
                                        
                                    <?php } ?>
                                    <tr class="fieldGroupCopyOTHER" style="display: none;">
                                    <td>
                                        <!-- FIELD DISPLAY COPY -->
                                        <input type="hidden" name="SID" value="<?php echo $SID; ?>">
                                        <td class="text-center"><a href="javascript:void(0)" class="btn btn-danger btn-sm removeOTHER"><i class="fas fa-minus fa-white"></i></a>
                                            
                                    </td>
                                    </tr>
                                </tbody>
                                    </table>
                            </div> 
                            </div> 
                            <!-- END OTHER -->
<div class="content">
<?php // var_dump($UnSubscriber);die; ?>
    <div class="container">

        <div class="portlet">

            <h4 class="portlet-title">
                <u>Master Sync Status&nbsp; <i class="fa fa-exchange "></i> </u>
            </h4>

            <div class="portlet-body">

                <div class="row">

                    <div class="col-sm-6 col-md-4">
                        <h4>Recent Activity</h4>

                        <div class="well">

                            <ul class="icons-list text-md">
                                <li><i class="icon-li fa fa-exchange text-success"></i>Sync <?php if(!empty($getLastSystemSyncsub)){ echo $getLastSystemSyncsub[0]['SubscribedCount'];} else{ echo 'test';}  ?> subscribers <?php if(!empty($getLastSystemSyncsub)){ echo $getLastSystemSyncsub[0]['SyncTime'];} else{ echo "0";}?></li>
                                <li><i class="icon-li fa fa-exchange text-success"></i>Sync <?php if(!empty($getLastSystemSyncsub)){ echo $getLastSystemSyncsub[0]['UnSubscribedCount'];} else{ echo 'test';}  ?> Unsubscribers <?php if(!empty($getLastSystemSyncsub)){ echo $getLastSystemSyncsub[0]['SyncTime'];} else{ echo "0";}?></li>
                                <li><i class="icon-li fa fa-exchange text-success"></i>Sync Successful <?php if(!empty($getLastSystemSyncsub)){ echo $getLastSystemSyncsub[0]['SyncTime']; } else{ echo '0';}?></li>
                            </ul>
                        </div> <!-- /.well -->


                    </div> <!-- /.col -->
                    <div class="col-sm-6 col-md-4">
                        <h4>Error Log</h4>

                        <div class="well">

                            <ul class="icons-list text-md">
                                <li>
                                    <i class="icon-li fa fa-ban text-danger"></i>
                                    Sync Not Failed </li>
                            </ul>
                        </div> <!-- /.well -->


                    </div> <!-- /.col -->
                    <div class="col-sm-6 col-md-4">
                        <h4>Master Switch</h4>
                        <div class="portlet">
                            <a class="btn btn-success btn-jumbo btn-block <?php if($autosync == 1) echo 'disabled'; ?>" href="javascript:stratsync(this);" id="syncstrat">AutoSync Active</a>
                            <br>
                            <a class="btn btn-primary btn-small btn-block <?php if($autosync == 0) echo 'disabled'; ?>" href="javascript:stopsync(this);" id="syncstop"><i class="fa fa-exclamation-triangle"></i> Deactivate Sync </a>
                        </div> <!-- /.portlet -->


                    </div> <!-- /.col -->


                </div> <!-- /.row -->

            </div> <!-- /.portlet-body -->

        </div>

        <div class="portlet">

            <h4 class="portlet-title">
                <u>System Sync Status &nbsp;<i class="fa fa-exchange "></i> </u>
            </h4>

            <div class="portlet-body">

                <div class="row">

                    <div class="col-sm-6 col-md-3">

                        <div class="row-stat">
                            <h3 class="row-stat-value">Exact Target</h3>
                            <hr>

                            <!-- Sync-stat -->
                            <div class="progress-stat hide">

                                <div class="progress-stat-label">
                                    Active Sync
                                </div>

                                <div class="progress-stat-value">
                                    
                                </div>

                                <div class="progress progress-striped progress-sm active" id="exact_progessbar">
                                    <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="100" role="progressbar" class="progress-bar progress-bar-success">
                                        <span class="sr-only">77.74% Sync Progress</span>
                                    </div>
                                </div> <!-- /.progress -->

                            </div> <!-- Sync-stat End -->
                            <div class="col-sm-12 col-md-6"> <p class="row-stat-label">Subscribed</p><h3 class="row-stat-value" id="et_subscribe"><?php if(!empty($getLastSystemSyncsub)){ echo $getLastSystemSyncsub[0]['SubscribedCount'];} else{ echo "0";}  ?></h3><hr><p class="row-stat-label">Last Sync</p><h3 class="row-stat-value" id="et_lastsync"><?php if(!empty($getLastSystemSyncsub)){ echo date('h:ma',  strtotime($getLastSystemSyncsub[0]['SyncTime']));}else{ echo "00:00";}?></h3></div>
                            <div class="col-sm-12  col-md-6"><p class="row-stat-label">UnSubscribers</p><h3 class="row-stat-value" id="et_unsubscribe"><?php if(!empty($getLastSystemSyncsub)){ echo $getLastSystemSyncsub[0]['UnSubscribedCount'];}else{ echo "0";}?></h3><hr><p class="row-stat-label">Next Sync</p><h3 class="row-stat-value" id="exact_target_timer"></h3></div> 
                            <h3 class="row-stat-value">&nbsp;</h3><hr><a id="et_stopsync" class="btn btn-primary disabled" href="javascript:;">Stop Sync</a>   &nbsp;   <a id="et_startsync" class="btn btn-primary" href="javascript:startsync(1);">Manual Sync</a>
                        </div> <!-- /.row-stat -->

                    </div> <!-- /.col -->
                    <div class="col-sm-6 col-md-3">

                        <div class="row-stat">
                            <h3 class="row-stat-value">BlackBoxx</h3>
                            <hr>

                            <!-- Sync-stat -->
                            <div class="progress-stat hide">

                                <div class="progress-stat-label">
                                    Active Sync
                                </div>

                                <div class="progress-stat-value">
                                    77.7%
                                </div>

                                <div class="progress progress-striped progress-sm active">
                                    <div style="width: 77%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="77" role="progressbar" class="progress-bar progress-bar-success">
                                        <span class="sr-only">77.74% Sync Progress</span>
                                    </div>
                                </div> <!-- /.progress -->

                            </div> <!-- Sync-stat End -->
                            <div class="col-sm-12 col-md-6"> <p class="row-stat-label">Subscribed</p><h3 class="row-stat-value">121</h3><hr><p class="row-stat-label">Last Sync</p><h3 class="row-stat-value">12.45am</h3></div>
                            <div class="col-sm-12  col-md-6"><p class="row-stat-label">UnSubscribers</p><h3 class="row-stat-value">21</h3><hr><p class="row-stat-label">Next Sync</p><h3 class="row-stat-value">85sec</h3></div> 
                            <h3 class="row-stat-value">&nbsp;</h3><hr><a class="btn btn-primary" href="javascript:;">Stop Sync</a>   &nbsp;   <a class="btn btn-primary disabled" href="javascript:;">Manual Sync</a>
                        </div> <!-- /.row-stat -->

                    </div> <!-- /.col -->
                    <div class="col-sm-6 col-md-3">

                        <div class="row-stat">
                            <h3 class="row-stat-value">BePoz</h3>
                            <hr>

                            <!-- Sync-stat -->
                            <div class="progress-stat hide">

                                <div class="progress-stat-label">
                                    Active Sync
                                </div>

                                <div class="progress-stat-value">
                                    77.7%
                                </div>

                                <div class="progress progress-striped progress-sm active">
                                    <div style="width: 77%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="77" role="progressbar" class="progress-bar progress-bar-success">
                                        <span class="sr-only">77.74% Sync Progress</span>
                                    </div>
                                </div> <!-- /.progress -->

                            </div> <!-- Sync-stat End -->
                            <div class="col-sm-12 col-md-6"> <p class="row-stat-label">Subscribed</p><h3 class="row-stat-value">121</h3><hr><p class="row-stat-label">Last Sync</p><h3 class="row-stat-value">12.45am</h3></div>
                            <div class="col-sm-12  col-md-6"><p class="row-stat-label">UnSubscribers</p><h3 class="row-stat-value">21</h3><hr><p class="row-stat-label">Next Sync</p><h3 class="row-stat-value">85sec</h3></div> 
                            <h3 class="row-stat-value">&nbsp;</h3><hr><a class="btn btn-primary" href="javascript:;">Stop Sync</a>   &nbsp;   <a class="btn btn-primary disabled" href="javascript:;">Manual Sync</a>
                        </div> <!-- /.row-stat -->

                    </div> <!-- /.col -->
                    <div class="col-sm-6 col-md-3">

                        <div class="row-stat">
                            <h3 class="row-stat-value">CRM-MD</h3>
                            <hr>

                            <!-- Sync-stat -->
                            <div class="progress-stat hide">

                                <div class="progress-stat-label">
                                    Active Sync
                                </div>

                                <div class="progress-stat-value">
                                    77.7%
                                </div>

                                <div class="progress progress-striped progress-sm active">
                                    <div style="width: 77%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="77" role="progressbar" class="progress-bar progress-bar-success">
                                        <span class="sr-only">0% Sync Progress</span>
                                    </div>
                                </div> <!-- /.progress -->

                            </div> <!-- Sync-stat End -->
                            <div class="col-sm-12 col-md-6"> <p class="row-stat-label">Subscribed</p><h3 class="row-stat-value">0</h3><hr><p class="row-stat-label">Last Sync</p><h3 class="row-stat-value">00.00am</h3></div>
                            <div class="col-sm-12  col-md-6"><p class="row-stat-label">UnSubscribers</p><h3 class="row-stat-value">0</h3><hr><p class="row-stat-label">Next Sync</p><h3 class="row-stat-value">0sec</h3></div> 
                            <h3 class="row-stat-value">&nbsp;</h3><hr><a class="btn btn-primary  disabled" href="javascript:;">Stop Sync</a>   &nbsp;   <a class="btn btn-primary disabled" href="javascript:;">Manual Sync</a>
                        </div> <!-- /.row-stat -->

                    </div> <!-- /.col -->




                </div> <!-- /.row -->

            </div> <!-- /.portlet-body -->

        </div>


              <div class="portlet">

        <h3 class="portlet-title">
          <u>Master Unsubscribe List </u>
        </h3>

        <div class="portlet-body">

          <table class="table table-striped table-bordered" id="table-1">
            <thead>
              <tr>
                <th style="width: 30%">ID</th>
                <th style="width: 20%">First Name</th>
                <th style="width: 18%">Last Name</th>
                <th style="width: 20%">Email</th>
                <th style="width: 12%">Exact Target</th>
                <th style="width: 12%">Blackbox</th>
                <th style="width: 12%">Bepoz</th>
                <th style="width: 12%">CRM - MD</th>
              </tr>
            </thead>
                         <tbody>
                <?php if($UnSubscriber != NULL)

                    foreach ($UnSubscriber as $key => $value) {
                        $store_name=explode(",", $value['storename'])
                        ?>
                <tr>
                            <td style="width: 8%"><?php echo $value['id']?></td>
                            <td style="width: 15%"><?php echo $value['firstname']?></td>
                            <td style="width: 15%"><?php echo $value['lastname']?></td>
                            <td style="width: 20%"><?php echo $value['email']?></td>
                            <td style="width: 10%"><?php  if(in_array("ET",$store_name)){echo "y";}else{echo "n";}?></td>
                            <td style="width: 15%"><?php  if(in_array("BB",$store_name)){echo "y";}else{echo "n";}?></td>
                            <td style="width: 10%"><?php  if(in_array("BP",$store_name)){echo "y";}else{echo "n";}?></td>
                            <td style="width: 10%"><?php  if(in_array("MDB",$store_name)){echo "y";}else{echo "n";}?></td>
                </tr>
                 <?php
                    }
                    ?> 
            </tbody>
               
            <tfoot>
              <tr>
               <th style="width: 30%">ID</th>
                <th style="width: 20%">First Name</th>
                <th style="width: 18%">Last Name</th>
                <th style="width: 20%">Email</th>
                <th style="width: 12%">Exact Target</th>
                <th style="width: 12%">Blackbox</th>
                <th style="width: 12%">Bepoz</th>
                <th style="width: 12%">CRM - MD</th>
              </tr>
            </tfoot>
          </table>

        </div> <!-- /.portlet-body -->

      </div> <!-- /.portlet -->

    </div> <!-- /.container -->

</div> <!-- .content -->
<?php 
  if(!empty($getLastSystemSyncsub)){ $time=  date("h:m:sa",strtotime($getLastSystemSyncsub[0]['SyncTime']));}
  if(!empty($getAutoSyncUpdate)){ $next=$getAutoSyncUpdate[0]['time_duration'];
$endTime = strtotime("+30'".$next."'minutes", strtotime($time));
//echo $next_time = strtotime(date('h:i:s', $time))."<br>";
$current_time=strtotime(date('h:i:sa',time()));
$diff = $endTime-$current_time;
if($diff){
    $timer_time= date('m', $diff);
}
  }
?>
<input type="hidden" name="auto_sync_time" value="<?php   echo $timer_time; ?>" id="auto_sync_time">
<script src="<?php echo base_url();?>assets/js/sync.js"></script>
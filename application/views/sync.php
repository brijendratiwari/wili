<div class="content">

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
                                <li><i class="icon-li fa fa-exchange text-success"></i>Sync 6 subscribers 12:32:012322</li>
                                <li><i class="icon-li fa fa-exchange text-success"></i>Sync 12 subscribers, 4 unsubscribes 12:32:012322</li>
                                <li><i class="icon-li fa fa-exchange text-success"></i>Sync Successful 12:32:012322</li>
                            </ul>
                        </div> <!-- /.well -->


                    </div> <!-- /.col -->
                    <div class="col-sm-6 col-md-4">
                        <h4>Error Log</h4>

                        <div class="well">

                            <ul class="icons-list text-md">
                                <li>
                                    <i class="icon-li fa fa-ban text-danger"></i>
                                    Sync Fail 12:32:012322</li>
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
                            <div class="progress-stat">

                                <div class="progress-stat-label">
                                    Active Sync
                                </div>

                                <div class="progress-stat-value">
                                    100%
                                </div>

                                <div class="progress progress-striped progress-sm active">
                                    <div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="100" role="progressbar" class="progress-bar progress-bar-success">
                                        <span class="sr-only">77.74% Sync Progress</span>
                                    </div>
                                </div> <!-- /.progress -->

                            </div> <!-- Sync-stat End -->
                            <div class="col-sm-12 col-md-6"> <p class="row-stat-label">Subscribed</p><h3 class="row-stat-value" id="et_subscribe">121</h3><hr><p class="row-stat-label">Last Sync</p><h3 class="row-stat-value" id="et_lastsync">12.45am</h3></div>
                            <div class="col-sm-12  col-md-6"><p class="row-stat-label">UnSubscribers</p><h3 class="row-stat-value" id="et_unsubscribe">21</h3><hr><p class="row-stat-label">Next Sync</p><h3 class="row-stat-value">85sec</h3></div> 
                            <h3 class="row-stat-value">&nbsp;</h3><hr><a id="et_stopsync" class="btn btn-primary disabled" href="javascript:;">Stop Sync</a>   &nbsp;   <a id="et_startsync" class="btn btn-primary" href="javascript:startsync(1);">Manual Sync</a>
                        </div> <!-- /.row-stat -->

                    </div> <!-- /.col -->
                    <div class="col-sm-6 col-md-3">

                        <div class="row-stat">
                            <h3 class="row-stat-value">BlackBoxx</h3>
                            <hr>

                            <!-- Sync-stat -->
                            <div class="progress-stat">

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
                            <div class="progress-stat">

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
                            <div class="progress-stat">

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
                <tr>
                    <td>432423</td>
                    <td>Bill</td>
                    <td>Stevens</td>
                    <td>bsteven@gmail.com</td>
                    <td>y</td>
                    <td>y</td>
                    <td>y</td>
                    <td>n</td>
                </tr>
                <tr>
                    <td>4111423</td>
                    <td>Dane</td>
                    <td>Type</td>
                    <td>dtyle@gmail.com</td>
                    <td>y</td>
                    <td>y</td>
                    <td>y</td>
                    <td>n</td>
                </tr>
                <tr>
                    <td>4544423</td>
                    <td>Ben</td>
                    <td>Williams</td>
                    <td>bwill@gmail.com</td>
                    <td>y</td>
                    <td>y</td>
                    <td>y</td>
                    <td>n</td>
                </tr>
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
<script src="<?php echo base_url();?>assets/js/sync.js"></script>
<div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Team
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="chat-panel panel panel-default">
                        
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        <?php if (count($members) > 0):?>
                            <ul class="chat">
                               <?php for($i=0;$i<count($members);$i++):?>
                                    
                                <li class="left clearfix">
                                    <span class="chat-img pull-left">
                                        <img class="img-circle" alt="User Avatar" src="<?php echo $members[$i]['avatar']?>" style="height: 50px;width:50px;">
                                    </span>
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <strong class="primary-font"><?php echo $members[$i]['name']?></strong><br> 
                                            <small class="text-muted">
                                                Equity:  <?php echo $members[$i]['percent']?>%<br>
                                                Slice:  <?php echo round($members[$i]['slices'])?><br>
                                                Pie:  <?php echo round($members[$i]['pie'])?>%
                                            </small>
                                        </div>
                                        <p>
                                           <?php echo $members[$i]['role']?>
                                        </p>
                                    </div>
                                    <?php if (Yii::app()->Ini->hasAccess($domain)):?>
                                      <?php $this->renderPartial('_member-buttons',array('contributions'=>$contributions,'member_id'=>$members[$i]['member_id'])); ?>
                                    <?php endif?>  
                                </li>
                                <?php endfor;?>
                            </ul>
                         <?php endif?>   
                        </div>
                        
                       
                    </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Equity Summary
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="flot-chart">
                                <div class="flot-chart-content" id="flot-pie-chart"></div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
                <!-- /.col-lg-6 -->
</div>

 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                       
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
</div>


<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/flot/excanvas.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/flot/jquery.flot.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/flot/jquery.flot.pie.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/flot/jquery.flot.resize.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/dashboard.js"></script>
<script>
$(function() {

    var data = <?php echo $points?>;

    var plotObj = $.plot($("#flot-pie-chart"), data, {
        series: {
            pie: {
                show: true
            }
        },
        grid: {
            hoverable: true
        },
        tooltip: true,
        tooltipOpts: {
            content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
            shifts: {
                x: 20,
                y: 0
            },
            defaultTheme: false
        }
    });

});
</script>

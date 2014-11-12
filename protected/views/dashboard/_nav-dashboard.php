<li>
   <a  class="<?php if ($this->menu=='dashboard') echo 'active'?> " href="<?php echo Yii::app()->request->baseUrl; ?>/dashboard"><i class="fa fa-dashboard fa-fw"></i>Dashboard</a>
</li>
<li>
   <a  class="<?php if ($this->menu=='contributions') echo 'active'?>" href="<?php echo Yii::app()->request->baseUrl; ?>/dashboard/contribution-types"><i class="fa fa-tasks fa-fw"></i>Contribution Types</a>
</li>


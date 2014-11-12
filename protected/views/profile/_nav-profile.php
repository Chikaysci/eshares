<li id="dashboard">
   <a href="<?php echo Yii::app()->request->baseUrl; ?>/dashboard"><i class="fa fa-dashboard fa-fw"></i>Main Dashboard</a>
</li>
<li>
   <a id="li_profile" class="<?echo $menu == 'profile' ? 'active':''?>" href="<?php echo Yii::app()->request->baseUrl; ?>/profile/settings"><i class="fa fa-male fa-fw"></i>Personal</a>
</li>
<li>
   <a id="li_mycontributions" class="<?echo $menu == 'mycontributions' ? 'active':''?>" href="<?php echo Yii::app()->request->baseUrl; ?>/profile/mycontribution"><i class="fa fa-money fa-fw"></i>My Contributions</a>
</li>
<!-- li>
   <a href="<?php echo Yii::app()->request->baseUrl; ?>"><i class="fa fa-envelope fa-fw"></i>Alerts</a>
</li -->
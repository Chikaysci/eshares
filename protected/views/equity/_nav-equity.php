<li id="dashboard">
   <a href="<?php echo Yii::app()->request->baseUrl; ?>/dashboard"><i class="fa fa-dashboard fa-fw"></i> Main Dashboard</a>
</li>
<li>
   <a id="tab-equity-dashboard" class="active" href="<?php echo Yii::app()->request->baseUrl; ?>/equity/details/t/<?php echo $this->domain?>" onclick="loaddashboard();"><i class="fa fa-dashboard fa-fw"></i> <?php echo ucfirst($this->domain)?> Dashboard</a>
</li>
<?php if (Yii::app()->Ini->hasAccess($this->domain)):?>
<li>
   <a  href="javascript:void(0)" onclick="loadaddfunds();"  id="tab-add-funds"><i class="fa fa-money fa-fw"></i> Add Funds</a>
</li>
<li>
   <a  href="javascript:void(0)" onclick="loaddrawfunds();" id="tab-draw-funds"><i class="fa fa-reply fa-fw"></i> Draw Funds</a>
</li>
<?php endif?>
<li>
   <a  href="javascript:void(0)"   onclick="loadcontributions();" id="tab-contributions"><i class="fa fa-institution fa-fw"></i> Contributions</a>
</li>
<li>
   <a  href="javascript:void(0)"   onclick="loadsummary();"  id="tab-summary"><i class="fa fa-tasks fa-fw"></i> Summary</a>
</li>
<?php if (Yii::app()->Ini->hasAccess($this->domain)):?>
<li>
   <a  href="javascript:loadbrandsettings();" id="tab-brand-settings"><i class="fa fa-globe fa-fw"></i> Venture Settings</a>
</li>
<li >
   <a  href="javascript:void(0)" onclick="loadmembersettings();" id="tab-member-settings"><i class="fa fa-users fa-fw"></i> Member Settings</a>
</li>
<?php endif?>

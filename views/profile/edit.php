<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Profile");
$this->breadcrumbs=array(
	UserModule::t("Profile")=>array('profile'),
	UserModule::t("Edit"),
);
$this->menu=array(
	array('label'=>UserModule::t('Manage Users'), 'url'=>array('/user/admin/admin'), 'visible'=>UserModule::isAdmin()),
    array('label'=>UserModule::t('List Users'), 'url'=>array('/user/default/index')),
    array('label'=>UserModule::t('Profile'), 'url'=>array('/user/profile/profile')),
    array('label'=>UserModule::t('Change password'), 'url'=>array('changepassword')),
    array('label'=>UserModule::t('Logout'), 'url'=>array('/user/logout/logout')),
);
?><h1><?php echo UserModule::t('Edit profile'); ?></h1>

<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm', array(
    'type'=>'horizontal',
    'id'=>'profile-form',
    'enableAjaxValidation'=>true,
    'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

    <fieldset>
        
        <legend><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></legend>
        
        <?php echo $form->errorSummary(array($model,$profile)); ?>
        
        
            
        <?php echo $form->textFieldRow($model,'username'); ?>
        <?php echo $form->textFieldRow($model,'email'); ?>
        
        <?php $profileFields=$profile->getFields();
            if ($profileFields) {
                foreach($profileFields as $field) {
                    
                    if ($widgetEdit = $field->widgetEdit($profile)) {
                        echo '<div class="control-group">';
                        echo $form->labelEx($profile,$field->varname, array('class'=>'control-label'));
                        echo '<div class="controls">';
                        echo $widgetEdit;
                        echo $form->error($profile,$field->varname, array('class'=>'help-inline'));
                        echo '</div></div>';
                    } elseif ($field->range) {
                        echo $form->dropDownListRow($profile,$field->varname,Profile::range($field->range));
                    } elseif ($field->field_type=="TEXT") {
                        echo $form->textAreaRow($profile,$field->varname,array('rows'=>6, 'cols'=>50));
                    } else {
                        echo $form->textFieldRow($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
                    }
                }
            }
        ?>

    </fieldset>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.BootButton',array(
            'label'=>$model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save'),
            'buttonType'=>'submit',
            'type'=>'primary',
        )); ?>
    </div>
<?php $this->endWidget(); ?>



<?php /*
<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'profile-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->errorSummary(array($model,$profile)); ?>

<?php 
		$profileFields=$profile->getFields();
		if ($profileFields) {
			foreach($profileFields as $field) {
			?>
	<div class="row">
		<?php echo $form->labelEx($profile,$field->varname);
		
		if ($widgetEdit = $field->widgetEdit($profile)) {
			echo $widgetEdit;
		} elseif ($field->range) {
			echo $form->dropDownList($profile,$field->varname,Profile::range($field->range));
		} elseif ($field->field_type=="TEXT") {
			echo $form->textArea($profile,$field->varname,array('rows'=>6, 'cols'=>50));
		} else {
			echo $form->textField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
		}
		echo $form->error($profile,$field->varname); ?>
	</div>	
			<?php
			}
		}
?>
	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
*/ ?>
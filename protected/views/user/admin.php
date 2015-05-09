<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	Yii::t('app', 'Manage'),
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>Yii::t('app', 'Create').' User', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('app', 'Manage');?> Users</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php 

?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'afterAjaxUpdate'=>"function(){jQuery('#User_fnac').datepicker($.datepicker.regional['es'])}",
	'columns'=>array(
		'id',
		'username',
		//'password',
                'usuarioCompleto',
                array(
                   // 'type'=>'date',
                    'name'=>'fnac',
                    'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker',array(
                                'model'=>$model,
                                'attribute'=>'fnac',
                                'language'=>'es',
                                // additional javascript options for the date picker plugin
                                'options'=>array(
                                    'showAnim'=>'fold',
                                ),
                                'htmlOptions'=>array(
                                    'style'=>'height:20px;'
                                ),
                            ),true)
                ),
		'email',
		'profile',
		array(
			'class'=>'CButtonColumn',
                        'afterDelete'=>'function(link,success,data){ if(success) alert(data);}',
		),
	),
)); ?>

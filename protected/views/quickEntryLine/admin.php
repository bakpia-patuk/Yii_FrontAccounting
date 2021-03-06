<?php
/* @var $this QuickEntryLineController */
/* @var $model QuickEntryLine */

$this->breadcrumbs=array(
	'Quick Entry Lines'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List QuickEntryLine', 'url'=>array('index')),
	array('label'=>'Create QuickEntryLine', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('quick-entry-line-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Quick Entry Lines</h1>

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
	$dialog = $this->widget('ext.ecolumns.EColumnsDialog', array(
       'options'=>array(
            'title' => 'Layout settings',
            'autoOpen' => false,
            'show' =>  'fade',
            'hide' =>  'fade',
        ),
       'htmlOptions' => array('style' => 'display: none'), //disable flush of dialog content
       'ecolumns' => array(
            'gridId' => 'quick-entry-line-grid', //id of related grid
            'storage' => 'session',  //where to store settings: 'db', 'session', 'cookie'
            'fixedLeft' => array('CCheckBoxColumn'), //fix checkbox to the left side 
            'model' => $model->search(), //model is used to get attribute labels
            'columns' => array(
				array(
					'name'=>'id',
					'header'=>'No',
				),
				

				array(
					'name'=>'quick_entry_id',
					'value'=>'$data->quickEntry->description',		
				),
				'amount',
				array(
					'name'=>'quick_entry_action_id',
					'value'=>'$data->quickEntryAction->name',		
				),
				array(
					'name'=>'destination_id',
					'value'=>'($data->destination != null) ? $data->destination->name : null',						
				),
				array(
					'name'=>'dimension1_id',
					'value'=>'$data->dimension1 != null ? $data->dimension2->name : null',		
				),
				array(
					'name'=>'dimension2_id',
					'value'=>'$data->dimension2->name',		
				),
		
		
				array(
					'class'=>'CButtonColumn',
				),            
           ),
       )
    ));
	$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'quick-entry-line-grid',	
	'filter'=>$model,
	'dataProvider' =>$model->search(),
    'columns' => $dialog->columns(),   				
    'template' => $dialog->link()."{summary}\n{items}\n{pager}",	
	)); 
?>

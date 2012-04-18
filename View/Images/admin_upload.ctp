<div class="images index">
	<h2><?php echo $model . ' ' . __('Images');?></h2>
    <?php 
        echo $this->Form->create($model, array('enctype' => 'multipart/form-data'));
        echo $this->Form->input('id');
        echo $this->Form->input('photo_upload', array('type' => 'file'));
        echo $this->Form->end(__('Upload Image'));
    ?>
</div>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Manage Images'), "/admin/images/manage/$model/{$this->request['id']}"); ?></li>
	</ul>
</div>

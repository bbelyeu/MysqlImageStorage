<script type="text/javascript">
var primary_image_id = <?php echo $this->data[$model]['primary_image_id']; ?>;

$(document).ready(function() {
    $("a.remove").click(function() {
        if ($(this).parents('tr').attr('id') == primary_image_id) {
            alert("Please choose a new primary image");
        }
        $(this).parents('tr').remove();
    });
});
</script>

<div class="images index">
	<h2><?php echo $model . ' ' . __('Images');?></h2>
    <?php 
        echo $this->Form->create($model);
        echo $this->Form->input('id');
    ?>
	<table cellpadding="0" cellspacing="0">
	    <tr>
			<th><?php echo __('Image');?></th>
            <th><?php echo __('Primary Image');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	    </tr>
	<?php
	foreach ($this->data['Image'] as $img): ?>
        <tr id="<?php echo $img['id']; ?>">
            <td><img src="/images/<?php echo $img['id'];?>" /></td>
            <td><input type="checkbox" name="data[<?php echo $model;?>][primary_image_id]" value="<?php echo $img['id'];?>" <?php if($this->data[$model]['primary_image_id']==$img['id']):?>checked="checked" <?php endif;?>/></td>
		    <td>
                <input type="hidden" name="data[Image][Image][]" value="<?php echo $img['id'];?>" />
                <a class="remove btn">Remove Image</a>
            </td>
        </tr>
<?php endforeach; ?>
	</table>
    <?php echo $this->Form->end(__('Submit'));?>
</div>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Upload Image'), "/admin/images/upload/$model/{$this->request['id']}"); ?></li>
	</ul>
</div>

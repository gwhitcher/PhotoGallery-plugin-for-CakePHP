<h1>Add Category</h1>
<?php
echo $this->Form->create($category, ['type' => 'file']);
echo $this->Form->input('title');
echo $this->Form->input('img', array('type' => 'file'));
echo $this->Form->button(__('Add Category'));
echo $this->Form->end();
?>
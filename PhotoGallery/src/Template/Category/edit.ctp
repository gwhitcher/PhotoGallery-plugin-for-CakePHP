<h1>Edit Category</h1>
<?php
echo $this->Form->create($category, ['type' => 'file']);
echo $this->Form->input('title');
echo $this->Form->input('description', ['rows' => '3']);
echo $this->Form->input('img', array('type' => 'file'));
echo $this->Form->button(__('Edit Category'));
echo $this->Form->end();
?>
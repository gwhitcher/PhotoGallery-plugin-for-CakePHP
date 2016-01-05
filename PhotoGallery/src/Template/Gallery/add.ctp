<h1>Add Photo</h1>
<?php
echo $this->Form->create($gallery, ['type' => 'file']);
echo $this->Form->input('title');
echo $this->Form->input('img', array('type' => 'file'));
echo $this->Form->button(__('Add Photo'));
echo $this->Form->end();
?>
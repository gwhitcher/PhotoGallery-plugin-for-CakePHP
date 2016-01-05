<h1>Edit Photo</h1>
<?php
echo $this->Form->create($gallery, ['type' => 'file']);
echo $this->Form->input('title');
echo $this->Form->input('description', ['rows' => '3']);
echo $this->Form->input('img', array('type' => 'file'));
echo $this->Form->button(__('Edit Photo'));
echo $this->Form->end();
?>
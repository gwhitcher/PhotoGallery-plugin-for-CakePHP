<?php
//Load CSS
echo $this->Html->css('PhotoGallery.styles');

echo '<div class="pg_delete">';
echo $this->Form->postLink(
    'Delete',
    ['action' => 'delete', $category->id],
    ['confirm' => 'Are you sure?']);
echo '</div>';
<?php
//Load routing
use Cake\Routing\Router;
//Load CSS
echo $this->Html->css('PhotoGallery.styles');

$image_url = $this->Html->image('PhotoGallery.gallery/md/'.$gallery->img);

echo '<h2>'.$gallery->title.'</h2>';

echo '<a href="'.Router::url('/', true).'photo_gallery/img/gallery/lg/'.$gallery->img.'" target="_blank">'.$image_url.'</a>';

echo '<p>'.$gallery->description.'</p>';

echo '<div class="pg_actions">';
echo $this->Html->link('Edit', ['action' => 'edit', $gallery->id], ['class' => 'edit']);
echo $this->Html->link('Delete', ['action' => 'delete', $gallery->id], ['class' => 'delete']);
echo '</div>';
<?php
//Load routing
use Cake\Routing\Router;
//Load CSS
echo $this->Html->css('PhotoGallery.styles');

$image_url = $this->Html->image('PhotoGallery.gallery/category/md/'.$category->img);

echo '<h2>'.$category->title.'</h2>';

echo '<p>'.$category->description.'</p>';

echo '<ul class="pg_list">';
foreach($gallery as $gallery_item) {
    $image_url = $this->Html->image('PhotoGallery.gallery/th/'.$gallery_item->img);
    echo '<li><a href="'.Router::url('/', true).'photo_gallery/gallery/view/'.$gallery_item->id.'">'.$image_url.'<div class="pg_caption">'.$gallery_item->title.'</div></a></li>';
}
echo '</ul>';

echo '<div class="pg_actions">';
echo $this->Html->link('Edit', ['action' => 'edit', $category->id], ['class' => 'edit']);
echo $this->Html->link('Delete', ['action' => 'delete', $category->id], ['class' => 'delete']);
echo '</div>';
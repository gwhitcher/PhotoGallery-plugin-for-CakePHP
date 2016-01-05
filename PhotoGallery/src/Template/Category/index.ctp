<?php
//Load routing
use Cake\Routing\Router;
//Load CSS
echo $this->Html->css('PhotoGallery.styles');

echo '<ul class="pg_list">';
foreach($category as $category_item) {
    $image_url = $this->Html->image('PhotoGallery.gallery/th/'.$category_item->img);
    echo '<li><a href="'.Router::url('/', true).'photo_gallery/category/view/'.$category_item->id.'">'.$image_url.'<div class="pg_caption">'.$category_item->title.'</div></a></li>';
}
echo '</ul>';
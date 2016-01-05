<?php
namespace PhotoGallery\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class GalleryTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->notEmpty('title');

        return $validator;
    }
}
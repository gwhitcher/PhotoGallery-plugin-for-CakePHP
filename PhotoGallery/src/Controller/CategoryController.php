<?php
namespace PhotoGallery\Controller;

use PhotoGallery\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Gallery Controller
 *
 * @property \PhotoGallery\Model\Table\CategoryTable $Category
 */
class CategoryController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('category', $this->paginate($this->Category));
        $this->set('_serialize', ['category']);
    }

    /**
     * View method
     *
     * @param string|null $id Category id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $category = $this->Category->get($id, [
            'contain' => []
        ]);
        $this->set('category', $category);
        $this->set('_serialize', ['category']);

        $gallery = TableRegistry::get('gallery')->find()->where(['category_id =' => $id])->order(['created' => 'DESC']);

        $this->set('gallery', $gallery);
        $this->set('_serialize', ['gallery']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $category = $this->Category->newEntity();
        if ($this->request->is('post')) {
            if(!empty($this->request->data['img']['name'])) {
                //UPLOAD MAIN FILE
                $image_directory = ROOT . '/plugins/PhotoGallery/webroot/img/gallery/category';
                $image_name = $this->request->data['img']['name'];
                if (file_exists($image_directory.'/'.$image_name)) {
                    $this->Flash->error(__('Image already exists.  Please choose a different filename or make sure the file you are uploading is not a duplicate!'));
                    $this->redirect(array('action' => 'add'));
                } else {
                    move_uploaded_file($this->request->data['img']['tmp_name'],$image_directory . $image_name);
                    $uploaded_file = $image_directory.'/'.$image_name;
                    /* START IMAGE RESIZING */
                    /* LARGE IMAGE RESIZE */
                    $im = new Imagick($uploaded_file);
                    $lg_width = $im->getImageWidth();
                    if ($lg_width > 800) {
                        $im->thumbnailImage(800, null, 0);
                    }
                    $lg_height = $im->getImageHeight();
                    if ($lg_height > 800) {
                        $im->thumbnailImage(null, 800, 0);
                    }
                    $im->writeImage($image_directory . '/lg/'.$image_name);

                    /* MEDIUM IMAGE RESIZE */
                    $im = new Imagick($uploaded_file);
                    $md_width = $im->getImageWidth();
                    if ($md_width > 250) {
                        $im->thumbnailImage(250, null, 0);
                    }
                    $md_height = $im->getImageHeight();
                    if ($md_height > 250) {
                        $im->thumbnailImage(null, 250, 0);
                    }
                    $im->writeImage($image_directory . '/md/'.$image_name);

                    /* THUMB IMAGE RESIZE */
                    $im = new Imagick($uploaded_file);
                    $th_width = $im->getImageWidth();
                    if ($th_width > 100) {
                        $im->thumbnailImage(100, null, 0);
                    }
                    $md_height = $im->getImageHeight();
                    if ($md_height > 100) {
                        $im->thumbnailImage(null, 100, 0);
                    }
                    $im->writeImage($image_directory . '/th/'.$image_name);
                    /* END IMAGE RESIZING */

                    //SAVE TO DATABASE
                    $this->request->data['img'] = $image_name;

                    $category = $this->Category->patchEntity($category, $this->request->data);
                    if ($this->Category->save($category)) {
                        $this->Flash->success('The category has been saved.');
                        return $this->redirect(['action' => 'index']);
                    } else {
                        $this->Flash->error('The category could not be saved. Please, try again.');
                    }
                }
            } else {
                $this->Flash->error(__('Image empty'));
                $this->redirect(array('action' => 'add'));
            }
        }
        $this->set(compact('category'));
        $this->set('_serialize', ['category']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Gallery id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $category = $this->Category->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if(!empty($this->request->data['img']['name'])) {
                //UPLOAD MAIN FILE
                $image_directory = WWW_ROOT . 'img/gallery/category';
                $image_name = $this->request->data['img']['name'];
                move_uploaded_file($this->request->data['img']['tmp_name'],$image_directory);
                $uploaded_file = $image_directory.'/'.$image_name;
                /* START IMAGE RESIZING */
                /* LARGE IMAGE RESIZE */
                $im = new Imagick($uploaded_file);
                $lg_width = $im->getImageWidth();
                if ($lg_width > 800) {
                    $im->thumbnailImage(800, null, 0);
                }
                $lg_height = $im->getImageHeight();
                if ($lg_height > 800) {
                    $im->thumbnailImage(null, 800, 0);
                }
                $im->writeImage($image_directory . '/lg/'.$image_name);

                /* MEDIUM IMAGE RESIZE */
                $im = new Imagick($uploaded_file);
                $md_width = $im->getImageWidth();
                if ($md_width > 250) {
                    $im->thumbnailImage(250, null, 0);
                }
                $md_height = $im->getImageHeight();
                if ($md_height > 250) {
                    $im->thumbnailImage(null, 250, 0);
                }
                $im->writeImage($image_directory . '/md/'.$image_name);

                /* THUMB IMAGE RESIZE */
                $im = new Imagick($uploaded_file);
                $th_width = $im->getImageWidth();
                if ($th_width > 100) {
                    $im->thumbnailImage(100, null, 0);
                }
                $md_height = $im->getImageHeight();
                if ($md_height > 100) {
                    $im->thumbnailImage(null, 100, 0);
                }
                $im->writeImage($image_directory . '/th/'.$image_name);
                /* END IMAGE RESIZING */

                //SAVE TO DATABASE
                $this->request->data['img'] = $image_name;
            } else {
                //SAVE EXISTING INFO TO DATABASE
                $this->request->data['img'] = $category->img;
            }

            $category = $this->Category->patchEntity($category, $this->request->data);
            if ($this->Category->save($category)) {
                $this->Flash->success('The category has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The category could not be saved. Please, try again.');
            }
        }
        $this->set(compact('category'));
        $this->set('_serialize', ['category']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Category id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $category = $this->Category->get($id);
        if ($this->request->is('post')) {
            if ($this->Category->delete($category)) {
                //Delete category files
                $image_directory = ROOT . '/plugins/PhotoGallery/webroot/img/gallery/category';
                $image_name = $category->img;
                unlink($image_directory.$image_name); //Delete original image
                unlink($image_directory.'th/'.$image_name); //Delete th image
                unlink($image_directory.'md/'.$image_name); //Delete th image
                unlink($image_directory.'lg/'.$image_name); //Delete th image

                //Delete all images in category
                $gallery = TableRegistry::get('gallery')->find()->where(['category_id =' => $id]);
                foreach($gallery as $gallery_item) {
                    //Delete from DB
                    $this->loadModel('Gallery');
                    $gal_rec = $this->Gallery->get($id);
                    $this->Gallery->delete($gal_rec);
                    //Delete files
                    $image_directory = ROOT . '/plugins/PhotoGallery/webroot/img/gallery/';
                    $image_name = $gallery_item->img;
                    unlink($image_directory.$image_name); //Delete original image
                    unlink($image_directory.'th/'.$image_name); //Delete th image
                    unlink($image_directory.'md/'.$image_name); //Delete th image
                    unlink($image_directory.'lg/'.$image_name); //Delete th image
                }
                $this->Flash->success('The category has been deleted.');
            } else {
                $this->Flash->error('The category could not be deleted. Please, try again.');
            }
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('category'));
        $this->set('_serialize', ['category']);
    }
}

<?php
namespace PhotoGallery\Controller;

use PhotoGallery\Controller\AppController;
use Cake\Datasource\ConnectionManager;

/**
 * Install Controller
 *
 * @property \PhotoGallery\Model\Table\InstallTable $Install
 */
class InstallController extends AppController
{
    public function index() {
        $conn = ConnectionManager::get('default');

        //Create gallery
        $query = 'CREATE TABLE gallery (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    category_id INT(11),
    title VARCHAR(50),
    description TEXT,
    img VARCHAR(50),
    created DATETIME DEFAULT NULL,
    modified DATETIME DEFAULT NULL
)';
        $conn->query($query);

        //Create gallery categories
        $query = 'CREATE TABLE category (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(50),
    description TEXT,
    img VARCHAR(50),
    created DATETIME DEFAULT NULL,
    modified DATETIME DEFAULT NULL
)';
        $conn->query($query);

        $this->Flash->success('Successfully installed.');
        return $this->redirect(['controller' => 'category', 'action' => 'index']);
    }
}
<?php
App::uses('MysqlImageStorageAppController', 'MysqlImageStorage.Controller');
/**
 * Images Controller
 *
 * @property Image $Image
 */
class ImagesController extends MysqlImageStorageAppController 
{
    /**
     * This method can be used to manage HABTM relationships
     * between your apps models and related images
     *
     * @param string $model
     * @param int $id
     * @return null
     */
    public function admin_manage($model, $id)
    {
        $model = ucfirst($model);
        App::uses($model, 'Model');
        $instance = new $model();
        $instance->id = (int) $id;
        if (!$instance->exists()) {
            throw new NotFoundException(__('Invalid request to manage images'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            if ($instance->save($this->request->data)) {
                $this->Session->setFlash(__('Images saved'));
            }
        }

        $this->data = $instance->read(null, $id);
        $this->set('model', $model);
    }

    /**
     * This method can be used to add new images in a HABTM relationship
     * between your apps models and related images
     *
     * @param string $model
     * @param int $id
     * @return null
     */
    public function admin_upload($model, $id)
    {
        $model = ucfirst($model);
        App::uses($model, 'Model');
        $instance = new $model();
        $instance->id = (int) $id;
        if (!$instance->exists()) {
            throw new NotFoundException(__('Invalid request to manage images'));
        }

        $instanceData = $instance->read(null, $id);

        if ($this->request->is('post') || $this->request->is('put')) {
            if (is_array($this->request->data[$model]['photo_upload']) && !empty($this->request->data[$model]['photo_upload'])) {
                $imgData = array();
                $imgData['Image'] = $this->request->data[$model]['photo_upload'];
                $imgData['Image']['image'] = addslashes(file_get_contents($imgData['Image']['tmp_name']));
                $this->Image->create();
                $this->Image->save($imgData);

                $instance->hasAndBelongsToMany['Image']['unique'] = false;
                $saveData = array(
                    $model => array(
                        'id' => (int) $id,
                    ),
                    'Image' => array(
                        'id' => $this->Image->id,
                    ),
                );

                if ($instance->save($saveData)) {
                    $this->Session->setFlash(__('Images saved'));
                }
            } else {
                $this->Session->setFlash(__("Image couldn't be uploaded"));
            }
        }

        $this->data = $instanceData;
        $this->set('model', $model);
    }

    /**
     * view method
     *
     * @param string $id
     * @return void
     */
	public function view($id = null) 
    {
        $this->layout = null;
        $id = (int) $this->request->params['id'];
		$this->Image->id = $id;
		if (empty($id) || !$this->Image->exists()) {
            header("HTTP/1.0 404 Not Found");
            exit();
		}
		$this->set('image', $this->Image->read(null, $id));
	}

    /**
     * admin_index method
     *
     * @return void
     */
	public function admin_index() 
    {
		$this->Image->recursive = 0;
		$this->set('images', $this->paginate());
	}

    /**
     * admin_view method
     *
     * @param string $id
     * @return void
     */
	public function admin_view($id = null) 
    {
		$this->Image->id = $id;
		if (!$this->Image->exists()) {
			throw new NotFoundException(__('Invalid image'));
		}
		$this->set('image', $this->Image->read(null, $id));
	}

    /**
     * admin_add method
     *
     * @return void
     */
	public function admin_add() 
    {
		if ($this->request->is('post')) {
			$this->Image->create();
			if ($this->Image->save($this->request->data)) {
				$this->Session->setFlash(__('The image has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The image could not be saved. Please, try again.'));
			}
		}
	}

    /**
     * admin_edit method
     *
     * @param string $id
     * @return void
     */
	public function admin_edit($id = null) 
    {
		$this->Image->id = $id;
		if (!$this->Image->exists()) {
			throw new NotFoundException(__('Invalid image'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Image->save($this->request->data)) {
				$this->Session->setFlash(__('The image has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The image could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Image->read(null, $id);
		}
	}

    /**
     * admin_delete method
     *
     * @param string $id
     * @return void
     */
	public function admin_delete($id = null) 
    {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Image->id = $id;
		if (!$this->Image->exists()) {
			throw new NotFoundException(__('Invalid image'));
		}
		if ($this->Image->delete()) {
			$this->Session->setFlash(__('Image deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Image was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

}

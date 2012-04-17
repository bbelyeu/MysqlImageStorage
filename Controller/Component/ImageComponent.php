<?php
App::uses('Component', 'Controller');
App::uses('Image', 'MysqlImageStorage.Model');

class ImageComponent extends Component
{
    /**
     * Process the submitted form data to save the image
     *
     * @param array $data request data array submitted by form
     * @return int id of image saved or 0 if no image was submitted
     */
    public function process($data)
    {
        if (is_array($data['photo_upload']) && !empty($data['photo_upload'])) {
            $imgData = array();
            $imgData['Image'] = $data['photo_upload'];
            $imgData['Image']['image'] = addslashes(file_get_contents($imgData['Image']['tmp_name']));
            $Image = new Image();
            $Image->create();
            $Image->save($imgData);
            return $Image->id;
        } else {
            return 0;
        }
    }
}

<?php
/* /app/View/Helper/LinkHelper.php */
App::uses('AppHelper', 'View/Helper');

class ImageHelper extends AppHelper
{
    /**
     * Display a box with the images related to a model
     *
     * @param array $images
     * @param array $model
     * @param int $columns
     * @return string
     */
    public function displayBox($images, $model = null, $columns = 4)
    {
        $modelName = array_shift(array_keys($model));
        $primaryImageId = (int) $model[$modelName]['primary_image_id'];
        $modelId = (int) $model[$modelName]['id'];
        // validate data coming in is what we need it to be
        $columns = (int) $columns;
        if ($columns === 0) {
            throw new \Exception(
                "Can't display image box with a 0 column width!"
            );
        }
        // make sure the array is 0 based indexed
        $images = array_values($images);

        $html = '';
        $html .= sprintf('<div style="display:table; margin-bottom:10px;">');

        // how many rows do we need?
        $rowCount = ceil(count($images) / $columns);

        // loop over every row
        for ($row = 0; $row < $rowCount; $row++) {
            $html .= sprintf('<div style="display: table-row;">');
            // loop over every column in this row
            for ($col = 0; $col < $columns; $col++) {
                $index = ($row * $columns) + $col;
                if (!empty($images[$index])) {
                    $html .= '<img style="display:table-cell; height:80px; width:80px; ';
                    $html .= 'margin-bottom:10px; margin-right:10px; vertical-align:middle;';
                    if ($images[$index]['id'] == $primaryImageId) {
                        $html .= ' border:2px solid red;';
                    }
                    $html .= '" src="/images/'.(int)$images[$index]['id'].'" />';
                }
            }
            $html .= sprintf('</div>');
        }
        $html .= sprintf('</div>');
        $html .= "<div class='actions well'>
                    <ul class='nav nav-list'>
                        <li>
                            <a href='/admin/images/manage/$modelName/$modelId'>
                                <i class='icon-pencil'></i>Manage Images
                            </a>
                        </li>
                        <li>
                            <a href='/admin/images/upload/$modelName/$modelId'>
                                <i class='icon-plus'></i>Add Image
                            </a>
                        </li>
                    </ul>
                </div>";
        return $html;
    }
}

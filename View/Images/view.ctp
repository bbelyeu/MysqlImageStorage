<?php
header("Content-type: {$image['Image']['type']}");
echo stripslashes($image['Image']['image']);
exit();

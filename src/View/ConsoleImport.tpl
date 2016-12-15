Success! The following posts were inserted:

<?php
    foreach ($this->data["posts"] as $model) {
        echo $this->sanitizer->sanitize($model->getTitle()) . "\n";
    }
?>


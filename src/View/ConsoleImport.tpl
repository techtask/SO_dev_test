Success! The following posts were inserted:

<?php
    foreach ($this->data["models"] as $model) {
        echo $this->sanitizer->sanitize($model->getTitle()) . "\n";
    }
?>


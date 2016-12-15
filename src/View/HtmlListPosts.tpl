<!Doctype html>
<html>
<head>
    <title>Post Display</title>
</head>
<body>
    <div id="content">
        <table>
            <tr><th>Title</th><th>Author</th><th>Body</th><th>Created_At</th><th>Modified_At</th></tr>
            <?php foreach ($this->posts as $post): ?>
            <tr><td><?php echo $this->sanitizer->sanitize($post->title); ?></td><td><?php echo $this->sanitizer->sanitize($post->authorName); ?></td><td><?php echo $this->sanitizer->sanitize($post->body); ?></td><td><?php echo $this->sanitizer->sanitize($post->created_at); ?></td><td><?php echo $this->sanitizer->sanitize($post->modified_at); ?></td></tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>

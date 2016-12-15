<!Doctype html>
<html>
<head>
    <title>Post Display</title>
</head>
<body>
    <div id="content">
        <table>
            <tr><td>Id</td><td><?php echo $this->sanitizer->sanitize($this->post->id); ?></td></tr>
            <tr><td>Title</td><td><?php echo $this->sanitizer->sanitize($this->post->title) ?></td></tr>
            <tr><td>Body</td><td><?php echo $this->sanitizer->sanitize($this->post->body); ?></td></tr>
            <tr><td>Created_At</td><td><?php echo $this->sanitizer->sanitize($this->post->created_at); ?></td></tr>
            <tr><td>Modified_at</td><td><?php echo $this->sanitizer->sanitize($this->post->modified_at); ?></td></tr>
            <tr><td>Author</td><td><?php echo $this->sanitizer->sanitize($this->post->author); ?></td></tr>
        </table>
    </div>
</body>
</html>

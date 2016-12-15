<!Doctype html>
<html>
<head>
    <title>Post Display</title>
</head>
<body>
    <div id="content">
        <table>
            <tr><td>Title</td><td><?php echo $this->sanitizer->sanitize($this->models[0]->title;) ?></td></tr>
            <tr><td></td><td></td></tr>
            <tr><td></td><td></td></tr>
            <tr><td></td><td></td></tr>
            <tr><td></td><td></td></tr>
            <tr><td>Author</td><td><?php echo $this->sanitizer->sanitize($this->models[0]->author;) ?></td></tr>
        </table>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pertemuan 4 - Form Validation and File Upload</title>
</head>
<body>
    <form action="do-file-upload.php" method="post" enctype="multipart/form-data">
        <div>
            <label for="file">File to be Uploaded</label>
            <input type="file" name="file" id="file">
        </div>
        <div>
            <button type="submit">Upload</button>
        </div>
    </form>
</body>
</html>
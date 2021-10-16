<?php session_start(); ;?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>File Upload Form</title>
</head>
<body>

<h4>List of uploaded images</h4>
<?php foreach ($images as $item) : ?>
    <li>
        <img src="/upload/{$item}" alt="">
    </li>
<?php endforeach ?>
    <form action="process.php" method="post" enctype="multipart/form-data">
        <h2>Upload File</h2>
        <label for="fileSelect">Filename:</label>
        <input type="file" name="photo" id="fileSelect">
        <input type="submit" name="submit" value="Upload">
        <p><strong>Note:</strong> Only .jpg, .jpeg, .gif, .png formats allowed to a max size of 5 MB.</p>
    </form>
    <?php if(isset($_SESSION['error'])) : ?>
     <p style="color: red;"><?php echo $_SESSION['error'] ;?></p>
     <?php elseif (isset($_SESSION['success'])) : ?>
        <p style="color: green;"><?php echo $_SESSION['success'] ;?></p>
    <?php endif ?>
</body>
</html>

<?php session_destroy(); ;?>
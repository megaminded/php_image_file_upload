<?php
session_start();
$location = __DIR__."/upload/";
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if file was uploaded without errors
    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
        # Validating the file type
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES["photo"]["name"];
        $filetype = $_FILES["photo"]["type"];
        $filesize = $_FILES["photo"]["size"];

        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        if (array_key_exists($ext, $allowed)) {

            // Verify file size - 5MB maximum
            $maxsize = 5 * 1024 * 1024;
            if ($filesize > $maxsize) {
                $_SESSION['error'] = 'Error: File size is larger than the allowed limit.';
                header('location:form.php');
            } else {
                // Verify MIME type of the file
                if (in_array($filetype, $allowed)) {
                    // Check whether file exists before uploading it
                    if (file_exists($location . $filename)) {
                        $_SESSION['error'] = "$filename is already exists.";
                        header('location:form.php');
                    } else {
                         if (move_uploaded_file($_FILES["photo"]["tmp_name"], $location. $filename)) {
                             $_SESSION['success'] = "$filename was uploaded successfully.";
                             header('location:form.php');
                         } else {
                            $_SESSION['error'] = 'Error: Unable to upload file.';
                            header('location:form.php');
                         }
                         ;
                    }
                } else {
                    echo "Error: There was a problem uploading your file. Please try again.";
                }
            }
        } else {
            $_SESSION['error'] = 'Error: Please select a valid file format.';
            header('location:form.php');
        }
    } else {
        echo "Error: " . $_FILES["photo"]["error"];
    }
}

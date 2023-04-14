<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $scriptName = $_POST['script-name'];
    $scriptFile = $_FILES['script-file'];

    $targetDir = 'scripts/';
    $targetFile = $targetDir . basename($scriptFile['name']);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if script file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, the script file already exists.";
        $uploadOk = 0;
    }

    // Check file size (limit to 5MB)
    if ($scriptFile['size'] > 5000000) {
        echo "Sorry, the script file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file types
    if ($fileType != "lua") {
        echo "Sorry, only Lua scripts are allowed.";
        $uploadOk = 0;
    }

    // Upload file if everything is OK
    if ($uploadOk == 0) {
        echo "Sorry, your script file was not uploaded.";
    } else {
        if (move_uploaded_file($scriptFile['tmp_name'], $targetFile)) {
            echo "The script file " . htmlspecialchars(basename($scriptFile['name'])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your script file.";
        }
    }
}
?>

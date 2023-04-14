<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['script_file'])) {
    $target_dir = 'uploads/';
    $target_file = $target_dir . basename($_FILES['script_file']['name']);
    $upload_success = move_uploaded_file($_FILES['script_file']['tmp_name'], $target_file);

    if ($upload_success) {
        // File uploaded successfully
        // TODO: Save script information to database and redirect to script page
    } else {
        // File upload failed
        // TODO: Show error message to user
    }
}

?>
<?php
header('Location: again.php?id=' . $script_id);
exit();

<?php if (isset($upload_error)): ?>
    <p class="ERROR_404"><?php echo $upload_error; ?></p>
<?php endif; ?>


<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['script_file'])) {
    $target_dir = 'uploads/';
    $target_file = $target_dir . basename($_FILES['script_file']['name']);
    $upload_success = move_uploaded_file($_FILES['script_file']['tmp_name'], $target_file);

    if ($upload_success) {
        // File uploaded successfully
        // Save script information to database
        $conn = mysqli_connect('localhost', 'username', 'password', 'database_name');
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $author = mysqli_real_escape_string($conn, $_POST['author']);
        $file_path = mysqli_real_escape_string($conn, $target_file);
        $query = "INSERT INTO scripts (name, description, author, file_path) VALUES ('$name', '$description', '$author', '$file_path')";
        mysqli_query($conn, $query);
        mysqli_close($conn);

        // Redirect to script page
        $script_id = mysqli_insert_id($conn);
        header('Location: script.php?id=' . $script_id);
        exit();
    } else {
        // File upload failed
        $upload_error = 'File upload failed. Please try again.';
    }
}

?>

<?php

<?php

$conn = mysqli_connect('localhost60', 'axtech', '2580', 'axtech');
$query = "SELECT * FROM scripts ORDER BY id DESC";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $name = htmlspecialchars($row['name']);
        $description = htmlspecialchars($row['description']);
        $author = htmlspecialchars($row['author']);
        $file_path = $row['file_path'];
        $file_name = basename($file_path);
        $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
        
        echo '<div class="script">';
        echo '<h3><a href="script.php?id=' . $row['id'] . '">' . $name . '</a></h3>';
        echo '<p>' . $description . '</p>';
        echo '<ul>';
        echo '<li>Author: ' . $author . '</li>';
        echo '<li>File: <a href="' . $file_path . '">' . $file_name . '</a></li>';
        echo '</ul>';
        echo '</div>';
    }
} else {
    echo '<p>No scripts found.</p>';
}

mysqli_close




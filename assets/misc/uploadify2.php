<?php

/*
  Uploadify
  Copyright (c) 2012 Reactive Apps, Ronnie Garcia
  Released under the MIT License <http://www.opensource.org/licenses/mit-license.php>
 */

// Define a destination
$targetFolder = './live-pms/uploads'; // Relative to the root

if (!empty($_FILES)) {
    $tempFile = $_FILES['Filedata']['tmp_name'];
    $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;

    // Validate the file type
    $fileTypes = array('jpg', 'jpeg', 'gif', 'png'); // File extensions
    $fileParts = pathinfo($_FILES['Filedata']['name']);

    if (in_array($fileParts['extension'], $fileTypes)) {
        $str_name = md5('chanopalis');
        $targetFile = rtrim($targetPath, '/') . '/' . $str_name .'.'. $fileParts['extension'];
        
        move_uploaded_file($tempFile, $targetFile);
        echo $str_name . $fileParts['extension'];
    } else {
        echo FALSE;
    }
}
?>

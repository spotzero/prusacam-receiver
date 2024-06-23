<HTML>
<BODY>
<?php

// Foreach directory in the files directory, inside that directory, get the image with the biggest name.
// Then display the image.


$dirs = scandir('files');
foreach ($dirs as $dir) {
    if ($dir === '.' || $dir === '..') {
        continue;
    }
    $files = scandir('files/' . $dir);
    $max = 0;
    $maxFile = '';
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') {
            continue;
        }
        $name = explode('.', $file)[0];
        if ($name > $max) {
            $max = $name;
            $maxFile = $file;
        }
    }
    if ($maxFile !== '') {
        echo '<img src="files/' . $dir . '/' . $maxFile . '">';
    }
}

?>
</BODY>
</HTML>
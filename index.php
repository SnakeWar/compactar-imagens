<?php
if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    $file_name[] = $_FILES["image_file"]["name"];
    $file_type[] = $_FILES["image_file"]["type"];
    $temp_name[] = $_FILES["image_file"]["tmp_name"];
    $file_size[] = $_FILES["image_file"]["size"];
    $error[] = $_FILES["image_file"]["error"];

    if (!$temp_name)
    {
        echo "ERROR: Please browse for file before uploading";
        exit();
    }
    function compress_image($source_url, $destination_url, $quality)
    {
        $info = getimagesize($source_url);
        if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source_url);
        elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source_url);
        elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source_url);
        imagejpeg($image, $destination_url, $quality);
        echo "Image uploaded successfully.<br>";
    }
    $file_name = $file_name[0];
    foreach ($file_name as $key => $file_nam) {

    if ($error[0][$key] > 0)
    {
        echo $error[0][$key] . "<br>";
    }
    else if (($file_type[0][$key] == "image/gif") || ($file_type[0][$key] == "image/jpeg") || ($file_type[0][$key] == "image/png") || ($file_type[0][$key] == "image/pjpeg"))
    {

            $filename = compress_image($temp_name[0][$key], "uploads/" . $file_nam, 50);

    }
    else
    {
        echo "A imagem deve ser jpg ou gif ou png.";
    }
    }
} ?>
<!DOCTYPE html>
<html>

<head>
    <title>Como comprimir uma imagem sem perder qualidade em PHP</title>
</head>

<body>
    <form action='' method='POST' enctype='multipart/form-data'>
        <input name="image_file[]" type="file" multiple accept="image/*">
        <button type="submit">Enviar</button>
    </form>
</body>

</html>
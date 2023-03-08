<?php

function asset($fileName)
{
$file = dirname(__FILE__,3) . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . $fileName;
if (file_exists($file)): return URL.'public/'.$fileName;endif;
}
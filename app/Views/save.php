<?php
if (!headers_sent($file, $line))
{
header("Location: /");
exit;
// Trigger an error here
}
else
{
echo "Headers sent in $file on line $line";
exit;
}
?>
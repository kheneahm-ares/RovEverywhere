<?php
$fileName = 121212121;
exec('cgi-bin/takePic.cgi "'. ($fileName). '" &> /dev/null &');

<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
include ('includes/session.inc');
session_destroy();
header('Location: index.html');
exit;
?> 
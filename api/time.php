<?php

include (__DIR__ . '/../CommonFunctions/HttpVerifications.php');

checkHttpMethod(['GET']);

echo date('d.m.Y H:i:s');

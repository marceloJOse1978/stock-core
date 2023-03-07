<?php
$outp=[];
exec("git config --global --add safe.directory C:/core-stock/resources/app/stock-core",$outp);
print_r($outp);
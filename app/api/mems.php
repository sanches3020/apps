<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/php/db.php';

/*$result = selectSql("
select *, (select count() from likes) from mems t1
");*/

$result = select(mems, []);

/*row()

scalar()*/


success($result);

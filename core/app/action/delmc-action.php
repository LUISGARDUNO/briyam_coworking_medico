<?php

$mc = MedicCategoryData::getByMC($_GET["medic_id"], $_GET["cat_id"]);

$mc->del();
Core::redir("./?view=editmedic&id=".$_GET["medic_id"]);
?>
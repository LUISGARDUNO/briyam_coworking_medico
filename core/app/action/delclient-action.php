<?php

$client = PersonData::getById($_GET["id"]);
$client->del();
Core::redir("./index.php?view=list&id=$client->list_id");

?>
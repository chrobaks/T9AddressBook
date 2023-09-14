<?php $View = $View ?? []; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Telefonbuch / T9Api</title>
    <style>
        h4 {margin:15px 0 0 15px;}
        table, div {margin: 15px;}
        td {vertical-align: top;padding: 0 30px;border: 1px solid #ccc;}
        table.table-list td {padding: 0 30px;border-left: 0;border-right: 0;}
        table.table-list tr:hover {color: #27114d;background-color: #ccc;}
    </style>
</head>
<body>
<?php include_once("form_address_book.tpl.php");?>
<?php include_once("message.tpl.php");?>
<?php include_once("address_book.tpl.php");?>
</body>
</html>

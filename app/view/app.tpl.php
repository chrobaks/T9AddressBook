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
        table.table-list tr:hover,
        div.keyboard-key:hover{color: #27114d;background-color: #ccc;}
        div.keyboard-wrapper {display: flex;flex-wrap: wrap;width: 160px;height: 160px;padding:0;}
        div.keyboard-key {cursor: pointer;width: 50px;height: 50px;margin: 0 1px 1px 0;border:1px solid #ccc;text-align: center; line-height: 1.3em;}
    </style>
</head>
<body>
<?php include_once("form_address_book.tpl.php");?>
<?php include_once("message.tpl.php");?>
<?php include_once("address_book.tpl.php");?>
<script>
    /**
     * Initialize click event on phone key items
     * -----------------------------------------
     * @type {NodeListOf<Element>}
     */
    const PhoneKeys = document.querySelectorAll('div.keyboard-key');
    // Add click event listener for phone key items
    [...PhoneKeys].map(key => {
        key.addEventListener('click', () => {
            const number = key?.dataset?.number;
            if (number) {document.getElementById('phone_number').value += number;}
        });
    });
</script>
</body>
</html>

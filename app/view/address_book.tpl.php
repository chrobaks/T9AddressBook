<?php $View = $View ?? []; ?>

<?php if(is_array($View["addressBook"]) && !empty($View["addressBook"])):?>
    <h4>Adressbuch</h4>
    <table class="table-list">
        <thead>
        <tr><th>Vorname</th><th>Familienname</th><th>Telefonnummer</th></tr>
        </thead>
        <tbody>
        <?php foreach($View["addressBook"] as $row):?>
            <tr><td><?=$row["first_name"];?></td><td><?=$row["second_name"];?></td><td><?=$row["phone"];?></td></tr>
        <?php endforeach;?>
        </tbody>
    </table>
<?php endif;?>

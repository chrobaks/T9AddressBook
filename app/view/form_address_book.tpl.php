<?php $View = $View ?? []; ?>
<table>
    <thead><tr><th>Neuer Eintrag</th><th>T9Api</th></tr></thead>
    <tbody>
    <tr>
        <td>
            <form method="post" action="index.php">
                <input type="hidden" value="addAddressBook" name="form_action">
                <p>
                    <b>Vorname</b> <small>(nur Buchstaben und Bindestrich ohne Leerzeichen)</small><br>
                    <input type="text" value="" name="first_name" placeholder="Vorname">
                </p>
                <p>
                    <b>Familienname</b> <small>(nur Buchstaben und Bindestrich ohne Leerzeichen)</small><br>
                    <input type="text" value="" name="second_name" placeholder="Familienname">
                </p>
                <p>
                    <b>Telefonnummer</b> <small>(nur Zahlen ohne Leerzeichen)</small><br>
                    <input type="number" value="" name="phone">
                </p>
                <p><button type="submit">Daten speichern</button></p>
            </form>
        </td>
        <td>
            <form method="post" action="index.php">
                <p>
                    <input type="hidden" value="getAddress" name="form_action">
                    <b>Telefonnummer</b> <small>(nur Zahlen (2-9) ohne Leerzeichen)</small><br>
                    <input type="number" value="" name="phone">
                </p>
                <p><button type="submit">Teilnehmer suchen</button></p>
            </form>
            <?php if(isset ($View["searchResult"]) && count($View["searchResult"]) > 0):?>
                <table class="table-list">
                    <thead>
                    <tr><th>Vorname</th><th>Familienname</th><th>Telefonnummer</th></tr>
                    </thead>
                    <tbody>
                    <?php foreach($View["searchResult"] as $row):?>
                        <tr>
                            <td><?=$row["first_name"];?></td>
                            <td><?=$row["second_name"];?></td>
                            <td><?=$row["phone"];?></td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            <?php else:?>
                <div>Keine Ergebnisse gefunden!</div>
            <?php endif;?>
        </td>
    </tr>
    </tbody>
</table>

<?php $View = $View ?? []; ?>
<table>
    <thead><tr><th>Neuer Eintrag</th><th>T9Api</th></tr></thead>
    <tbody>
    <tr>
        <td>
            <form method="post" action="index.php?addAddressBook">
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
            <?php if(isset ($View["numberLetterConfig"]) && count($View["numberLetterConfig"]) > 0):?>
            <div class="keyboard-wrapper">
                <div class="keyboard-key"></div>
                <?php foreach($View["numberLetterConfig"] as $number => $letter):?>
                <div class="keyboard-key" data-number="<?=$number;?>" data-letter="<?=$letter;?>"><?=$letter;?><br><?=$number;?></div>
                <?php endforeach;?>
            </div>
            <?php endif;?>
            <form method="post" action="index.php?getAddress">
                <p>
                    <b>Telefonnummer</b> <small>(nur Zahlen (2-9) ohne Leerzeichen)</small><br>
                    <input type="number" value="" name="phone" id="phone_number">
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

<?php
$appConfig = [
    "form" => [
        "columnsExpr" => [
            "addressBook" => [
                "first_name" => "#^[a-zA-ZäöüÄÖÜß \-]{2,30}$#",
                "second_name" => "#^[a-zA-ZäöüÄÖÜß \-]{2,30}$#",
                "phone" => "#^[\d]{3,16}$#",
            ],
            "phone" =>  "#^[2-9]{3,16}$#",
        ],
        "columnErrors" => [
            "first_name" => "Keinen gültigen Eintrag für gefunden für: Vorname.",
            "second_name" => "Keinen gültigen Eintrag für gefunden für: Nachname.",
            "phone" => "Keinen gültigen Eintrag für gefunden für: Telefonnummer.",
        ]
    ],
    "query" => [
        "insert" => [
            "address_book" => "INSERT INTO address_book ([%COLUMNS%]) VALUES (?,?,?)"
        ],
        "select" => [
            "address_book_select" => "SELECT DISTINCT * FROM address_book WHERE first_name LIKE '[%FIRSTNAME%]%' OR second_name LIKE '[%SECONDNAME%]%' ORDER BY first_name",
            "address_book" => "SELECT DISTINCT * FROM address_book ORDER BY first_name, second_name"
        ]
    ]
];

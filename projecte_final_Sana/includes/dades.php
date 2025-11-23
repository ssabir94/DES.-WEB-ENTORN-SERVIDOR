<?php
/*
 * En aquest fitxer defineixo els arrays que simulen una petita base de dades d'usuaris i de productes per a gats.
 */

// Array d'usuaris d’exemple.
$usuaris = [
    [
        "nom"   => "Sana Sabir",
        "email" => "sana@gatificat.cat",
        "tipus" => "administrador"
    ],
    [
        "nom"   => "Carlos Vacas",
        "email" => "admin@gatificat.cat",
        "tipus" => "administrador"
    ],
    [
        "nom"   => "Jennifer Lopez",
        "email" => "jlo@gmail.com",
        "tipus" => "client_premium"
    ],
    [
        "nom"   => "Peppa Pig",
        "email" => "peppapig@gmail.com",
        "tipus" => "client"
    ]
];

/*
 * Ara defineixo un catàleg de productes pensats per a gats.
 * Organitzo els productes en categories: alimentació, accesoris, higiene i joguines.
 * Cada producte té nom, categoria, tipus, preu, descripció i si està disponible o no.
 */
$productes = [
    // Menjar sec
    [
        "nom"        => "Pinso premium pollastre",
        "categoria"  => "Alimentació",
        "tipus"      => "Sec",
        "preu"       => 18.50,
        "descripcio" => "Pinso complet per a gats adults amb gust de pollastre.",
        "disponible" => true
    ],
    [
        "nom"        => "Pinso light esterilitzat",
        "categoria"  => "Alimentació",
        "tipus"      => "Sec",
        "preu"       => 21.90,
        "descripcio" => "Recepta reduïda en calories pensada per a gats esterilitzats.",
        "disponible" => true
    ],

    // Menjar humit
    [
        "nom"        => "Llauna salmó gourmet",
        "categoria"  => "Alimentació",
        "tipus"      => "Humit",
        "preu"       => 1.35,
        "descripcio" => "Llauna de salmó amb textura suau i alt contingut en aigua.",
        "disponible" => true
    ],
    [
        "nom"        => "Sobre pollastre i arròs",
        "categoria"  => "Alimentació",
        "tipus"      => "Humit",
        "preu"       => 0.95,
        "descripcio" => "Sachet de pollastre amb arròs per a gats exigents.",
        "disponible" => false   // marco algun producte com a no disponible per poder provar condicions després
    ],

    // Accesoris
    [
        "nom"        => "Rascador torre gran",
        "categoria"  => "Accesoris",
        "tipus"      => "Gran",
        "preu"       => 79.99,
        "descripcio" => "Torre amb diverses plataformes i zones de descans.",
        "disponible" => true
    ],
    [
        "nom"        => "Rascador base simple",
        "categoria"  => "Accesoris",
        "tipus"      => "Petit",
        "preu"       => 24.50,
        "descripcio" => "Base de rascador compacta per a espais reduïts.",
        "disponible" => true
    ],

    // Higiene
    [
        "nom"        => "Sorra aglomerant perfumada",
        "categoria"  => "Higiene",
        "tipus"      => "Sorra",
        "preu"       => 9.80,
        "descripcio" => "Sorra aglomerant amb una lleugera olor fresca.",
        "disponible" => true
    ],
    [
        "nom"        => "Recollidor sorra amb pala",
        "categoria"  => "Higiene",
        "tipus"      => "Recollidor",
        "preu"       => 6.20,
        "descripcio" => "Kit amb pala i recollidor per netejar la sorra.",
        "disponible" => true
    ],
    [
        "nom"        => "Xampú suau per a gats",
        "categoria"  => "Higiene",
        "tipus"      => "Xampú",
        "preu"       => 7.90,
        "descripcio" => "Xampú especialment formulat per al pH de la pell del gat.",
        "disponible" => false
    ],

    // Joguines
    [
        "nom"        => "Ratolí de roba amb catnip",
        "categoria"  => "Joguina",
        "tipus"      => "Ratolí",
        "preu"       => 3.50,
        "descripcio" => "Ratolí de tela amb catnip per estimular el joc.",
        "disponible" => true
    ],
    [
        "nom"        => "Canya amb plomes",
        "categoria"  => "Joguina",
        "tipus"      => "Canya",
        "preu"       => 5.75,
        "descripcio" => "Canya amb plomes per jugar amb el gat i fomentar l'exercici.",
        "disponible" => true
    ]
];
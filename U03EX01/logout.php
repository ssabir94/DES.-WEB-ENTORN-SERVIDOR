<?php
//Per dir a PHP quina sessió tancar, sino pot donar error.
session_start();
//"Desestablir".Buidem totes les variables de sessió!!
session_unset();
//Aquest nom és molt dramàtic, però ara toca "destruir" la sessió.
session_destroy();

//I ara una cosa molt important: redirigir a la pàgina d'inici, sino em quedo penjada :')
header("Location: index.php");
exit();
?>
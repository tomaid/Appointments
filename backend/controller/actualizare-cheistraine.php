<?php
require_once '../config/constants.php';
require_once '../service/chei-straineServ.php';
$date = json_decode(file_get_contents('php://input'), true);
session_start();
if((isset($_SESSION['user'])) && (!empty($_SESSION['user']))&& ($_SESSION['acces']==3)){
empty($date['mdl_baza_de_date']) ? die(http_response_code(406)):$bd = $date['mdl_baza_de_date'];
empty($date['mdl_coloana']) ? die(http_response_code(406)):$col = $date['mdl_coloana'];
empty($date['mdl_tabela']) ? die(http_response_code(406)):$tab = $date['mdl_tabela'];
empty($date['mdl_tabela_referinta']) ? die(http_response_code(406)):$tab_referinta = $date['mdl_tabela_referinta'];
empty($date['mdl_coloana_referinta']) ? die(http_response_code(406)):$col_referinta = $date['mdl_coloana_referinta'];
empty($date['mdl_nume_constrangere']) ? die(http_response_code(406)):$constrangere = $date['mdl_nume_constrangere'];
    $cheiStraine = new CheiStraineService();
    $cheiStraine->actualizareCheiStraine($bd,$col,$tab, $tab_referinta, $col_referinta, $constrangere);

}
else {
    echo "interzis";
    return http_response_code(406);
}
?>
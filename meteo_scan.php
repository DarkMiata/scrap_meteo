<?php

/**
 * Description of meteo_scan
 *
 * @author DarkMiata
 */
// ------------------------
require_once 'lib/darkmiata_lib.php';
require_once 'lib/simple_html_dom.php';
require_once 'class/conditions_meteo.php';
// ------------------------


set_time_limit(0);  // temps d éxécution du script php infini
// retire le buffer de la sortie console ?
ob_start(null, 2);

// Boucle principale du script
//while (true) {
//echo ("hello world !!\n");
//scan_meteo('Lille');
//
//sleep (10);
//}

scan_meteo('Lille');

$conditionsMeteo = new conditions_meteo();

// ========================================
// ========================================
// génére l'url de la page La chaine météo en fonction de la ville demandé

function generateUrl($ville) {
  switch ($ville) {
    case 'Lille':
      $numVille = '2948';
      break;

    default:
      $numVille = '';
      break;
  }

  if ($numVille == '') {
    $url = "";
  }
  else {
    $url = 'http://lille.lachainemeteo.com/meteo-france/ville/previsions-meteo-'
        . $ville . '-' . $numVille . '-0.php';
  }

  return $url;
}
// ------------------------
// scan la ville demandé

function scan_meteo($ville) {
  $url = generateUrl($ville);

  if ($url != null) {
    scrap_meteo($url);
  }
  else {
    echo ("Ville inconnue\n");
  }
}

// ------------------------

function scrap_meteo ($url) {

  $html = file_get_html($url);

  // récupération du bloc html de la prévision jour
  $blockPrevisionJourHtml = $html->find('div[id=prevision_entite]')[0];

  // cible le bloc de la date
  $blockJourPrevision = $blockPrevisionJourHtml->find('div[class=date_prevision]')[0];

  $jour = $blockJourPrevision->find('div')[1]->plaintext;
  $mois = $blockJourPrevision->find('div')[2]->plaintext;

  //echo("jour: ".$jour."  - mois: ".$mois);

  $blockPrevisQuartJour[0] = $blockPrevisionJourHtml->find('div[id=previs_quart_jour_0]')[0];
  $blockPrevisQuartJour[1] = $blockPrevisionJourHtml->find('div[id=previs_quart_jour_1]')[0];
  $blockPrevisQuartJour[2] = $blockPrevisionJourHtml->find('div[id=previs_quart_jour_2]')[0];


}

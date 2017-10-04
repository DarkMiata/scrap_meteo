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

function scrap_meteo($url) {

  global $blockPrevisionJourHtml;

  $html = file_get_html($url);

  // récupération du bloc html de la prévision jour
  $blockPrevisionJourHtml = $html->find('div[id=prevision_entite]')[0];

  // cible le bloc de la date
  $blockJourPrevision = $blockPrevisionJourHtml->find('div[class=date_prevision]')[0];

  $jour = $blockJourPrevision->find('div')[1]->plaintext;
  $mois = $blockJourPrevision->find('div')[2]->plaintext;

  echo("jour: " . $jour . "  - mois: " . $mois . " \n");

  // cible les blocs des prévision 'quart jour'
  for ($index = 0; $index < 3; $index++) {

    $blockPrevisQuartJour   = scrapBlockPrevisQuartJour($index);
    $nomQuartJour[$index]   = scrapNomQuartJour($blockPrevisQuartJour);

  }
}

// ------------------------
// récupère le nom des prévision 'quart jour'

function scrapNomQuartJour($blockHtml) {

  $nomQuartJour = $blockHtml->find('div[class=nom_quart_jour]')[0]->plaintext;

  echo "quart jour: ". $nomQuartJour . "\n";

  return $nomQuartJour;
}
// ------------------------

function scrapBlockPrevisQuartJour ($index) {

    global $blockPrevisionJourHtml;

    $blockPrevisQuartJour = $blockPrevisionJourHtml
            ->find('div[id=previs_quart_jour_' . $index . ']')[0];

    return $blockPrevisQuartJour;
}
// ------------------------



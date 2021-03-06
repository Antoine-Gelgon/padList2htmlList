  <?php

  include ('./head.php');

  //récupérer le contenu du pad
  $padUrl = 'https://lite6.framapad.org/p/JcA306Aere';
  $datas = file_get_contents($padUrl.'/export/html');

  // Récupérer les catégories
  // grandes catégories
  preg_match_all("/\<code style=\"font-family: monospace\"\>(.*?)\<\/code>/", $datas, $bigCats);
  preg_match_all("/====(.*?)====/", $datas, $bigCatsNb);
  preg_match_all("/%%%%%%%%%%(.*?)%%%%%%%%%%/", $datas, $contents);

  // menu
  echo '<div class="menuHome">';
    // Texte d'accueil
    echo '<h1>Ce site est né d\'une initiative commune visant à rassembler des ressources afin de créer des dynamiques de diffusion et de transmission de savoirs axés sur les alternatives historiques et contemporaines.</h1><br/>';
    echo '<h1><a href="index.php">Ressources</a>&thinsp;: </h1>';

    // afficher toutes les catégories
    echo '<ul class="bigCat">';
      echo '<li class="cat current"><a href="result.php?go=all&sub=all">vue globale</span></li>';
      foreach($bigCats as $i => $bigCats){
        if ($i == 0) continue;
        foreach($bigCats as $i => $bigCat){
          $cap = array('É', 'À', 'È', 'Ç', 'Ù', 'Ô');
          $low = array('é', 'à', 'è', 'ç', 'ù', 'ô');
          $bigCat = str_replace($cap, $low, $bigCat);
          $bigCat = preg_replace("/\((.*?)\)/", "", $bigCat);
          echo '<li class="other cat'.$i.'"><a href="result.php?go='.$i.'&sub=all">'.strtolower($bigCat).'</a></li>';
          echo '<ul class="sousCat">';
            foreach ($contents as $j => $content){
              if ($j == 0) continue;
              foreach ($content as $k => $datas){
                if ($k == $i){
                  preg_match_all("/--------------------<\/li><li><strong>(.*?)<\/strong>/", $datas, $smallCats);
                  foreach ($smallCats as $l => $smallCats){
                    if ($l == 0) continue;
                    foreach ($smallCats as $m => $smallCat){
                      $cap = array('É', '&#201;', '&#233;', 'À', '&#192;', '&#194;', 'È', '&#200;', '&#202;', 'Ç', 'Ù', 'Ô', '&#212;');
                      $low = array('é', 'é', 'é',           'à', 'à',      'â',      'è', 'è',      'ê',      'ç', 'ù', 'ô', 'ô');
                      $smallCat = str_replace($cap, $low, $smallCat);
                      $smallCat = preg_replace("/\((.*?)\)/", "", $smallCat);
                      echo '<li class="other cat'.$i.'"><a href="result.php?go='.$i.'&sub='.$m.'">'.strtolower($smallCat).'</a></li>';
                    }
                  }
                }
              }
            }
          echo '</ul>';
        }
      }
    echo '</ul>';
    // sous-catégories
    /*

    preg_match_all("/--------------------<\/li><li><strong>(.*?)<\/strong>/", $datas, $smallCats);
    preg_match_all("/==(.*?)==/", $datas, $smallCatsNb);

    echo '<ul class="smallCat">';
      echo '<li class="sousCat current"><span>vue globale</span></li>';
      foreach($smallCats as $i => $smallCats){
        if ($i == 0) continue;
        foreach($smallCats as $i => $smallCat){
          $cap = array('É', '&#201;', '&#233;', 'À', '&#192;', '&#194;', 'È', '&#200;', '&#202;', 'Ç', 'Ù', 'Ô', '&#212;');
          $low = array('é', 'é', 'é',           'à', 'à',      'â',      'è', 'è',      'ê',      'ç', 'ù', 'ô', 'ô');
          $smallCat = str_replace($cap, $low, $smallCat);
          $smallCat = preg_replace("/\((.*?)\)/", "", $smallCat);
          echo '<li class="other sousCat'.$i.'"><span>'.strtolower($smallCat).'</span></li>';
        }
      }
    echo '</ul>';
    */

    echo '<a class="pourquoi" href="about.php">&thinsp;?</a>';
  echo '</div>';
  echo '<div class="content">';
  echo '</div>';

include ('./footer.php');

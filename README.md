La connection à la database se fait par l'intermédiare de la commande :
      $base = mysqli_connect ('localhost', 'root', '')
    présente en haut du fichier fonctions.php et requetes.php.

Nous avons rencontré un bug que nous n'avons pas eu le tps de régler lors du projet dans la partie requete:
    => Il faut lancer au préalable une autre requête que la une avant de pouvoir cliquer sur le bouton de la première requete.

Attention :
    Dans la partie de lecture de tables, il faut raffraichir la page après chaque appel de fonction.

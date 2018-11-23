<?php
  include("template/header.php")
 ?>
<?php if (!isset($_GET['start']) && !isset($_GET['id'])) {
     ?>
 <form action="index.php?start=loading" method="post">
  <label for="name">Nom de votre personnage:</label>
  <input id="name" type="text" name="name">
  <input type="submit" value="Envoyer">
 </form>
<?php
 } ?>

 <?php if (isset($_GET['start'])) {
     if ($_GET['start'] == 'true') {
         ?>
          <a href="index.php">Déconnexion</a>

         <?php foreach ($lastUser as $perso) {
             ?>
             <h1 class="text-center sizeh1">Votre Personnage</h1>
             <div class="row col-6 mx-auto m-0 pt-2 allborders">
              <p class="mr-1">Pseudo: <?php echo $perso->getNames(); ?></p>
              <p>Dégats: <?php echo $perso->getDamage(); ?></p>
             </div>
         <?php
         } ?>
         
         <h2 class="text-center sizeh1 mt-5">Vos Adversaires</h2>
         <?php foreach ($users as $perso) {
             ?>
             <div class="row col-6 mx-auto m-0 pt-2 allborders">
              <p>Pseudo:</p><a class="mr-1" href="index.php?id=<?php echo $perso->getId(); ?>"><?php echo $perso->getNames(); ?></a>
              <p>Dégats: <?php echo $perso->getDamage(); ?></p>
             </div>
         <?php
         }
     }
 } ?> 

 <?php
   include("template/footer.php")
  ?>

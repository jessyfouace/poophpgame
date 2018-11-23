<?php
require "../model/Database.php";

$bdd = Database::BDD();

function loadClass($class, $bdd)
{
    require '../' . $class . '.php';
}

spl_autoload_register('loadClass');

loadClass('entities/Personnages', $bdd);
loadClass('model/PersonnageManager', $bdd);

$manager = new PersonnageManager($bdd);

if (isset($_GET['start']) && !empty($_POST['name'])) {
    if ($_GET['start'] == 'loading') {
        $perso = new Personnage([
            'names' => $_POST['name'],
            'damage' => 0
            ]);
        $manager->addPersonnage($perso);
        header('Location: index.php?start=true');
    }
}
    
    if (isset($_GET["start"])) {
        if ($_GET['start'] == 'true') {
            $users = $manager->getPersonnages();
            $lastUser = $manager->getLastPersonnage();
        }
    }

    if (isset($_GET["id"])) {
        $takeUser = $manager->getPersonnageById($_GET['id']);
        $takeUser->takeDamage();
        if ($takeUser->getDamage() < 100) {
            $updateUser = $manager->update($takeUser);
            header('location: index.php?start=true');
        }
        if ($takeUser->getDamage() >= 100) {
            $deleteUser = $manager->deletePersonnage($takeUser);
            header('location: index.php?start=true');
        }
    }

    require "../views/indexVue.php";

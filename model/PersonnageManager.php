<?php
class PersonnageManager
{
    private $_bdd;

    public function __construct(PDO $bdd)
    {
        $this->setDb($bdd);
    }

    /**
     * Add new personnage
     *
     * @param Personnage $perso
     * @return self
     */
    public function addPersonnage(Personnage $perso)
    {
        $addBdd = $this->_bdd->prepare('INSERT INTO personages(names, damage) VALUES(:names, :damage)');
        $addBdd->bindValue(':names', $perso->getNames(), PDO::PARAM_STR);
        $addBdd->bindValue(':damage', $perso->getDamage(), PDO::PARAM_INT);
        $addBdd->execute();
    }

    /**
     * delete personnage by id
     *
     * @param Personnage $perso
     * @return self
     */
    public function deletePersonnage(Personnage $perso)
    {
        $this->_bdd->exec('DELETE FROM personages WHERE id = '.$perso->getId());
    }

    /**
     * get one personnage by id
     *
     * @param integer $id
     * @return self
     */
    public function getPersonnageById(int $id)
    {
        $perso;

        $takeBdd = $this->_bdd->prepare('SELECT * FROM personages WHERE id = :id');
        $takeBdd->bindValue(':id', $id, PDO::PARAM_INT);
        $takeBdd->execute();

        $takeAllBdd = $takeBdd->fetchAll();
        foreach ($takeAllBdd as $personnages) {
            $perso = new Personnage($personnages);
        }

        return $perso;
    }

    /**
     * get all personnages without the last one
     *
     * @return self
     */
    public function getPersonnages()
    {
        $persos = [];

        $takeBdd = $this->_bdd->prepare('SELECT * FROM personages ORDER BY id DESC LIMIT 1, 99999999');
        $takeBdd->execute();
        $takeAllBdd = $takeBdd->fetchAll();
        foreach ($takeAllBdd as $personnages) {
            $persos[] = new Personnage($personnages);
        }

        return $persos;
    }

    /**
     * get last personnage
     *
     * @return self
     */
    public function getLastPersonnage()
    {
        $perso = [];

        $takeBdd = $this->_bdd->prepare('SELECT * FROM personages ORDER BY id DESC LIMIT 1');
        $takeBdd->execute();
        $takeAllBdd = $takeBdd->fetchAll();
        foreach ($takeAllBdd as $personnages) {
            $perso[] = new Personnage($personnages);
        }

        return $perso;
    }

    /**
     * update object by id
     *
     * @param Personnage $perso
     * @return self
     */
    public function update(Personnage $perso)
    {
        $updateBdd = $this->_bdd->prepare('UPDATE personages SET damage = :damage WHERE id = :id');
        $updateBdd->bindValue(':id', $perso->getId(), PDO::PARAM_STR);
        $updateBdd->bindValue(':damage', $perso->getDamage(), PDO::PARAM_STR);
        $updateBdd->execute();
    }

    /**
     * set the bdd
     *
     * @param PDO $bdd
     * @return self
     */
    public function setDb(PDO $bdd)
    {
        $this->_bdd = $bdd;
    }
}

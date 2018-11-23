<?php
class Personnage
{
    private $_id;
    private $_names;
    private $_damage;

    public function __construct($personnage = [])
    {
        $this->hydrate($personnage);
    }

    public function hydrate($personnage)
    {
        foreach ($personnage as $key => $value) {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }


    /**
     * make damage of object and set him
     *
     * @return self
     */
    public function takeDamage()
    {
        $lifeCible = $this->getDamage();
        $lifeCible = $lifeCible + 5;
        $this->setDamage($lifeCible);
    }

    /**
     * Take the id of object
     *
     * @return self
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * set the id of object
     *
     * @param [type] $_id
     * @return self
     */
    public function setId(int $id)
    {
        $this->_id = $id;

        return $this;
    }

    /**
     * Take the name of object
     *
     * @return self
     */
    public function getNames()
    {
        return $this->_names;
    }

    /**
     * Set the name of object
     *
     * @param [type] $_names
     * @return self
     */
    public function setNames(string $names)
    {
        $this->_names = $names;

        return $this;
    }

    /**
     * get the damage of object
     *
     * @return self
     */
    public function getDamage()
    {
        return $this->_damage;
    }

    /**
     * set the damage of object
     *
     * @param [type] $_damage
     * @return self
     */
    public function setDamage(int $damage)
    {
        $this->_damage = $damage;

        return $this;
    }
}

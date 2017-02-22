<?php
    class Cuisine
    {
        private $cuisine;
        private $id;

        function __construct($cuisine, $id = null)
        {
            $this->cuisine = $cuisine;
            $this->id = $id;
        }

        function setCuisine($cuisine)
        {
            $this->cuisine = $cuisine;
        }

        function getId()
        {
            return $this->id;
        }

        function getCuisine()
        {
            return $this->cuisine;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO cuisine_type(cuisine_type) VALUES ('{$this->getCuisine()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }
        static function getAll()
        {
            $returned_cuisines = $GLOBALS['DB']->query("SELECT * FROM cuisine_type;");
            $cuisines = array();
            foreach ($returned_cuisines as $cuisine) {
                $type = $cuisine['cuisine_type'];
                $id = $cuisine['id'];
                $new_cuisine = new Cuisine($type, $id);
                array_push($cuisines, $new_cuisine);
            }
            return $cuisines;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec(" DELETE FROM cuisine_type;");
        }

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE cuisine_type SET cuisine_type '{$this->getCuisine()}' WHERE id = {$this->getId()};");
            $this->setCuisine($new_name);
        }


    }
?>

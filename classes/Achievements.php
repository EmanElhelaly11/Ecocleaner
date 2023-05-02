<?php

//----------Singleton Design Pattern-------------

class Achievements {
    private static $instance = null;
    private $count;
    
    private function __construct() {
        $this->count = $this->countAchievements();
    }
    
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Achievements();
        }
        return self::$instance;
    }
    
    public function getCount() {
        return $this->count;
    }
    
    private function countAchievements($achievements) {
        return count($achievements);
    }
}
?>

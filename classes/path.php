<?php

//création de la classe path pour faire les chemins absolus 
class path {

    //déclaration de la variable $absolutePath (static appartient à la classe et non a l'instance de la classe)
    private static $absolutePath = null;

    //décaration des constantes
    const CLASSES = 'classes/';
    const CONTROLLERS = 'controllers/';
    const MODELS = 'models/';

    /**
     * Méthode permettant de décomposer le chemin
     * @return type
     */
    public static function getAbsolutePath() {
        if (is_null(self::$absolutePath)) {
            self::$absolutePath = explode(self::CLASSES, __FILE__)[0];
        }
        return self::$absolutePath;
    }

    /**
     * 
     * @return type
     */
    public static function getClassesPath() {
        return self::getAbsolutePath() . self::CLASSES;
    }

    /**
     * 
     * @return type
     */
    public static function getControllersPath() {
        return self::getAbsolutePath() . self::CONTROLLERS;
    }

    /**
     * 
     * @return type
     */
    public static function getModelsPath() {
        return self::getAbsolutePath() . self::MODELS;
    }

    /**
     * Méthode des chemins à côté de index
     * @return type
     */
    public static function getRootPath() {
        return self::getAbsolutePath();
    }

}

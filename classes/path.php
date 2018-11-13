<?php

//création de la classe path pour faire les chemins absolus 
class path {

    //déclaration de la variable $absolutePath (static appartient à la classe et non à l'instance de la classe)
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
     * Méthode permettant d'avoir le chemin absolu vers le dossier classes
     * @return type
     */
    public static function getClassesPath() {
        return self::getAbsolutePath() . self::CLASSES;
    }

    /**
     * Méthode permettant d'avoir le chemin absolu vers le dossier controllers
     * @return type
     */
    public static function getControllersPath() {
        return self::getAbsolutePath() . self::CONTROLLERS;
    }

    /**
     * Méthode permettant d'avoir le chemin absolu vers le dossier models
     * @return type
     */
    public static function getModelsPath() {
        return self::getAbsolutePath() . self::MODELS;
    }

    /**
     * Méthode permettant d'avoir le chemin absolu au niveau de la racine du projet
     * @return type
     */
    public static function getRootPath() {
        return self::getAbsolutePath();
    }

}

<?php
const HASHING_COST_VALUE= 12; //Pour le hashing des mots de passe
const MAX_SIZE_IMAGE= 1; //Taille maximale de l'image
const CHEMIN_PHOTO_PROFIL= "Content/img/user/"; //dossier de stockage des images de profils
const CHEMIN_PIECE_JOINTE= "Content/img/PiecesJointes/"; //dossier de stockage des images de profils
const DEFAULT_PP= "pp.jpg"; //nom de l'image de profil par défaut
const PASSWORD_REGEX_CONSTITUTION = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$^+-=!*()@%&]).{8,}$/';
const PHONENUMBER_REGEX_CONSTITUTION = '/^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$/';
const CLIENT_PROFILE_LABEL = 'CLIENT';
const CLIENT_PROFILE_CODE = 2;
const ADMIN_PROFILE_LABEL = 'ADMINISTRATEUR';
const ADMIN_PROFILE_CODE = 1;
const IMG_MAX_WIDTH = 4000;
const IMG_MAX_HEIGHT=  2000;
const PIECE_JOINTE_PRINCIPALE = 1;
const PIECE_JOINTE_ADDITIONNELLE = 2;
const STATUT_VALIDE = 1;
const STATUT_NON_VALIDE = 0;
const STATUT_BLOQUE = -1;
const POUCENTAGE_TAXE = 0.1925;
const PAYPAL_ID = 6;

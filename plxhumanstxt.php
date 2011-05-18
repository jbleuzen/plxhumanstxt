<?php

    class plxhumanstxt extends plxPlugin {

        public function __construct($default_lang) {

            # appel du constructeur de la classe plxPlugin (obligatoire)
            parent::__construct($default_lang);

            # limite l'acces l'ecran d'administration du plugin
            $this->setConfigProfil(PROFIL_ADMIN);

			# Déclarations du hook dans le head
			$this->addHook('ThemeEndHead', 'jb_write_humans_meta');
        }
        
        public  function jb_write_humans_meta(){
        	echo '<link type="text/plain" rel="author" href="http://'.$_SERVER['SERVER_NAME'].'/humans.txt" />';
        }

    }

?>

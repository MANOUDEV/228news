import { createStore } from "vuex";

//Importation des modules gérant les données contenu dans l'entête de page

import politiqueModule from './modules/frontoffice/header/politique'

import afriqueModule from './modules/frontoffice/header/afrique' 

import societeModule from './modules/frontoffice/header/societe' 

import sportsModule from './modules/frontoffice/header/sports' 

import chroniquesModule from './modules/frontoffice/header/chroniques' 

//Importation des modules gérant les données contenu dans le pied de page

import newsletterModule from './modules/frontoffice/footer/newsletter'
 
import categoryPopularsModule from './modules/frontoffice/footer/categoryPopulars'

import tagsPopularsModule from './modules/frontoffice/footer/tagsPopulars'
 
//Importation du module gérant les données des publications sur la page d'accueil

import sectionsPublicationsHomePageModule from './modules/frontoffice/sectionsPublicationsHomePage/sectionsPublicationsHomePage'
 
//Le fonctionnalités pour l'authentification

import loginModule from './modules/auth/login';

import meProfileModule from './modules/auth/meProfile';

import logoutModule from './modules/auth/logout';

import registerModule from './modules/auth/register';

import forgot_passwordModule from './modules/auth/forgot_password';

//Sécurité pour les pages d'administration

import roleModule from './modules/backoffice/role'


//Importation du module gérant les données d'envoi de messages

import contactModule from "./modules/frontoffice/includes/contact"

  
const store = createStore({
    modules:{

        //Déclaration des modules gérant les données contenu dans l'entête de page

        politique: politiqueModule,
        afrique: afriqueModule,
        societe: societeModule,
        sports: sportsModule,
        chroniques: chroniquesModule,
       
        //Déclaration des modules gérant les données contenu dans le pied de page

        newsletter: newsletterModule, 
        categoryPopulars: categoryPopularsModule,
        tagsPopulars: tagsPopularsModule,

        //Déclaration des modules gérant les données du système d'authenitification
        
        login: loginModule,
        logout:logoutModule,
        meProfile: meProfileModule,
        forgot_password: forgot_passwordModule,
        register: registerModule,

        //Déclaration du module gérant les données des publications sur la page d'accueil
        
        sectionsPublicationsHomePage: sectionsPublicationsHomePageModule,

        //Déclaration des modules gérant les données du système de la securité su site

        roleSecurity: roleModule,
        
        //Déclaration du module gérant les données d'envoi des messages

        contact: contactModule,

    }
  });

  export default store;

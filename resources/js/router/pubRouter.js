import { createRouter, createWebHistory } from 'vue-router';

//Importation du composant du tableau de bord des publicateurs d'articles

import DashboardPub from '../components/backoffice/publicateur/pages/DashboardComponent.vue'; 

import ProfilePub from '../components/backoffice/publicateur/pages/profile/ProfileComponent.vue';

//Importation du composant de gestion des tags des publicateurs

import TagsPub from '../components/backoffice/publicateur/pages/tags/TagsComponent.vue';

//Importation du composant de gestion des auteurs des publicateurs

import AuthorPub from '../components/backoffice/publicateur/pages/authors/AuthorComponent.vue';

import AuthorCreatePub from '../components/backoffice/publicateur/pages/authors/CreateAuthorComponent.vue';

import AuthorUpdatePub from '../components/backoffice/publicateur/pages/authors/UpdateAuthorComponent.vue';

 
const routes =[

  //Routes pour les fonctionnalités de l'interface de l'publicateurs

  //Tableau de bord

  {path:'/pub/dashboard',component: DashboardPub, name: 'pub.dashboard' ,meta: { requiredAuth: true }},

  //Gestion du profil

  {path:'/pub/profile',component: ProfilePub, name: 'pub.profile' ,meta: { requiredAuth: true }},
  
  //Gestion des tags

  {path:'/pub/tags',component: TagsPub, name: 'pub.tags' ,meta: { requiredAuth: true }},

  //Gestion des auteurs

  {path:'/pub/authors',component: AuthorPub, name: 'pub.authors' ,meta: { requiredAuth: true }},

  {path:'/pub/authors/create',component: AuthorCreatePub, name: 'pub.authors.create' ,meta: { requiredAuth: true }},

  {path:'/pub/authors/:slug/update',component: AuthorUpdatePub, name: 'pub.authors.update' ,meta: { requiredAuth: true }},

 
];
 
export const routeConfig = createRouter({
  history: createWebHistory(),
  routes: routes
});

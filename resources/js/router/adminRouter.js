import { createRouter, createWebHistory } from 'vue-router';

//Importation du composant du tableau de bord de l'administrateur

import DashboardAdmin from '../components/backoffice/administrateur/pages/DashboardComponent.vue';

//Importation du composant du tableau de bord de l'administrateur

import ProfileAdmin from '../components/backoffice/administrateur/pages/profile/ProfileComponent.vue';

//Importation du composant de gestion des catégories de l'administrateur

import CategoryAdmin from '../components/backoffice/administrateur/pages/category/CategoryComponent.vue';

//Importation du composant de gestion des publications de l'administrateur

import PublicationCreateAdmin from '../components/backoffice/administrateur/pages/publications/CreatePublicationComponent.vue';
 
import PublicationCreateBySlugType  from '../components/backoffice/administrateur/pages/publications/PublicationCreateBySlugTypeComponent.vue';
 
//Importation du composant de gestion des tags des publicateurs

import TagsAdmin from '../components/backoffice/administrateur/pages/tags/TagsComponent.vue';
  
//Importation du composant de gestion des newsletters de l'administrateur

import NewsLetterAdmin from '../components/backoffice/administrateur/pages/newsLetter/newsLetterComponent.vue';


//Importation du composant de gestion des auteurs des de l'administrateur

import AuthorAdmin from '../components/backoffice/administrateur/pages/authors/AuthorComponent.vue';

import AuthorCreateAdmin from '../components/backoffice/administrateur/pages/authors/CreateAuthorComponent.vue';

import AuthorUpdateAdmin from '../components/backoffice/administrateur/pages/authors/UpdateAuthorComponent.vue';

 
const routes =[

  //Routes pour les fonctionnalités de l'interface de l'administrateur

  //Tableau de bord

  {path:'/admin/dashboard',component: DashboardAdmin, name: 'admin.dashboard' ,meta: { requiredAuth: true }},

   //Gestion du profil

   {path:'/admin/profile',component: ProfileAdmin, name: 'admin.profile' ,meta: { requiredAuth: true }},
    
  //Gestion des catégories

  {path:'/admin/category',component: CategoryAdmin, name: 'admin.category' ,meta: { requiredAuth: true }},

  //Gestion des publications

  {path:'/admin/publications/create',component: PublicationCreateAdmin, name: 'admin.publications.create' ,meta: { requiredAuth: true }},
  
  {path:'/admin/publications/create/:slug/type_publications',component: PublicationCreateBySlugType , name: 'admin.publications.create.type_publication' ,meta: { requiredAuth: true }},
 
 
  //Gestion des tags

  {path:'/admin/tags',component: TagsAdmin, name: 'admin.tags' ,meta: { requiredAuth: true }},

  // Gestion des newsletters

  {path:'/admin/newsletters',component: NewsLetterAdmin, name: 'admin.newsletters' ,meta: { requiredAuth: true }},
 
  //Gestion des auteurs

  {path:'/admin/authors',component: AuthorAdmin, name: 'admin.authors' ,meta: { requiredAuth: true }},

  {path:'/admin/authors/create',component: AuthorCreateAdmin, name: 'admin.authors.create' ,meta: { requiredAuth: true }},

  {path:'/admin/authors/:slug/update',component: AuthorUpdateAdmin, name: 'admin.authors.update' ,meta: { requiredAuth: true }},

];

export const routeConfig = createRouter({
  history: createWebHistory(),
  routes: routes
});

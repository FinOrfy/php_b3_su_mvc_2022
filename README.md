* REMILI Rédouane
* COBLENTZ Robin
* SALVI Coline
* KRIFAH Amel

# php_b3_su_mvc_2022
# Développement d’un système CRUD

👀🎨 **Il y a aussi une branch "form_connexion" où se trouve un travailler sur un formulaire de connexion.**

Dans le dossier /src on crée une Class UserForm qui va permettre de construire 
et générer dynamiquement des champs pour créer un formulaire qui nous permettra d’ajouter et d’éditer les utilisateurs. 
De plus ça permet d’éviter de devoir les créer à chaque fois dans le template Twig.

---
Ensuite on améliore le fichier UserController.php dans le but d’obtenir des méthodes CRUD à l’aide de UserForm.php => on ajoute dans un premier temps :
````use App\Form\UserForm;````
Qui va nous permettre d'utiliser notre nouvelle Classe UserForm

* ✔	On créer les methode getUser en se connectant à l’EntityManager qui va nous permettre de récupérer un utilisateur si il existe déjà et d’envoyer le rendu visuel des informations sur le template /profil_user.html.twig

* ✔	Ensuite on créer la fonction editUser ou addUser (en cours) toujours connecter à la base de donnée grâce à l’EntityManager puis on instancier le formulaire de UserForm.php et générer les différents champs dynamiquement dans le visuel du template /edit_user.html.twig. On fait persister les modification et on les envois dans à base de donnée avec la methode flush()

* ✔	Pour l’ajout d’utilisateurs on créer la method addUser, on définit une route (pour le moment : /users), cette methode va ajouter un nouvel utilisateur à la class Use. Pour cela on génère les différents champs du formulaire grâce à notre class FormUser et comme pour la method de modification, on persist et flush() les données. Puis on renvoie vers le rendu dans le template /list.html.twig  

* ✔	Enfin la methode removeUsers définit par la route /users/delete/ va trouver l’utilisateur et simplement lancé la function remove() définit dans Doctrine. Pas besoins de faire persister les données et on flush(). La methode finit par nous renvoyé vers la liste des users avec le template /list.html.twig

---
On a donc La classe FormUser et les différentes methode CRUD dans userController.php qui nous retourne un rendu Twig.
Il faut donc terminer par la création de ces rendus visuel en créant les différent fichier Twig dans le dossier templates/user

Il y a base.html.twig il s’agit du fichier qu’on va pouvoir réutiliser dans toutes les autres pages facilement grâce à une fonction Twig :
````{% extends "base.html.twig" %}````
Il faut rajouter cette function en début de chaque template twig si l'on veut récupérer le visuel de base.html.twig

On créer donc les différent fichier twig où nous renvoie les methode CRUD de UserController.php :
* ✔	edit_user.html.twig
* ✔	list.html.twig (qui existait déjà)
* ✔	profil_user.html.twig

---
## Fonctionnement des Routes

On cherche à débloquer la route de la method getUser : Il s’agit de récupérer un User particulier à l’aide de son id.
Dans le fichier Routing/Routeur.php on retrouve en premier lieu la method splitUrlUri on dit que cette methode renvoie un tableau qu’on nomme ````tab_rout[]````. Cela permet de récupérer l’id de l’itilisateur qui est en 3ème position dans l’url. Le tableau contiendra la class user et l’id grâce à la variable $arrayUri qui à l’index 2 contient l’id de l’utilisateur.
![splitUrlUri](/docs/splitUrlUri.png)

Puis dans la methode getRoute on fait un print_r($this->routes) afin de voir toutes les routes enregistrer
Et on remplace $route['url'] par ['name'] pour que dans la route de la method getUser je puisse remplacer 'user' par 'show_user' parce que ça ne marche pas avec route comme localhost/user/1 mais cela fonctionne avec localhost/show_user/1.

Dans la methode execute() on créer la variable ````$paramRoute = $this->splitUrlUri($uri);```` qui recupere l'url de la function splitUrlUri() et on instancie getRoute() qui va permettre de recuperer dans l'url les users grâce à la variable $paramRoute qu'on vient de créer.
![execute](/docs/execute.png)

Pour récupere l'id de l'utilisateur on ajoute un 3ème parametre à la methode getMethodParams

````$params = $this->getMethodParams($controllerName, $method, $paramRoute["id"]);````

En dernier lieu il faut donc adapter la method getMethodParams() afin que celle çi puisse si il le faut récupérer un utilisateur unique à l'aide de son id :
On donne donc le 3ème paramètre à la method (id) qu'on définit bien par default comme pouvant être NULL afin que si on ne cherche pas d'user précis, on puisse par la suite avoir tous les users.
On définit donc la condition que si $id existe alors $params["id"] sera la valeurs du 3ème parametre id.

`````
if ($id) {
      $params["id"] = $id;
    }
`````

=> On retourne dans UserController.php et on rajoute à la method getUser le 3ème paramettre $id qu'on définit pour la bonne pratique comme un entier.
La method getUser retourne le template /profil_user.html.twig, on met bien le 'name' de la route dans l'url (localhost/show_user/1) et on retrouve bien notre 1 users présent dans notre BDD :
![bdd](/docs/bdd.png)
![user1](/docs/user1.png)



---
PS :
Les améliorations n’ont pas commencé sur la dernier version du projet à jours dans GitHub.
La génération du formulaire n’est pas tout à fait finalisée. Et seul la route de la method getUser est fontionnel pour l'instant 👍


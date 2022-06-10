* REMILI Rédouane
* COBLENTZ Robin
* KRIFAH Amel
* SALVI Coline

# php_b3_su_mvc_2022
# Développement d’un système CRUD

Dans le dossier /src On crée une Class UserForm qui va permettre de construire et générer dynamiquement des champs pour créer un formulaire qui nous permettra d’ajouter et d’éditer les utilisateurs. 
De plus ça permet d’éviter de devoir les créer à chaque fois dans le template Twig.

---
Ensuite on améliore le fichier UserController.php dans le but d’obtenir des méthodes CRUD à l’aide de UserForm.php => on ajoute dans un premier temps :
````use App\Form\UserForm;````
Qui va nous permettre d'utiliser notre nouvelle Classe UserForm

* -	On créer les methode getUser en se connectant à l’EntityManager qui va nous permettre de récupérer un utilisateur si il existe déjà et d’envoyer le rendu visuel des informations sur le template /profil_user.html.twig
* -	Ensuite on créer la fonction editUser ou addUser (en cours) toujours connecter à la base de donnée grâce à l’EntityManager puis on instancier le formulaire de UserForm.php et générer les différents champs dynamiquement dans le visuel du template /edit_user.html.twig. On fait persister les modification et on les envois dans à base de donnée avec la methode flush()
* -	Pour l’ajout d’utilisateurs on créer la method addUser, on définit une route (pour le moment : /users), cette methode va ajouter un nouvel utilisateur à la class Use. Pour cela on génère les différents champs du formulaire grâce à notre class FormUser et comme pour la method de modification, on persist et flush() les données. Puis on renvoie vers le rendu dans le template /list.html.twig
* -	Enfin la methode removeUsers définit par la route /users/delete/ va trouver l’utilisateur et simplement lancé la function remove() définit dans Doctrine. Pas besoins de faire persister les données et on flush(). La methode finit par nous renvoyé vers la liste des users avec le template /list.html.twig

---
On a donc La classe FormUser et les différentes methode CRUD dans userController.php qui nous retourne un rendu Twig.
Il faut donc terminer par la création de ces rendus visuel en créant les différent fichier Twig dans le dossier templates/user

On trouve le fichier base.html.twig, il s’agit du fichier qu’on va pouvoir réutiliser dans toutes les autres pages facilement grâce à une fonction Twig :
````{% extends "base.html.twig" %}````
Il faut rajouter cette fonction Twig en début de chaque template twig si l'on veut le visuel de base.html.twig

On créer donc les différent fichier twig où nous renvoie les methode CRUD de UserController.php :
* -	edit_user.html.twig
* -	list.html.twig (qui existait déjà)
* -	profil_user.html.twig

---
PS :
Je crois qu’on n’a pas commencé les améliorations sur le dernier projet à jours dans GitHub.
La génération du formulaire n’est pas tout à fait finalisée. Le projet est envoyé tel quel mais un autre entièrement terminer et fonctionnel sera envoyé demain matin 👍
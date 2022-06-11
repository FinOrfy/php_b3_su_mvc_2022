<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserForm;
use Doctrine\ORM\EntityManager;

use App\Routing\Attribute\Route;

use App\Routing\RouteNotFoundException;

class UserController extends AbstractController
{
  #[Route(path: "/users", name: "users_list")]
  public function list(EntityManager $em)
  {
    // Création liste users
    // Ne pas utiliser l'entity manager
    // Créer à l'aide d'une boucle un nombre X d'utilisateurs avec des données fakes
    // Transmettre ensuite ces utilisateurs à la vue
    

    // $repository = $em->getRepository(User::class);

    $users = $em->findAll();

    echo $this->twig->render('user/list.html.twig', ['users' => $users]);
  }


  #[Route(path: "/users/edit/:id", name: "edit_user", httpMethod: "GET")]
  public function editUser(EntityManager $em)
  {
   // $repository = $em->getRepository(User::class);   
  
    $user = $em->find($id);

    if (!$user) {

        $e = new RouteNotFoundException();
        throw $e->message;
    } 

    $arrayOptions = [
                   array('nomElementForm'=>'input','typeElementForm'=>'name', 'nomElementForm'=>'name'),
    ];
    
    $objectContentForm = new UserForm($arrayOptions);

    $contentString = $objectContentForm->getContentForm();


    echo $this->twig->render('user/edit_user.html.twig', ['contentString' => $contentString]);
  }

  #[Route(path: "/users/edit/:id", name: "update_user", httpMethod: "POST")]
  public function updateUser(EntityManager $em)
  {
   // $repository = $em->getRepository(User::class);   
    $id = $_POST["id"];
    $user = $em->find($id);

    if (!$user) {

        $e = new RouteNotFoundException();
        throw $e->message;
    }
    
    if(isset($_POST["name"]) && !empty($_POST["name"])){

      $user->setName($_POST["name"]);
    }

    if(isset($_POST["firstName"]) && !empty($_POST["firstName"])){

      $user->setFirstName($_POST["firstName"]);
    }

    if(isset($_POST["username"]) && !empty($_POST["username"])){

      $user->setUsername($_POST["username"]);
    }

    if(isset($_POST["password"]) && !empty($_POST["password"])){

      $user->setPassword($_POST["password"]);
    }

    if(isset($_POST["email"]) && !empty($_POST["email"])){

      $user->setEmail($_POST["email"]);
    }

    if(isset($_POST["birthDate"]) && !empty($_POST["birthDate"])){

      $user->setBirthDate($_POST["birthDate"]);
    }

    $em->persist($user);
    $em->flush();


    echo $this->twig->render('user/profil_user.html.twig', ['user' => $user]);
  }

   #[Route(path: "/users", name: "add_user", httpMethod: "POST")]
  public function addUser(EntityManager $em)
  {
   // $repository = $em->getRepository(User::class);   
  
    $user = new User();
  
    
    if(isset($_POST["name"]) && !empty($_POST["name"])){

      $user->setName($_POST["name"]);
    }

    if(isset($_POST["firstName"]) && !empty($_POST["firstName"])){

      $user->setFirstName($_POST["firstName"]);
    }

    if(isset($_POST["username"]) && !empty($_POST["username"])){

      $user->setUsername($_POST["username"]);
    }

    if(isset($_POST["password"]) && !empty($_POST["password"])){

      $user->setPassword($_POST["password"]);
    }

    if(isset($_POST["email"]) && !empty($_POST["email"])){

      $user->setEmail($_POST["email"]);
    }

    if(isset($_POST["birthDate"]) && !empty($_POST["birthDate"])){

      $user->setBirthDate($_POST["birthDate"]);
    }

    $em->persist($user);
    
    $em->flush();

    $users = $em->findAll();

    echo $this->twig->render('user/list.html.twig', ['users' => $users]);

  }

  #[Route(path: "/users/:id", name: "show_user", httpMethod: "GET")]
  public function getUser(EntityManager $em, int $id)
  {
    $repository = $em->getRepository(User::class);   
  
    //$id = 1;
    $user = $repository->find($id);

    if (!$user) {

        $e = new RouteNotFoundException();
        throw $e->message;
    }   

    //var_dump($user);
    echo $this->twig->render('user/profil_user.html.twig', ['user' => $user]);
    
  }

  #[Route(path: "/users/delete/:id", name: "delete_user", httpMethod: "GET")]
  public function removeUser(EntityManager $em, int $id)
  {
   //  $repository = $em->getRepository(User::class);   
  
    $user = $em->find($id);

    if (!$user) {

        $e = new RouteNotFoundException();
        throw $e->message;
    } 
    
    $em->remove($user);
    $em->flush();

    $users = $em->findAll();

    echo $this->twig->render('user/list.html.twig', ['users' => $users]);

  }
}

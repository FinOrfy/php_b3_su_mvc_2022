<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserForm;
use Doctrine\ORM\EntityManager;

use App\Routing\Attribute\Route;

use App\Routing\RouteNotFoundException;
use DateTime;


class UserController extends AbstractController
{

  #[Route(path: "/users", name: "users_list", httpMethod: "GET")]
  public function list(EntityManager $em)
  {
    // Création liste users
    // Ne pas utiliser l'entity manager
    // Créer à l'aide d'une boucle un nombre X d'utilisateurs avec des données fakes
    // Transmettre ensuite ces utilisateurs à la vue
    
    $user = $em
    ->getRepository(User::class)
    ->findAll();

    if (!$user) {

      $e = new RouteNotFoundException();
      throw $e->message;
  }   

    //var_dump($users);
    echo $this->twig->render('user/list.html.twig', ['user' => $user]);  }

  /*
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
  */
  #[Route(path: "/users", name: "add_user", httpMethod: "GET")]
  public function addUser(EntityManager $em)
  {
  
    $user = new User();

    $user->setName("Bob")
    ->setFirstName("John")
    ->setUsername("Bobby")
    ->setPassword("randompass")
    ->setEmail("bob@bob.com")
    ->setBirthDate(new DateTime('1981-02-16'));
    /*
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
    */
    $em->persist($user);
    $em->flush();

    //$users = $em->findAll();

    //echo $this->twig->render('user/list.html.twig', ['users' => $users]);

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

  #[Route(path: "/users/:id", name: "delete_user", httpMethod: "GET")]
  public function removeUser(EntityManager $em, int $id)
  {
    $repository = $em->getRepository(User::class);   
  
    $user = $repository->find($id);

    if (!$user) {

        $e = new RouteNotFoundException();
        throw $e->message;
    } 
    
    $em->remove($user);
    $em->flush();
    echo"<script language=\"javascript\">";
    echo"alert('effacer avec succes')";
    echo"</script>";
  }
}

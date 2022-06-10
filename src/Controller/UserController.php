<?php

namespace App\Controller;

use App\Routing\Attribute\Route;
use App\Session\SessionInterface;
use Doctrine\ORM\EntityManager;

class UserController extends AbstractController
{
  #[Route(path: "/users", name: "users_list")]
  public function list(SessionInterface $session)
  {
    $users = [];

    echo $this->twig->render(
      'user/list.html.twig',
      [
        'users' => $users,
        'filter' => $session->get('filter', 'none')
      ]
    );
  }

  #[Route(path: "/user/edit/{id}", name: "user_edit")]
  public function edit(EntityManager $em, int $id)
  {
    var_dump($id);
  }
}

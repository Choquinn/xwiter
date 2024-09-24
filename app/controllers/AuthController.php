<?php

namespace App\Controllers;

use Core\Controller;
use Core\Database;

class AuthController extends Controller
{
  public function login()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $email = $_POST['email'];
      $password = $_POST['password'];

      if ($email === 'admin@example.com' && $password === '123456') {
        echo "Login realizado com sucesso!";
      } else {
        echo "Email ou senha incorretos!";
      }
    }

    $this->view('auth/login');
  }

  public function register()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $name = $_POST['name'];
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST['password'];

      $db = Database::connect();
      $stm = $db->prepare("INSERT INTO users (name, username, email, password) VALUES(:name, :username, :email, :password)");
      $stm->bindParam(":name", $name);
      $stm->bindParam(":username", $username);
      $stm->bindParam(":email", $email);
      $stm->bindParam(":password", $password);
      if($stm->execute()){
        $this->redirect('/login');
      }else{
        echo "erro";
      }
    }
    $this->view('auth/register');
  }
}
<?php

$linuxDistros = [
  "Debian",
  "Slackware",
  "RHEL",
  "Suse",
  "Ubuntu",
  "Fedora",
  "OpenSuse"
];

class SelecionaDistroLinux
{
  private $name;
  private $value;

  public function setName($name)
  {
     $this->name = $name;
  }

  public function getName()
  {
     return $this->name;
  }

  public function setValue($value)
  {
     if (!is_array($value)) {
        die ("Erro: não é um array.");
     }
     $this->value = $value;
   }

  public function getValue()
  {
     return $this->value;
  }

  private function makeOptions($value)
  {
     foreach($value as $v) {
        echo "<option value=\"" . $v . "\">" .ucfirst($v). "</option>\n";
      }
  }

  public function makeSelect()
  {
     echo "<select name=\"" .$this->getName(). "\">\n";
     $this->makeOptions($this->getValue());
     echo "</select>" ;
  }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
        <!-- Google Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
        <!-- Bootstrap core CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
        <!-- Material Design Bootstrap -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
      <title>Cadastro de usuário - Vigilantes de Distros</title>
   </head>
   <body>
      <?php if (!isset($_POST['submit'])) : ?>
      <form class="border border-light p-5" method="post" action="index.php">
         <p class="h4 mb-4 text-center">Cadastro de usuário - Vigilantes de Distros</p>
         <p class="h5 mb-4 text-center">Formulário</p>
         <input name="name" type="text" class="form-control mb-4" placeholder="Nome">
         <input name="email" type="text" class="form-control mb-4" placeholder="E-mail">
         <input name="username" type="text" class="form-control mb-4" placeholder="Nome de usuário">
         <p>Distribuição GNU/Linux:
            <?php
               $distro = new SelecionaDistroLinux();
               $distro->setName('distro');
               $distro->setValue($linuxDistros);
               $distro->makeSelect();
            ?>
         </p>
         <button type="submit" name="submit" class="btn btn-info btn-block my-4">Registrar</button>
      </form>
      <?php else :
            $name = $_POST['name'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $selDistro = $_POST['distro'];
            echo "<p class=\"text-center font-weight-bold\">".$name.", seu cadastro foi realizado com sucesso!</p>";
            echo "<p class=\"text-center font-weight-bold\">Abaixo os dados cadastrados:</p>";
            echo "<p class=\"text-center\">Nome de usuário: ".$username."</p>";
            echo "<p class=\"text-center\">E-mail: ".$email."</p>";
            echo "<p class=\"text-center\">Distribuição GNU/Linux: ".$selDistro."</p>";
      endif; ?>
   </body>
</html>
<?php
class UserController extends BaseController {

    
     public function test1 (){
        $repository = new MainRepository("app_user");
        $repository->with("Customer");
        $user = $repository->getOne(1);
        $this->entities =['user'=> $user];
        $this->render();
     }

     public function test2 (){
      $repository = new MainRepository("customer");
      $repository->with("User");
      $customer = $repository->getOne(1);
      $this->entities =['customer'=> $customer];
      $this->render();
     }
    
     public function test3 (){
      $repository = new MainRepository("app_user");
      $repository->with("Customer");
      $users = $repository->getAll();
      $this->entities =['users'=> $users];
      $this->render();
      }
      public function test4 (){
         $repository = new MainRepository("customer");
         $repository->with("User");
         $customers = $repository->getAll();
         $this->entities =['customers'=> $customers];
         $this->render();
      }

      
    private static $prefix = '$argon2id$v=19$m=1024,t=2,p=2$';
    
    private static $options = [
        'memory_cost' => 1024,
        'time_cost'   => 2,
        'threads'     => 2,
    ];

    public function login()
    {    
      $errors = [];
      $posted = [];
      if (isset($_SESSION['post'])){
          $posted = $_SESSION['post'];
          unset($_SESSION['post']);
          $repository = new MainRepository('app_user');
          $errors = $repository->validate($posted);
          if (count($errors) == 0) {
              $users = $repository->getAll("login = '".$posted['login'] ."'");
              if(count($users) == 1){
                  $user = array_pop($users);
                  if(password_verify($posted['password'], self::$prefix . $user->password)){
                      unset($user->login);
                      unset($user->password);
                      $repo = new MainRepository('customer');
                      $customer = $repo->getOne($user->customer_id);
                      $user->customer = $customer;
                      $_SESSION['logged'] = serialize($user);
                      header('Location: /home');
                      die;
                  }
              }
          }
          $errors['bad'] = true; 
      }
      $this->entities = [ 'errors' => $errors, 
                          'posted' => $posted ];
      $this->render();
  }

  public function logout()
  {
   unset($_SESSION['logged']);
   header('Location: /user/login');
   die;
  }

  public function commands()
  {
    if(!isset($_SESSION['logged']))
      {
          header('Location: /user/login');
         die;
      }
      $logged = unserialize($_SESSION['logged']);
      $customer_id = $logged->customer_id;
      $repository = new MainRepository('command');
      $repository->with('Lines', ['Product']);
      $commands = $repository->getAll("customer_id = " . $customer_id);

      $this->entities = ['commands' => $commands];

      $this->render();
   }


}
?>
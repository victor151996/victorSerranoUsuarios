<?php 

use Firebase\JWT\JWT;

class Controller_Users extends Controller_Rest
{

    public function post_create()
    {   
            if ( ! isset($_POST['name']) || !isset($_POST['pasword']) ) 
            {
                $json = $this->response(array(
                    'code' => 400,
                    'message' => 'parametro incorrecto, se necesita que el parametro se llame name'
                ));

                return $json;
            }

            $input = $_POST;
            $user = new Model_Users();
            $user->nombre = $input['name'];
              $user->contraseña = $input['pasword'];
            $user->save();

            $json = $this->response(array(
                'code' => 200,
                'message' => 'usuario creado',
                'nombre' => $input['name'],
                'contraseña' => $input['pasword']
            ));

            return $json;



        

        
    }


    public function get_users()
    {
        $users = Model_Users::find('all');

        return $this->response(Arr::reindex($users));
    }

 public function get_login()
    {

            if ( ! isset($_GET['name']) || ! isset($_GET['pasword']) ) 
            {
                $json = $this->response(array(
                    'code' => 400,
                    'message' => 'parametro incorrecto, falta algun parametro'
                ));
                return $json;
            }

            $input = $_GET;
           
            $usuario = Model_Users::find('first', array(
                'where' => array(
                    array('nombre',$_GET['name']),
                    array('contraseña',$_GET['pasword']),
                    ),
                ));

            if ($usuario != null)
            {

                $time = time();
                $key = 'my_secret_key';

                $token = array(
                    'iat' => $time, // Tiempo que inició el token
                    'exp' => $time + (60*60), // Tiempo que expirará el token (+1 hora)
                    'data' => [ // información del usuario
                    'username' => $_GET["name"],
                    'pasword' => $_GET["pasword"]
                    ]
                );
                $jwt = JWT::encode($token, $key);

                $json = $this->response(array(
                            'code' => 200,
                            'message' => 'usuario logueado', 
                            'data'=> ['token'=>$jwt]
                        ));

                return $json;
            }
            else
            {

                $json = $this->response(array(
                'code' => 400,
                'message' => 'el login es incorrecto',
                'data' => ''
                    ));

                return $json;
            }

            


        //$time = time();
        //$key = 'my_secret_key';

//        $token = array(
  //      'iat' => $time, // Tiempo que inició el token
    //    'exp' => $time + (60*60), // Tiempo que expirará el token (+1 hora)
      //  'data' => [ // información del usuario
        //    'username' => $_GET["su_nombre"],
          //  'pasword' => $_GET["su_contraseña"]
        //]
//);

$jwt = JWT::encode($token, $kuy);
    }
    public function post_delete()
    {
        $user = Model_Users::find($_POST['id']);
        $userName = $user->nombre;
        $user->delete();

        $json = $this->response(array(
            'code' => 200,
            'message' => 'usuario borrado',
            'nombre' => $userName
        ));

        return $json;
    }
}
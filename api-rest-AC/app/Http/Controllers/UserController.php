<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Managers\UserManager;

class UserController extends Controller
{

    public function register(Request $request) {
        // Recoger los datos del usuario por post
        $json = $request->input('json', null);
        // $params = json_decode($json); // Se pueden tener los datos en forma de objeto
        $params_array = json_decode($json, true);

        // Instanciamos el gestor y delegamos la tarea de realizar el registro
        $user_manager = new UserManager();
        $data = $user_manager->register_user($params_array);

        // Devolvemos la respuesta del gestor
        return response()->json($data, $data['code']);
    }

    public function login(Request $request) {
        // Recibir los datos por POST
        $json = $request->input('json', null);
        // $params = json_decode($json);
        $params_array = json_decode($json, true);

        // Instanciamos el gestor y delegamos la tarea de realizar el login
        $user_manager = new UserManager();
        $data = $user_manager->login_user($params_array);

        return response()->json($data, 200);
    }

    public function update(Request $request) {
        // Recoger token de la cabecera
        $token = $request->header('Authorization');

        // Recoger los datos por post
        $json = $request->input('json', null);
        // $params = json_decode($json);
        $params_array = json_decode($json, true);


        // Instanciamos el gestor y delegamos la tarea de realizar el login
        $user_manager = new UserManager();
        $data = $user_manager->update_user($token, $params_array);

        return response()->json($data, $data['code']);
    }

    public function upload(Request $request) {
        // Instanciamos el gestor y delegamos la tarea de realizar subir la imagen
        $user_manager = new UserManager();
        $data = $user_manager->upload_user_image($request);

        return response()->json($data, $data['code']);
    }

    public function get_image($file_name) {
        // Instanciamos el gestor y delegamos la tarea de realizar obtener la imagen
        $user_manager = new UserManager();
        $data = $user_manager->get_user_image($file_name);

        return $data;
    }

    public function user_detail($id) {
        // Instanciamos el gestor y delegamos la tarea de realizar obtener la imagen
        $user_manager = new UserManager();
        $data = $user_manager->get_user_detail($id);

        return response()->json($data, $data['code']);
    }

}

<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class UsuariosModel extends Model{

    public function insereUsuario($dados){
        $insere = DB::table('usuarios')->insertGetId([
                'usu_nome' => $dados['nome'], 'usu_cpf' => $dados['cpf'], 'usu_status' => 1
            ]);
        return $insere;
    }
    public function listaUsuariosAtivos(){
        $busca = DB::table('usuarios')->where('usu_status', 1)->get();
        return $busca;
    }
    public function listaUsuarios(){
        $busca = DB::table('usuarios')->paginate(10);
        return $busca;
    }
    public function buscaUsuarioId($usuarioid){
        $busca = DB::table('usuarios')->where('usuarios_id', $usuarioid)->get();
        return $busca;
    }
    public function buscaEmpresaUsuarioId($usuarioid){
        $busca = DB::table('empresas')
            ->leftjoin('empresas_usuarios', 'empresas_usuarios.empresas_id', '=', 'empresas.empresas_id')
            ->leftjoin('usuarios', 'usuarios.usuarios_id', '=', 'empresas_usuarios.usuarios_id')
                ->where('empresas_usuarios.emp_usu_status', 1)
                ->Where('usuarios.usuarios_id', $usuarioid)
               ->get();
        return $busca;
    }
    public function ativarUsuario($usuarioid){
        $update = DB::table('usuarios')
            ->where('usuarios_id', $usuarioid)
                ->update(['usu_status' => 1]);
        return $update;
    }
    public function desativarUsuario($usuarioid){
        $update = DB::table('usuarios')
            ->where('usuarios_id', $usuarioid)
                ->update(['usu_status' => 0]);
        return $update;
    }
    public function editarUsuario($dados){
        $update = DB::table('usuarios')->where('usuarios_id', $dados['usuariosid'])
            ->update([
                'usu_nome' => $dados['nome'], 'usu_cpf' => $dados['cpf'], 'usu_status' => 1
            ]);
        return $update;
    }
   
}

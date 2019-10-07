<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class EmpresasModel extends Model{
    
    public function listaEmpresas(){
        $busca = DB::table('empresas')->get();
        return $busca;
    }
    public function insereEmpresa($dados){
        $busca = DB::table('empresas')->insertGetId([
                'emp_razao_social' => $dados['razaosocial'], 'emp_cnpj' => $dados['cnpj'],
                'emp_status' => 1
                ]);
        return $busca;
    }
    public function ativarEmpresa($empresasid){
        $update = DB::table('empresas')->where('empresas_id', $empresasid)->update(['emp_status' => 1]);
        return $update;
    }
    public function desativarEmpresa($empresasid){
        $update = DB::table('empresas')->where('empresas_id', $empresasid)->update(['emp_status' => 0]);
        return $update;
    }
    public function associaUsuarioEmpresa($usuarios_id, $empresas_id){
        $insere = DB::table('empresas_usuarios')->insert([
            'usuarios_id' => $usuarios_id, 'empresas_id' => $empresas_id, 'emp_usu_status' => 1
        ]);
        return $insere;
    }
    public function buscaUsuarioEmpresaId($empresasid){
        $busca = DB::table('empresas')
            ->leftjoin('empresas_usuarios', 'empresas_usuarios.empresas_id', '=', 'empresas.empresas_id')
            ->leftjoin('usuarios', 'usuarios.usuarios_id', '=', 'empresas_usuarios.usuarios_id')
                ->where('empresas_usuarios.emp_usu_status', 1)
                ->Where('empresas.empresas_id', $empresasid)
               ->get();
        return $busca;
    }
    public function buscaEmpresaId($empresasid){
        $busca = DB::table('empresas')
                ->Where('empresas.empresas_id', $empresasid)
               ->get();
        return $busca;
    }
    public function usuariosDisponiveis($empresasid){
        $busca = DB::table('usuarios')
            ->leftjoin('empresas_usuarios', 'empresas_usuarios.usuarios_id', '=', 'usuarios.usuarios_id')
            ->leftjoin('empresas', 'empresas.empresas_id', '=', 'empresas_usuarios.empresas_id')
                ->select('empresas_usuarios.empresas_id', 'empresas.emp_razao_social', 'empresas.emp_cnpj',
                         'usuarios.usu_nome', 'usuarios.usu_cpf', 'usuarios.usuarios_id')
                ->where('empresas.empresas_id', $empresasid)
                ->get();
    return $busca;
    }
    public function editarEmpresa($dados){
        $update = DB::table('empresas')->where('empresas_id', $dados['empresasid'])
                ->update([
                'emp_razao_social' => $dados['razaosocial'], 'emp_cnpj' => $dados['cnpj'],
                'emp_status' => 1
                ]);
        return $update;
    }
    public function desaassociaUsuarioEmpresa($usuariosid, $empresasid){
        $update = DB::table('empresas_usuarios')
                ->where('usuarios_id', $usuariosid)
                ->where('empresas_id', $empresasid)
                    ->update(['emp_usu_status' => 0]);
        return $update;
    }
}

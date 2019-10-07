<?php

namespace App\Http\Controllers;
use App\EmpresasModel;
use App\UsuariosModel;

use Illuminate\Http\Request;

class UsuariosController extends Controller{

    public function __construct(EmpresasModel $empresasmodel, UsuariosModel $usuariosmodel){
        $this->empresasmodel = $empresasmodel;
        $this->usuariosmodel = $usuariosmodel;
    }
   
    public function cadastrarUsuarios(){
        $empresas = $this->empresasmodel->listaEmpresas();
        return view('components.cadastros.cadastro_usuario', ['empresas' => $empresas]);
    }
    public function salvarUsuario(Request $request){
        $validatedData = $request->validate([
            'nome' => 'required|max:45',
            'cpf' => 'required',
        ]);
        $dados = array();
        $nome = $request->nome;
        $cpf = $request->cpf;    
        $dados['nome'] = $nome;
        $dados['cpf'] = $cpf;
        $insere = $this->usuariosmodel->insereUsuario($dados);
        $usuarios_id = $insere;

        if($request->checkOpempresas){ /// associar empresas
            $empresas = $request->checkempresas;
            foreach($empresas as $key){
                $insere = $this->empresasmodel->associaUsuarioEmpresa($usuarios_id, $key);
            }
        }
        if($insere){
            $request->session()->flash('sucesso', 'Usuário cadastrada com sucesso!');
        }else{
            $request->session()->flash('error', 'Não foi possivel cadastrar usuário');
        }
        return redirect('/usuarios/cadastrar');
    }
  
    public function listarUsuarios(){
        $usuarios = $this->usuariosmodel->listaUsuarios();
        return view('components.listagem.usuarios', ['usuarios' => $usuarios]);
    }
    public function ativarUsuario(Request $request){
        $validatedData = $request->validate([
            'usuariosid' => 'required',
        ]);
        $usuarioid = $request->usuariosid;    
        $ativar = $this->usuariosmodel->ativarUsuario($usuarioid);
        if($ativar){
            $request->session()->flash('sucesso', 'Usuário ativado com sucesso!');
        }else{
            $request->session()->flash('error', 'Não foi possivel ativar usuário');
        }
        return redirect('/usuarios/listar');
    }
    public function desativarUsuario(Request $request){
        $validatedData = $request->validate([
            'usuariosid' => 'required',
        ]);
        $usuarioid = $request->usuariosid;    
        $ativar = $this->usuariosmodel->desativarUsuario($usuarioid);
        if($ativar){
            $request->session()->flash('sucesso', 'Usuário desaativado com sucesso!');
        }else{
            $request->session()->flash('error', 'Não foi possivel desaativar usuário');
        }
        return redirect('/usuarios/listar');
    }
    public function visualizarUsuario(Request $request){
        $validatedData = $request->validate([
            'usuariosid' => 'required',
        ]);
        $usuariosid = $request->usuariosid;
        $dados = $this->usuariosmodel->buscaUsuarioId($usuariosid);
        $empresas = $this->usuariosmodel->buscaEmpresaUsuarioId($usuariosid);
        return view('components.pages.visualizarUsuario', ['dados' => $dados, 'empresas' => $empresas]);
    }
    public function editarUsuario(Request $request){
        $validatedData = $request->validate([
            'usuariosid' => 'required',
        ]);
        $usuariosid = $request->usuariosid;
        $dados = $this->usuariosmodel->buscaUsuarioId($usuariosid);
        $empresas = $this->usuariosmodel->buscaEmpresaUsuarioId($usuariosid);
        return view('components.pages.editarUsuario', ['dados' => $dados, 'empresas' => $empresas]);
    }
    public function salvarEdicao(Request $request){
        $validatedData = $request->validate([
            'nome' => 'required|max:45',
            'cpf' => 'required',
        ]);
        $dados = array();
        $dados['nome'] = $request->nome;
        $dados['cpf'] = $request->cpf;  
        $dados['usuariosid'] = $request->usuariosid; 
        $update = $this->usuariosmodel->editarUsuario($dados);

        if($request->checkempresas){ /// associar empresas
            $empresas = $request->checkempresas;
            foreach($empresas as $key){
                $update = $this->empresasmodel->desaassociaUsuarioEmpresa($dados['usuariosid'], $key);
            }
        }
        if($update){
            $request->session()->flash('sucesso', 'Usuário editado com sucesso!');
        }else{
            $request->session()->flash('error', 'Não foi possivel editar usuário');
        }
        return redirect('/usuarios/listar');
    }
}

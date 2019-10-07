<?php

namespace App\Http\Controllers;
use App\EmpresasModel;
use App\UsuariosModel;
use Illuminate\Http\Request;

class EmpresasController extends Controller{
    
    public function __construct(EmpresasModel $empresasmodel, UsuariosModel $usuariosmodel){
        $this->empresasmodel = $empresasmodel;
        $this->usuariosmodel = $usuariosmodel;
    }

    public function cadastrarEmpresas(){
        $usuarios = $this->usuariosmodel->listaUsuarios();
        return view('components.cadastros.cadastro_empresas', ['usuarios' => $usuarios]);
    }
    public function listarEmpresas(){
        $empresas = $this->empresasmodel->listaEmpresas();
        return view('components.listagem.empresas', ['empresas' => $empresas]);
    }
    public function salvarEmpresa(Request $request){
        $validatedData = $request->validate([
            'razaosocial' => 'required|max:45',
            'cnpj' => 'required',
        ]);
        $dados = array();
        $dados['razaosocial'] = $request->razaosocial;
        $dados['cnpj'] = $request->cnpj;
        $insere = $this->empresasmodel->insereEmpresa($dados);
        $empresas_id = $insere;

        if($request->checkOpempresas){ /// associar usuarios
            $usuarios = $request->checkusuarios;
            foreach($usuarios as $key){
                $insere = $this->empresasmodel->associaUsuarioEmpresa($key, $empresas_id);
            }
        }
        if($insere){
            $request->session()->flash('sucesso', 'Empresa cadastrada com sucesso!');
        }else{
            $request->session()->flash('error', 'Não foi possivel cadastrar empresa');
        }

        return redirect('/empresas/cadastrar');

    }
    public function ativarEmpresa(Request $request){
        $validatedData = $request->validate([
            'empresasid' => 'required',
        ]);
        $empresasid = $request->empresasid;
        $update = $this->empresasmodel->ativarEmpresa($empresasid);    

        if($update){
            $request->session()->flash('sucesso', 'Empresa ativada com sucesso!');
        }else{
            $request->session()->flash('error', 'Não foi possivel ativar empresa');
        }

        return redirect('/empresas/listar');
    }
    public function desativarEmpresa(Request $request){
        $validatedData = $request->validate([
            'empresasid' => 'required',
        ]);
        $empresasid = $request->empresasid;
        $update = $this->empresasmodel->desativarEmpresa($empresasid);    

        if($update){
            $request->session()->flash('sucesso', 'Empresa desativada com sucesso!');
        }else{
            $request->session()->flash('error', 'Não foi possivel desativar empresa');
        }

        return redirect('/empresas/listar');
    }
    public function visualizarEmpresa(Request $request){
        $validatedData = $request->validate([
            'empresasid' => 'required',
        ]);
        $empresasid = $request->empresasid;
        $dados = $this->empresasmodel->buscaEmpresaId($empresasid);
        $usuarios = $this->empresasmodel->buscaUsuarioEmpresaId($empresasid);
        return view('components.pages.visualizarEmpresa', ['dados' => $dados, 'usuarios' => $usuarios]);
    }
    public function editarEmpresa(Request $request){
        $validatedData = $request->validate([
            'empresasid' => 'required',
        ]);
        $empresasid = $request->empresasid;
        $dados = $this->empresasmodel->buscaEmpresaId($empresasid);
        $usuarios = $this->empresasmodel->buscaUsuarioEmpresaId($empresasid);
        return view('components.pages.editarEmpresa', ['dados' => $dados, 'usuarios' => $usuarios]);
    }
    public function salvarEdicao(Request $request){
        $validatedData = $request->validate([
            'razaosocial' => 'required|max:45',
            'cnpj' => 'required',
            'empresaid' => 'required'
        ]);
        $dados = array();
        
        $dados['razaosocial'] = $request->razaosocial;
        $dados['cnpj'] = $request->cnpj;
        $dados['empresasid'] = $request->empresaid;
        $update = $this->empresasmodel->editarEmpresa($dados);
        if($request->checkusuarios){ /// desassociar usuarios
            $usuarios = $request->checkusuarios;
            foreach($usuarios as $key){
                $update = $this->empresasmodel->desaassociaUsuarioEmpresa($key, $dados['empresasid']);
            }
        }
        if($update){
            $request->session()->flash('sucesso', 'Empresa editada com sucesso!');
        }else{
            $request->session()->flash('error', 'Não foi possivel editar empresa');
        }

        return redirect('/empresas/listar');
    }
}

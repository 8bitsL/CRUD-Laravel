@extends('app')
@section('app_body')
    <div class="card text-center">
        <div class="card-header">
            Cadastrar empresa
        </div>
        <div class="card-body">
        <form method="POST" action="{{action('EmpresasController@salvarEmpresa')}}">
            {!! csrf_field() !!}
            <div class="form-group row">
                <label  class="col-sm-2 col-form-label">Razao social</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="razaosocial" placeholder="Informe a razao social" require>
                </div>
                <label class="col-sm-2 col-form-label">CNPJ</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="cnpj" name="cnpj" placeholder="##.###.###/####-##" onkeyup="mascara('##.###.###/####-##',this,event,true)" maxlength="22" required>
                </div>
            </div>
            <div class="col-sm-6">
                <input type="checkbox" name="checkOpempresas" onclick="listaUsuarios();"/> <label>Associar a uma usuários</label> 
            </div>
            <div id="usuarios" style="display: none;">
            <div class="form-group row" >
                <label class="col-sm-2 col-form-label">Usuários</label>
                <table class="table table-striped col-md-6 " >
                    <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">CPF</th>
                        <th scope="col">Ação</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($usuarios as $key)
                        <tr>
                            <td>{{$key->usu_nome}}</td>
                            <td>{{$key->usu_cpf}}</td>
                            <td><input type="checkbox" name="checkusuarios[]" value="{{$key->usuarios_id}}" /></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            </div>
            <div class="form-group">
                <div class="col-md-8">
                    <button id="button2id" name="button2id" class="btn btn-danger">Cancelar</button>
                    <button class="btn btn-success">Salvar</button>
                </div>
            </div>
        </form> 
        </div>
        </div>
        </div>
    </div>
  </div>
</div>

<script>

    function listaUsuarios(){

        document.getElementById('usuarios').style.display = 'block';

    }



</script>

@endsection
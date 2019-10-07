@extends('app')
@section('app_body')
    <div class="card text-center">
        <div class="card-header">
            Editar usuario
        </div>
        <div class="card-body">
        <form method="POST" action="{{action('UsuariosController@salvarEdicao')}}">
            {!! csrf_field() !!}
            <div class="form-group row">
                <label  class="col-sm-2 col-form-label">Nome</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="nome" value="{{$dados[0]->usu_nome}}" placeholder="Informe a razao social" require>
                </div>
                <input type="hidden" value="{{$dados[0]->usuarios_id}}" name="usuariosid" />
                <label class="col-sm-2 col-form-label">CPF</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="cpf" value="{{$dados[0]->usu_cpf}}" name="cpf" placeholder="##.###.###/####-##" onkeyup="mascara('###.###.###-##',this,event,true)" maxlength="22" required>
                </div>
            </div>
            <div class="form-group row" >
                <label class="col-sm-2 col-form-label">Empresas</label>
                <table class="table table-striped col-md-6 " >
                    <thead>
                    <tr>
                        <th scope="col">Razão social</th>
                        <th scope="col">CNPJ</th>
                        <th scope="col">Desassociar</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if(isset($empresas))
                        @foreach($empresas as $key)
                        <tr>
                            <td>{{$key->emp_razao_social}}</td>
                            <td>{{$key->emp_cnpj}}</td>
                            <td><input type="checkbox" name="checkempresas[]" value="{{$key->empresas_id}}" /></td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            </div>
            <div class="form-group ">
                <div class="col-md-8 ">
                    <button class="btn btn-success">Salvar</button>
                </div>
            </div>
        </form> 
        </div>
        </div>
    </div>
  </div>
</div>
@endsection
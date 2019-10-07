@extends('app')
@section('app_body')
    <div class="card text-center">
        <div class="card-header">
            Editar empresa
        </div>
        <div class="card-body">
        <form method="POST" action="{{action('EmpresasController@salvarEdicao')}}">
            {!! csrf_field() !!}
            <div class="form-group row">
                <label  class="col-sm-2 col-form-label">Razao social</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="razaosocial" value="{{$dados[0]->emp_razao_social}}" placeholder="Informe a razao social" value="{{$dados[0]->emp_razao_social}}" require>
                </div>
                <input type="hidden" value="{{$dados[0]->empresas_id}}" name="empresaid" />
                <label class="col-sm-2 col-form-label">CNPJ</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="cnpj" value="{{$dados[0]->emp_cnpj}}" name="cnpj" placeholder="##.###.###/####-##" value="{{$dados[0]->emp_cnpj}}" onkeyup="mascara('##.###.###/####-##',this,event,true)" maxlength="22" required>
                </div>
            </div>
            <div class="form-group row" >
                <label class="col-sm-2 col-form-label">Usuários</label>
                <table class="table table-striped col-md-6 " >
                    <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">CPF</th>
                        <th scope="col">Desassociar</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if(isset($usuarios))
                        @foreach($usuarios as $key)
                        <tr>
                            <td>{{$key->usu_nome}}</td>
                            <td>{{$key->usu_cpf}}</td>
                            <td><input type="checkbox" name="checkusuarios[]" value="{{$key->usuarios_id}}" /></td>
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
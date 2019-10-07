@extends('app')
@section('app_body')
    <div class="card ">
        <div class="card-header text-center">
            Visualizar empresa
        </div>
        <div class="card-body">
            <label>Razão social: {{$dados[0]->emp_razao_social}}</label><br>
            <label>CNPJ: {{$dados[0]->emp_cnpj}}</label>
            <div class="form-group row" >
                <label class="col-sm-2 col-form-label">Usuarios associados: </label>
                <table class="table table-bordered col-md-6 " >
                    <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">CPF</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if(isset($usuarios))
                        @foreach($usuarios as $key)
                        <tr>
                            <td>{{$key->usu_nome}}</td>
                            <td>{{$key->usu_cpf}}</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        </div>
        </div>
    </div>
  </div>
</div>
@endsection
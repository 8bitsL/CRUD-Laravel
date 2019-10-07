@extends('app')
@section('app_body')
    <div class="card ">
        <div class="card-header text-center">
            Visualizar funcionario
        </div>
        <div class="card-body">
            <label>Razão social: {{$dados[0]->usu_nome}}</label><br>
            <label>CNPJ: {{$dados[0]->usu_cpf}}</label>
            <div class="form-group row" >
                <label class="col-sm-2 col-form-label">Empresas associadas: </label>
                <table class="table table-bordered col-md-6 " >
                    <thead>
                    <tr>
                        <th scope="col">Razão social</th>
                        <th scope="col">CNPJ</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if(isset($empresas))
                        @foreach($empresas as $key)
                        <tr>
                            <td>{{$key->emp_razao_social}}</td>
                            <td>{{$key->emp_cnpj}}</td>
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
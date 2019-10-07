@extends('app')
@section('app_body')
    <div class="card text-center">
        <div class="card-header">
            Empresas
        </div>
        <div class="card-body">
       
                <table class="table table-striped col-md-12" >
                    <thead>
                    <tr>
                        <th scope="col">Razão social</th>
                        <th scope="col">CNPJ</th>
                        <th scope="col">Status</th>
                        <th scope="col">Ação</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($empresas as $key)
                        <tr>
                            <td>{{$key->emp_razao_social}}</td>
                            <td>{{$key->emp_cnpj}}</td>
                            <td>
                                @if($key->emp_status == 1)
                                    <span class="badge badge-success">Ativo</span>
                                @else
                                    <span class="badge badge-danger">Inativo</span>
                                @endif
                            </td>
                            <td class="row">
                                <form method="POST" action="{{action('EmpresasController@visualizarEmpresa')}}">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="empresasid" value="{{$key->empresas_id}}" />
                                    <button type="submit" class="btn btn-info btn-sm">Visualizar</button>
                                </form>
                                <form method="POST" action="{{action('EmpresasController@editarEmpresa')}}">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="empresasid" value="{{$key->empresas_id}}" />
                                    <button type="submit" class="btn btn-primary btn-sm">Editar</button>
                                </form>
                                @if($key->emp_status == 1)
                                <form method="POST" action="{{action('EmpresasController@desativarEmpresa')}}">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="empresasid" value="{{$key->empresas_id}}" />
                                    <button type="submit" class="btn btn-danger btn-sm">Desativar</button>
                                </form>
                                @else
                                <form method="POST" action="{{action('EmpresasController@ativarEmpresa')}}">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="empresasid" value="{{$key->empresas_id}}" />
                                    <button type="submit" class="btn btn-success btn-sm">Ativar</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
  </div>
</div>

@endsection
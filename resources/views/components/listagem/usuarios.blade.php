@extends('app')
@section('app_body')
    <div class="card text-center">
        <div class="card-header">
            Usuários
        </div>
        <div class="card-body">
       
                <table class="table table-striped col-md-12" >
                    <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">CPF</th>
                        <th scope="col">Status</th>
                        <th scope="col">Ação</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($usuarios as $key)
                        <tr>
                            <td>{{$key->usu_nome}}</td>
                            <td>{{$key->usu_cpf}}</td>
                            <td>
                                @if($key->usu_status == 1)
                                    <span class="badge badge-success">Ativo</span>
                                @else
                                    <span class="badge badge-danger">Inativo</span>
                                @endif
                            </td>
                            <td class="row">
                                <form method="POST" action="{{action('UsuariosController@visualizarUsuario')}}">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="usuariosid" value="{{$key->usuarios_id}}" />
                                    <button type="submit" class="btn btn-info btn-sm">Visualizar</button>
                                </form>
                                <form method="POST" action="{{action('UsuariosController@editarUsuario')}}">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="usuariosid" value="{{$key->usuarios_id}}" />
                                    <button type="submit" class="btn btn-primary btn-sm">Editar</button>
                                </form>
                                @if($key->usu_status == 1)
                                <form method="POST" action="{{action('UsuariosController@desativarUsuario')}}">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="usuariosid" value="{{$key->usuarios_id}}" />
                                    <button type="submit" class="btn btn-danger btn-sm">Desativar</button>
                                </form>
                                @else
                                <form method="POST" action="{{action('UsuariosController@ativarUsuario')}}">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="usuariosid" value="{{$key->usuarios_id}}" />
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
@extends('app')



@section('app_body')





    <div class="card text-center">

        <div class="card-header">

            Cadastrar usuário

        </div>

        <div class="card-body">

        <form method="POST" action="{{action('UsuariosController@salvarUsuario')}}">
            {!! csrf_field() !!}
            <div class="form-group row">

                <label  class="col-sm-2 col-form-label">Nome</label>

                <div class="col-sm-4">

                    <input type="text" class="form-control" name="nome" placeholder="Informe o nome" require>

                </div>

                <label class="col-sm-2 col-form-label">CPF</label>

                <div class="col-sm-4">

                    <input type="text" class="form-control" id="cpf" name="cpf" placeholder="###.###.###-##" onkeyup="mascara('###.###.###-##',this,event,true)" maxlength="14" placeholder="Informe o CPF" required>

                </div>

            </div>

            <div class="col-sm-6">

                <input type="checkbox" name="checkOpempresas" onclick="listaEmpresas();"/> <label>Associar a uma empresa</label> 

            </div>

            <div id="empresas" style="display: none;">

            <div class="form-group row" >

                <label class="col-sm-2 col-form-label">Empresas</label>

                <table class="table table-striped col-md-6 " >

                    <thead>

                    <tr>

                        <th scope="col">Razao social</th>

                        <th scope="col">CNPJ</th>

                        <th scope="col">Ação</th>

                    </tr>

                    </thead>

                    <tbody>

                        @foreach($empresas as $key)

                        <tr>

                            <td>{{$key->emp_razao_social}}</td>

                            <td>{{$key->emp_cnpj}}</td>

                            <td><input type="checkbox" name="checkempresas[]" value="{{$key->empresas_id}}" /></td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>
            </div>
            <div class="form-group">

                <div class="col-md-8">
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

    function listaEmpresas(){

        document.getElementById('empresas').style.display = 'block';

    }



</script>

@endsection
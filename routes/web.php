<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('app');
});
Route::get('/usuarios/cadastrar', 'UsuariosController@cadastrarUsuarios');
Route::post('/usuarios/inserir', 'UsuariosController@salvarUsuario');
Route::get('/usuarios/listar', 'UsuariosController@listarUsuarios');
Route::post('/usuarios/ativar', 'UsuariosController@ativarUsuario');
Route::post('/usuarios/desativar', 'UsuariosController@desativarUsuario');
Route::post('/usuarios/visualizar', 'UsuariosController@visualizarUsuario');
Route::post('/usuarios/editar', 'UsuariosController@editarUsuario');
Route::post('/usuarios/salvar-edicao', 'UsuariosController@salvarEdicao');

Route::get('/empresas/cadastrar', 'EmpresasController@cadastrarEmpresas');
Route::post('/empresas/inserir', 'EmpresasController@salvarEmpresa');
Route::get('/empresas/listar', 'EmpresasController@listarEmpresas');
Route::post('/empresas/ativar', 'EmpresasController@ativarEmpresa');
Route::post('/empresas/desativar', 'EmpresasController@desativarEmpresa');
Route::post('/empresas/visualizar', 'EmpresasController@visualizarEmpresa');
Route::post('/empresas/editar', 'EmpresasController@editarEmpresa');
Route::any('/empresas/salvar-edicao', 'EmpresasController@salvarEdicao');
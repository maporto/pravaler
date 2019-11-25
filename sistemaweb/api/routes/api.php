<?php

// CRUD ALUNOS
Route::get('aluno', 'AlunoController@getList');
Route::post('aluno', 'AlunoController@create');
Route::put('aluno/{aluno}', 'AlunoController@update');
Route::get('aluno/{aluno}', 'AlunoController@get');
Route::delete('aluno/{aluno}', 'AlunoController@delete');

// CRUD CURSOS
Route::post('curso', 'CursoController@create');
Route::get('curso', 'CursoController@getList');
Route::put('curso/{curso}', 'CursoController@update');
Route::get('curso/{curso}', 'CursoController@get');
Route::delete('curso/{curso}', 'CursoController@delete');

// CRUD ALUNOS
Route::get('instituicao', 'InstituicaoController@getList');
Route::post('instituicao', 'InstituicaoController@create');
Route::put('instituicao/{instituicao}', 'InstituicaoController@update');
Route::get('instituicao/{instituicao}', 'InstituicaoController@get');
Route::delete('instituicao/{instituicao}', 'InstituicaoController@delete');

// ENDERECO
Route::get('estados', 'EnderecoController@getEstados');
Route::get('municipios', 'EnderecoController@getMunicipios');
Route::get('bairros', 'EnderecoController@getBairros');

{!! $BEGIN_PHP !!}
Route::get('{{snake_case($model,'-')}}/pagination', ['uses' => '{{$model}}Controller@pagination']);
Route::get('{{snake_case($model,'-')}}/create', ['uses' => '{{$model}}Controller@create']);
Route::post('{{snake_case($model,'-')}}/store', ['uses' => '{{$model}}Controller@store']);
Route::get('{{snake_case($model,'-')}}/edit/{id}', ['uses' => '{{$model}}Controller@edit']);
Route::post('{{snake_case($model,'-')}}/edit/{id}', ['uses' => '{{$model}}Controller@update']);
Route::get('{{snake_case($model,'-')}}/show/{id}', ['uses' => '{{$model}}Controller@show']);
Route::resource('{{snake_case($model,'-')}}', '{{$model}}Controller');
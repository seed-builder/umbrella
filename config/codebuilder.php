<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016-12-19
 * Time: 16:44
 */
return [
	//blade templates and cache folder
	'blade' => [
		'template' =>  realpath(base_path('resources/templates')),
		'template_cache' =>  realpath(base_path('resources/templates/cache')),
	],
	//outputs groups
	'outputs' => ['partner'],
	//output group
	//template name => output settings
	'common' => [
		'model' => ['path' => app_path('Models'), 'name_pattern' => '{model}.php'],
		//'route' => ['path' => base_path('routes/admin'), 'name_pattern' => '{model}.php', 'name_format' => 'strtolower'],
		//'controller' => ['path' => app_path('Http/Controllers/Admin'), 'name_pattern' => '{model}Controller.php'],
		//'view' => ['path' => base_path('resources/views'), 'name_pattern' => '{model}.blade.php', 'name_format' => 'strtolower'],
	],
	'api' => [
		'route' => ['path' => base_path('routes/api'), 'name_pattern' => '{model}.php', 'name_format' => 'strtolower'],
		'controller' => ['path' => app_path('Http/Controllers/Api'), 'name_pattern' => '{model}Controller.php'],
	],
	'datatables' => [
		'route' => ['path' => base_path('routes/admin'), 'name_pattern' => '{model}.php', 'name_format' => 'strtolower'],
		'controller' => ['path' => app_path('Http/Controllers/Admin'), 'name_pattern' => '{model}Controller.php'],
		'view_index' => ['path' => base_path('resources/views/admin/{model}'), 'name_pattern' => 'index.blade.php', 'name_format' => 'snake_case2'],
		'view_create' => ['path' => base_path('resources/views/admin/{model}'), 'name_pattern' => 'create.blade.php', 'name_format' => 'snake_case2'],
		'view_edit' => ['path' => base_path('resources/views/admin/{model}'), 'name_pattern' => 'edit.blade.php', 'name_format' => 'snake_case2'],
		'view_show' => ['path' => base_path('resources/views/admin/{model}'), 'name_pattern' => 'show.blade.php', 'name_format' => 'snake_case2'],
		'js' => ['path' => base_path('public/assets/admin'), 'name_pattern' => '{model}.js', 'name_format' => 'snake_case'],
	],
    'singlepage' => [
        'route' => ['path' => base_path('routes/admin'), 'name_pattern' => '{model}.php', 'name_format' => 'strtolower'],
        'controller' => ['path' => app_path('Http/Controllers/Admin'), 'name_pattern' => '{model}Controller.php'],
        'view_index' => ['path' => base_path('resources/views/admin/{model}'), 'name_pattern' => 'index.blade.php', 'name_format' => 'snake_case2'],
        'js' => ['path' => base_path('public/assets/admin'), 'name_pattern' => '{model}.js', 'name_format' => 'snake_case'],
    ],
    'partner' => [
        'route' => ['path' => base_path('routes/partner'), 'name_pattern' => '{model}.php', 'name_format' => 'strtolower'],
        'controller' => ['path' => app_path('Http/Controllers/Partner'), 'name_pattern' => '{model}Controller.php'],
        'view_index' => ['path' => base_path('resources/views/partner/{model}'), 'name_pattern' => 'index.blade.php', 'name_format' => 'snake_case2'],
        'view_create' => ['path' => base_path('resources/views/partner/{model}'), 'name_pattern' => 'create.blade.php', 'name_format' => 'snake_case2'],
        'view_edit' => ['path' => base_path('resources/views/partner/{model}'), 'name_pattern' => 'edit.blade.php', 'name_format' => 'snake_case2'],
        'view_show' => ['path' => base_path('resources/views/partner/{model}'), 'name_pattern' => 'show.blade.php', 'name_format' => 'snake_case2'],
        'js' => ['path' => base_path('public/assets/partner'), 'name_pattern' => '{model}.js', 'name_format' => 'snake_case'],
    ],
];
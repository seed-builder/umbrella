{!! $BEGIN_PHP !!}

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;
use App\Models\{{$model}};

class {{$model}}Controller extends ApiController
{
	//
	public function newEntity(array $attributes = [])
	{
		// TODO: Implement newEntity() method.
		return new {{$model}}($attributes);
	}
}
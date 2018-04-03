<?php 

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait ApiResponser
{
	private function successResponse($data, $code)
	{
		return response()->json($data, $code);
	}

	protected function errorsResponse($message, $code)
	{
		return response()->json(['error' => $message, 'code' => $code], $code);
	}

	protected function showAll(Collection $colletion, $code = 200)
	{
		return $this->successResponse(['data' => $colletion], $code);
	}

    protected function showOne(Model $instance, $code = 200)
    {
        return $this->successResponse(['data' => $instance], $code);
    }

    protected function showMessage(String $message, $code = 200)
    {
        return $this->successResponse(['data' => $message], $code);
    }
    
}
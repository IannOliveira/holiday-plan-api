<?php

namespace App\Exceptions;

use Exception;

class IdNaoEncontradoException extends Exception
{
    protected $message = 'Id nao encontrado.';

    public function render(){
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage(),
        ]);

    }
}

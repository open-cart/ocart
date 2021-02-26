<?php
namespace System\Core\Http\Responses;


use Illuminate\Contracts\Support\Responsable;

class BaseHttpResponse implements Responsable
{
    /**
     * @var bool
     */
    protected $error = false;

    /**
     * @var
     */
    protected $message;

    /**
     * @var
     */
    protected $data;

    /**
     * @var int
     */
    protected $code = 200;

    /**
     * @param bool $error
     * @return BaseHttpResponse
     */
    public function setError(bool $error = true)
    {
        $this->error = $error;
        return $this;
    }

    /**
     * @param $message
     * @return BaseHttpResponse
     */
    public function setMessage(string $message = '')
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Symfony\Component\HttpFoundation\Response|void
     */
    public function toResponse($request)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'error'   => $this->error,
                'data'    => $this->data,
                'message' => $this->message,
            ], $this->code);
        }
    }
}

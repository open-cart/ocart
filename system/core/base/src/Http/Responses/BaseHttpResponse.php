<?php
namespace System\Core\Http\Responses;


use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\URL;

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
     * @var string
     */
    protected $previousUrl = '';

    /**
     * @var string
     */
    protected $nextUrl = '';

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

        if ($request->input('submit') === 'save' && !empty($this->previousUrl)) {
            return redirect()->to($this->previousUrl);
        } elseif (!empty($this->nextUrl)) {
            return redirect()->to($this->nextUrl);
        }

        return redirect()->to(URL::previous());
    }

    /**
     * @param string $nextUrl
     * @return BaseHttpResponse
     */
    public function setNextUrl(string $nextUrl)
    {
        $this->nextUrl = $nextUrl;
        return $this;
    }

    /**
     * @param string $previousUrl
     * @return BaseHttpResponse
     */
    public function setPreviousUrl(string $previousUrl)
    {
        $this->previousUrl = $previousUrl;
        return $this;
    }
}

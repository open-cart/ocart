<?php
namespace Ocart\EcommerceReview\Http\Controllers;

use Ocart\Core\Http\Controllers\BaseController;
use Ocart\Core\Http\Responses\BaseHttpResponse;
use Ocart\EcommerceReview\Http\Requests\ReviewRequest;
use Ocart\EcommerceReview\Repositories\ReviewRepository;

class PublicController extends BaseController
{
    /**
     * @var ReviewRepository
     */
    protected $reviewRepository;

    public function __construct(ReviewRepository $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    public function postCreateReview(ReviewRequest $request, BaseHttpResponse $response)
    {
        $exists = $this->reviewRepository->count([
            'customer_id' => auth('web')->user()->getAuthIdentifier(),
            'product_id'  => $request->input('product_id'),
        ]);

        if ($exists > 0) {
            return $response
                ->setError()
                ->setMessage(__('You have reviewed this product already!'));
        }

        $request->merge(['customer_id' => auth('web')->user()->getAuthIdentifier()]);

        $this->reviewRepository->create($request->input());

        return $response->setMessage(__('Added review successfully!'));
    }
}

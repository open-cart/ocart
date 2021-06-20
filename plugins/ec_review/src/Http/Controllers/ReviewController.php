<?php
namespace Ocart\EcommerceReview\Http\Controllers;


use Illuminate\Http\Request;
use Ocart\Core\Http\Controllers\BaseController;
use Ocart\EcommerceReview\Repositories\ReviewRepository;
use Ocart\EcommerceReview\Table\ReviewTable;

class ReviewController extends BaseController
{
    /**
     * @var ReviewRepository
     */
    protected $repo;

    public function __construct(ReviewRepository $repo)
    {
        $this->repo = $repo;
        $this->authorizeResource($repo->getModel(), 'id');
    }

    /**
     * Get the map of resource methods to ability names.
     *
     * @return array
     */
    protected function resourceAbilityMap()
    {
        return [
            'index' => 'ec_review.reviews.index',
            'destroy' => 'ec_review.reviews.destroy',
        ];
    }

    public function index(ReviewTable $table)
    {
        page_title()->setTitle(trans('plugins/ec_review::reviews.title'));
        return $table->render();
    }

    function destroy(Request $request)
    {
        $this->repo->delete($request->input('id'));

        return response()->json([]);
    }
}

<?php
namespace Ocart\Payment\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Ocart\Core\Forms\FormBuilder;
use Ocart\Core\Http\Controllers\BaseController;
use Ocart\Payment\Repositories\PaymentRepository;

class PaymentMethodController extends BaseController
{
    /**
     * @var PaymentRepository
     */
    protected $paymentRepository;

    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
        $this->authorizeResource($paymentRepository->getModel(), 'id');
    }

    /**
     * Get the map of resource methods to ability names.
     *
     * @return array
     */
    protected function resourceAbilityMap()
    {
        return [
            'index' => 'payments.transactions.index',
            'show' => 'payments.transactions.update',
            'create' => 'payments.transactions.create',
            'store' => 'payments.transactions.create',
            'edit' => 'payments.transactions.update',
            'update' => 'payments.transactions.update',
            'destroy' => 'payments.transactions.destroy',
        ];
    }

    public function index()
    {
        return view('plugins.payment::settings.index');
    }
}
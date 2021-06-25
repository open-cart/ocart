<?php
namespace Ocart\Payment\Http\Controllers;

use Illuminate\Http\Request;
use Ocart\Core\Http\Responses\BaseHttpResponse;
use Ocart\Payment\Forms\PaymentTransactionForm;
use Ocart\Core\Forms\FormBuilder;
use Ocart\Core\Http\Controllers\BaseController;
use Ocart\Payment\Http\Requests\UpdateTransactionRequest;
use Ocart\Payment\Repositories\PaymentRepository;
use Ocart\Payment\Tables\PaymentTransactionTable;

class PaymentTransactionController extends BaseController
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

    public function index(PaymentTransactionTable $table)
    {
        return $table->render();
    }

    function show($id, FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/payment::payment.edit_transaction'));
        $transaction = $this->paymentRepository->skipCriteria()->find($id);

        return $formBuilder->create(PaymentTransactionForm::class, ['model' => $transaction])
            ->setMethod('PUT')
            ->setUrl(route('payments.transactions.update', ['id' => $transaction->id]))
            ->renderForm([], true, false);
    }

    function update($id, UpdateTransactionRequest $request, BaseHttpResponse $response)
    {
        $data = $request->all();

        $transaction = $this->paymentRepository->update(\Arr::only($data, ['status']), $id);

        return $response->setPreviousUrl(route('payments.transactions.index'))
            ->setNextUrl(route('payments.transactions.show', $transaction->id));
    }

    function destroy(Request $request)
    {
        $this->paymentRepository->delete($request->input('id'));

        return response()->json([]);
    }
}
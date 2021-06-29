<?php


namespace Ocart\Contact\Http\Controllers;


use Illuminate\Support\Facades\Mail;
use Ocart\Contact\Events\SentContactEvent;
use Ocart\Contact\Http\Requests\ContactRequest;
use Ocart\Contact\Repositories\Interfaces\ContactRepository;
use Ocart\Core\Facades\EmailHandler;
use Ocart\Core\Http\Controllers\BaseController;
use Ocart\Core\Http\Responses\BaseHttpResponse;
use \Exception;

class PublicController extends BaseController
{
    /**
     * @var ContactRepository
     */
    protected $contactRepository;

    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function postSendContact(ContactRequest $request, BaseHttpResponse $response)
    {
        try {
            $contact = $this->contactRepository->create($request->input());

            event(new SentContactEvent($contact));

           EmailHandler::module('contact')
               ->setVariableValues([
                   'contact_name'    => $contact->name ?? 'N/A',
                   'contact_subject' => $contact->subject ?? 'N/A',
                   'contact_email'   => $contact->email ?? 'N/A',
                   'contact_phone'   => $contact->phone ?? 'N/A',
                   'contact_address' => $contact->address ?? 'N/A',
                   'contact_content' => $contact->content ?? 'N/A',
               ])
               ->sendUsingTemplate('plugins.contact::emails.e-contact');

            return $response->setMessage(__('Send message successfully!'));
        } catch (Exception $exception) {
            info($exception->getMessage());
            return $response
                ->setError()
                ->setMessage(trans('plugins/contact::contact.email.failed'));
        }
    }
}

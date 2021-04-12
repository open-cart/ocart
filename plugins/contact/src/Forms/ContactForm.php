<?php
namespace Ocart\Contact\Forms;

use Ocart\Contact\Enums\ContactStatusEnum;
use Ocart\Contact\Models\Contact;
use Ocart\Core\Forms\FormAbstract;

class ContactForm extends FormAbstract
{

    public function buildForm()
    {
        $this
            ->setupModel(new Contact())
            ->withCustomFields()
            ->setModuleName('blog_tag')
            ->setFormOption('class', 'space-y-4')
            ->setFormOption('id', 'from-builder')
            ->addMetaBoxes([
                'information' => [
                    'title' => trans('Contact information'),
                    'content' => apply_filters(
                        'contact_information',
                        view('plugins.contact::contact-information', ['form' => $this, 'model' => $this->getModel()]),
                        $this
                    )
                ],
            ])->addMetaBoxes([
                'replies' => [
                    'title' => trans('Replies'),
                    'content' => apply_filters(
                        'contact_replies',
                        view('plugins.contact::contact-replies'),
                        $this
                    )
                ],
            ])

            ->add('status', 'select', [
                'choices'    => ContactStatusEnum::labels()
            ])
            ->setBreakFieldPoint('status');
    }
}

<?php

namespace App\Forms\Director;

use Kris\LaravelFormBuilder\Form;
use App\Person;

class DirectorForm extends Form
{
  protected $formOptions = [
    'method' => 'POST'
  ];

  public function buildForm()
  {
    $this->add('director_heading', 'static', [
      'tag' => 'h2',
      'value' => 'Director',
      'label_show' => false
    ]);

    $people = Person::all();
    $people_choices = array();
    foreach($people as $person){
      $people_choices[$person->id] = $person->first_name . ' ' . $person->last_name . ' <' . $person->email . '>';
    }
    
    $this->add('person_id','choice', [
      'choices' => $people_choices,
      'label' => 'Add Existing Director',
      'attr' => ['id' => 'person-id'],
      'wrapper' => ['class' => 'director-search-group'],
      'multiple' => false,
      'rules' => 'required_without_all:choir_id,director.first_name',
      'error_messages' => [
        'person_id.required_without' => 'Please select an existing director or add a new one.'
      ]
    ]);
    
    $this->add('add_director', 'static', [
      'label_show' => false,
      'tag' => 'a',
      'attr' => ['class' => 'toggle-new-director btn btn-secondary', 'href' => '#'],
      'value' => 'Or create a new director',
      'wrapper' => ['class' => 'search-or-new']
    ]);
    
    $this->add('first_name','text', [
      'label' => 'First Name',
      'wrapper' => ['class' => 'form-group director-create-group'],
      'rules' => 'required_without_all:choir_id,person_id,director.person_id',
      'error_messages' => [
        'first_name.required_without' => 'Director first name is required unless selecting an existing director.'
      ]
    ]);

    $this->add('last_name','text', [
      'label' => 'Last Name',
      'wrapper' => ['class' => 'form-group director-create-group'],
      'rules' => 'required_without_all:choir_id,person_id,director.person_id',
      'error_messages' => [
        'last_name.required_without' => 'Director last name is required unless selecting an existing director.'
      ]
    ]);

    $this->add('email','email', [
      'label' => 'Email Address',
      'wrapper' => ['class' => 'form-group director-create-group'],
      'rules' => ['required_without_all:choir_id,person_id,director.person_id', 'unique:people,email', 'email'],
      'error_messages' => [
        'email.required_without' => 'Director email is required unless selecting an existing director.',
        'email.unique' => 'That email address already belongs to a person in the system.'
      ]
    ]);

    $this->add('emails_additional','text', [
      'label' => 'Additional Email Addresses',
      'wrapper' => ['class' => 'form-group director-create-group'],
      'help_block' => [
        'text' => 'One or more addition emails that should also get notifications. Separate addresses with a comma.',
        'tag' => 'p',
        'attr' => ['class' => 'help-block']
      ],
      'rules' => ['regex:/^([\w+-.%]+@[\w-.]+\.[A-Za-z]{2,4},?(\s*)?)+$/'],
      'error_messages' => [
        'emails_additional.regex' => 'Please enter one ore more valid email addresses, separated by a comma.'
      ]
    ]);

    $this->add('tel','tel', [
      'label' => 'Mobile Phone Number (to receive link to results via text message) - optional',
      'wrapper' => ['class' => 'form-group director-create-group'],
      'rules' => ['regex:/^(?:(?:(\s*\(?([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9])\s*)|([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\)?\s*(?:[.-]\s*)?)([2-9]1[02-9]|[2-9][02-9]1|[2-9][02-9]{2})\s*(?:[.-]\s*)?([0-9]{4})$/'],
      'error_messages' => [
        'tel.regex' => 'Please enter a valid telephone number with the area code.'
      ]
    ]);

  }
}

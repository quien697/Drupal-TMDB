<?php

namespace Drupal\movies\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class MoviesConfigForm extends FormBase {

  const MOVIES_API_CONFIG_PAGE = 'movies_api_config_page:values';

  public function getFormId() {
    return 'movies_api_config_page';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $values = \Drupal::state() -> get(key: self::MOVIES_API_CONFIG_PAGE);
    $values['api_base_url'] = $values['api_base_url'] ?? 'https://api.themoviedb.org';
    $values['api_key'] = $values['api_key'] ?? '514354a145080c7b3471994a728d34e0';

    $form = [];

    $form['api_base_url'] = [
      '#type' => 'textfield',
      '#title' => $this -> t(string: 'API Base URL'),
      '#description' => $this -> t(string: 'This is the API Base URL'),
      '#required' => TRUE,
      '#default_value' => $values['api_base_url'],
    ];

    $form['api_key'] = [
      '#type' => 'textfield',
      '#title' => $this -> t(string: 'API Key (v3 auth)'),
      '#description' => $this -> t(string: 'This is the api key that will be used to access the API'),
      '#required' => TRUE,
      '#default_value' => $values['api_key'],
    ];

    $form['actions']['typp'] = 'action';
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this -> t(string: 'Save'),
      '#button_type' => 'primary',
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $submitted_values = $form_state -> cleanValues() -> getValues();
    \Drupal::state() -> set(self::MOVIES_API_CONFIG_PAGE, $submitted_values);

    $messenger = \Drupal::service(id: 'messenger');
    $messenger -> addMessage($this -> t(string: 'Your new configuration has been saved.'));
  }

}
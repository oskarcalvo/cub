<?php

namespace Drupal\cub\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Class CubForm.
 *
 * @package Drupal\cub\Form
 */
class CubForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $cub = $this->entity;
    $wadus = '';
    $form['#description'] = [
      '#type' => 'item',
      '#markup' => self::generateLink('More information Here', 'https://ga-dev-tools.appspot.com/campaign-url-builder/'),
    ];
    
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $cub->label(),
      '#description' => $this->t("Label for the CUB."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $cub->id(),
      '#machine_name' => [
        'exists' => '\Drupal\cub\Entity\Cub::load',
        //'replace_pattern' => '([^a-z0-9_]+)|(^custom$)',
        //'error' => 'The machine-readable name must be unique, and can only contain lowercase letters, numbers, and underscores. Additionally, it can not be the reserved word "custom".',

      ],
      '#disabled' => !$cub->isNew(),
    ];
  
    $form['webUrl'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Website Url'),
      '#maxlength' => 255,
      '#default_value' => $cub->webUrl(),
      '#description' => $this->t("The full website URL (e.g. https://www.example.com) or an internal path."),
      '#required' => TRUE,
    ];
  
    $form['source'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Campaign Source'),
      '#maxlength' => 255,
      '#default_value' => $cub->source(),
      '#description' => $this->t("The referrer: (e.g. google, newsletter)."),
      '#required' => TRUE,
    ];
  
    $form['medium'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Campaign Medium'),
      '#maxlength' => 255,
      '#default_value' => $cub->medium(),
      '#description' => $this->t("Marketing medium: (e.g. cpc, banner, email)."),
    ];
  
    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Campaign Name'),
      '#maxlength' => 255,
      '#default_value' => $cub->name(),
      '#description' => $this->t("Product, promo code, or slogan (e.g. spring_sale)."),
    ];
  
    $form['term'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Campaign Term'),
      '#maxlength' => 255,
      '#default_value' => $cub->term(),
      '#description' => $this->t("Identify the paid keywords."),
    ];
  
    $form['content'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Campaign Content'),
      '#maxlength' => 255,
      '#default_value' => $cub->content(),
      '#description' => $this->t("Use to differentiate ads."),
    ];
    return $form;
  }
  
  /**
   * @param string $text
   * @param string $uri
   * @return mixed|null
   */
  private static function generateLink($text, $uri){
    $url = Url::fromUri($uri);
    $link = Link::fromTextandUrl($text,$url);
    return render($link);
    
  }
  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $cub = $this->entity;
    $status = $cub->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Cub.', [
          '%label' => $cub->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Cub.', [
          '%label' => $cub->label(),
        ]));
    }
    \Drupal\cub\helpers\CubHelpers::cubCleanCache();
    $form_state->setRedirectUrl($cub->toUrl('collection'));
  }
  
}

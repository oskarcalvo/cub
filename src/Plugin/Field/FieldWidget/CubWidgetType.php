<?php

namespace Drupal\cub\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'cub_widget_type' widget.
 *
 * @FieldWidget(
 *   id = "cub_widget_type",
 *   label = @Translation("Cub widget type"),
 *   field_types = {
 *     "cub_field_type"
 *   }
 * )
 */
class CubWidgetType extends WidgetBase {
  
  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
  
    $entidades = \Drupal\cub\Helpers\CubHelpers::getListOfEntyties();
    
    $wadus = 'element';
    $newfields['cub'] = [
      '#type' => 'details',
      '#title' => $this->t('Campaing url builder'),
      '#group' => 'advanced',
      '#weight' => 85,
      
    ];

    foreach ($entidades as $key => $cub) {
      $newfields['cub'][$key] = [
        '#title' => $cub['label'],
        '#type' => 'details',
      ];
      $newfields['cub'][$key]['label'] = [
        '#type' => 'hidden',
        '#title' => $this->t('Label'),
        '#maxlength' => 255,
        '#default_value' => $cub['label'],
        '#description' => $this->t("Label for the CUB."),
        '#required' => TRUE,
      ];
    
      $newfields['cub'][$key]['id'] = [
        '#type' => 'hidden',
        '#default_value' => $cub['id'],
        '#machine_name' => [
          'exists' => '\Drupal\cub\Entity\Cub::load',
          //'replace_pattern' => '([^a-z0-9_]+)|(^custom$)',
          //'error' => 'The machine-readable name must be unique, and can only contain lowercase letters, numbers, and underscores. Additionally, it can not be the reserved word "custom".',
      
        ],
        '#disabled' => TRUE
      ];
      $newfields['cub'][$key]['webUrl'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Website Url'),
        '#maxlength' => 255,
        '#default_value' => $cub['weburl'],
        '#description' => $this->t("The full website URL (e.g. https://www.example.com) or an internal path."),
        '#required' => TRUE,
      ];
    
      $newfields['cub'][$key]['source'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Campaign Source'),
        '#maxlength' => 255,
        '#default_value' => $cub['source'],
        '#description' => $this->t("The referrer: (e.g. google, newsletter)."),
        '#required' => TRUE,
      ];
    
      $newfields['cub'][$key]['medium'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Campaign Medium'),
        '#maxlength' => 255,
        '#default_value' => $cub['medium'],
        '#description' => $this->t("Marketing medium: (e.g. cpc, banner, email)."),
      ];
    
      $newfields['cub'][$key]['name'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Campaign Name'),
        '#maxlength' => 255,
        '#default_value' => $cub['name'],
        '#description' => $this->t("Product, promo code, or slogan (e.g. spring_sale)."),
      ];
    
      $newfields['cub'][$key]['term'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Campaign Term'),
        '#maxlength' => 255,
        '#default_value' => $cub['term'],
        '#description' => $this->t("Identify the paid keywords."),
      ];
    
      $newfields['cub'][$key]['content'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Campaign Content'),
        '#maxlength' => 255,
        '#default_value' => $cub['content'],
        '#description' => $this->t("Use to differentiate ads."),
      ];
    }
    
    

    
    $element['value'] = $element + $newfields;
    
    
    return $element;
  }

}

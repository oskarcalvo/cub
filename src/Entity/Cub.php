<?php

namespace Drupal\cub\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the Cub entity.
 *
 * @ConfigEntityType(
 *   id = "cub",
 *   label = @Translation("Cub"),
 *   handlers = {
 *     "list_builder" = "Drupal\cub\CubListBuilder",
 *     "form" = {
 *       "add" = "Drupal\cub\Form\CubForm",
 *       "edit" = "Drupal\cub\Form\CubForm",
 *       "delete" = "Drupal\cub\Form\CubDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\cub\CubHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "cub",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/config/search/cub/{cub}",
 *     "add-form" = "/admin/config/search/cub/add",
 *     "edit-form" = "/admin/config/search/cub/{cub}/edit",
 *     "delete-form" = "/admin/config/search/cub/{cub}/delete",
 *     "collection" = "/admin/config/search/cub"
 *   }
 * )
 */
class Cub extends ConfigEntityBase implements CubInterface {

  /**
   * The Cub ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Cub label.
   *
   * @var string
   */
  protected $label;

  /**
   * Webesite URL 
   *
   * @var url
   */
  protected $url;
  
  /**
   * Campaign Source
   *
   * @var source
   */
  protected $source;

  /**
   * Campaign Medium
   *
   * @var medium
   */
  protected $medium;

  /**
   * Campaign Name
   *
   * @var name
   */
  protected $name;

  /**
   * Campaign Term
   *
   * @var $term
   */
  protected $term;

  /**
   * Campaign Content
   *
   * @var content
   */
  protected $content;
  
  /**
   * @return \Drupal\cub\Entity\source
   */
  public function source(){
    return $this->source;
  }
  
  /**
   * @return \Drupal\cub\Entity\medium
   */
  public function medium(){
    return $this->medium;
  }
  
  /**
   * @return \Drupal\cub\Entity\name
   */
  public function name(){
    return $this->name;
  }
  
  public function term(){
    return $this->term;
  }
  
  /**
   * @return \Drupal\cub\Entity\content
   */
  public function content(){
    return $this->content;
  }
}

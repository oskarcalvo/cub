<?php

namespace Drupal\cub\Helpers;

class CubHelpers {
  
  const CUBLISTOFENTYTIES = 'CubListOfEntytites';
  
  /**
   * @return array
   */
  static function getListOfEntyties(){
    if ($cache = \Drupal::cache()->get(CUBLISTOFENTYTIES)) {
      return $cache->data;
    }else {
      $listOfData = self::getEntytiesData();
      \Drupal::cache()->set(CUBLISTOFENTYTIES, $listOfData);
      return $listOfData;
    }
    
  }
  
  
  /**
   * @return array|null
   */
  private function getEntytiesData() {
    $query = \Drupal::entityQuery('cub')->execute();
    if(!is_array($query)){
      return NULL;
    }
    
    $entidades = entity_load_multiple('cub', $query);
    $listOfData = [];
    foreach($entidades as $key => $value){
      $listOfData[$key]['label'] = $value->label;
      $listOfData[$key]['weburl'] = $value->weburl();
      $listOfData[$key]['source'] = $value->source();
      $listOfData[$key]['medium'] = $value->medium();
      $listOfData[$key]['namel'] = $value->name();
      $listOfData[$key]['term'] = $value->term();
      $listOfData[$key]['content'] = $value->content();
    }
    return $listOfData;
  }
  
  static function cubCleanCache(){
    $cache = \Drupal::cache()->get(\Drupal\cub\Helpers\CubHelpers::CUBLISTOFENTYTIES);
    if (isset($cache->data)) {
      \Drupal::cache()
        ->delete(\Drupal\cub\Helpers\CubHelpers::CUBLISTOFENTYTIES);
      return TRUE;
    }
    return NULL;
  }
}
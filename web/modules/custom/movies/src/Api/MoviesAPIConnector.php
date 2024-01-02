<?php

namespace Drupal\movies\Api;

use Drupal\node\Entity\Node;

/**
 * Movies API Management Class
 */
class MoviesAPIConnector {

  private $client;

  private $query;

  public function __construct(\Drupal\Core\Http\ClientFactory $client) {
    $movie_api_config = \Drupal::state() -> get(key: \Drupal\movies\Form\MoviesConfigForm::MOVIES_API_CONFIG_PAGE);
    $api_url = ($movie_api_config['api_base_url']) ?: 'https://api.themoviedb.org';
    $api_key = ($movie_api_config['api_key']) ?: '514354a145080c7b3471994a728d34e0';
    $query = ['api_key' => $api_key];

    $this -> query = $query;
    $this -> client = $client -> fromOptions([
      'base_uri' => $api_url,
      'query' => $query
    ]);
  }

  /**
   * Fetch data
   *
   * @return Json Data Type
   */
  public function fetchMovies() {
    $data = [];
    $endpoint = '/3/discover/movie';
    $options = ['query' => $this -> query];

    try {
      $request = $this -> client -> get($endpoint, $options);
      $result = $request -> getBody() -> getContents();
      $data = json_decode($result);
    } catch (\Exception $e) {
      \Drupal::messenger() -> addError('An error occurred while requesting the endpoint: '.$e->getMessage());
    }

    return $data -> results;
  }

  /**
   * Store Json data to node.
   *
   * @param [Json Data Type] $data
   * @return void
   */
  public function createNodes($data) {
    if (!empty($data)) {
      foreach ($data as $item) {
        try {
          $nids = \Drupal::entityQuery('node')
                          ->condition('type', 'movie')
                          ->condition('field_id', $item->id)
                          ->accessCheck(FALSE)
                          ->execute();

          if (empty($nids)) {
            $node = Node::create(['type' => 'movie']);
          } else {
            $node = Node::load(reset($nids));
          }

          $node -> setTitle($item -> title);
          $node -> field_id          = $item -> id;
          $node -> field_description = $item -> overview;
          $node -> field_image_url   = $this -> getImageURL($item -> poster_path);

          $node->save();
        } catch (\Exception $e) {
          \Drupal::logger('movies')->error('Error creating node for Movie ID '.$item -> id.': '.$e -> getMessage());
        }
      }
    }
  }

  /**
   * Get whole path of image url
   *
   * @param [String] $image_path
   * @return String
   */
  public function getImageURL($image_path) {
    return 'https://image.tmdb.org/t/p/w500/'.$image_path;
  }

}
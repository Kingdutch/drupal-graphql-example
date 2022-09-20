<?php
/**
 * @file
 * This file has originally been created for Open Social and has been shared as
 * part of the DrupalCon EU talk "Building a GraphQL API - Beyond the Basics"
 * under the GPLv2 license.
 *
 * Find the original code in https://github.com/goalgorilla/open_social/
 */

declare(strict_types=1);

namespace Drupal\drupalcon\Plugin\GraphQL\DataProducer\Edge;

use Drupal\graphql\Plugin\DataProducerPluginCachingInterface;
use Drupal\graphql\Plugin\GraphQL\DataProducer\DataProducerPluginBase;
use Drupal\drupalcon\Wrappers\EdgeInterface;

/**
 * Returns the cursor for an edge.
 *
 * @DataProducer(
 *   id = "edge_cursor",
 *   name = @Translation("Edge cursor"),
 *   description = @Translation("Returns the cursor of an edge."),
 *   produces = @ContextDefinition("string",
 *     label = @Translation("Cursor")
 *   ),
 *   consumes = {
 *     "edge" = @ContextDefinition("any",
 *       label = @Translation("EdgeInterface")
 *     )
 *   }
 * )
 */
class EdgeCursor extends DataProducerPluginBase implements DataProducerPluginCachingInterface {

  /**
   * Resolves the value for this data producer.
   *
   * @param \Drupal\drupalcon\Wrappers\EdgeInterface $edge
   *   The edge to return the cursor for.
   *
   * @return mixed
   *   The cursor for this edge.
   */
  public function resolve(EdgeInterface $edge) {
    return $edge->getCursor();
  }

}

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

namespace Drupal\drupalcon\Plugin\GraphQL\DataProducer\Connection;

use Drupal\graphql\Plugin\DataProducerPluginCachingInterface;
use Drupal\graphql\Plugin\GraphQL\DataProducer\DataProducerPluginBase;
use Drupal\drupalcon\GraphQL\ConnectionInterface;

/**
 * Produces the page info from a connection object.
 *
 * @DataProducer(
 *   id = "connection_page_info",
 *   name = @Translation("Connection page info"),
 *   description = @Translation("Returns the page info of a connection."),
 *   produces = @ContextDefinition("page_info",
 *     label = @Translation("Page Info")
 *   ),
 *   consumes = {
 *     "connection" = @ContextDefinition("any",
 *       label = @Translation("QueryConnection")
 *     )
 *   }
 * )
 */
class ConnectionPageInfo extends DataProducerPluginBase implements DataProducerPluginCachingInterface {

  /**
   * Resolves the request.
   *
   * @param \Drupal\drupalcon\GraphQL\ConnectionInterface $connection
   *   The connection to return the page info for.
   *
   * @return mixed
   *   The page info for the connection.
   */
  public function resolve(ConnectionInterface $connection) {
    return $connection->pageInfo();
  }

}

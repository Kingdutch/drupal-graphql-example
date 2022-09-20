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

namespace Drupal\drupalcon\Plugin\GraphQL\Schema;

use Drupal\graphql\GraphQL\ResolverBuilder;
use Drupal\graphql\GraphQL\ResolverRegistry;
use Drupal\graphql\Plugin\GraphQL\Schema\SdlSchemaPluginBase;

/**
 * @Schema(
 *   id = "drupalcon",
 *   name = "A DrupalCon base GraphQL Schema"
 * )
 */
class DrupalConBaseSchema extends SdlSchemaPluginBase {

  /**
   * {@inheritdoc}
   */
  public function getResolverRegistry() {
    $registry = new ResolverRegistry();
    $builder = new ResolverBuilder();

    $registry->addFieldResolver('DateTime', 'timestamp', $builder->fromParent());

    $registry->addFieldResolver('Connection', 'edges',
      $builder->produce('connection_edges')->map('connection', $builder->fromParent())
    );
    $registry->addFieldResolver('Connection', 'nodes',
      $builder->produce('connection_nodes')->map('connection', $builder->fromParent())
    );
    $registry->addFieldResolver('Connection', 'pageInfo',
      $builder->produce('connection_page_info')
        ->map('connection', $builder->fromParent())
    );

    $registry->addFieldResolver('Edge', 'cursor',
      $builder->produce('edge_cursor')->map('edge', $builder->fromParent())
    );
    $registry->addFieldResolver('Edge', 'node',
      $builder->produce('edge_node')->map('edge', $builder->fromParent())
    );

    return $registry;
  }

}

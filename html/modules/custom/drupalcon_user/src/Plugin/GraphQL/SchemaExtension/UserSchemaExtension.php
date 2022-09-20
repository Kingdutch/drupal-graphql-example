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

namespace Drupal\drupalcon_user\Plugin\GraphQL\SchemaExtension;

use Drupal\graphql\GraphQL\ResolverBuilder;
use Drupal\graphql\GraphQL\ResolverRegistryInterface;
use Drupal\drupalcon\Plugin\GraphQL\SchemaExtension\SchemaExtensionPluginBase;

/**
 * Adds user data to the GraphQL API.
 *
 * @SchemaExtension(
 *   id = "drupalcon_user_schema_extension",
 *   name = "DrupalCon - User Schema Extension",
 *   description = "GraphQL schema extension for DrupalCon user data.",
 *   schema = "drupalcon"
 * )
 */
class UserSchemaExtension extends SchemaExtensionPluginBase {

  /**
   * {@inheritdoc}
   */
  public function registerResolvers(ResolverRegistryInterface $registry) {
    $builder = new ResolverBuilder();

    // Root Query fields.
    $registry->addFieldResolver('Query', 'users',
      $builder->produce('query_user')
        ->map('after', $builder->fromArgument('after'))
        ->map('before', $builder->fromArgument('before'))
        ->map('first', $builder->fromArgument('first'))
        ->map('last', $builder->fromArgument('last'))
        ->map('reverse', $builder->fromArgument('reverse'))
        ->map('sortKey', $builder->fromArgument('sortKey'))
    );

    $registry->addFieldResolver('Query', 'user',
      $builder->produce('entity_load_by_uuid')
        ->map('type', $builder->fromValue('user'))
        ->map('uuid', $builder->fromArgument('id'))
    );

    // User type fields.
    $registry->addFieldResolver('User', 'id',
      $builder->produce('entity_uuid')
        ->map('entity', $builder->fromParent())
    );

    $registry->addFieldResolver('User', 'displayName',
      $builder->produce('entity_label')
        ->map('entity', $builder->fromParent())
    );

    $registry->addFieldResolver('User', 'created',
      $builder->fromPath('entity:user', 'created.value')
    );

    $registry->addFieldResolver('User', 'updated',
      $builder->fromPath('entity:user', 'changed.value')
    );

    $registry->addFieldResolver('User', 'status',
      $builder->produce('user_status')
        ->map('user', $builder->fromParent())
    );

    $registry->addFieldResolver('User', 'roles',
      $builder->produce('user_roles')
        ->map('user', $builder->fromParent())
    );
  }

}

<?php

/**
 * @file
 * Contains Drupal\forblock\Plugin\Block\UserPasswordBlock.
 */

namespace Drupal\formblock\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Form\FormBuilderInterface;

/**
 * Provides a block for the password reset form.
 *
 * @Block(
 *   id = "formblock_user_password",
 *   admin_label = @Translation("Request new password form"),
 *   provider = "user"
 * )
 *
 * Note that we set module to contact so that blocks will be disabled correctly
 * when the module is disabled.
 */
class UserPasswordBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The form builder.
   *
   * @var \Drupal\Core\Form\FormBuilderInterface.
   */
  protected $formBuilder;

  /**
   * Constructs a new UserPasswordBlock plugin.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Form\FormBuilderInterface $form_builder
   *   The form builder.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, FormBuilderInterface $form_builder) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->formBuilder = $form_builder;
  }

  /**
   * Creates the block.
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('form_builder')
    );
  }

  /**
   * Implements \Drupal\block\BlockBase::build().
   */
  public function build() {
    $build = array();

    $build['form'] = $this->formBuilder->getForm('Drupal\user\Form\UserPasswordForm');

    return $build;
  }

}

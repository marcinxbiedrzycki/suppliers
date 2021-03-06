<?php

namespace ContainerVcWCxd6;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getSupplierSyncCommandService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'App\Command\SupplierSyncCommand' shared autowired service.
     *
     * @return \App\Command\SupplierSyncCommand
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/console/Command/Command.php';
        include_once \dirname(__DIR__, 4).'/src/Command/SupplierSyncCommand.php';
        include_once \dirname(__DIR__, 4).'/src/Supplier/SupplierFactoryInterface.php';
        include_once \dirname(__DIR__, 4).'/src/Supplier/Factory.php';
        include_once \dirname(__DIR__, 4).'/src/Parser/ParserFactoryInterface.php';
        include_once \dirname(__DIR__, 4).'/src/Parser/ParserFactory.php';

        $container->privates['App\\Command\\SupplierSyncCommand'] = $instance = new \App\Command\SupplierSyncCommand(new \App\Supplier\Factory\SupplierFactory(($container->services['event_dispatcher'] ?? $container->getEventDispatcherService()), ($container->privates['monolog.logger'] ?? $container->load('getMonolog_LoggerService')), new \App\Parser\Factory\ParserFactory()));

        $instance->setName('divante:supplier-sync');

        return $instance;
    }
}

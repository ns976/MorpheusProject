<?php

namespace ContainerPBbxjGC;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/*
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getJobExecutorService extends App_KernelProdContainer
{
    /*
     * Gets the public 'console.command.public_alias.App\Command\JobExecutor' shared autowired service.
     *
     * @return \App\Command\JobExecutor
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->services['console.command.public_alias.App\\Command\\JobExecutor'] = new \App\Command\JobExecutor();
    }
}

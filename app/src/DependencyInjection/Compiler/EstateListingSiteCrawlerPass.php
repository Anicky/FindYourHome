<?php

// src/DependencyInjection/Compiler/EstateListingSiteCrawlerPass.php

namespace App\DependencyInjection\Compiler;

use App\Service\EstateListingSiteCrawlerInterface;
use App\Service\EstateListingSiteCrawlerChain;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class EstateListingSiteCrawlerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        if (!$container->has(EstateListingSiteCrawlerChain::class)) {
            return;
        }

        $definition = $container->findDefinition(EstateListingSiteCrawlerChain::class);

        $taggedServices = $container->findTaggedServiceIds('app.estate_listing_site_crawler');

        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall('addCrawler', [new Reference($id)]);
        }
    }
}
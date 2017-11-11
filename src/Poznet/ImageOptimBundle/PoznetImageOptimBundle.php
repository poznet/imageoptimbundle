<?php

namespace Poznet\ImageOptimBundle;

use Poznet\ImageOptimBundle\DependencyInjection\PoznetImageOptimExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class PoznetImageOptimBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new PoznetImageOptimExtension();
    }
}

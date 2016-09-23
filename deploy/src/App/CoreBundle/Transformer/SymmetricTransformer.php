<?php

namespace App\CoreBundle\Transformer;

use MediaMonks\Doctrine\Transformable\Transformer\ZendCryptSymmetricTransformer;

/**
 * @package App\CoreBundle\Transformer
 * @author Rutger Mensch <rutger@mediamonks.com>
 */
class SymmetricTransformer extends ZendCryptSymmetricTransformer
{
    /**
     * {@inheritdoc}
     */
    public function transform($value)
    {
        if ($value === null) {
            return null;
        }

        return parent::transform($value);
    }

    /**
     * {@inheritdoc}
     */
    public function reverseTransform($value)
    {
        if ($value === null) {
            return null;
        }

        return parent::reverseTransform($value);
    }
}

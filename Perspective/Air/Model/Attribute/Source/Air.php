<?php

namespace Perspective\Air\Model\Attribute\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class Air extends AbstractSource
{
    /**
     * Get all options
     * @return array
     */
    public function getAllOptions()
    {
        if (!$this->_options) {
            $this->_options = [
                ['label' => __('None'), 'value' => 'none'],
                ['label' => __('Balloon'), 'value' => 'balloon'],
                ['label' => __('Charter Plane'), 'value' => 'charterPlane'],
                ['label' => __('High-speed plane'), 'value' => 'hsPlane'],
                ['label' => __('Spaceship'), 'value' => 'spaceship'],
            ];
        }
        return $this->_options;
    }
}

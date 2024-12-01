<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ThreeJsScene extends Component
{
    public $width = 1;
    public $height = 1;
    public $depth = 1;
    public $color = '0x00ff00'; // Default color

    public function updateDimensions($width, $height, $depth)
    {
        $this->width = $width;
        $this->height = $height;
        $this->depth = $depth;
        $this->emit('updateCube'); // Emit event to update the cube
    }

    public function updateColor($color)
    {
        $this->color = $color;
        $this->emit('updateCube'); // Emit event to update the cube
    }

    public function render()
    {
        return view('livewire.three-js-scene');
    }
} 
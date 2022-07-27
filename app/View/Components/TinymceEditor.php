<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TinymceEditor extends Component
{
    public $id;
    public $name;
    public $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $value, $name)
    {
        $this->id = $id;
        $this->value = $value;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tinymce-editor');
    }
}

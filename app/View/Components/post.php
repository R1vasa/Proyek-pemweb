<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\posts;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;

class post extends Component
{
    public $data;
    public $posts;
    public $post;
    /**
     * Create a new component instance.
     */
    public function __construct($data = 'no data passed', $post = null)
    {
        $this->data = $data;
        // $this->data = $data;
        // $this->post = $post;
        $currentPath = Request::path();

        if ($currentPath === 'profile') {
            $this->post = $post;
            $this->posts = null;
        } else {
            $this->posts = \App\Models\Post::with('user')->latest()->get();
            $this->post = null;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.post');
    }
}

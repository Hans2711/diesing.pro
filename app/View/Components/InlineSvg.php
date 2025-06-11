<?php

namespace App\View\Components;

use Illuminate\Support\Facades\File;
use Illuminate\Support\HtmlString;
use Illuminate\View\Component;

class InlineSvg extends Component
{
    public string $icon;
    public ?string $class;
    public ?string $title;

    public function __construct(string $icon, string $class = null, string $title = null)
    {
        $this->icon = $icon;
        $this->class = $class;
        $this->title = $title;
    }

    public function render()
    {
        $path = resource_path(trim($this->icon, '/'));
        if (!str_ends_with($path, '.svg')) {
            $path .= '.svg';
        }
        if (!File::exists($path)) {
            return new HtmlString('');
        }

        $svg = File::get($path);

        if ($this->class) {
            if (preg_match('/class="([^"]*)"/', $svg)) {
                $svg = preg_replace('/class="([^"]*)"/', 'class="$1 ' . $this->class . '"', $svg, 1);
            } else {
                $svg = preg_replace('/<svg/', '<svg class="' . $this->class . '"', $svg, 1);
            }
        }

        if ($this->title) {
            $svg = preg_replace('/<svg([^>]*)>/', '<svg$1><title>' . e($this->title) . '</title>', $svg, 1);
        }

        return new HtmlString($svg);
    }
}

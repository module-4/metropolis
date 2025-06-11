<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    /**
     * Create a new component instance.
     */


    protected $except = ['type'];

    private array $variantClasses = [
        'primary' => 'bg-primary text-primary-foreground shadow hover:bg-primary/90',
        'accent' => 'bg-accent text-accent-foreground shadow-sm hover:bg-accent/80',
        'success' => 'bg-success text-success-foreground shadow-sm hover:bg-success/90',
        'danger' => 'bg-danger text-danger-foreground shadow-sm hover:bg-danger/90',
        'ghost' => 'hover:bg-bg-foreground/5',
        'link' => 'text-primary underline-offset-4 hover:underline'
    ];

    private array $sizeClasses = [
        'default' => 'h-9 px-4 py-2',
        'sm' => 'h-8 rounded-md px-3 text-xs',
        'lg' => 'h-10 rounded-md px-8',
        'icon' => "h-9 w-9",
        'link' => '',
    ];

    public function __construct(
        public string $variant = 'primary',
        public string $size = 'default',
        public bool   $isLink = false
    )
    {
        // Validate the variant
        $validVariants = array_keys($this->variantClasses);
        if (!in_array($this->variant, $validVariants)) {
            throw new \InvalidArgumentException("Invalid variant: $this->variant");
        }

        // Validate the size
        $validSizes = array_keys($this->sizeClasses);
        if (!in_array($this->size, $validSizes)) {
            throw new \InvalidArgumentException("Invalid size: $this->size");
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button', [
            'variantClass' => $this->variantClasses[$this->variant] . ' focus-visible:outline-none focus-visible:ring-2 ring-offset-2 ring-primary focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50',
            'sizeClass' => $this->sizeClasses[$this->size]
        ]);
    }
}

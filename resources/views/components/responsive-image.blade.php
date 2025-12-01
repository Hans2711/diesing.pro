@props(['src', 'alt', 'title', 'class' => '', 'loading' => 'lazy', 'fetchpriority' => 'auto', 'sizes' => '(max-width: 768px) 100vw, (max-width: 1024px) 50vw, 800px', 'small' => false])

@php
    // Extract image name without extension
    $imagePath = $src;
    $imageName = basename($imagePath);
    $imageNameWithoutExt = pathinfo($imageName, PATHINFO_FILENAME);
    
    // Determine widths based on image size
    $widths = $small ? [100, 200, 300] : [400, 800, 1200];
    
    // Build srcset using pre-generated responsive images
    // Only include sizes that actually exist
    $srcsetParts = [];
    foreach ($widths as $width) {
        $responsiveFilename = $imageNameWithoutExt . '-' . $width . 'w.webp';
        $responsivePath = public_path('build/images/responsive/' . $responsiveFilename);
        
        // Only add to srcset if the file exists
        if (file_exists($responsivePath)) {
            $srcsetParts[] = asset('build/images/responsive/' . $responsiveFilename) . ' ' . $width . 'w';
        }
    }
    $srcset = implode(', ', $srcsetParts);
    
    // Fallback src uses the original Vite asset
    $fallbackSrc = Vite::asset($imagePath);
@endphp

<img 
    src="{{ $fallbackSrc }}" 
    srcset="{{ $srcset }}"
    sizes="{{ $sizes }}"
    alt="{{ $alt }}" 
    title="{{ $title }}"
    loading="{{ $loading }}"
    fetchpriority="{{ $fetchpriority }}"
    class="{{ $class }}"
    {{ $attributes }}
/>

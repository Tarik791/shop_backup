<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $product->name }} - Details</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
</head>
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
    <div class="min-h-screen bg-white dark:bg-gray-900 text-black dark:text-white p-6">    
        <h1 class="text-3xl mb-6">{{ $product->name }}</h1>

    <!-- Prikazivanje glavne slike proizvoda -->
    @if($product->images->isNotEmpty())
        <div class="product-main-image mb-6">
            <img src="{{ $product->images->first()->url }}" alt="{{ $product->name }} main image" class="w-full h-auto mb-4">
        </div>
    @endif

    <p class="text-lg mb-4">{{ $product->description }}</p>
    <p class="text-xl font-bold mb-6">${{ $product->product_price }}</p>

    <!-- Prikazivanje galerije slika proizvoda -->
    <div class="product-images mb-6">
        <h3>Additional Images:</h3>
        <div class="flex gap-4">
            @foreach($product->images as $image)
                <img src="{{ $image->url }}" alt="{{ $product->name }} image" class="w-32 h-32 object-cover">
            @endforeach
        </div>
    </div>

    <!-- Prikazivanje varijanti proizvoda -->
    @if($product->variants->isNotEmpty())
        <div class="product-variants mb-6">
            <h3>Variants:</h3>
            @foreach($product->variants as $variant)
                <div class="variant border p-4 mb-4">
                    <h4 class="text-lg font-semibold">{{ $variant->variant_handle }}</h4>
                    <p>Price: ${{ $variant->variant_price }}</p>
                </div>
            @endforeach
        </div>
    @else
        <p>No variants available for this product.</p>
    @endif

    <a href="{{ route('product.index') }}" class="text-blue-500 hover:underline mt-6">Back to Products</a>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome - Products</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
</head>
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">

    <div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
        <main class="flex max-w-[335px] w-full flex-col-reverse lg:max-w-4xl lg:flex-col">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8 w-full">
                @foreach($products as $product)
                    <div class="product-card border p-4">
                        <!-- Glavna slika proizvoda -->
                        @if($product->images->isNotEmpty())
                            <img src="{{ $product->images->first()->url }}" alt="{{ $product->name }} image" class="w-full h-48 object-cover mb-4">
                        @endif
                        <h2 class="text-xl font-semibold">{{ $product->name }}</h2>
                        <p>{{ $product->description }}</p>
                        <p class="text-lg font-bold">${{ $product->product_price }}</p>

                        <a href="{{ route('product.show', ['uuid' => $product->id]) }}" class="text-blue-500 hover:underline mt-4 block">View Details</a>
                    </div>
                @endforeach
                <!-- Paginate links -->
                <div class="mt-6">
                    {{ $products->links() }}
                </div>
            </div>
        </main>
    </div>
</body>
</html>

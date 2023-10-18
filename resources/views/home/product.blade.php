<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Our <span>products</span>
            </h2>
        </div>
        <div class="row">
            @foreach ($products ?? [] as $product)
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="box">
                        <div class="option_container">
                            <div class="options">
                                <a href="{{url('product_detail', $product->id)}}" class="option1">
                                    {{ $product->title }}
                                </a>
                                <a href="" class="option2">
                                    Buy Now
                                </a>
                            </div>
                        </div>
                        <div class="img-box">
                            <img src="product_images/{{ collect($product->images)->first()->image_name }}" alt="">
                            @php
                                $discountPercentage = round((($product->price - $product->discount_price) / $product->price) * 100);
                            @endphp
                            @if ($product->discount_price > 0 && $discountPercentage > 0 && $discountPercentage <= 100)
                                <div class="discount_badge">
                                    {{ $discountPercentage }}% OFF
                                </div>
                            @endif
                        </div>
                        <div class="detail-box">
                            <h5>
                                {{ $product->title }}
                            </h5>
                            <h6>
                                @if ($product->discount_price > 0)
                                    <span style="text-decoration: line-through; color: #999; font-size: 12px;">
                                        Rs {{ number_format($product->price) }}
                                    </span>
                                    <span><span style="color: #f7444e; ">Rs</span>
                                        {{ number_format($product->discount_price) }}
                                    </span>
                                @else
                                    <span><span style="color: #f7444e">Rs</span>
                                        {{ number_format($product->price) }}
                                    </span>
                                @endif
                            </h6>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @if(isset($products))
        <div style="margin-top: 60px;">
            {!! $products??[]->withQueryString()->links('pagination::bootstrap-5') !!}
        </div>
        @endif
    </div>
</section>
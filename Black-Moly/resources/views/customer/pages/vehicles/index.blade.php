@extends('customer.layouts.app')
@section('content')
    <!------ Breadcrumbs Start ------>
    <div class="impl_bread_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1>{{ isset($condition) ? ucfirst($condition) . ' Vehicles' : 'Vehicles' }}</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">{{ isset($condition) ? ucfirst($condition) . ' Vehicles' : 'Vehicles' }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!------ Purchase new section Start ------>
    <div class="impl_purchase_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="impl_sorting_text custom_select">
                        <span class="impl_show"> Showing {{ $vehicles->firstItem() }} - {{ $vehicles->lastItem() }} of {{ $totalVehicles }} Results</span>
                        <div class="impl_select_wrapper">
                            <span>sort by</span>
                            <select onchange="location = this.value;">
                                <option value="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                                <option value="{{ request()->fullUrlWithQuery(['sort' => 'oldest']) }}" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                                <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_high']) }}" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price High to Low</option>
                                <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_low']) }}" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price Low to High</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="impl_purchase_inner">
                        <div class="row">
                            <div class="col-lg-3 col-md-4">
                                <div class="impl_sidebar">
                                    <div class="impl_product_search widget woocommerce">
                                        <form action="{{ route('customer.vehicles.search') }}" method="GET">
                                            <div class="impl_footer_subs">
                                                <input type="text" name="query" class="form-control" placeholder="Search..." value="{{ request('query') }}">
                                                <button type="submit" class="foo_subs_btn"><i class="fa fa-search" aria-hidden="true"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                    <!--Brands-->
                                    <div class="impl_product_brand widget woocommerce">
                                        <h2 class="widget-title">brands</h2>
                                        <form id="brand-filter-form" action="{{ route('customer.vehicles.index') }}" method="GET">
                                            <input type="hidden" name="sort" value="{{ request('sort') }}">
                                            <ul>
                                                @foreach($brands as $brand)
                                                    <li>
                                                        <label class="brnds_check_label">
                                                            {{ $brand->name }}
                                                            <input type="checkbox" name="brand[]" value="{{ $brand->id }}"
                                                                   {{ in_array($brand->id, (array)request('brand')) ? 'checked' : '' }}
                                                                   onchange="document.getElementById('brand-filter-form').submit()">
                                                            <span class="label-text"></span>
                                                        </label>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </form>
                                    </div>
                                    <!--Price Range-->
                                    <div class="impl_product_price widget woocommerce">
                                        <h2 class="widget-title">price range</h2>
                                        <div class="price_range">
                                            <input type="text" id="range_24" name="ionRangeSlider" value=""
                                                   data-min="{{ $minPrice }}"
                                                   data-max="{{ $maxPrice }}"
                                                   data-from="{{ request('price_min') ?? $minPrice }}"
                                                   data-to="{{ request('price_max') ?? $maxPrice }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-8">
                                <div class="row">
                                    @forelse($vehicles as $vehicle)
                                        <div class="col-lg-4 col-md-6 mb-4">
                                            <div class="impl_fea_car_box">
                                                <div class="impl_fea_car_img">
                                                    @if($vehicle->images->where('is_primary', true)->first())
                                                        <img src="{{ asset('storage/' . $vehicle->images->where('is_primary', true)->first()->image_path) }}" alt="{{ $vehicle->title }}" class="img-fluid impl_frst_car_img" />
                                                        <img src="{{ asset('storage/' . $vehicle->images->where('is_primary', true)->first()->image_path) }}" alt="{{ $vehicle->title }}" class="img-fluid impl_hover_car_img" />
                                                    @else
                                                        <img src="{{ asset('images/placeholder-car.jpg') }}" alt="{{ $vehicle->title }}" class="img-fluid impl_frst_car_img" />
                                                        <img src="{{ asset('images/placeholder-car.jpg') }}" alt="{{ $vehicle->title }}" class="img-fluid impl_hover_car_img" />
                                                    @endif
                                                </div>
                                                <div class="impl_fea_car_data">
                                                    <h2><a href="{{ route('customer.vehicles.show', $vehicle->slug) }}">{{ $vehicle->title }}</a></h2>
                                                    <ul>
                                                        <li><span class="impl_fea_title">model</span>
                                                            <span class="impl_fea_name">{{ $vehicle->model->name }}</span></li>
                                                        <li><span class="impl_fea_title">Vehicle Status</span>
                                                            <span class="impl_fea_name">{{ ucfirst($vehicle->condition) }}</span></li>
                                                        <li><span class="impl_fea_title">Brand</span>
                                                            <span class="impl_fea_name">{{ $vehicle->model->brand->name }}</span></li>
                                                    </ul>
                                                    <div class="impl_fea_btn">
                                                        <button class="impl_btn">
                                                            <span class="impl_doller">Rs {{ number_format($vehicle->price) }}</span>
                                                            <span class="impl_bnw">buy now</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12">
                                            <div class="alert alert-info">No vehicles found matching your criteria.</div>
                                        </div>
                                    @endforelse

                                    <!--pagination start-->
                                    <div class="col-lg-12 col-md-12">
                                        <div class="impl_pagination_wrapper">
                                            {{ $vehicles->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Price range slider initialization
        $(document).ready(function() {
            $("#range_24").ionRangeSlider({
                type: "double",
                min: $("#range_24").data('min'),
                max: $("#range_24").data('max'),
                from: $("#range_24").data('from'),
                to: $("#range_24").data('to'),
                prefix: "$",
                grid: true,
                onFinish: function(data) {
                    window.location.href = "{{ request()->url() }}?price_min=" + data.from + "&price_max=" + data.to +
                        "&sort={{ request('sort') }}" +
                        "{{ request('brand') ? '&brand[]=' . implode('&brand[]=', (array)request('brand')) : '' }}" +
                        "{{ request('category') ? '&category=' . request('category') : '' }}";
                }
            });
        });

        // Add category filter
        function addCategoryFilter(categoryId) {
            document.getElementById('category-filter').value = categoryId;
            document.getElementById('category-filter-form').submit();
        }
    </script>
@endpush

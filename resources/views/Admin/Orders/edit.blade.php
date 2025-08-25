<!-- Page header -->
<section class="content-header">
    {{--    <h1>{{$title}}</h1>--}}
</section>
<!-- /page header -->

<!-- Content area -->
<div class="content">
    <div class="box card">
        <form role="form" enctype="multipart/form-data" method="post"
              action="{{ route('orders.update',['order'=>$item]) }}">
            @csrf
            @method('PUT')
            <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>
                <button type="submit" class="btn btn-success float-right">{{__('fields.Buttons.Save')}}</button>
            </div>
            <!-- Input group addons -->
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card card-primary card-tabs card-body">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill"
                                   href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home"
                                   aria-selected="true">{{__('fields.Menu.Content')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill"
                                   href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile"
                                   aria-selected="false">{{__('fields.Menu.Products')}}</a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel"
                                 aria-labelledby="custom-tabs-one-home-tab">
                                <fieldset class="mb-3">
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{{__('fields.Delivery.Title')}}<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <select name="delivery" class="form-control select2"
                                                        style="width: 100%;">
                                                    @foreach($deliveryList as $key=>$deliver)
                                                        <option @if($key === intval($item->delivery)) selected
                                                                @endif value="{{$key}}">{{$deliver}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{{__('fields.Payment.Title')}}<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <select name="payment" class="form-control select2"
                                                        style="width: 100%;">
                                                    @foreach($paymentList as $key=>$payment)
                                                        <option @if($key === intval($item->payment)) selected
                                                                @endif value="{{$key}}">{{$payment}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{{__('fields.NP.Title')}}<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <label for="np">Місто</label>
                                                <select id="np" name="np" class="form-control select2"
                                                        style="width: 100%;">
                                                    <option>{{ $item->np ?? 'м. Київ' }}</option>
                                                </select>
                                                <label for="np-warehouses">Відділення</label>
                                                <select id="np-warehouses" name="np_warehouses"
                                                        class="form-control select2"
                                                        style="width: 100%;">
                                                    <option>{{ $item->np_warehouses ?? 'Відділення №1: вул. Пирогівський шлях' }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{{__('fields.Fio.Title')}}<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <input type="text" name="fio" class="form-control"
                                                       value="{{ $item->fio ?? old('fio') }}"
                                                       placeholder="{{__('fields.Fio.Placeholder')}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{{__('fields.Email.Title')}}<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <input type="text" name="email" class="form-control"
                                                       value="{{ $item->email ?? old('email') }}"
                                                       placeholder="{{__('fields.Email.Placeholder')}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{{__('fields.Phone.Title')}}<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <input type="text" name="phone" class="form-control"
                                                       value="{{ $item->phone ?? old('phone') }}"
                                                       placeholder="{{__('fields.Phone.Placeholder')}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{{__('fields.Total.Title')}}<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <input disabled type="text" name="total" class="form-control"
                                                       value="{{ $item->total ?? old('total') }}"
                                                       placeholder="{{__('fields.Total.Placeholder')}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{{__('fields.Payment.Title')}}<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <select name="status" class="form-control select2"
                                                        style="width: 100%;">
                                                    @foreach($statusList as $key=>$status)
                                                        <option @if(intval($item->status->value)===$key) selected @endif value="{{$key}}">{{$status}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </fieldset>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel"
                                 aria-labelledby="custom-tabs-one-profile-tab">
                                <fieldset class="mb-3">
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{{__('fields.Products.Title')}}<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <select id="products" class="form-control select2"
                                                        style="width: 100%;">
                                                </select>
                                                <button
                                                    onclick="addProducts($('#products').select2('data')[0].id,$('#products').select2('data')[0].text);"
                                                    id="add-products" class="form-control btn-success" type="button">Add
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">Обрані<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <div id="selected">

                                                    @if(isset($products))
                                                        @foreach($products as $product)
                                                            <div id="product_field_{{$product['id']}}">
                                                                <label for="product">{{$product['title']}}</label>
                                                                <div class="input-group">
                                                                    <input id="product" name="products[{{$product['id']}}][id]" type="text" class="form-control hidden" value="{{$product['id']}}">
                                                                    <div class="input-group-append">
                                                                        <input id="product" name="products[{{$product['id']}}][count]" type="number" class="form-control" placeholder="Кількість" value="{{$product['count']}}">
                                                                        <button onclick="removeProduct({{$product['id']}})" class="form-control btn-danger" type="button">Delete</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- /input group addons -->
</div>
<!-- /content area -->

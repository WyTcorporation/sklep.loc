<!-- Page header -->
<section class="content-header">
    <h1>{{$title}}</h1>
</section>
<!-- /page header -->


<!-- Content area -->
<div class="content">

    <!-- Input group addons -->
    <div class="box card">
        <form role="form" enctype="multipart/form-data" method="post"
              action="{{ route('larders.update',['larder' => $item->id ]) }}">

            @csrf
            @method('PUT')
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

                @csrf
                    <fieldset class="mb-3">
                        <legend class="">{{__('Common info')}}</legend>
                        <div class="form-group">
                            @if($products)
                                <label>{{__('Products')}}</label>
                                <select name="product_id" class="form-control select2" style="width: 100%;">
                                    @foreach($products as $product)
                                        <option {{ $item->product_id === $product->id ?"selected": "" }} value="{{ $product->id ?? "" }}">{{ $product->title ?? "" }}</option>
                                    @endforeach
                                </select>
                            @endif
                            <label>Product Term: <span class="text-danger">*</span></label>
                            <div class="input-group" id="reservationdate" data-target-input="nearest">
                                <input value="{{ $item->product_term ?? "" }}" name="product_term" type="text" class="form-control datetimepicker-input"
                                       data-target="#reservationdate"/>
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            <label>Remember:</label>
                            <div class="input-group" id="reservationdate2" data-target-input="nearest">
                                <input value="{{ $item->remember ?? "" }}" name="remember" type="text" class="form-control datetimepicker-input"
                                       data-target="#reservationdate2"/>
                                <div class="input-group-append" data-target="#reservationdate2"
                                     data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="user_id" value="{{ $item->user_id ?? "" }}">
                    </fieldset>
                <button type="submit" class="btn btn-success">{{__('Submit')}}</button>


            </div>
        </form>
    </div>
    <!-- /input group addons -->

</div>

<!-- /content area -->

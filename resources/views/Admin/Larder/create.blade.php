<!-- Page header -->
<section class="content-header">
    <h1>{{$title}}</h1>
</section>
<!-- /page header -->

<!-- Content area -->
<div class="content">

    <!-- Input group addons -->
    <div class="box card">
        <form role="form" enctype="multipart/form-data" method="post" action="{{ route('larders.store') }}">

            @csrf

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
                    <div class="form-group row">
                        @if($products)
                            <label>{{__('Products')}}</label>
                            <select name="product_id" class="form-control select2" style="width: 100%;">
                                @foreach($products as $product)
                                    <option value="{{ $product->id ?? "" }}">{{ $product->title ?? "" }}</option>
                                @endforeach
                            </select>
                        @endif
                        <label>Product Term: <span class="text-danger">*</span></label>
                        <div class="input-group" id="reservationdate" data-target-input="nearest">
                            <input name="product_term" type="text" class="form-control datetimepicker-input"
                                   data-target="#reservationdate"
                                   placeholder="{{__('Date')}}"
                            />
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                        <label>Remember:</label>
                        <div class="input-group" id="reservationdate2" data-target-input="nearest">
                            <input name="remember" type="text" class="form-control datetimepicker-input"
                                   data-target="#reservationdate2"
                                   placeholder="{{__('Date')}}"
                            />
                            <div class="input-group-append" data-target="#reservationdate2"
                                 data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                        <label class="col-form-label">{{__('Count')}}</label>
                            <div class="input-group">
                                <input type="number" name="count" class="form-control"
                                       value="{{old('count')}}"
                                       placeholder="{{__('Count')}}">
                            </div>
                    </div>
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                </fieldset>
                <button type="submit" class="btn btn-success">{{__('Submit')}}</button>
            </div>
        </form>
    </div>
    <!-- /input group addons -->

</div>

<!-- /content area -->

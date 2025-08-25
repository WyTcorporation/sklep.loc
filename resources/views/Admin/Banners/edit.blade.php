<!-- Page header -->
<section class="content-header">
{{--    <h1>{{$title}}</h1>--}}
</section>
<!-- /page header -->


<!-- Content area -->
<div class="content">
    <!-- Input group addons -->
    <div class="box card">
        <form role="form" enctype="multipart/form-data" method="POST"
              action="{{ route('banners.update',['banner' => $item->id ]) }}">

            @csrf
            @method('PUT')
            <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>
                <button type="submit" class="btn btn-success float-right">{{__('fields.Buttons.Save')}}</button>
            </div>
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
                                   aria-selected="false">{{__('fields.Menu.Image')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill"
                                   href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages"
                                   aria-selected="false">{{__('fields.Menu.Seo')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-configs-tab" data-toggle="pill"
                                   href="#custom-tabs-one-configs" role="tab" aria-controls="custom-tabs-one-configs"
                                   aria-selected="false">{{__('fields.Menu.Configs')}}</a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel"
                                 aria-labelledby="custom-tabs-one-home-tab">
                                <fieldset class="mb-3">
                                    @if($pages)
                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-2">{{__('admin.Pages.Title')}}<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-lg-10">
                                                <div class="input-group">
                                                    <select name="page_id" class="form-control select2"
                                                            style="width: 100%;">
                                                        @foreach($pages as $page)
                                                            <option
                                                                {{ $item->pages_id === $page->id? 'selected' :'' }}
                                                                value="{{ $page->id ?? "" }}"
                                                            >
                                                                {{ $page->title ?? "" }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{{__('fields.Link.Title')}}<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <input type="text" name="link" required class="form-control"
                                                       {{--                                                   value="{{__('fields.Link.Value')}}"--}}
                                                       value="{{ $item->link ?? __('fields.Link.Value') }}"
                                                       placeholder="{{__('fields.Link.Placeholder')}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{{__('fields.Title.Title')}}</label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <input type="text" name="title" class="form-control"
                                                       {{--                                                   value="{{__('fields.Title.Value')}}"--}}
                                                       value="{{ $item->title ?? __('fields.Title.Value') }}"
                                                       placeholder="{{__('fields.Title.Placeholder')}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{{__('fields.Text.Title')}}</label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <input type="text" name="text" class="form-control"
                                                       {{--                                                   value="{{__('fields.Text.Value')}}"--}}
                                                       value="{{ $item->text ?? __('fields.Text.Value') }}"
                                                       placeholder="{{__('fields.Text.Placeholder')}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{{__('fields.Buttons.Title')}}</label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <input type="text" name="button" class="form-control"
                                                       {{--                                                   value="{{__('fields.Buttons.Value')}}"--}}
                                                       value="{{ $item->button ?? __('fields.Buttons.Value') }}"
                                                       placeholder="{{__('fields.Buttons.Placeholder')}}">
                                            </div>
                                        </div>
                                    </div>

                                </fieldset>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel"
                                 aria-labelledby="custom-tabs-one-profile-tab">
                                <fieldset class="mb-3">
                                    <div class="form-group row">
                                        <label for="exampleInputFile">{{__('fields.Image.Title')}}<span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="image" class="custom-file-input"
                                                       id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">
                                                    {{ $item->src ?? __('fields.ChooseFile.Title') }}
                                                    {{--                                                {{__('fields.ChooseFile.Title')}}--}}
                                                </label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">{{__('fields.Upload.Title')}}</span>
                                            </div>
                                        </div>
                                        @if($item->src)
                                            <img width="250px" src="/{{$item->src}}" alt="{{ $item->alt ?? "" }}">
                                        @endif
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{{__('fields.Alt.Title')}}<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <input type="text" name="alt" required class="form-control"
                                                       {{--                                                   value="{{__('fields.Alt.Value')}}"--}}
                                                       value="{{ $item->alt ?? __('fields.Alt.Value') }}"
                                                       placeholder="{{__('fields.Alt.Placeholder')}}">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel"
                                 aria-labelledby="custom-tabs-one-messages-tab">
                                <fieldset class="mb-3">

                                </fieldset>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-one-configs" role="tabpanel"
                                 aria-labelledby="custom-tabs-one-configs-tab">
                                <fieldset class="mb-3">

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

<!-- Page header -->
<section class="content-header">
    {{--        <h1>{{$title}}</h1>--}}
</section>
<!-- /page header -->
<!-- Content area -->
<div class="content">
    <div class="box card">
        <form role="form" enctype="multipart/form-data" method="post" action="{{ route('products.categories.store') }}">
            @csrf
            @method('POST')
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
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{{__('fields.Title.Title')}}</label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <input type="text" name="title" class="form-control"
                                                       value="{{ $item->title ?? __('fields.Title.Value') }}"
                                                       placeholder="{{__('fields.Title.Placeholder')}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{{__('fields.Content.Title')}}<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <textarea
                                                    name="content"
                                                    class="form-control"
                                                    id="content"
                                                    placeholder="{{__('fields.Content.Placeholder')}}"
                                                >
                                               {{ $item->content ?? __('fields.Content.Title') }}
                                  </textarea>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel"
                                 aria-labelledby="custom-tabs-one-profile-tab">
                                <fieldset class="mb-3">
                                    <div class="form-group">
                                        <label for="exampleInputFile">{{__('fields.Icon.Title')}}<span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="icon" class="custom-file-input"
                                                       id="exampleInputFile">
                                                <label class="custom-file-label"
                                                       for="exampleInputFile">{{__('fields.ChooseFile.Title')}}</label>
                                                {{--                                            <label class="custom-file-label" for="exampleInputFile">{{ $item->src ?? __('ChooseFile') }}</label>--}}
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">{{__('fields.Upload.Title')}}</span>
                                            </div>
                                        </div>
                                        {{--                                    @if($item->src)--}}
                                        {{--                                        <img width="250px" src="/{{$item->src}}" alt="{{ $item->alt ?? "" }}">--}}
                                        {{--                                    @endif--}}
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">{{__('fields.Image.Title')}}<span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="image" class="custom-file-input"
                                                       id="exampleInputFile">
                                                <label class="custom-file-label"
                                                       for="exampleInputFile">{{__('fields.ChooseFile.Title')}}</label>
                                                {{--                                            <label class="custom-file-label" for="exampleInputFile">{{ $item->src ?? __('ChooseFile') }}</label>--}}
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">{{__('fields.Upload.Title')}}</span>
                                            </div>
                                        </div>
                                        {{--                                    @if($item->src)--}}
                                        {{--                                        <img width="250px" src="/{{$item->src}}" alt="{{ $item->alt ?? "" }}">--}}
                                        {{--                                    @endif--}}
                                    </div>

                                </fieldset>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel"
                                 aria-labelledby="custom-tabs-one-messages-tab">
                                <fieldset class="mb-3">
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{{__('admin.Seo.metaTitle')}}<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <input type="text" name="meta_title" required class="form-control"
                                                       value="{{ $item->meta_title ?? __('admin.Seo.metaTitle')}}"
                                                       placeholder="{{__('admin.Seo.metaTitle')}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{{__('admin.Seo.metaKey')}}<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <input type="text" name="meta_keys" class="form-control"
                                                       value="{{ $item->meta_keys ?? __('admin.Seo.metaKey') }}"
                                                       placeholder="{{__('admin.Seo.metaKey')}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{{__('admin.Seo.metaDesc')}}<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <input type="text" name="meta_description" class="form-control"
                                                       value="{{ $item->meta_description ?? __('admin.Seo.metaDesc') }}"
                                                       placeholder="{{__('admin.Seo.metaDesc')}}">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-one-configs" role="tabpanel"
                                 aria-labelledby="custom-tabs-one-configs-tab">
                                <fieldset class="mb-3">
 @if($categories)
                                        <div class="form-group">
                                            <label>{{__('fields.Categories.Title')}}</label>
                                            <select name="parent_id" class="form-control select2" style="width: 100%;">
                                                {{--                                            <option  {{ $item->parent_id === Null ?'selected':'' }} value="">{{__('ParentNull')}}</option>--}}
                                                <option value="">{{__('fields.Categories.ParentNull')}}</option>
                                                @foreach($categories as $category)
                                                    <option
                                                        {{--                                                    {{ $item->id === $category->id? 'disabled' :'' }}--}}
                                                        {{--                                                    {{ $item->parent_id === $category->id? 'selected' :'' }}--}}
                                                        value="{{ $category->id ?? "" }}"
                                                    >{{ $category->title ?? "" }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif

                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{{__('fields.SortOrder.Title')}}<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <input type="number" name="sort_order" class="form-control"
                                                       value="{{ $item->sort_order ?? __('fields.SortOrder.Value') }}"
                                                       placeholder="{{__('fields.SortOrder.Placeholder')}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{{__('fields.Alias.Title')}}<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <input type="text" name="url" class="form-control"
                                                       value="{{ $item->url ?? __('fields.Alias.Value') }}"
                                                       placeholder="{{__('fields.Alias.Placeholder')}}">
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

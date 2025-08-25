<!-- Page header -->
<section class="content-header">
    {{--        <h1>{{$title}}</h1>--}}
</section>
<!-- /page header -->
<!-- Content area -->
<div class="content">
    <div class="box card">
        <form role="form" enctype="multipart/form-data" method="post" action="{{ route('menus.store') }}">
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
                                                       value="{{ $item->title ?? old('title') }}"
                                                       placeholder="{{__('fields.Title.Placeholder')}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{{__('fields.Alias.Title')}}<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <input type="text" name="path" class="form-control"
                                                       value="{{ $item->path ?? old('path') }}"
                                                       placeholder="{{__('fields.Alias.Placeholder')}}">
                                            </div>
                                        </div>
                                    </div>

                                    @if($menus)
                                        <div class="form-group row">
                                            <label
                                                class="col-form-label col-lg-2">{{__('fields.Categories.Title')}}</label>
                                            <div class="col-lg-10">
                                                <div class="input-group">
                                                    <select name="parent" class="form-control select2"
                                                            style="width: 100%;">
                                                        <option
                                                            value="0">{{__('fields.Categories.ParentNull')}}</option>
                                                        @foreach($menus as $menu)
                                                            <option
                                                                value="{{ $menu->id ?? "" }}">{{ $menu->title ?? "" }}
                                                                - {{ $menu->path ?? "" }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="form-group row">
                                        <label
                                            class="col-form-label col-lg-2">{{__('fields.Type.Title')}}</label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <select name="type" class="form-control select2" style="width: 100%;">
                                                    <option value="admin">admin</option>
                                                    <option value="front">front</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{{__('fields.SortOrder.Title')}}<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <input type="text" name="sort_order" class="form-control"
                                                        value="{{ $item->sort_order ?? old('sort_order') }}"
                                                       placeholder="{{__('fields.SortOrder.Placeholder')}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="custom-control custom-checkbox">
                                            <input
                                                class="custom-control-input custom-control-input-green"
                                                type="checkbox"
                                                id="PermissionMenu"
                                                name="permission_menu"
                                            >
                                            <label for="PermissionMenu"
                                                   class="custom-control-label">{{__('fields.PermissionMenu.Title')}}</label>
                                        </div>
                                    </div>

                                </fieldset>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel"
                                 aria-labelledby="custom-tabs-one-profile-tab">
                                <fieldset class="mb-3">

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

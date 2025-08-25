<!-- Page header -->
<section class="content-header">
    {{--        <h1>{{$title}}</h1>--}}
</section>
<!-- /page header -->
<!-- Content area -->
<div class="content">
    <div class="box card">
        <form role="form" enctype="multipart/form-data" method="post"
              action="{{ route('products.update',['product' => $item->id ]) }}">
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
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-comments-tab" data-toggle="pill"
                                   href="#custom-tabs-one-comments" role="tab" aria-controls="custom-tabs-one-comments"
                                   aria-selected="false">{{__('fields.Menu.Comments')}}</a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel"
                                 aria-labelledby="custom-tabs-one-home-tab">
                                <fieldset class="mb-3">
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{{__('fields.Product_Code.Title')}}<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">#</span>
                                                </div>
                                                <input type="text" name="product_code" class="form-control"
                                                       value="{{ $item->product_code ?? __('fields.Product_Code.Value') }}"
                                                       placeholder="{{__('fields.Product_Code.Placeholder')}}">
                                            </div>
                                        </div>
                                    </div>

                                    @if($categories)
                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-2">{{__('fields.Categories.Title')}}
                                                <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-lg-10">
                                                <div class="input-group">
                                                    <select name="category_product_id" class="form-control select2"
                                                            style="width: 100%;">
                                                        @foreach($categories as $category)
                                                            <option
                                                                {{ $item->category_product_id === $category->id?'selected':'' }}
                                                                value="{{ $category->id ?? "" }}">
                                                                {{ $category->title ?? "" }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{{__('fields.Price.Title')}}<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">₴</span>
                                                </div>
                                                <input type="number" name="price" class="form-control"
                                                       value="{{ $item->price ?? __('fields.Price.Value') }}"
                                                       placeholder="{{__('fields.Price.Placeholder')}}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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
                                                    {{ $item->content ?? __('fields.Content.Value') }}
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{{__('fields.Characteristics.Title')}}
                                            <span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                            <textarea
                                                name="characteristics"
                                                class="form-control"
                                                id="characteristics"
                                                placeholder="{{__('fields.Characteristics.Placeholder')}}">
                                                   {{ $item->characteristics ?? __('fields.Characteristics.Title') }}
                                              </textarea>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel"
                                 aria-labelledby="custom-tabs-one-profile-tab">
                                <fieldset class="mb-3">
                                    <div class="card-body">
                                        <div id="actions" class="row">
                                            <div class="col-lg-6">
                                                <div class="btn-group w-100">
                                              <span class="btn btn-success col fileinput-button">
                                                <i class="fas fa-plus"></i>
                                                <span>Add files</span>
                                              </span>
                                                    <button type="button" class="btn btn-primary col start">
                                                        <i class="fas fa-upload"></i>
                                                        <span>Start upload</span>
                                                    </button>
                                                    <button type="reset" class="btn btn-warning col cancel">
                                                        <i class="fas fa-times-circle"></i>
                                                        <span>Cancel upload</span>
                                                    </button>
                                                    <div class="hidden">
                                                        <input id="images" name="images" type="text"
                                                               value="{{ json_encode($images) ?? "" }}"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 d-flex align-items-center">
                                                <div class="fileupload-process w-100">
                                                    <div id="total-progress" class="progress progress-striped active"
                                                         role="progressbar" aria-valuemin="0" aria-valuemax="100"
                                                         aria-valuenow="0">
                                                        <div class="progress-bar progress-bar-success" style="width:0%;"
                                                             data-dz-uploadprogress></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table table-striped files" id="previews">
                                            @if($images)
                                                @foreach($images as $image)
                                                    <div id=""
                                                         class="row mt-2 dz-processing dz-image-preview dz-complete"
                                                         data-path="{{$image['path']}}"
                                                         data-name="{{$image['name']}}"
                                                         data-sort-order="{{$image['sort_order']}}"
                                                         data-is-main="{{$image['is_main'] ? 1 : 0}}">
                                                        <div class="col-auto">
                                            <span class="preview">
                                                <img width="80" height="80"
                                                     src="{{$image['path']}}"
                                                     alt="{{$image['name']}}"
                                                     data-dz-thumbnail="">
                                            </span>
                                                        </div>
                                                        <div class="col d-flex align-items-center">
                                                            <p class="mb-0">
                                                                <span class="lead"
                                                                      data-dz-name="">{{$image['name']}}</span>
                                                            </p>
                                                            <strong class="error text-danger"
                                                                    data-dz-errormessage=""></strong>
                                                        </div>
                                                        <div class="col-4 d-flex align-items-center">
                                                            <div class="progress progress-striped active w-100"
                                                                 role="progressbar"
                                                                 aria-valuemin="0" aria-valuemax="100"
                                                                 aria-valuenow="0">
                                                                <div class="progress-bar progress-bar-success"
                                                                     style="width: 100%;"
                                                                     data-dz-uploadprogress=""></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-auto d-flex align-items-center">
                                                            <div class="btn-group">
                                                                <button class="btn btn-primary start"
                                                                        disabled="disabled"><i
                                                                        class="fas fa-upload"></i> <span>Start</span>
                                                                </button>
                                                                <button data-dz-remove=""
                                                                        class="btn btn-warning cancel"><i
                                                                        class="fas fa-times-circle"></i>
                                                                    <span>Cancel</span>
                                                                </button>
                                                                <button data-dz-remove="" class="btn btn-danger delete">
                                                                    <i
                                                                        class="fas fa-trash"></i> <span>Delete</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif


                                            <div id="template" class="row mt-2">
                                                <div class="col-auto">
                                            <span class="preview">
                                                  <img src="data:," alt="" data-dz-thumbnail/>
                                            </span>
                                                </div>
                                                <div class="col d-flex align-items-center">
                                                    <p class="mb-0">
                                                        <span class="lead" data-dz-name></span>
                                                        (<span data-dz-size></span>)
                                                    </p>
                                                    <strong class="error text-danger" data-dz-errormessage></strong>
                                                </div>
                                                <div class="col-4 d-flex align-items-center">
                                                    <div class="progress progress-striped active w-100"
                                                         role="progressbar"
                                                         aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                                        <div class="progress-bar progress-bar-success" style="width:0%;"
                                                             data-dz-uploadprogress></div>
                                                    </div>
                                                </div>
                                                <div class="col-auto d-flex align-items-center">
                                                    <div class="btn-group">
                                                        <button class="btn btn-primary start">
                                                            <i class="fas fa-upload"></i>
                                                            <span>Start</span>
                                                        </button>
                                                        <button data-dz-remove class="btn btn-warning cancel">
                                                            <i class="fas fa-times-circle"></i>
                                                            <span>Cancel</span>
                                                        </button>
                                                        <button data-dz-remove class="btn btn-danger delete">
                                                            <i class="fas fa-trash"></i>
                                                            <span>Delete</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel"
                                 aria-labelledby="custom-tabs-one-messages-tab">
                                <fieldset class="mb-3">
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
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{{__('fields.New.Title')}}</label>
                                        <div class="col-lg-10">
                                            <input type="checkbox" name="new"
                                                   {{ $item->new === 1?'checked':'' }} data-bootstrap-switch>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{{__('fields.Hit.Title')}}</label>
                                        <div class="col-lg-10">
                                            <input type="checkbox" name="hit"
                                                   {{ $item->hit === 1?'checked':'' }} data-bootstrap-switch
                                                   data-off-color="danger" data-on-color="success">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{{__('fields.Status.Title')}}</label>
                                        <div class="col-lg-10">
                                            <select name="status" class="form-control select2" style="width: 100%;">
                                                @foreach($status as $key=>$val)
                                                    <option
                                                        {{ $item->status === $key?'selected':'' }}
                                                        value="{{ $key}}">
                                                        {{$val}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-one-comments" role="tabpanel"
                                 aria-labelledby="custom-tabs-one-configs-tab">
                                <fieldset class="mb-3">
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{{__('fields.Fio.Title')}}</label>
                                        <div class="col-lg-10">
                                            <input type="text" name="comments[fio]" class="form-control"
                                                   value="{{ $item->fio ?? old('fio') }}"
                                                   placeholder="{{__('fields.Fio.Placeholder')}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{{__('fields.Content.Title')}}</label>
                                        <div class="col-lg-10">
                                            <textarea  name="comments[content]" class="form-control"
                                                       placeholder="{{__('fields.Content.Placeholder')}}"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{{__('fields.Starts.Title')}}</label>
                                        <div class="col-lg-10">
                                            <select name="comments[starts]" class="form-control" style="width: 100%;">
                                                @for($x=0;$x<6;$x++)
                                                    <option value="{{$x}}">{{$x}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </fieldset>
                                <hr>
                                @if(!empty($comments))
                                    @foreach($comments as $comment)
                                        <fieldset class="mb-3">
                                            <input type="hidden" name="commentsUpdate[{{$comment->id}}][id]"
                                                   value="{{ $comment->id ?? old('id') }}">
                                            <div class="form-group row">
                                                <label class="col-form-label col-lg-2">{{__('fields.Fio.Title')}}</label>
                                                <div class="col-lg-10">
                                                    <input type="text" name="commentsUpdate[{{$comment->id}}][fio]" class="form-control"
                                                           value="{{ $comment->fio ?? old('fio') }}"
                                                           placeholder="{{__('fields.Fio.Placeholder')}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-lg-2">{{__('fields.Content.Title')}}</label>
                                                <div class="col-lg-10">
                                            <textarea  name="commentsUpdate[{{$comment->id}}][content]" class="form-control"
                                                       placeholder="{{__('fields.Content.Placeholder')}}">{{ $comment->content ?? old('fio') }}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-lg-2">{{__('fields.Starts.Title')}}</label>
                                                <div class="col-lg-10">
                                                    <select name="commentsUpdate[{{$comment->id}}][starts]" class="form-control" style="width: 100%;">
                                                        @for($x=0;$x<6;$x++)
                                                            <option @if($x ===$comment->starts) selected @endif value="{{$x}}">{{$x}}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <hr>
                                    @endforeach
                                @endif
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


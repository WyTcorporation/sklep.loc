@foreach($items as $item)
    <li class="active">
        <a href="{{ route('categories.show',['category'=>$item->url]) }}">
            {{$item->title}} <small>({{count($item->products)}})</small>
        </a>
    </li>
@endforeach

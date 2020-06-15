<ul class="h-100 d-flex align-items-center justify-content-between">

    @php

        if (Voyager::translatable($items)) {
            $items = $items->load('translations');
        }

    @endphp

    @foreach ($items as $item)

        @php

            $originalItem = $item;
            if (Voyager::translatable($item)) {
                $item = $item->translate($options->locale);
            }

            $isActive = null;
            $styles = null;
            $icon = null;

            // Background Color or Color
            if (isset($options->color) && $options->color == true) {
                $styles = 'color:'.$item->color;
            }
            if (isset($options->background) && $options->background == true) {
                $styles = 'background-color:'.$item->color;
            }

            // Check if link is current
            if(url($item->link()) == url()->current()){
                $isActive = 'class="active"';
            }

            // Set Icon
            if(isset($item->icon_class)){
                $icon = '<i class="' . $item->icon_class . '"></i>';
            }

        @endphp

        <li {!!$isActive!!}>
            <a href="{{ url($item->link()) }}" target="{{ $item->target }}" style="{{ $styles }}">
                {!! $icon !!}{{ $item->title }}
            </a>
        </li>
    @endforeach

</ul>

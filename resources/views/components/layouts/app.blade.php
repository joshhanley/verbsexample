<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    {{ $slot }}
    @ray(app(\Thunk\Verbs\Lifecycle\EphemeralEventQueue::class))
    <script src="verbs-livewire.js" verbs:snapshot="{!! \Livewire\Drawer\Utils::escapeStringForHtml(app(\Thunk\Verbs\Lifecycle\EphemeralEventQueue::class)->dehydrate()) !!}"></script>
</body>

</html>

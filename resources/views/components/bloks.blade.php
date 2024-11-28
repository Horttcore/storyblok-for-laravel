@props(['bloks'])

<div {{ $attributes }}>
    @foreach ($bloks as $blok)
        <x-blok :blok="$blok" />
    @endforeach
</div>

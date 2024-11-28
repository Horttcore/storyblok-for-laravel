@props(['blok'])

<x-dynamic-component :component="'bloks.' . $blok['component']" :blok="$blok" />

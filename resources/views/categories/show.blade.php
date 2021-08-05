@extends('layout')
@section('title', __('categories.show', ['name' => $category->name]))

@section('content')

    <h3 class="text-lg font-semibold">{{ __('categories.profile') }}</h3>
    <div class="mb-6 bg-white sm:rounded-lg shadow overflow-hidden">
        <div>
            <dl>
                <div class="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm text-gray-500">
                        {{ __('common.name') }}
                    </dt>
                    <dd class="sm:col-span-2">
                        {{ $category->name }}
                    </dd>
                </div>
                <div class="px-4 py-5 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm text-gray-500">
                        {{ __('common.description') }}
                    </dt>
                    <dd class="sm:col-span-2">
                        {{ $category->description }}
                    </dd>
                </div>
                <div class="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm text-gray-500">
                        {{ __('common.file') }}
                    </dt>
                    <dd class="sm:col-span-2">
                        <code class="text-sm text-pink-500">
                            {{ $category->tagfile }}
                        </code>
                    </dd>
                </div>
                <div class="px-4 py-5 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm text-gray-500">
                        {{ __('common.entities') }}
                    </dt>
                    <dd class="sm:col-span-2">
                        <ul class="list-inside list-decimal">
                            @forelse ($category->entities as $entity)
                                <li><a class="text-blue-500 hover:underline" href="{{ route('entities.show', $entity) }}">{{ $entity->name_en ?: $entity->entityid }}</a></li>
                            @empty
                                {{ __('categories.no_entities') }}
                            @endforelse
                        </ul>
                    </dd>
                </div>
            </dl>
        </div>
        <div class="px-6 py-3 bg-gray-100">
            <x-buttons.back href="{{ route('categories.index') }}"/>
            <a class="px-4 py-2 bg-yellow-300 text-yellow-600 hover:bg-yellow-200 rounded shadow" href="{{ route('categories.edit', $category) }}">{{ __('common.edit') }}</a>

            <x-forms.destroy-category :category="$category"/>

        </div>
    </div>

@endsection
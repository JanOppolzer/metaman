@extends('layout')
@section('title', __('entities.show', ['name' => $entity->name_en]))

@section('content')

    @include('entities.navigation')

    <h3 class="text-lg font-semibold">{{ __('entities.profile') }}</h3>
    <div class="mb-6 bg-white dark:bg-gray-800 sm:rounded-lg shadow overflow-hidden">
        <div>
            <dl>
                <div class="px-4 py-5 bg-gray-50 dark:bg-gray-900 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm text-gray-500">{{ __('common.name') }}</dt>
                    <dd class="sm:col-span-2">
                        <span class="pr-4">{{ $entity->name_en ?? __('entities.no_name') }}</span>
                        <x-pils.approved :model="$entity"/>
                        <x-pils.status :model="$entity"/>
                        <x-pils.state :model="$entity"/>
                    </dd>
                </div>
                <div class="px-4 py-5 bg-white dark:bg-gray-800 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm text-gray-500">{{ __('common.description') }}</dt>
                    <dd class="sm:col-span-2">{{ $entity->description_en ?? __('entities.no_description') }}</dd>
                </div>
                <div class="px-4 py-5 bg-gray-50 dark:bg-gray-900 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm text-gray-500">{{ __('common.entityid') }}</dt>
                    <dd class="sm:col-span-2"><code class="text-sm text-pink-500">{{ $entity->entityid }}</code></dd>
                </div>
                <div class="px-4 py-5 bg-white dark:bg-gray-800 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm text-gray-500">{{ __('common.type') }}</dt>
                    <dd class="sm:col-span-2">{{ $entity->kind }}</dd>
                </div>
                <div class="px-4 py-5 bg-gray-50 dark:bg-gray-900 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm text-gray-500">{{ __('common.categories') }}</dt>
                    <dd class="sm:col-span-2">
                        <x-pils.rs category="{{ $entity->rs }}"/>
                        <x-pils.cocov1 category="{{ $entity->cocov1 }}"/>
                        <x-pils.sirtfi category="{{ $entity->sirtfi }}"/>
                        <x-pils.hfd category="{{ $entity->hfd }}"/>
                    </dd>
                </div>
                <div class="px-4 py-5 bg-white dark:bg-gray-800 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm text-gray-500">{{ __('common.edugain_membership') }}</dt>
                    <dd class="sm:col-span-2">
                        @if ($entity->edugain)
                            {{ __('common.yes') }}
                        @else
                            {{ __('common.no') }}
                        @endif
                    </dd>
                </div>
                @can('update', $entity)
                    <div class="px-4 py-5 bg-gray-50 dark:bg-gray-800 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm text-gray-500">{{ __('common.file') }}</dt>
                        <dd class="sm:col-span-2"><code class="text-sm text-pink-500">{{ $entity->file }}</code></dd>
                    </div>
                @endcan
                @can('do-everything')
                    @if ($entity->type === 'idp')
                        <div class="px-4 py-5 bg-white dark:bg-gray-800 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm text-gray-500">
                                {{ __('common.category') }}
                            </dt>
                            <dd class="sm:col-span-2">
                                <form class="inline-block" action="{{ route('entities.update', $entity) }}" method="post">
                                    @csrf
                                    @method('patch')
                                    <input type="hidden" name="action" value="category">
                                    <select class="text-sm rounded" name="category" id="category">
                                        <option value="">{{ __('categories.select_category') }}</option>
                                        @forelse ($categories as $category)
                                            <option value="{{ $category->id }}" @if($category->id === $entity->category_id) {{ "selected" }} @endif>{{ $category->name }}</option>
                                        @empty
                                            <option value="">{{ __('categories.no_categories') }}</option>
                                        @endforelse
                                    </select>
                                    <button class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-gray-50 rounded shadow" type="reset">{{ __('common.reset') }}</button>
                                    <x-buttons.submit text="Update"/>
                                </form>
                            </dd>
                        </div>
                    @endif
                @endcan
            </dl>
        </div>
        <div class="px-6 py-3 bg-gray-100">
            <x-buttons.back href="{{ route('entities.index') }}"/>

            @can('update', $entity)
                @unless ($entity->trashed())
                    <a class="px-4 py-2 bg-yellow-300 text-yellow-600 hover:bg-yellow-200 rounded shadow" href="{{ route('entities.edit', $entity) }}">{{ __('common.edit') }}</a>
                @endunless
            @endcan

            <x-forms.edugain-membership :entity="$entity"/>
            <x-forms.hide-from-discovery :entity="$entity"/>
            <x-forms.change-status route="entities" :model="$entity"/>
            <x-forms.change-state route="entities" :model="$entity"/>
            <x-forms.destroy route="entities" :model="$entity"/>

            <x-modals.confirm :model="$entity" form="status"/>
        </div>
    </div>

@endsection
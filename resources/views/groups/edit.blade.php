@extends('layout')
@section('title', __('groups.edit', ['name' => $group->name]))

@section('content')

    <form action="{{ route('groups.update', $group) }}" method="post">
        @csrf
        @method('patch')
        <div class="mb-6 bg-white sm:rounded-lg shadow overflow-hidden">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg font-semibold">
                    {{ __('groups.profile') }}
                </h3>
            </div>
            <div class="border-t border-gray-300">
                <dl>
                    <div class="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm text-gray-500">
                            <label class="text-sm" for="name">
                                {{ __('common.name') }}
                            </label>
                        </dt>
                        <dd class="sm:col-span-2">
                            {!! $errors->first('name', '<div class="text-red-600 text-sm font-semibold float-right">:message</div>') !!}
                            <input class="text-sm dark:bg-transparent @error('name') border-red-500 border @else @if(old('name') !== null) border-green-500 @endif @enderror focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm border-gray-300 dark:border-gray-700 rounded-md" type="text" name="name" id="name" maxlength="32" placeholder="{{ __('groups.name_placeholder') }}" value="{{ $group->name }}" required>
                        </dd>
                    </div>
                    <div class="px-4 py-5 bg-white dark:bg-gray-800 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm text-gray-500">
                            <label class="text-sm" for="name">{{ __('common.description') }}</label>
                        </dt>
                        <dd class="sm:col-span-2">
                            {!! $errors->first('description', '<div class="text-red-600 text-sm font-semibold float-right">:message</div>') !!}
                            <input class="text-sm dark:bg-transparent @error('description') border-red-500 border @else @if(old('description') !== null) border-green-500 @endif @enderror focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm border-gray-300 dark:border-gray-700 rounded-md" type="text" name="description" id="description" maxlength="255" placeholder="{{ __('groups.description_placeholder') }}" value="{{ $group->description }}" required>
                        </dd>
                    </div>    
                    <div class="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm text-gray-500">
                            <label class="text-sm" for="name">
                                {{ __('common.file') }}
                            </label>
                        </dt>
                        <dd class="sm:col-span-2">
                            {!! $errors->first('tagfile', '<div class="text-red-600 text-sm font-semibold float-right">:message</div>') !!}
                            <input class="text-sm dark:bg-transparent @error('tagfile') border-red-500 border @else @if(old('tagfile') !== null) border-green-500 @endif @enderror focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm border-gray-300 dark:border-gray-700 rounded-md" type="text" name="tagfile" id="tagfile" maxlength="36" placeholder="{{ __('groups.file_placeholder') }}" value="{{ $group->tagfile }}" required>
                        </dd>
                    </div>
                </dl>
            </div>
            <div class="px-4 py-4 bg-gray-100">
                <x-buttons.back href="{{ route('groups.index') }}"/>
                <x-buttons.submit text="{{ __('groups.update') }}"/>
            </div>
    </form>

@endsection
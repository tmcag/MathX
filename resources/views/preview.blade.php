@extends('layout')

@section('content')

    <div class="min-h-screen bg-slate-50 px-4 py-10">
        <div class="mx-auto max-w-4xl">
            <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                <span class="text-sm font-semibold uppercase tracking-wider text-indigo-600">
                    Matemática
                </span>

                    <h1 class="mt-2 text-3xl font-bold tracking-tight text-slate-900">
                        Lista de exercícios
                    </h1>

                    <p class="mt-2 text-sm text-slate-500">
                        Resolva os exercícios e teste seus conhecimentos.
                    </p>
                </div>

                <a href="{{ route('home') }}"
                   class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-100">
                    Voltar
                </a>
            </div>

            <div class="mb-8 grid grid-cols-1 gap-4 sm:grid-cols-3">
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm font-medium text-slate-500">Total de exercícios</p>
                    <p class="mt-2 text-2xl font-bold text-slate-900">{{ count($exercises) }}</p>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm font-medium text-slate-500">Matéria</p>
                    <p class="mt-2 text-2xl font-bold text-slate-900">Matemática</p>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                <div class="mb-6 flex items-center justify-between">
                    <h2 class="text-lg font-bold text-slate-900">
                        Exercícios
                    </h2>

                    <span class="rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-600">
                    {{ count($exercises) }} questões
                </span>
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    @foreach($exercises as $exercise)
                        <div class="flex items-center justify-between rounded-xl border border-slate-200 p-4">
                            <span class="text-sm font-medium text-slate-500">
                                <!-- Adiciona um 0 antes dos números que contem apenas um algarismo -->
                                Questão {{ str_pad($exercise['id'] + 1, 2, '0', STR_PAD_LEFT) }}
                            </span>
                            <span class="text-xl font-bold text-slate-900">{{ $exercise['exercise'] }} = </span>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8 flex flex-col gap-3 border-t border-slate-100 pt-6 sm:flex-row sm:justify-end">
                    <a href="{{ route('exercises-export') }}"
                            class="rounded-xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                        Baixar exercícios
                    </a>

                    <a href="{{ route('exercises-print') }}"
                            class="rounded-xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                        Imprimir exercícios
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

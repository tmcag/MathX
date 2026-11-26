@extends('layout')

@section('content')
    <div class="min-h-screen bg-slate-50 flex items-center justify-center p-6">
        <div class="w-full max-w-2xl bg-white rounded-2xl shadow-xl border border-slate-100 p-8">
            <div class="mb-8">
            <span class="text-sm font-semibold text-indigo-600 uppercase tracking-wider">
                Gerador de exercícios
            </span>

                <h1 class="text-3xl font-bold text-slate-800 mt-2">
                    Monte sua lista
                </h1>

                <p class="text-slate-500 mt-2">
                    Configure as operações e os números para gerar seus exercícios.
                </p>
            </div>

            <form class="space-y-7" method="POST" action="{{ route('exercises-generate') }}">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-3">
                        Operações matemáticas
                    </label>

                    <div class="grid grid-cols-2 gap-4">

                        <label class="cursor-pointer">
                            <input type="checkbox" name="operations[]" value="addition"
                                   @checked(in_array('addition', old('operations', [])))
                                   class="peer sr-only">

                            <div class="flex items-center gap-3 p-4 rounded-xl border-2 border-slate-200
                                    peer-checked:border-indigo-500 peer-checked:bg-indigo-50
                                    transition-all duration-200 hover:border-indigo-300">

                                <div class="w-10 h-10 flex items-center justify-center rounded-lg
                                        bg-emerald-100 text-emerald-600 text-xl font-bold">
                                    +
                                </div>

                                <span class="font-medium text-slate-700">
                                Adição
                            </span>
                            </div>
                        </label>

                        <label class="cursor-pointer">
                            <input type="checkbox" name="operations[]" value="subtraction"
                                   @checked(in_array('subtraction', old('operations', [])))
                                   class="peer sr-only">

                            <div class="flex items-center gap-3 p-4 rounded-xl border-2 border-slate-200
                                    peer-checked:border-indigo-500 peer-checked:bg-indigo-50
                                    transition-all duration-200 hover:border-indigo-300">

                                <div class="w-10 h-10 flex items-center justify-center rounded-lg
                                        bg-rose-100 text-rose-600 text-xl font-bold">
                                    −
                                </div>

                                <span class="font-medium text-slate-700">
                                Subtração
                            </span>
                            </div>
                        </label>

                        <label class="cursor-pointer">
                            <input type="checkbox" name="operations[]" value="multiplication"
                                   @checked(in_array('multiplication', old('operations', [])))
                                   class="peer sr-only">

                            <div class="flex items-center gap-3 p-4 rounded-xl border-2 border-slate-200
                                    peer-checked:border-indigo-500 peer-checked:bg-indigo-50
                                    transition-all duration-200 hover:border-indigo-300">

                                <div class="w-10 h-10 flex items-center justify-center rounded-lg
                                        bg-amber-100 text-amber-600 text-xl font-bold">
                                    ×
                                </div>

                                <span class="font-medium text-slate-700">
                                Multiplicação
                            </span>
                            </div>
                        </label>

                        <label class="cursor-pointer">
                            <input type="checkbox" name="operations[]" value="division"
                                   @checked(in_array('division', old('operations', [])))
                                   class="peer sr-only">

                            <div class="flex items-center gap-3 p-4 rounded-xl border-2 border-slate-200
                                    peer-checked:border-indigo-500 peer-checked:bg-indigo-50
                                    transition-all duration-200 hover:border-indigo-300">

                                <div class="w-10 h-10 flex items-center justify-center rounded-lg
                                        bg-sky-100 text-sky-600 text-xl font-bold">
                                    ÷
                                </div>

                                <span class="font-medium text-slate-700">
                                Divisão
                            </span>
                            </div>
                        </label>

                    </div>

                    @error('operations[]')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-3">
                        Intervalo dos números
                    </label>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="minimum" class="block text-sm text-slate-500 mb-2">
                                Valor mínimo
                            </label>

                            <input
                                type="number"
                                name="minimum"
                                id="minimum"
                                value="{{ old('minimum') }}"
                                placeholder="Ex: 1"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500/20
                                   focus:border-indigo-500 transition"
                            >

                            @error('minimum')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="maximum" class="block text-sm text-slate-500 mb-2">
                                Valor máximo
                            </label>

                            <input
                                type="number"
                                name="maximum"
                                id="maximum"
                                value="{{ old('maximum') }}"
                                placeholder="Ex: 100"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500/20
                                   focus:border-indigo-500 transition"
                            >


                            @error('maximum')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div>
                    <label for="quantity" class="block text-sm font-semibold text-slate-700 mb-3">
                        Quantidade de exercícios
                    </label>

                    <input
                        type="number"
                        name="quantity"
                        id="quantity"
                        value="{{ old('quantity') }}"
                        placeholder="Ex: 20"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200
                           focus:outline-none focus:ring-2 focus:ring-indigo-500/20
                           focus:border-indigo-500 transition"
                    >

                    @error('quantity')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <button
                    type="submit"
                    class="w-full flex items-center justify-center gap-2 cursor-pointer
                       bg-indigo-600 hover:bg-indigo-700 text-white font-semibold
                       py-4 px-6 rounded-xl shadow-lg shadow-indigo-600/20
                       transition-all duration-200 hover:-translate-y-0.5">

                    <span>Gerar exercícios</span>
                </button>
            </form>
        </div>
    </div>
@endsection

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use const PHP_EOL;

class MainController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function generateExercises(Request $request)
    {
        $rules = [
            'operations' => 'required|array|min:1',
            'operations.*' => 'required|in:addition,division,multiplication,subtraction',
            'minimum' => 'required|numeric|min:0|max:999|lt:maximum',
            'maximum' => 'required|numeric|min:0|max:999|gt:minimum',
            'quantity' => 'required|integer|min:1|max:999'
        ];

        $messages = [
            'operations.required' => 'Selecione pelo menos uma operação.',
            'operations.min' => 'Selecione pelo menos uma operação.',
            'operations.*.in' => 'Uma operação selecionada é inválida.',

            'minimum.required' => 'Campo obrigatório.',
            'minimum.numeric' => 'O valor precisa ser um número.',
            'minimum.min' => 'O valor precisa ser no mínimo :min.',
            'minimum.max' => 'O valor precisa ser no máximo :max.',
            'minimum.lt' => 'O valor precisa ser menor que o máximo.',

            'maximum.required' => 'Campo obrigatório.',
            'maximum.numeric' => 'O valor precisa ser um número.',
            'maximum.min' => 'O valor precisa ser no mínimo :min.',
            'maximum.max' => 'O valor precisa ser no máximo :max.',
            'maximum.gt' => 'O máximo precisa ser maior que o mínimo.',

            'quantity.required' => 'Campo obrigatório.',
            'quantity.integer' => 'A quantidade precisa ser um número inteiro.',
            'quantity.min' => 'A quantidade precisa ser de no mínimo :min.',
            'quantity.max' => 'A quantidade precisa ser de no máximo :max.',
        ];

        $request->validate($rules, $messages);

        $operations = $request->operations;
        $quantity = $request->quantity;

        $min = $request->minimum;
        $max = $request->maximum;

        $exercises = [];

        for ($i = 0; $i < $quantity; $i++) {
            $random = array_rand($operations);
            $operation = $operations[$random];

            $num1 = rand($min, $max);
            $num2 = rand($min, $max);

            $exercise = '';
            $solution = '';

            switch ($operation) {
                case 'addition':
                    $exercise = "$num1 + $num2";
                    $solution = $num1 + $num2;
                    break;
                case 'division':
                    $exercise = "$num1 : $num2";
                    $solution = $num2 === 0 ? 'Impossível dividir' : $num1 / $num2;
                    break;
                case 'multiplication':
                    $exercise = "$num1 x $num2";
                    $solution = $num1 * $num2;
                    break;
                case 'subtraction':
                    $exercise = "$num1 - $num2";
                    $solution = $num1 - $num2;
            }

            if (is_float($solution)) $solution = round($solution, 2);

            $exercises[] = [
                'id' => $i,
                'operation' => $operation,
                'exercise' => $exercise,
                'solution' => "$exercise = $solution",
            ];

            session(['exercises' => $exercises]);
        }

        return view('preview', ['exercises' => $exercises]);
    }

    public function printExercises(Request $request)
    {
        if (! session()->has('exercises')) {
            return redirect()->route('home');
        }

        $exercises = session('exercises');

        echo '<pre>';
        echo '<h1>Exercícios de Matemática</h1>';
        echo '<hr>';

        foreach ($exercises as $exercise) {
            echo '<h2>' . $exercise['exercise'] . ' = </h2>';
        }

        echo '<hr>';
        echo '<h3>Soluções</h3>';

        foreach ($exercises as $exercise) {
            echo '<h2>'. $exercise['solution'] . '</h2>';
        }

        return null;
    }

    public function exportExercises(Request $request)
    {
        if (! session()->has('exercises')) {
            return redirect()->route('home');
        }

        $exercises = session('exercises');

        $fileName = 'exercises_mathX' . date('YmdHis') . '.txt';
        $content = '';

        foreach ($exercises as $exercise) {
            $content .= $exercise['id'] . ' > '  . $exercise['exercise'] . PHP_EOL;
        }

        $content .= PHP_EOL . PHP_EOL;

        foreach ($exercises as $exercise) {
            $content .= $exercise['id'] . ' > '  . $exercise['solution'] . PHP_EOL;
        }

        return response($content)
            ->header('Content-Type', 'text/plain')
            ->header('Content-Disposition', 'attachment; filename=' . $fileName);
    }
}

<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/aluno')->group(function(){

    Route::get('/', function(){

        $dados = array(
            array(1, "Ana"),
            array(2, "Bruno"),
            array(3, "Carol"),
            array(4, "Danilo"),
            array(5, "Ellen")
        );

        $alunos = "<ul>";
        foreach($dados as $aluno) {
            $alunos .= "<li>$aluno[0] - $aluno[1]</li>";
        }
        $alunos .= "</ul>";
        return $alunos;


    })->name('aluno');

    Route::get('/limite/{total}', function($total) {

        $dados = array(
            array(1, "Ana"),
            array(2, "Bruno"),
            array(3, "Carol"),
            array(4, "Danilo"),
            array(5, "Ellen")
        );

        $alunos = "<ul>";

        if($total <= count($dados)) {
            $cont = 0;
            foreach($dados as $aluno) {
                $alunos .= "<li>$aluno[0] - $aluno[1]</li>";
                $cont++;
                if($cont >= $total) break;
            }
        }
        else {
            $alunos = $alunos."<li>Tamanho Máximo = ".count($dados)."</li>";
        }

        $alunos .= "</ul>";
        return $alunos;

    })->name('aluno.limite')->where('total', '[0-9]+');

    Route::get('/matricula/{matricula}', function($matricula) {

        $dados = array(
            array(1, "Ana"),
            array(2, "Bruno"),
            array(3, "Carol"),
            array(4, "Danilo"),
            array(5, "Ellen")
        );

        $alunos = "<ul>";
        foreach($dados as $aluno) {
            if($aluno[0] == $matricula){
                $alunos .= "<li>$aluno[0] - $aluno[1]</li>";
                $alunos .= "</ul>";
                return $alunos;
            }
        }
        $alunos .= "<li>NÃO ENCONTRADO!</li></ul>";
        return $alunos;

    })->name('aluno.matricula')->where('matricula', '[0-9]+');

    Route::get('/nome/{nome}', function($nome) {
        $dados = array(
            array(1, "Ana"),
            array(2, "Bruno"),
            array(3, "Carol"),
            array(4, "Danilo"),
            array(5, "Ellen")
        );

        $alunos = "<ul>";
        foreach($dados as $aluno) {
            if($aluno[1] == $nome){
                $alunos .= "<li>$aluno[0] - $aluno[1]</li>";
                $alunos .= "</ul>";
                return $alunos;
            }
        }
        $alunos .= "<li>NÃO ENCONTRADO!</li></ul>";
        return $alunos;
    })->name('aluno.nome')->where('nome', '[A-Za-z]+');

});

Route::prefix('/nota')->group(function() {

    Route::get('/', function() {
        $dados = array(
            array(1, "Ana", "9"),
            array(2, "Bruno", "2"),
            array(3, "Carol", "8"),
            array(4, "Danilo", "5"),
            array(5, "Ellen", "4")
        );
        $notas = "<table>
                    <tr>
                        <th>Matricula</th>
                        <th>Aluno</th>
                        <th>Nota</th>
                    </tr>";

        foreach($dados as $aluno) {
            $notas .= "<tr><td>$aluno[0]</td><td>$aluno[1]</td><td>$aluno[2]</td></tr>";
        }
        $notas .= "</table>";
        return $notas;

    })->name('nota');
    
    Route::get('/limite/{total}', function($total) {
        $dados = array(
            array(1, "Ana", "9"),
            array(2, "Bruno", "2"),
            array(3, "Carol", "8"),
            array(4, "Danilo", "5"),
            array(5, "Ellen", "4")
        );
        if($total <= count($dados)) {
            $notas = "<table>
                        <tr>
                            <th>Matricula</th>
                            <th>Aluno</th>
                            <th>Nota</th>
                        </tr>";
            $cont = 0;
            foreach($dados as $aluno) {
                $notas .= "<tr><td>$aluno[0]</td><td>$aluno[1]</td><td>$aluno[2]</td></tr>";
                $cont++;
                if($cont >= $total) break;
            }
            $notas .= "</table>";
        }
        else {
            $notas = "<ul><li>Tamanho Máximo = ".count($dados)."</li></ul>";
        }
        return $notas;

    })->name('nota.limite')->where('total', '[0-9]+');
    
    Route::get('/lancar/{nota}/{matricula}/{nome?}', function($nota,$matricula, $nome=null) {
        $dados = array(
            array(1, "Ana", "9"),
            array(2, "Bruno", "2"),
            array(3, "Carol", "8"),
            array(4, "Danilo", "5"),
            array(5, "Ellen", "4")
        );
        $flag = false;
        $notas = "<table>
                    <tr>
                        <th>Matricula</th>
                        <th>Aluno</th>
                        <th>Nota</th>
                    </tr>";
        foreach($dados as $aluno) {
            if($aluno[0] == $matricula && ($nome == null || $nome == $aluno[1])  ){
                $aluno[2] = $nota;
                $flag = true;
            }

            $notas .= "<tr><td>$aluno[0]</td><td>$aluno[1]</td><td>$aluno[2]</td></tr>";
        }
        $notas .= "</table>";
        if($flag ){
            return $notas;
        }
        return "<ul><li>NAO ENCONTRADO</li></ul>";

    })->name('nota.lancar')->where('nota', '[0-9]+')->where('matricula', '[0-9]+');
    
    Route::get('/conceito/{A}/{B}/{C}', function($A,$B, $C) {
        $dados = array(
            array(1, "Ana", 9),
            array(2, "Bruno", 2),
            array(3, "Carol", 8),
            array(4, "Danilo", 6),
            array(5, "Ellen", 4)
        );
        $notas = "<table>
                    <tr>
                        <th>Matricula</th>
                        <th>Aluno</th>
                        <th>Nota</th>
                    </tr>";
        foreach($dados as $aluno) {
            $conceito = "D";
            if($aluno[2] >= $A){
                $conceito = "A";
            }else if($aluno[2] >= $B){
                $conceito = "B";
            }else if($aluno[2] >= $C){
                $conceito = "C";
            }

            $notas .= "<tr><td>$aluno[0]</td><td>$aluno[1]</td><td>$conceito</td></tr>";
        }
        $notas .= "</table>";
        return $notas;

    })->name('nota.conceito')->where('A', '[0-9]+')->where('B', '[0-9]+')->where('C', '[0-9]+');
    
    Route::post('/conceito', function(Request $request) {
        
        $data = $request->all();
        $A = $data['A'];
        $B = $data['B'];
        $C = $data['C'];
        
        $dados = array(
            array(1, "Ana", 9),
            array(2, "Bruno", 2),
            array(3, "Carol", 8),
            array(4, "Danilo", 6),
            array(5, "Ellen", 4)
        );
        $alunos = "";
        foreach($dados as $aluno) {
            $conceito = "D";
            if($aluno[2] >= $A){
                $conceito = "A";
            }else if($aluno[2] >= $B){
                $conceito = "B";
            }else if($aluno[2] >= $C){
                $conceito = "C";
            }

            $alunos .= "$aluno[0] - $aluno[1] - $conceito\n";
        }
        return $alunos;
    });
});

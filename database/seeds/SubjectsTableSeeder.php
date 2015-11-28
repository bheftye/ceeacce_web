<?php

use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /******************* Primer modulo ************************/
        DB::table('subjects')->insert([
            'id' => 1,
            'clv' => "C-TLR01",
            'name' => "Taller de Lectura y Redacción I",
            'module' => 1,
            'credits' => 2.6,
            'length' => 2,
            'order' => 1,
        ]);

        DB::table('subjects')->insert([
            'id' => 2,
            'clv' => "C-ETI01",
            'name' => "Etimologías Grecolatinas",
            'module' => 1,
            'credits' => 5.2,
            'length' => 4,
            'order' => 2,
        ]);

        DB::table('subjects')->insert([
            'id' => 3,
            'clv' => "M-MAT01",
            'name' => "Matemáticas I",
            'module' => 1,
            'credits' => 5.2,
            'length' => 4,
            'order' => 3,
        ]);

        DB::table('subjects')->insert([
            'id' => 4,
            'clv' => "CE-QUI01",
            'name' => "Química I",
            'module' => 1,
            'credits' => 5.7,
            'length' => 4,
            'order' => 4,
        ]);

        DB::table('subjects')->insert([
            'id' => 5,
            'clv' => "C-ING01",
            'name' => "Inglés I",
            'module' => 1,
            'credits' => 2.6,
            'length' => 2,
            'order' => 5,
        ]);

 /*
 * "C-TLR01   ";"Taller de Lectura y Redacción I";TRUE;2.6;2
 * "C-ETI01   ";"Etimologías Grecolatinas";FALSE;5.2;4
 * "M-MAT01   ";"Matemáticas I";TRUE;5.2;4
 * "CE-QUI01  ";"Química I";TRUE;5.7;4
 * "C-ING01   ";"Inglés I";TRUE;2.6;2
 */

        /******************* Primer modulo ************************/

        /******************* Segundo modulo ************************/

        DB::table('subjects')->insert([
            'id' => 6,
            'clv' => "C-TLR02",
            'name' => "Taller de Lectura y Redacción II",
            'module' => 2,
            'credits' => 2.6,
            'length' => 2,
            'order' => 6,
        ]);

        DB::table('subjects')->insert([
            'id' => 7,
            'clv' => "C-INF01",
            'name' => "Informática I",
            'module' => 2,
            'credits' => 2.6,
            'length' => 2,
            'order' => 7,
        ]);

        DB::table('subjects')->insert([
            'id' => 8,
            'clv' => "M-MAT02",
            'name' => "Matemáticas II",
            'module' => 2,
            'credits' => 5.2,
            'length' => 4,
            'order' => 8,
        ]);

        DB::table('subjects')->insert([
            'id' => 9,
            'clv' => "CE-QUI02",
            'name' => "Química II",
            'module' => 2,
            'credits' => 4.3,
            'length' => 3,
            'order' => 9,
        ]);

        DB::table('subjects')->insert([
            'id' => 10,
            'clv' => "C-ING02",
            'name' => "Inglés II",
            'module' => 2,
            'credits' => 2.3,
            'length' => 2,
            'order' => 10,
        ]);

        DB::table('subjects')->insert([
            'id' => 11,
            'clv' => "CE-BIO01",
            'name' => "Biología I",
            'module' => 2,
            'credits' => 4.1,
            'length' => 3,
            'order' => 11,
        ]);


        /*"C-TLR02   ";"Taller de Lectura y Redacción II";TRUE;2.6;2
         * "C-INF01   ";"Informática I";TRUE;2.6;2
         * "M-MAT02   ";"Matemáticas II";TRUE;5.2;4
         * "CE-QUI02  ";"Química II";TRUE;4.3;3
         * "C-ING02   ";"Inglés II";TRUE;2.3;2
         * "CE-BIO01  ";"Biología I";TRUE;4.1;3*/

        /******************* Segundo modulo ************************/

        /******************* Tercer modulo ************************/

        DB::table('subjects')->insert([
            'id' => 12,
            'clv' => "CS-HIS01",
            'name' => "Historia de México I",
            'module' => 3,
            'credits' => 2.3,
            'length' => 2,
            'order' => 12,
        ]);

        DB::table('subjects')->insert([
            'id' => 13,
            'clv' => "C-INF02",
            'name' => "Informática II",
            'module' => 3,
            'credits' => 2.6,
            'length' => 2,
            'order' => 13,
        ]);

        DB::table('subjects')->insert([
            'id' => 14,
            'clv' => "M-MAT03",
            'name' => "Matemáticas III",
            'module' => 3,
            'credits' => 5.2,
            'length' => 4,
            'order' => 14,
        ]);

        DB::table('subjects')->insert([
            'id' => 15,
            'clv' => "CE-FIS01",
            'name' => "Física I",
            'module' => 3,
            'credits' => 4.3,
            'length' => 3,
            'order' => 15,
        ]);

        DB::table('subjects')->insert([
            'id' => 16,
            'clv' => "C-ING03",
            'name' => "Inglés III",
            'module' => 3,
            'credits' => 2.3,
            'length' => 2,
            'order' => 16,
        ]);

        DB::table('subjects')->insert([
            'id' => 17,
            'clv' => "CE-BIO02",
            'name' => "Biología II",
            'module' => 3,
            'credits' => 4.1,
            'length' => 3,
            'order' => 17,
        ]);

        /* "CS-HIS01  ";"Historia de México I";TRUE;2.3;2
         * "C-INF02   ";"Informática II";TRUE;2.6;2
         * "M-MAT03   ";"Matemáticas III";TRUE;5.2;4
         * "CE-FIS01  ";"Física I";TRUE;4.3;3
         * "C-ING03   ";"Inglés III";TRUE;2.3;2
         * "CE-BIO02  ";"Biología II";TRUE;4.1;3*/

        /******************* Tercer modulo ************************/

        /******************* Cuarto modulo ************************/
        DB::table('subjects')->insert([
            'id' => 18,
            'clv' => "CS-HIS02",
            'name' => "Historia de México II",
            'module' => 4,
            'credits' => 2.6,
            'length' => 2,
            'order' => 18,
        ]);

        DB::table('subjects')->insert([
            'id' => 19,
            'clv' => "CS-FIL01",
            'name' => "Filosofía",
            'module' => 4,
            'credits' => 2.6,
            'length' => 2,
            'order' => 19,
        ]);

        DB::table('subjects')->insert([
            'id' => 20,
            'clv' => "M-MAT04",
            'name' => "Matemáticas IV",
            'module' => 4,
            'credits' => 3.9,
            'length' => 3,
            'order' => 20,
        ]);

        DB::table('subjects')->insert([
            'id' => 21,
            'clv' => "CE-FIS02",
            'name' => "Física II",
            'module' => 4,
            'credits' => 4.3,
            'length' => 3,
            'order' => 21,
        ]);

        DB::table('subjects')->insert([
            'id' => 22,
            'clv' => "C-ING04",
            'name' => "Inglés IV",
            'module' => 4,
            'credits' => 2.3,
            'length' => 2,
            'order' => 22,
        ]);

        DB::table('subjects')->insert([
            'id' => 23,
            'clv' => "CS-CON01",
            'name' => "Contabilidad I",
            'module' => 4,
            'credits' => 2.6,
            'length' => 2,
            'order' => 23,
        ]);

        DB::table('subjects')->insert([
            'id' => 24,
            'clv' => "C-LIT01",
            'name' => "Literatura I",
            'module' => 4,
            'credits' => 2.3,
            'length' => 2,
            'order' => 24,
        ]);

        /*
         * "CS-HIS02  ";"Historia de México II";TRUE;2.6;2
         * "CS-FIL01  ";"Filosofía";FALSE;2.6;2
         * "M-MAT04   ";"Matemáticas IV";TRUE;3.9;3
         * "CE-FIS02  ";"Física II";TRUE;4.3;3
         * "C-ING04   ";"Inglés IV";TRUE;2.3;2
         * "CS-CON01  ";"Contabilidad I";TRUE;2.6;2
         * "C-LIT01   ";"Literatura I";TRUE;2.3;2
         * */

        /******************* Cuarto modulo ************************/

        /******************* Quinto modulo ************************/
        DB::table('subjects')->insert([
            'id' => 25,
            'clv' => "M-PRO01",
            'name' => "Probabilidad y Estadística",
            'module' => 5,
            'credits' => 2.6,
            'length' => 2,
            'order' => 25,
        ]);

        DB::table('subjects')->insert([
            'id' => 26,
            'clv' => "CS-ADM01",
            'name' => "Administración",
            'module' => 5,
            'credits' => 2.6,
            'length' => 2,
            'order' => 26,
        ]);

        DB::table('subjects')->insert([
            'id' => 27,
            'clv' => "CS-HIS03",
            'name' => "Historia de Nuestro Tiempo",
            'module' => 5,
            'credits' => 2.3,
            'length' => 2,
            'order' => 27,
        ]);

        DB::table('subjects')->insert([
            'id' => 28,
            'clv' => "CS-ECO01",
            'name' => "Economía",
            'module' => 5,
            'credits' => 2.3,
            'length' => 2,
            'order' => 28,
        ]);

        DB::table('subjects')->insert([
            'id' => 29,
            'clv' => "CS-ETI01",
            'name' => "Ética y Valores",
            'module' => 5,
            'credits' => 2.6,
            'length' => 2,
            'order' => 29,
        ]);

        DB::table('subjects')->insert([
            'id' => 30,
            'clv' => "CS-HIS04",
            'name' => "Historia de Yucatán",
            'module' => 5,
            'credits' => 2.3,
            'length' => 2,
            'order' => 30,
        ]);

        DB::table('subjects')->insert([
            'id' => 31,
            'clv' => "LIT02",
            'name' => "Literatura II",
            'module' => 5,
            'credits' => 2.6,
            'length' => 2,
            'order' => 31,
        ]);

        DB::table('subjects')->insert([
            'id' => 32,
            'clv' => "CS-CON02",
            'name' => "Contabilidad II",
            'module' => 5,
            'credits' => 2.6,
            'length' => 2,
            'order' => 32,
        ]);

        /*"M-PRO01   ";"Probabilidad y Estadística";FALSE;2.6;2
         * "CS-ADM01  ";"Administración";FALSE;2.6;2
         * "CS-HIS03  ";"Historia de Nuestro Tiempo";FALSE;2.3;2
         * "CS-ECO01  ";"Economía";FALSE;2.3;2
         * "CS-ETI01  ";"Ética y Valores";FALSE;2.6;2
         * "CS-HIS04  ";"Historia de Yucatán";FALSE;2.3;2
         * "C-LIT02   ";"Literatura II";TRUE;2.6;2
         * "CS-CON02  ";"Contabilidad II";TRUE;2.6;2
         */
        /******************* Quinto modulo ************************/

        /******************* Sexto modulo ************************/

        DB::table('subjects')->insert([
            'id' => 33,
            'clv' => "CE-ECG01",
            'name' => "Ecología y Medio Ambiente",
            'module' => 6,
            'credits' => 2.6,
            'length' => 2,
            'order' => 33,
        ]);

        DB::table('subjects')->insert([
            'id' => 34,
            'clv' => "CE-MET01",
            'name' => "Metodología de la Investigación",
            'module' => 6,
            'credits' => 2.6,
            'length' => 2,
            'order' => 34,
        ]);

        DB::table('subjects')->insert([
            'id' => 35,
            'clv' => "CS-DER01",
            'name' => "Derecho",
            'module' => 6,
            'credits' => 2.6,
            'length' => 2,
            'order' => 35,
        ]);

        DB::table('subjects')->insert([
            'id' => 36,
            'clv' => "CS-PSI01",
            'name' => "Psicología",
            'module' => 6,
            'credits' => 2.3,
            'length' => 2,
            'order' => 36,
        ]);

        DB::table('subjects')->insert([
            'id' => 37,
            'clv' => "CS-INT01",
            'name' => "Introducción a las Ciencias Sociales",
            'module' => 6,
            'credits' => 2.3,
            'length' => 2,
            'order' => 37,
        ]);

        DB::table('subjects')->insert([
            'id' => 38,
            'clv' => "CE-ANA01",
            'name' => "Anatomía y Fisiología Humana",
            'module' => 6,
            'credits' => 2.6,
            'length' => 2,
            'order' => 38,
        ]);

        DB::table('subjects')->insert([
            'id' => 39,
            'clv' => "CS-EST01",
            'name' => "Estructura Socioeconómica de México",
            'module' => 6,
            'credits' => 2.6,
            'length' => 2,
            'order' => 39,
        ]);

        DB::table('subjects')->insert([
            'id' => 40,
            'clv' => "CS-INF01",
            'name' => "Informática Contable",
            'module' => 6,
            'credits' => 2.6,
            'length' => 2,
            'order' => 40,
        ]);

        /* "CE-ECG01  ";"Ecología y Medio Ambiente";FALSE;2.6;2
         * "CE-MET01  ";"Metodología de la Investigación";FALSE;2.6;2
         * "CS-DER01  ";"Derecho";FALSE;2.6;2
         * "CS-PSI01  ";"Psicología";FALSE;2.3;2
         * "CS-INT01  ";"Introducción a las Ciencias Sociales";FALSE;2.3;2
         * "CE-ANA01  ";"Anatomía y Fisiología Humana";FALSE;2.6;2
         * "CS-EST01  ";"Estructura Socioeconómica de México";FALSE;2.6;2
         * "CS-INF01  ";"Informática Contable";FALSE;2.6;2
         */
        /******************* Sexto modulo ************************/

/*
 *
 *
*/


    }
}

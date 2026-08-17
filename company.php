<?php

class Company {
    public $name;
    public $location;
    public $tot_employees;
    
    // Proprietà statiche per il tracciamento globale
    public static $counter = 0;
    public static $all_companies = [];

    // Costruttore con la firma e i nomi dei parametri del professore
    public function __construct($nome, $sede, $dipendenti = 0) {
        $this->name = $nome;
        $this->location = $sede;
        $this->tot_employees = $dipendenti;
        
        self::$counter++;
        self::$all_companies[] = $this;
    }

    // 1. Metodo del professore per confrontare due interi
    public function checkIfGreater($int1, $int2) {
        if ($int1 > $int2) {
            return true;
        }
        return false;
    }

    // 2. Metodo del professore per stampare lo stato in base a una soglia ($num)
    public function printCheckEmployees($num = 0) {
        if ($this->checkIfGreater($this->tot_employees, $num)) {
            echo "L'azienda {$this->name} con sede in {$this->location} ha ben {$this->tot_employees} dipendenti.\n";
        } else {
            echo "L'azienda {$this->name} con sede in {$this->location} non ha abbastanza dipendenti.\n";
        }
    }

    // 3. Metodo per calcolare la spesa annuale della singola azienda
    public function calculateAnnualExpense($cost_per_employee = 30000) {
        $expense = $this->tot_employees * $cost_per_employee;
        echo "L'azienda {$this->name} ha una spesa annuale di " . number_format($expense, 0, ',', '.') . " €\n";
        return $expense;
    }

    // 4. Metodo statico per calcolare e stampare la spesa totale di tutte le aziende
    public static function printAbsoluteTotal($cost_per_employee = 30000) {
        $total_expense = 0;
        foreach (self::$all_companies as $company) {
            $total_expense += $company->tot_employees * $cost_per_employee;
        }
        echo "\n--- TOTALE ASSOLUTO ---\n";
        echo "La spesa complessiva di tutte le " . self::$counter . " aziende messe insieme è di " . number_format($total_expense, 0, ',', '.') . " €\n";
    }
}

// --- Creazione delle istanze ---
$company1 = new Company('Aulab', 'Italia', 50);
$company2 = new Company('TechCorp', 'Germania', 120);
$company3 = new Company('InnoSoft', 'Spagna', 0);
$company4 = new Company('DataGlobal', 'Francia', 85);
$company5 = new Company('WebFuture', 'Portogallo', 20);

// --- Test dei metodi del professore ---
echo "=== VERIFICA DIPENDENTI (Stile Prof) ===\n";
$company1->printCheckEmployees(10); // Verifica se ha più di 10 dipendenti
$company2->printCheckEmployees(100); // Verifica se ha più di 100 dipendenti
$company3->printCheckEmployees(5);  // Verifica se ha più di 5 dipendenti

echo "\n=== SPESE ANNUALI ===\n";
$company1->calculateAnnualExpense();
$company2->calculateAnnualExpense();
$company3->calculateAnnualExpense();
$company4->calculateAnnualExpense();
$company5->calculateAnnualExpense();

// --- Test del totale assoluto ---
Company::printAbsoluteTotal();
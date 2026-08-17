<?php

class Company {
    public $name;
    public $location;
    public $tot_employees;
    
    // Contatore statico e array per tracciare le aziende create (stile del prof)
    public static $counter = 0;
    public static $all_companies = [];

    public function __construct($name, $location, $tot_employees = 0) {
        $this->name = $name;
        $this->location = $location;
        $this->tot_employees = $tot_employees;
        
        self::$counter++;
        self::$all_companies[] = $this;
    }

    // 1. Metodo per stampare lo stato dei dipendenti dell'azienda
    public function printStatus() {
        if ($this->tot_employees > 0) {
            echo "L’ufficio {$this->name} con sede in {$this->location} ha ben {$this->tot_employees} dipendenti\n";
        } else {
            echo "L’ufficio {$this->name} con sede in {$this->location} non ha dipendenti\n";
        }
    }

    // 2. Metodo che calcola la spesa annuale per l'oggetto corrente (ipotizzando ad es. 30.000€ per dipendente)
    public function calculateAnnualExpense($cost_per_employee = 30000) {
        $expense = $this->tot_employees * $cost_per_employee;
        echo "L'azienda {$this->name} ha una spesa annuale di " . number_format($expense, 0, ',', '.') . " €\n";
        return $expense;
    }

    // 3. Metodo che calcola l'insieme totale delle spese di tutte le aziende create
    public static function calculateTotalExpenses($cost_per_employee = 30000) {
        $total_expense = 0;
        foreach (self::$all_companies as $company) {
            $total_expense += $company->tot_employees * $cost_per_employee;
        }
        return $total_expense;
    }

    // 4. Metodo statico che permette di stampare a terminale il totale assoluto di tutte le aziende
    public static function printAbsoluteTotal() {
        $total = self::calculateTotalExpenses();
        echo "\n--- TOTALE ASSOLUTO ---\n";
        echo "La spesa complessiva di tutte le " . self::$counter . " aziende messe insieme è di " . number_format($total, 0, ',', '.') . " €\n";
    }
}

// --- Creazione di 5 istanze di 5 aziende diverse ---
$company1 = new Company("Aulab", "Italia", 50);
$company2 = new Company("TechCorp", "Germania", 120);
$company3 = new Company("InnoSoft", "Spagna", 0); // Test sede senza dipendenti
$company4 = new Company("DataGlobal", "Francia", 85);
$company5 = new Company("WebFuture", "Portogallo", 20);

// --- Test dei metodi ---

echo "=== STATO DEGLI UFFICI ===\n";
$company1->printStatus();
$company2->printStatus();
$company3->printStatus();
$company4->printStatus();
$company5->printStatus();

echo "\n=== SPESE ANNUALI PER AZIENDA ===\n";
$company1->calculateAnnualExpense();
$company2->calculateAnnualExpense();
$company3->calculateAnnualExpense();
$company4->calculateAnnualExpense();
$company5->calculateAnnualExpense();

// --- Chiamata del metodo statico finale ---
Company::printAbsoluteTotal();
<?php

namespace Saifkamal\Module2;

class Application{
    private $incomeArr;
    private $expenseArr;
    private $availableIncomeCat = ["job","part-time","freelancing","business"];
    private $availableExpenseCat = ["food","clothing","medicine","utilities","travel"];

    public function run() : int {
        global $argv;//Access CLI
        $this->initializeIncomeArray();//Initialize the income array
        $this->initializeExpenseArray();//Initialize the expense array
        $commandName = $argv[1] ?? null;//Basic Argument Parsing
        if ($commandName == 'simple-php-cli') {
            while(true){
                $this->showOptions();
                $choice = $this->readChoice();
                switch ($choice) {
                    case 1:
                        $this->handleOptionOne();
                        break;
                    case 2:
                        $this->handleOptionTwo();
                        break;
                    case 3:
                        $this->handleOptionThree();
                        break;
                    case 4:
                        $this->handleOptionFour();
                        break;
                    case 5:
                        $this->handleOptionFive();
                        break;
                    case 6:
                        $this->handleOptionSix();
                        break;
                    case 7:
                        $this->handleOptionSeven();
                        return 0;
                        break;
                    
                    default:
                        # code...
                        break;
                }
            }
        }else{
            $this->showHelp();
        }
        return 0;
    }

    private function showHelp() : void {
        echo "Usage: myapp <command>\n";
        echo "Avaialble Commands: \n";
        echo " test\n";
    }

    private function showOptions() : void {
        echo "Choose an Option: (Enter only the number of the option)\n";
        echo " 1. Add Income\n";
        echo " 2. Add Expense\n";
        echo " 3. View Income\n";
        echo " 4. View Expenses\n";
        echo " 5. View Savings\n";
        echo " 6. View Categories\n";
        echo " 7. Exit\n";
        echo " Enter Your Choice:\n";
    }

    private function readChoice() : int {
        $handle = fopen("php://stdin","r");//Open Standard Input(Keyboard)
        $line = fgets($handle);
        fclose($handle);
        return (int) trim($line);
    }

    private function readAdditionalInfo() : int {
        $handle = fopen("php://stdin","r");//Open Standard Input
        $line = fgets($handle);
        fclose($handle);
        return (int) trim($line);
    }

    private function handleOptionOne() : void {
        echo "Enter the amount of income in number(e.g 10000,25000,45000):\n";
        $income = $this->readAdditionalInfo();
        $this->addIncome($income);
        echo "Added your income, which is: " . $income . "\n";
    }

    private function handleOptionTwo() : void {
        echo "Enter the amount of expense in number(e.g 5000, 4500):\n";
        $expense = $this->readAdditionalInfo();
        $this->addExpense($expense);
        echo "Added your expense, which is: " . $expense . "\n";
    }

    private function handleOptionThree() : void {
        //Read File Content
        $filename = __DIR__.'/income-array.txt';
        $serializedData = file_get_contents($filename);
        //Get in Array Form
        if (filesize($filename) > 0) {
            $currentIncomeArr = unserialize($serializedData);
            //Display the list
            echo "Here's the current income list: \n";
            foreach ($currentIncomeArr as $item) {
                echo  $item ."\n";
            }
        }else{
            echo "Sorry, income list is empty\n";
        }
        echo "\n";
    }

    private function handleOptionFour() : void {
        //Read File Content
        $filename = __DIR__.'/expense-array.txt';
        $serializedData = file_get_contents($filename);
        //Get in Array Form
        if (filesize($filename) > 0) {
            $currentExpenseArr = unserialize($serializedData);
            //Display the list
            echo "Here's the current expense list: \n";
            foreach ($currentExpenseArr as $item) {
                echo  $item ."\n";
            }
        }else{
            echo "Sorry, expense list is empty\n";
        }
        echo "\n";
    }

    private function handleOptionFive() : void {
        //Read Income and Expense File Content
        $incomeFilename = __DIR__.'/income-array.txt';
        $serializedIncomeData = file_get_contents($incomeFilename);
        $expenseFileName = __DIR__.'/expense-array.txt';
        $serializedExpenseData = file_get_contents($expenseFileName);
        $sumIncome = 0;
        $sumExpense = 0;
        //Get the total income in Array Form
        if (filesize($incomeFilename) > 0) {
            $currrentIncomeArr = unserialize($serializedIncomeData);
            foreach ($currrentIncomeArr as $item) {
                $sumIncome = $sumIncome + $item;
            }
        }else{
            echo "Sorry, income list is empty, cannot give the sum\n";
        }
        //Get the total expense in Array form
        if (filesize($expenseFileName) > 0) {
            $currentExpenseArr = unserialize($serializedExpenseData);
            foreach ($currentExpenseArr as $item) {
                $sumExpense = $sumExpense + $item;
            }
        }else{
            echo "Sorry, expense list is empty, cannot give the sum\n";
        }
        //Get the total savings
        echo "The total savings is:" . ($sumIncome - $sumExpense) . "\n";
        echo "\n";
    }

    private function handleOptionSix() : void {
        //Get the file names
        $incomeCatFileName = __DIR__.'/income-categories.txt';
        $expenseCatFileName = __DIR__.'/expense-categories.txt';
        //Check if income category file is empty or not
        if (filesize($incomeCatFileName) == 0) {
            //Serialize Income Category Data
            $serializedIncomeCatData = serialize($this->availableIncomeCat);
            //Put Income Categories into file
            file_put_contents($incomeCatFileName,$serializedIncomeCatData);
        }
        //Check if expense category file is empty or not
        if (filesize($expenseCatFileName) == 0) {
            //Serialize Expense Category Data
            $serializedExpenseCatData = serialize($this->availableExpenseCat);
            //Put Expense Categories into file
            file_put_contents($expenseCatFileName,$serializedExpenseCatData);
        }
        //Display the income categories from file
        $serializedIncomeCatData = file_get_contents($incomeCatFileName);
        $unserializedIncomeCatArr = unserialize($serializedIncomeCatData);
        echo "Available Income Categories: \n";
        foreach ($unserializedIncomeCatArr as $item) {
            echo $item . "\n";
        }
        //Display the expense categories from file
        $serializedExpenseCatData = file_get_contents($expenseCatFileName);
        $unserializedExpenseCatArr = unserialize($serializedExpenseCatData);
        echo "\nAvailable Expense Categories: \n";
        foreach ($unserializedExpenseCatArr as $item) {
            echo $item . "\n";
        }
        echo "\n";
    }

    private function handleOptionSeven() : void {
        echo "Exiting the application, goodbye!\n";
    }

    private function initializeIncomeArray() : void {
        $this->incomeArr = [];
    }

    private function initializeExpenseArray() : void {
        $this->expenseArr = [];
    }

    private function addIncome($income) : void {
        //Read previous array data from file
        $filename = __DIR__.'/income-array.txt';
        $serializedData = file_get_contents($filename);
        //Get in Array form
        if (filesize($filename) > 0) {//There is data
            $previousIncomeArr = unserialize($serializedData);
            //Store the previous income array data into the $incomeArr variable
            foreach ($previousIncomeArr as $item) {
                array_push($this->incomeArr, $item);
            }
        }
        //Add the new income
        array_push($this->incomeArr, $income);
        //Serialize the updated income array
        $serializedData = serialize($this->incomeArr);
        //Put it in the file
        file_put_contents($filename,$serializedData);
    }

    private function addExpense($expense): void {
        //Read previous array data from file
        $filename = __DIR__.'/expense-array.txt';
        $serializedData = file_get_contents($filename);
        //Get in Array form
        if (filesize($filename) > 0) {//There is data
            $previousExpenseArr = unserialize($serializedData);
            //Store the previous expense array data into the $expenseArr variable
            foreach ($previousExpenseArr as $item) {
                array_push($this->expenseArr, $item);
            }
        }
        //Add the new expense
        array_push($this->expenseArr, $expense);
        //Serialize the updated expense array
        $serializedData = serialize($this->expenseArr);
        //Put it in the file
        file_put_contents($filename,$serializedData);
    }
}
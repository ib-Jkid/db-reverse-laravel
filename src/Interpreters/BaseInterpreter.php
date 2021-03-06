<?php 

namespace App\Interpreters;

use App\Actions\Action;
use App\Actions\CloseAction;
use App\Actions\ConnectDBAction;
use App\Actions\CreateMigrationAction;
use App\Actions\CreateModelAction;
use App\Actions\CreateSeederAction;
use App\Actions\GenerateCrudControllersAction;
use App\Actions\GenerateCrudRoutesAction;
use App\Actions\HelpAction;
use App\Actions\StatusAction;
use App\Exceptions\InvalidCommandException;
use App\Interactor;
use Throwable;

class BaseInterpreter implements Interpreter {

    

    public function __construct()
    {
        
    }


    public function interprete(string $statement): Action
    {
        $commands  = explode(" ",$statement);
        try {
            switch(count($commands)) {
                case 1: 
                    $execute = $commands[0];
                    
                    return $this->$execute(); 
                  
                break;
                case 2: 
                    $execute = $commands[0];
                    return $this->$execute($commands[1]);
                break;
                case 3:
                    $execute = $commands[0];
                    return $this->$execute($commands[1],$commands[2]);
                break;
                case 4:
                    $execute = $commands[0];
                    return $this->$execute($commands[1],$commands[2],$commands[3]);
                break;
                default: 
                    throw new InvalidCommandException();
                break;
            }

        }catch(Throwable $e) {
            throw new InvalidCommandException("The statement '{$statement}' is not recognized ");
        }


         

        
        

      
    }

    private function help() : Action {
      
        return new HelpAction();
    }

    private function connect() : Action {
        return new ConnectDBAction();
    }

    private function exit() : Action {
        return new CloseAction();
    }

    private function status() :  Action {
        return new StatusAction();
    }

    private function show() {

    }

    private function create(string $type, string $tableName = null) : Action {

        /** @var Action */
        $action = null;

        switch($type) {
            case "migrations": 
                $action = new CreateMigrationAction($tableName);
            break;
            
            case "seeders":
               $action = new CreateSeederAction($tableName);
            break;

            case "models": 
                $action = new CreateModelAction($tableName);
            break;

            default: 
                throw new InvalidCommandException();
            break;
        }

        return $action;
    }

    private function generate(string $subject,string $type, string $tableName = null) {
       
        switch($subject) {
            case "crud": 
                $type = "generateCrud".ucwords($type);
                return $this->$type($tableName);
            break;
            default: 
                throw new InvalidCommandException();
            break;
        }
    }

    private function generateCrudControllers(?string $tableName) {
    
        return new GenerateCrudControllersAction($tableName);
    }



}

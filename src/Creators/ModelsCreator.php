<?php 

namespace App\Creators;

use App\DataObject\Table;
use App\Exceptions\FileSystemException;
use App\Interactor;
use App\setup\Inflector;
use App\State\ConfigState;
use App\State\ConnectionState;

class ModelsCreator implements FileCreator {

    private $table;
    private $className;
    private $fileName;
    private $path;
    public function __construct() 
    {
        $this->path = ConfigState::getFileSystemConfiguration()["output_dir"]."/models";

                
        if(file_exists($this->path)) {

            array_map('unlink', glob($this->path."/*.*"));

            rmdir($this->path);
        }
      
        mkdir($this->path,0777,true);
    }

    public function setTable(Table $table) : void {

        $this->table = $table;

        $this->className = Inflector::singularize(str_replace(" ", "", ucwords(str_replace("_", " ", $table->getName()))));

        $this->fileName = $this->className.".php";

    }

    public function createFile() : void {   

        if(!$this->table) throw new FileSystemException("No table found");

        Interactor::sendMessage("Creating : {$this->fileName}");

        $this->writeToFile($this->wrapFrame($));

        Interactor::sendSucceessMessage("Created :{$this->fileName}");

    }

    private function getFillbles() : string {
        $content = "";

        foreach ($this->table->getContents() as $data) {
            $content .= "\t\t\t[\n";
                foreach ($data as $columnName=>$value) {
                    $content .=(strlen($value) > 0)?  "\t\t\t\t'" . $columnName . "' => '" . ($value) . "',\n" : 
                     "\t\t\t\t'" . $columnName . "' => null,\n";
                }
            $content .= "\t\t\t],\n";
        }

        return $content;
    }

    private function getHidden() : string  {
        return "";
    }

    private function wrapFrame($fillables,$hidden,$relationShips = "") : string {

        $properties = "".
        
        "<?php\n\n".


        "namespace App;\n\n".


        "use Illuminate\Database\Eloquent\Model;\n\n".


        "class {$this->className} extends Model {\n". 
        
            "\tprotected \$table = '{$this->table->getName()}';\n".

            "\tprotected \$fillable = [\n".
                $fillables. 
                $hidden.
                $relationShips.
            "\t];\n".

        "}\n";
      
        
        return $properties;
    }

    private function writeToFile(string $content) : void {

        file_put_contents("{$this->path}/{$this->fileName}",$content);
    }
}
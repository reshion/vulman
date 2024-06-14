<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateModelsFromJson extends Command
{
    protected $signature = 'generate:models {file}';

    protected $description = 'Generate Laravel models from a JSON file';

    public function handle()
    {
        $file = $this->argument('file');
        $modelsData = json_decode(File::get($file), true);

        foreach ($modelsData as $modelName => $modelAttributes) {
            $this->createModel($modelName, $modelAttributes);
        }

        $this->info('Models generated successfully.');
    }

    protected function createModel($modelName, $modelAttributes)
    {
        // Check if the model already exists
        if (!class_exists($modelName)) {
            // Create the model class
            $modelContent = "<?php\n\n";
            $modelContent .= "namespace App;\n\n";
            $modelContent .= "use Illuminate\Database\Eloquent\Model;\n\n";
            $modelContent .= "class {$modelName} extends Model\n";
            $modelContent .= "{\n";
            foreach ($modelAttributes['attributes'] as $attribute => $type) {
                $modelContent .= "    protected \$fillable = ['{$attribute}'];\n";
            }
            $modelContent .= "}\n";

            // Write the model file
            $modelFilePath = app_path($modelName . '.php');
            File::put($modelFilePath, $modelContent);

            $this->info("Model {$modelName} created.");
        } else {
            $this->info("Model {$modelName} already exists. Skipping.");
        }
    }
}

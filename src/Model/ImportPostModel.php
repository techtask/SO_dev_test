<?php

namespace silverorange\DevTest\Model;

use silverorange\DevTest\Model\PostModelFactory;
use silverorange\DevTest\Validation\ImportPostValidator;

class ImportPostModel
{
    public function __construct(PostModelFactory $modelFactory, ImportPostValidator $validator)
    {
        $this->modelFactory = $modelFactory;
        $this->validator = $validator;
    }

    public function importPostsFromFiles(Array $files)
    {

        $data = array("error" => false);
        $models = array();
        foreach ($files as $file) {
            $contents = @file_get_contents($file);
            if ($contents === false) {
                $data["error"] = true;
                $data["errorMessage"] = "Error reading file $file.";
                return $data;
            }

            try {
                $json = json_decode($contents);
            } catch (\Exception $e) {
                $data["error"] = true;
                $data["errorMessage"] = "Invalid json in file $file. " . $e->getMessage(); 
                return $data;
            }

            try {
                $valid = $this->validator->validatePostJSON($json);
                if ($valid === true) {
                    // Do the creation here.
                    $model = $this->modelFactory->create($json["id"], $json["title"], $json["body"], $json["modified_at"], $json["created_at"], $json["author"]);
                    $model->save();
                    $models[] = $model;
                } else {
                    $data["error"] = true;
                    $data["errorMessage"] = "Json does not specify correct parameters in file $file.";
                    return $data;
                }
            }
            catch (\Exception $e) {
                $data["error"] = true;
                $data["errorMessage"] = "Error inserting post from file $file into the database. " . $e->getMessage(); 
                return $data;
            }


        }
        $data["posts"] = $models;
        return $data;
    }
}

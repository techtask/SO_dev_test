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
            try {
                $contents = file_get_contents($file);
            } catch (\Exception $e) {
                $data["error"] = true;
                $data["errorMessage"] = "Error reading file $arg. " . $e->getMessage(); 
                return $data;
            }

            try {
                $json = json_decode($contents);
            } catch (\Exception $e) {
                $data["error"] = true;
                $data["errorMessage"] = "Invalid json in file $arg. " . $e->getMessage(); 
                return $data;
            }

            try {
                $valid = $this->importValidator->validatePostJSON($json);
                if ($valid === true) {
                    // Do the creation here.
                    $model = $this->modelFactory->create($json["id"], $json["title"], $json["body"], $json["modified_at"], $json["created_at"], $json["author"]);
                    $model->save();
                } else {
                    $data["error"] = true;
                    $data["errorMessage"] = "Json does not specify correct parameters in file $arg. " . $e->getMessage(); 
                    return $data;
                }
            }
            catch (\Exception $e) {
                $data["error"] = true;
                $data["errorMessage"] = "Error inserting post from file $arg into the database. " . $e->getMessage(); 
                return $data;
            }


        }
        $data["postIds"] = $ids;
        return $data;
    }
}

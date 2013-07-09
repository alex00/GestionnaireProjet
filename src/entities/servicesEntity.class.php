<?php

use Components\SQLEntities\TzSQL;
use Components\DebugTools\DebugTool;

class servicesEntity {

    private $service_id;
    private $service_name;
    private $service_code;
    private $project_id;
    private $relations = array();

    /*     * ******************** GETTER ********************** */

    public function getService_id() {
        return $this->service_id;
    }

    public function getService_name() {
        return $this->service_name;
    }

    public function getService_code() {
        return $this->service_code;
    }

    public function getProject_id() {
        return $this->project_id;
    }

    /*     * ******************** SETTER ********************** */

    public function setService_id($val) {
        $this->service_id = $val;
    }

    public function setService_name($val) {
        $this->service_name = $val;
    }

    public function setService_code($val) {
        $this->service_code = $val;
    }

    public function setProject_id($val) {
        $this->project_id = $val;
    }

    /*     * ******************** Delete ********************** */

    public function Delete() {

        if (!empty($this->service_id)) {

            $sql = "DELETE FROM services WHERE service_id = " . intval($this->service_id) . ";";

            $result = TzSQL::getPDO()->prepare($sql);
            $result->execute();

            return $result;
        } else {
            DebugTool::$error->catchError(array('Fail delete', __FILE__, __LINE__, true));
            return false;
        }
    }

    /*     * ******************** Update ********************** */

    public function Update() {

        $sql = 'UPDATE `services` SET `service_id` = "' . $this->service_id . '", `service_name` = "' . $this->service_name . '", `service_code` = "' . $this->service_code . '", `project_id` = "' . $this->project_id . '" WHERE service_id = ' . intval($this->service_id);

        $result = TzSQL::getPDO()->prepare($sql);
        $result->execute();

        if (!empty($this->service_id)) {
            if ($result)
                return true;
            else {
                DebugTool::$error->catchError(array('Fail update', __FILE__, __LINE__, true));
                return false;
            }
        } else {
            DebugTool::$error->catchError(array('Fail update: primkey is null', __FILE__, __LINE__, true));
            return false;
        }
    }

    /*     * ******************** Insert ********************** */

    public function Insert() {

        $this->service_id = '';

        $sql = 'INSERT INTO services (`service_id`,`service_name`,`service_code`,`project_id`) VALUES ("' . $this->service_id . '","' . $this->service_name . '","' . $this->service_code . '","' . $this->project_id . '")';

        $result = TzSQL::getPDO()->prepare($sql);
        $result->execute();

        if ($result) {
            $lastid = TzSQL::getPDO()->lastInsertId();
            $this->service_id = $lastid;
            return true;
        } else {
            DebugTool::$error->catchError(array('Fail insert', __FILE__, __LINE__, true));
            return false;
        }
    }

    /*     * ******************** FindAll ********************** */

    public function findAll($recursif = 'yes') {

        $sql = 'SELECT * FROM services';
        $result = TzSQL::getPDO()->prepare($sql);
        $result->execute();
        $formatResult = $result->fetchAll(PDO::FETCH_ASSOC);
        $entitiesArray = array();

        foreach ($formatResult as $key => $data) {

            $tmpInstance = new servicesEntity();

            foreach ($data as $k => $value) {

                $method = 'set' . ucfirst($k);
                $tmpInstance->$method($value);

                if ($recursif == null) {
                    foreach ($this->relations as $relationId => $relationLinks) {
                        if (array_key_exists($k, $relationLinks)) {
                            $entity = tzSQL::getEntity($relationId);
                            $content = $entity->findManyBy($relationLinks[$k], $value, 'no');
                            $tmpInstance->$relationId = $content;
                        }
                    }
                }
            }
            array_push($entitiesArray, $tmpInstance);
        }

        if (!empty($entitiesArray))
            return $entitiesArray;
        else {
            DebugTool::$error->catchError(array('No results', __FILE__, __LINE__, true));
            return false;
        }
    }

    /*     * *********** FindOneBy(column, value) ************** */

    public function findOneBy($param, $value) {


        switch ($param) {

            case $param == 'service_id':
                $param = 'service_id';
                break;

            case $param == 'service_name':
                $param = 'service_name';
                break;

            case $param == 'service_code':
                $param = 'service_code';
                break;

            case $param == 'project_id':
                $param = 'project_id';
                break;

            default:
                DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__, __LINE__, true));
                return false;
        }

        $sql = 'SELECT * FROM services WHERE ' . $param . ' = "' . $value . '"';
        $data = TzSQL::getPDO()->prepare($sql);
        $data->execute();
        $result = $data->fetch(PDO::FETCH_OBJ);

        if (!empty($result)) {
            $this->service_id = $result->service_id;
            $this->service_name = $result->service_name;
            $this->service_code = $result->service_code;
            $this->project_id = $result->project_id;

            return true;
        } else {
            DebugTool::$error->catchError(array('Result is null', __FILE__, __LINE__, true));
            return false;
        }
    }

    /*     * ******************** Find(id) ********************** */

    public function find($id) {

        $sql = 'SELECT * FROM services WHERE service_id = ' . $id;
        $result = TzSQL::getPDO()->prepare($sql);
        $result->execute();
        $formatResult = $result->fetch(PDO::FETCH_OBJ);
        if (!empty($formatResult)) {
            $this->service_id = $formatResult->service_id;
            $this->service_name = $formatResult->service_name;
            $this->service_code = $formatResult->service_code;
            $this->project_id = $formatResult->project_id;

            return true;
        } else {
            DebugTool::$error->catchError(array('Result is null', __FILE__, __LINE__, true));
            return false;
        }
    }

    /*     * *********** FindManyBy(column, value) ************** */

    public function findManyBy($param, $value, $recursif = 'yes') {


        switch ($param) {

            case $param == 'service_id':
                $param = 'service_id';
                break;

            case $param == 'service_name':
                $param = 'service_name';
                break;

            case $param == 'service_code':
                $param = 'service_code';
                break;

            case $param == 'project_id':
                $param = 'project_id';
                break;

            default:
                DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__, __LINE__, true));
                return false;
        }

        $sql = 'SELECT * FROM services WHERE ' . $param . ' = "' . $value . '"';
        $data = TzSQL::getPDO()->prepare($sql);
        $data->execute();
        $formatResult = $data->fetchAll(PDO::FETCH_ASSOC);
        $entitiesArray = array();

        if (!empty($formatResult)) {

            foreach ($formatResult as $key => $data) {

                $tmpInstance = new servicesEntity();

                foreach ($data as $k => $value) {

                    $method = 'set' . ucfirst($k);
                    $tmpInstance->$method($value);

                    if ($recursif == 'yes') {
                        foreach ($this->relations as $relationId => $relationLinks) {
                            if (array_key_exists($k, $relationLinks)) {
                                $entity = tzSQL::getEntity($relationId);
                                $content = $entity->findManyBy($relationLinks[$k], $value, 'no');
                                $tmpInstance->$relationId = $content;
                            }
                        }
                    }
                }
                array_push($entitiesArray, $tmpInstance);
            }

            if ($entitiesArray)
                return $entitiesArray;
            else {
                DebugTool::$error->catchError(array('Result is null', __FILE__, __LINE__, true));
                return false;
            }
        }
    }

    public function getIdForAddMember($projectid) {

        $sql = 'SELECT * FROM services WHERE service_code = "not-affiliated" AND project_id = '.$projectid;
        $data = TzSQL::getPDO()->prepare($sql);
        $data->execute();
        $formatResult = $data->fetchAll(PDO::FETCH_ASSOC);

        
        $entitiesArray = array();

        foreach ($formatResult as $value) {
            array_push($entitiesArray, $value);
        }
        
        return $entitiesArray[0]['service_id'];
    }

}

?>
					
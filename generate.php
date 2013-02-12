<?php
error_reporting(E_ALL);
ini_set('display_errors','On');
define('ROOT_PATH', dirname(__FILE__));
ini_set('include_path', ROOT_PATH . '/lib');

require_once('Doctrine/Doctrine.php');
spl_autoload_register(array('Doctrine', 'autoload'));
$manager = Doctrine_Manager::getInstance();
//$conn = Doctrine_Manager::connection('mysql://db_user:Yj7CWLC567KtL2o@localhost/city');
$conn = Doctrine_Manager::connection('mysql://root:@localhost/winmaweb');

$profiler = new Doctrine_Connection_Profiler();
$conn->setListener($profiler);

$conn->setCharset('utf8');

$manager->setAttribute(Doctrine_Core::ATTR_AUTO_ACCESSOR_OVERRIDE, true);

Doctrine_Core::loadModels(ROOT_PATH . '/models/generated');
Doctrine_Core::loadModels(ROOT_PATH . '/models');
Doctrine_Core::loadModels(ROOT_PATH . '/DQ');

set_time_limit(100); 
Doctrine_Core::dropDatabases();
Doctrine_Core::createDatabases();
Doctrine_Core::generateModelsFromYaml(dirname(__FILE__) . '/schema.yml', 'models');
Doctrine_Core::createTablesFromModels(dirname(__FILE__) . '/models');

Doctrine_Core::loadData(dirname(__FILE__) . '/fixtures');

$mFunc = "
        CREATE FUNCTION `hierarchy_connect_by_parent_eq_prior_id_with_level`(`value` INT, `maxlevel` INT)
            RETURNS int(11)
            LANGUAGE SQL
            NOT DETERMINISTIC
            READS SQL DATA
            SQL SECURITY DEFINER
            COMMENT ''
        BEGIN
            DECLARE _id INT;
            DECLARE _parent INT;
            DECLARE _next INT;
            DECLARE _i INT;
            DECLARE CONTINUE HANDLER FOR NOT FOUND SET @id = NULL;

            SET _parent = @id;
            SET _id = -1;
            SET _i = 0;

            IF @id IS NULL THEN
                    RETURN NULL;
            END IF;

            LOOP
                    SELECT  MIN(id)
                    INTO    @id
                    FROM    user
                    WHERE   parent_id = _parent
                            AND id > _id
                            AND COALESCE(@level < maxlevel, TRUE);
                    IF @id IS NOT NULL OR _parent = @start_with THEN
                            SET @level = @level + 1;
                            RETURN @id;
                    END IF;
                    SET @level := @level - 1;
                    SELECT  id, parent_id
                    INTO    _id, _parent
                    FROM    user
                    WHERE   id = _parent;
                    SET _i = _i + 1;
            END LOOP;
            RETURN NULL;
        END";

$conn->execute($mFunc);

$mFunc2 = "
            CREATE FUNCTION `hierarchy_sys_connect_by_path`(`delimiter` TEXT, `node` INT)
                    RETURNS text
                    LANGUAGE SQL
                    NOT DETERMINISTIC
                    READS SQL DATA
                    SQL SECURITY DEFINER
                    COMMENT ''
            BEGIN
                 DECLARE _path TEXT;
             DECLARE _cpath TEXT;
                    DECLARE _id INT;
                DECLARE EXIT HANDLER FOR NOT FOUND RETURN _path;
                SET _id = COALESCE(node, @id);
                  SET _path = _id;
                LOOP
                            SELECT  parent_id
                          INTO    _id
                     FROM    user
                     WHERE   id = _id
                                AND COALESCE(id <> @start_with, TRUE);
                          SET _path = CONCAT(_id, delimiter, _path);
              END LOOP;
            END";

$conn->execute($mFunc2);